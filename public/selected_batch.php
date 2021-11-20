<?php

require_once "../app/app.php";


if (is_post()) {

    session_start();

    $output = "";

    $batchNo = $_POST['batchNo'];
    $_SESSION['batchNo'] = $batchNo;

    // Fetch the selected batch's details from the database
    $statement = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
    $statement->bindValue(':batchNo', $batchNo);
    $statement->execute();
    $batch = $statement->fetch();

    $output = "<p><strong>Batch No:</strong> " . $batch['batchNo'] . "</p>
                <p><strong>Expiry Date:</strong> " . $batch['expiryDate'] . "</p>
                <p><strong>Quantity Available:</strong> " . $batch['quantityAvailable'] . "</p>
                <p><strong>Quantity Pending:</strong> " . $batch['quantityPending'] . "</p>
                <p><strong>Quantity Administered:</strong> " . $batch['quantityAdministered'] . "</p>";

    echo $output;
}
