<?php

require_once "../app/app.php";


session_start();

if (is_post()) {

    $output = "";


    $vaccineID = $_POST['vaccineID'];
    $_SESSION['vaccineID'] = $vaccineID;

    // Fetch the selected vaccine's details from the database
    $statement = $pdo->prepare("SELECT * FROM vaccines WHERE vaccineID = :vaccineID");
    $statement->bindValue(':vaccineID', $vaccineID);
    $statement->execute();
    $vaccine = $statement->fetch();

    $output = "<p><strong>Vaccine Name: </strong>" . $vaccine['vaccineName'] . "</p>
    <p><strong>Manufacturer: </strong>" . $vaccine['manufacturer'] . "</p>";

    echo $output;
}
