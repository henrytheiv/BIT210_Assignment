<?php

require_once '../../app/app.php';


if (is_post()) {


    //collect values from a form with method="post"
    $username = $_POST['adminUsername'];
    $password = $_POST['adminPassword'];
    $email = $_POST['adminEmail'];
    $fullName = $_POST['adminFullname'];
    $staffID = $_POST['adminStaffid'];
    $centreName = $_POST['admincentreName'];

    $success = '';

    $wrong_admin_username = '';
    $wrong_admin_password = '';
    $wrong_admin_email = '';
    $wrong_admin_fullname = '';
    $wrong_admin_staffID = '';
    $wrong_admin_centreName = '';

    //prevent duplicate username 
    $findExistingAdminSQL = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
    $findExistingAdminSQL->bindValue(':username', $username);
    $findExistingAdminSQL->execute();
    $result = $findExistingAdminSQL->rowCount();

    //prevent duplicate email
    $findExistingEmailSQL = $pdo->prepare("SELECT * FROM admins WHERE email = :email");
    $findExistingEmailSQL->bindValue(':email', $email);
    $findExistingEmailSQL->execute();
    $result1 = $findExistingEmailSQL->rowCount();

    //validation for username
    if (empty($username)) {
        $wrong_admin_username = 'blankAdminUsername';
    } else {
        if ($result > 0) {
            $wrong_admin_username = 'usedAdminUsername';
        }
    }

    //validation for password (min 6 chars, min 1 Uppercase, min 1 number)
    if (empty($password)) {
        $wrong_admin_password = 'blankAdminPassword';
    } else {
        if ($password < 6 || !preg_match('@[A-Z]@', $password) || !preg_match('@[0-9]@', $password)) {
            $wrong_admin_password = 'invalidAdminPassword';
        }
    }

    //validation for email
    if (empty($email)) {
        $wrong_admin_email = 'blankAdminEmail';
    } else {
        if ($result1 > 0) {
            $wrong_admin_email = 'usedAdminEmail';
        }
    }

    //validation for full name
    if (empty($fullName)) {
        $wrong_admin_fullname = 'blankAdminFullname';
    }

    //validation for staff ID
    if (empty($staffID)) {
        $wrong_admin_staffID = 'blankAdminstaffId';
    }

    //validation for centre name
    // if (empty($centreName)) {
    //     $wrong_admin_centreName = 'blankAdmincentreName';
    // }

    //if all the data entered is validate then store user data into database
    if (
        $wrong_admin_username == '' && $wrong_admin_password == ''
        && $wrong_admin_email == '' && $wrong_admin_fullname == ''
        && $wrong_admin_staffID == '' 
    ) {

        $data = array(
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':fullName' => $fullName,
            ':staffID' => $staffID,
            ':centreName' => $centreName
        );

        //pass data into dahvax database with table name admins 
        $statement = $pdo->prepare("INSERT INTO admins (username, password, email, fullName, staffID, centreName) VALUES (:username, :password, :email, :fullName, :staffID, :centreName)");

        $statement->execute($data);

        $success = 'Sign Up successfully!';
    }

    $output = array(
        'success' => $success,
        'wrong_admin_username'  =>  $wrong_admin_username,
        'wrong_admin_password'  =>  $wrong_admin_password,
        'wrong_admin_email'  =>  $wrong_admin_email,
        'wrong_admin_fullname'  =>  $wrong_admin_fullname,
        'wrong_admin_staffID'  =>  $wrong_admin_staffID
      
    );

    // converts PHP arrays into JavaScript
    echo json_encode($output);
}
