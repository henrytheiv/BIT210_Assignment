<?php

require_once "../../app/app.php";


if (is_post()) {


    //collect values from a form with method="post"
    $centreName = $_POST['centreName'];
    $address = $_POST['centreAddress'];

    $success = '';

    $wrong_centrename = '';
    $wrong_address = '';

    //prevent duplicate centre name 
    $findExistingcentreSQL = $pdo->prepare("SELECT * FROM healthcarecentres WHERE centreName = :centreName");
    $findExistingcentreSQL->bindValue(':centreName', $centreName);
    $findExistingcentreSQL->execute();
    $result = $findExistingcentreSQL->rowCount();

    //validation for centre name
    if (empty($centreName)) {
        $wrong_centrename = 'blankCentreName';
    } else {
        if ($result > 0) {
            $wrong_centrename = 'usedCentreName';
        }
    }

    //validation for address
    if (empty($address)) {
        $wrong_address = 'blankAddress';
    }


    //if all the data entered is validate then store user data into database
    if (
        $wrong_centrename == '' && $wrong_address == ''
    ) {

        $data = array(
            ':centreName' => $centreName,
            ':address' => $address

        );

        //pass data into dahvax database with table name healthcarecentres 
        $statement = $pdo->prepare("INSERT INTO healthcarecentres (centreName, address) VALUES (:centreName, :address)");

        $statement->execute($data);

        $success = 'Added successfully!';
    }

    $output = array(
        'success' => $success,
        'wrong_centrename'  =>  $wrong_centrename,
        'wrong_address'  =>  $wrong_address
        
    );

    // converts PHP arrays into JavaScript
    echo json_encode($output);
}
