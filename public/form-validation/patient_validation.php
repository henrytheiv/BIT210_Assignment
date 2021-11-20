<?php

require_once "../../app/app.php";


if (is_post()) {

    //call databse.php
    require_once '../../app/database.php';

    //collect values from a form with method="post"
    $username = $_POST['patientUsername'];
    $password = $_POST['patientPassword'];
    $email = $_POST['patientEmail'];
    $fullName = $_POST['patientFullname'];
    $ICPassport = $_POST['patientIcpassport'];

    $success = '';

    $wrong_patient_username = '';
    $wrong_patient_password = '';
    $wrong_patient_email = '';
    $wrong_patient_fullname = '';
    $wrong_patient_Icpassport = '';

    //prevent duplicate username 
    $findExistingPatientSQL = $pdo->prepare("SELECT * FROM patients WHERE username = :username");
    $findExistingPatientSQL->bindValue(':username', $username);
    $findExistingPatientSQL->execute();
    $result = $findExistingPatientSQL->rowCount();

    //prevent duplicate username 
    $findExistingEmailSQL = $pdo->prepare("SELECT * FROM patients WHERE email = :email");
    $findExistingEmailSQL->bindValue(':email', $email);
    $findExistingEmailSQL->execute();
    $result1 = $findExistingEmailSQL->rowCount();

    //validation for username
    if (empty($username)) {
        $wrong_patient_username = 'blankPatientUsername';
    } else {
        if ($result > 0) {
            $wrong_patient_username = 'usedPatientUsername';
        }
    }

    //validation for password (min 6 chars, min 1 Uppercase, min 1 number)
    if (empty($password)) {
        $wrong_patient_password = 'blankPatientPassword';
    } else {
        if (strlen($password) < 6) {
            $wrong_patient_password = 'invalidPatientPassword';
        }
    }

    //validation for email
    if (empty($email)) {
        $wrong_patient_email = 'blankPatientEmail';
    } else {
        if ($result1 > 0) {
            $wrong_patient_email = 'usedPatientEmail';
        }
    }

    //validation for full name
    if (empty($fullName)) {
        $wrong_patient_fullname = 'blankPatientFullname';
    }

    //validation for icpassport
    if (empty($ICPassport)) {
        $wrong_patient_Icpassport = 'blankPatientIcpassport';
    }


    //if all the data entered is validate then store user data into database
    if (
        $wrong_patient_username == '' && $wrong_patient_password == ''
        && $wrong_patient_email == '' && $wrong_patient_fullname == ''
        && $wrong_patient_Icpassport == ''
    ) {

        $data = array(
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':fullName' => $fullName,
            ':ICPassport' => $ICPassport
        );

        //pass data into dahvax database with table name patients 
        $statement = $pdo->prepare("INSERT INTO patients (username, password, email, fullName, ICPassport) VALUES (:username, :password, :email, :fullName, :ICPassport)");

        $statement->execute($data);

        $success = 'Sign Up successfully!';
    }

    $output = array(
        'success' => $success,
        'wrong_patient_username'  =>  $wrong_patient_username,
        'wrong_patient_password'  =>  $wrong_patient_password,
        'wrong_patient_email'  =>  $wrong_patient_email,
        'wrong_patient_fullname'  =>  $wrong_patient_fullname,
        'wrong_patient_Icpassport'  =>  $wrong_patient_Icpassport

    );

    // converts PHP arrays into JavaScript
    echo json_encode($output);
}
