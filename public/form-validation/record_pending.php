<?php

require_once '../../app/app.php';


if (is_post()) {

    $vaccinationID = $_POST['vaccinationID'];
    $status = $_POST['status'];
    $batchNo = $_POST['batchNo'];

    if (empty(trim($_POST['remarks']))) {
        $remarks = "-";
    } else {
        $remarks = $_POST['remarks'];
    }

    $getBatchQuantitySql = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
    $getBatchQuantitySql->bindValue(":batchNo", $batchNo);
    $getBatchQuantitySql->execute();
    $batch = $getBatchQuantitySql->fetch();

    $quantityPending = $batch['quantityPending'];
    $quantityAvailable = $batch['quantityAvailable'];


    
    if ($status === 'Confirmed') {
        // update SQL to update the status from 'Pending' to 'Confirm'
        $updateToConfirmSql = $pdo->prepare("UPDATE vaccinations SET status='Confirmed', 
    remarks = :remarks WHERE vaccinationID = :vaccinationID");
        $updateToConfirmSql->execute(array(
            ':remarks' => $remarks,
            ':vaccinationID' => $vaccinationID
        ));
    }

    else {
        // update SQL to update the status from 'Pending' to 'Reject'
        $updateToRejectedSql = $pdo->prepare("UPDATE vaccinations SET status='Rejected', 
    remarks = :remarks WHERE vaccinationID = :vaccinationID");
        $updateToRejectedSql->execute(array(
            ':remarks' => $remarks,
            ':vaccinationID' => $vaccinationID
        ));

        // upadate the quantity of pending and quantity of available in the batch
        $updateQuantityRejectedSql = $pdo->prepare("UPDATE batches SET quantityPending = :quantityPending, 
    quantityAvailable = :quantityAvailable WHERE batchNo = :batchNo");
        $updateQuantityRejectedSql->execute(array(
            ':quantityPending' => $quantityPending - 1,
            ':quantityAvailable' => $quantityAvailable + 1,
            ':batchNo' => $batchNo
        ));
        

    }
}
