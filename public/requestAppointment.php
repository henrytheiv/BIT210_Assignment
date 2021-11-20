<?php

require '../app/app.php';

if (is_post()) {


    $username = $_POST['username'];
    $batchNo = $_POST['batchNo'];
    $appointmentDate = $_POST['appointmentDate'];
    $status = "Pending";
    $remarks = "-";

    $data = array(

        ':appointmentDate' => $appointmentDate,
        ':status' => $status,
        ':remarks' => $remarks,
        ':username' => $username,
        ':batchNo' => $batchNo

    );



    $requestSql = $pdo->prepare("INSERT INTO vaccinations (appointmentDate, status, remarks, username, batchNo) 
    VALUES (:appointmentDate, :status, :remarks, :username, :batchNo)");
    $requestSql->execute($data);





    $getBatchSql = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
    $getBatchSql->bindValue(':batchNo', $batchNo);
    $getBatchSql->execute();
    $batch = $getBatchSql->fetch();

    $newQuantityPending = $batch['quantityPending'] + 1;
    $newQuantityAvailable = $batch['quantityAvailable'] - 1;



    $updateBatchSql = $pdo->prepare("UPDATE batches SET quantityPending = :quantityPending, 
            quantityAvailable = :quantityAvailable WHERE batchNo = :batchNo");
    $updateBatchSql->execute(array(
        ':quantityPending' => $newQuantityPending,
        ':quantityAvailable' => $newQuantityAvailable,
        ':batchNo' => $batchNo
    ));
}