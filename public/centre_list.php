<?php

require_once "../app/app.php";


if (is_post()) {


  $output = "";


  $vaccineID = $_POST['vaccineID'];

  $getBatchesSql = $pdo->prepare("SELECT * FROM batches WHERE vaccineID = :vaccineID");
  $getBatchesSql->bindValue(":vaccineID", $vaccineID);
  $getBatchesSql->execute();
  $batches = $getBatchesSql->fetchAll(PDO::FETCH_ASSOC);

  if (count($batches) > 0) {

    $centreRow = "";

    foreach ($batches as $batch) {

      // $getCentreSql = $pdo->prepare("SELECT * FROM healthcarecentres WHERE centreName = :centreName");
      // $getCentreSql->bindValue(":centreName", $batch['centreName']);
      // $getCentreSql->execute();
      // $centre= $getCentreSql->fetch();

      $getCentresSql = $pdo->prepare("SELECT * FROM healthcarecentres WHERE centreName = :centreName GROUP BY centreName and address");
      $getCentresSql->bindValue(":centreName", $batch['centreName']);
      $getCentresSql->execute();
      $centres = $getCentresSql->fetchAll(PDO::FETCH_ASSOC);

      for ($i = 0; $i < count($centres); $i++) {

        $currentCentreName = $centres[$i]['centreName'];

        // if ($currentCentreName !== ) {

          $centreRow = $centreRow .
            '<tr>
      <td>' . $centres[$i]['centreName'] . '</td>
      <td>' . $centres[$i]['address'] . '</td>
      <td><i class="fas fa-plus-square fa-2x" id="' . $centres[$i]['centreName'] . '" data-bs-target="#viewBatches" data-bs-toggle="modal" data-bs-dismiss="modal" onclick="viewBatches(this.id)"></i></td>
      </tr>';
        // }
      }
    }


    $output = '<div class="scrollable">
        <table class="table table-hover p-0">
        <thead>
          <tr>
            <th scope="col">Centre Name</th>
            <th scope="col">Address</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>' . $centreRow . '

        </tbody>
      </table>

      </div>';
  } else {

    $output = "<h3 class='p-5 text-center'>No centres offering this vaccine</h3>";
  }


  echo $output;
}
