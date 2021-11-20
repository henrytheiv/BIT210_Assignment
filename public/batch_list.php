<?php

require_once "../app/app.php";


if (is_post()) {


    $output = "";


    $centreName = $_POST['centreName'];

    // Retrieve all batches belong to the healthcare centre
    $getBatchesSql = $pdo->prepare("SELECT * FROM batches WHERE centreName = :centreName");
    $getBatchesSql->bindValue(":centreName", $centreName);
    $getBatchesSql->execute();
    $batches = $getBatchesSql->fetchAll(PDO::FETCH_ASSOC);

    $batchRow = "";

    foreach ($batches as $batch) {
        $batchRow = $batchRow .
            '<tr>
                <td>' . $batch['batchNo'] . '</td>
                <td>' . $batch['expiryDate'] . '</td>
                <td>' . $batch['quantityAvailable'] . '</td>
                <td><i class="fas fa-plus-square fa-2x" id="'.$batch['batchNo'].'" data-bs-target="#appointmentForm" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="viewAppointmentForm(this.id)"></td>
            </tr>';
    }


    $output = '<div class="scrollable">
        <table class="table table-hover p-0">
        <thead>
          <tr>
            <th scope="col">Batch No.</th>
            <th scope="col">Expiry Date</th>
            <th scope="col">Quantity Available</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>' . $batchRow . '

        </tbody>
      </table>

      </div>';



    echo $output;
}
