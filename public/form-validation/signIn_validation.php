<?php

session_start();

require_once '../../app/app.php';


if (is_post()) {


    // Retrieve the data from 'POST' method
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = '';

    $success = '';

    $wrong_username = '';
    $wrong_password = '';

    // Check if username has been used
    $findPatientSQL = $pdo->prepare("SELECT * FROM patients WHERE username = :username");
    $findPatientSQL->bindValue(':username', $username);
    $findPatientSQL->execute();
    $patientResult = $findPatientSQL->rowCount();

    $findAdminSQL = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
    $findAdminSQL->bindValue(':username', $username);
    $findAdminSQL->execute();
    $adminResult = $findAdminSQL->rowCount();

    if (empty(trim($username))) {

        $wrong_username = 'blankUsername';
    }


    if (empty(trim($password))) {
        $wrong_password = 'blankPassword';
    }

    if (!empty(trim($username)) && !empty(trim($password))) {


        if ($patientResult == 0 && $adminResult == 0) {

            $wrong_username = 'invalidUsername';
            $wrong_password = 'invalidPassword';
        } else {

            if ($patientResult > 0) {

                $wrong_username = '';
                $patient = $findPatientSQL->fetch();

                if ($password == $patient['password']) {

                    $wrong_password = '';
                    $success = 'successPatient';
                    $user = $patient['username'];

                } else {

                    $wrong_password = 'invalidPassword';
                }
            } else {

                $wrong_username = '';
                $admin = $findAdminSQL->fetch();

                if ($password == $admin['password']) {

                    $wrong_password = '';
                    $success = 'successAdmin';
                    $user = $admin['username'];

                } else {

                    $wrong_password = 'invalidPassword';
                }
            }
        }
    }

    // Start a sesion for the user
    $_SESSION['user'] = $user;



    $output = array(

        'success' => $success,
        'wrong_username' => $wrong_username,
        'wrong_password' => $wrong_password
    );

    echo json_encode($output);


}




