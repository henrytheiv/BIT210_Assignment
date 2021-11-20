<?php

require_once "../app/app.php";


if (is_post()) {


  $output = "";

  $vaccinationID = $_POST['vaccinationID'];


  $findVaccinationSql = $pdo->prepare("SELECT * FROM vaccinations WHERE vaccinationID = :vaccinationID");
  $findVaccinationSql->bindValue(":vaccinationID", $vaccinationID);
  $findVaccinationSql->execute();
  $vaccination = $findVaccinationSql->fetch();

  $findPatientSql = $pdo->prepare("SELECT * FROM patients WHERE username = :username");
  $findPatientSql->bindValue(":username", $vaccination['username']);
  $findPatientSql->execute();
  $patient = $findPatientSql->fetch();

  $findBatchSql = $pdo->prepare("SELECT * FROM batches WHERE batchNo = :batchNo");
  $findBatchSql->bindValue(":batchNo", $vaccination['batchNo']);
  $findBatchSql->execute();
  $batch = $findBatchSql->fetch();

  $findVaccineSql = $pdo->prepare("SELECT * FROM vaccines WHERE vaccineID = :vaccineID");
  $findVaccineSql->bindValue(":vaccineID", $batch['vaccineID']);
  $findVaccineSql->execute();
  $vaccine = $findVaccineSql->fetch();

  // if status is pending then show 2 radio button reject/confirm and remarks textfeild 
  if ($vaccination['status'] === 'Pending') {

    $updateStatusForm = "<p>" . $vaccination['status'] . "
    <i class='fas fa-edit fa-lg' onclick='inputRemarks()'></i>
</p>
<span class='type' id='enterRemark'>
<form id='form' action=''>
    <div class='form-control'>
      <input type='text' value='" . $vaccination['vaccinationID'] . "' name='vaccinationID' class='form-data d-none'/>

      <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='status' value='Rejected'>
        <label class='form-check-label' >Reject</label>
      </div>

      <div class='form-check form-check-inline'>
        <input class='form-check-input' type='radio' name='status' value='Confirmed'>
        <label class='form-check-label' >Confirm</label>
      </div>

      <input type='text' value='" . $batch['batchNo'] . "' name='batchNo' class='form-data d-none'/>
      <br>
      <label for='remark'>Remarks:</label>
      <input type='text' placeholder='Any remarks?' name='remarks' class='form-data'/>
    </div>
  </form>
  <button type='button' name='submit' id='submit'  onclick='updateFromPending(); return false;'>Update</button>
    </span>
  </div>";

  // if status is rejected 
  } else if ($vaccination['status'] === "Rejected") {
    $updateStatusForm = "<p>" . $vaccination['status'] . "</p><p>Remarks: " . $vaccination['remarks'] . "</p>";

  // if status is administered 
  } else if ($vaccination['status'] === "Administered") {
    $updateStatusForm = "<p>" . $vaccination['status'] . "</p><p>Remarks: " . $vaccination['remarks'] . "</p>";

  // if status is confirm then show remarks textfield
  } else {
    $updateStatusForm = "<p>" . $vaccination['status'] . "
    <i class='fas fa-edit fa-lg' onclick='inputRemarks()'></i>
</p>
<span class='type' id='enterRemark'>
<form id='form' class='validation-form'>
  <input type='hidden' value='" . $vaccinationID . "' name='vaccinationID' id='vaccinationID' class='form_data' />
  <input type='hidden' value='" . $vaccination['status'] . "' name='status' id='status' class='form_data' />
  <input type='hidden' value='" . $batch['batchNo'] . "' name='batchNo' id='batchNo' class='form_data' />
  <div class='form-control'>
    <label for='remarks'>Remarks:</label>
    <input type='text' placeholder='Any remarks?' name='remarks' id='remarks' class='form_data' />
  </div>
  <button type='button' name='submit' id='submit' onclick='updateToAdministered(); return false;'>Update</button>
</form>
    </span>
  </div>";  
  }

  $output = "
    <div class='row'>
    <div class='col'>
      <div class='information'>
        <h3 class='header'>Patient details:</h3>
        <p><strong>Full Name: </strong>" . $patient['fullName'] . "</p>
        <p><strong>IC/ Passport: </strong>" . $patient['ICPassport'] . "</p>
      </div>
    </div>
    <div class='col'>
      <div class='information'>
        <h3 class='header'>Batch info:</h3>
        <p><strong>Batch No.: </strong>" . $batch['batchNo'] . "</p>
        <p><strong>Expiry Date: </strong>" . $batch['expiryDate'] . "</p>
        <p><strong>Vaccine Name: </strong>" . $vaccine['vaccineName'] . "</p>
        <p><strong>Manufacturer: </strong>" . $vaccine['manufacturer'] . "</p>
      </div>
    </div>
  </div>
  <div class='row'>
    <h3 class='header mt-0'>Status:</h3>
" . $updateStatusForm;




  echo $output;
}