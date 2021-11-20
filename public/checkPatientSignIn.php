<?php

// This PHP file is to check whether an patient has signed in


if ($_SESSION['user'] == null) {

    redirect("index.php");
} else {

    $findPatientSql = $pdo->prepare("SELECT * FROM patients WHERE username = :username");
    $findPatientSql->bindValue(":username", $_SESSION['user']);
    $findPatientSql->execute();
    $result = $findPatientSql->rowCount();

    if (!$result > 0) {

        redirect("AdminMenu.php");
    }
}
