<?php

session_start();

require '../app/app.php';

if(is_post()){

    $username = $_SESSION['user'];
    $batchNo = $_POST['batchNo'];
    $status = 'Pending';
    $remarks = '-';


    $output="<form id='form' method='POST' action='requestAppointment.php' class='validation-form'>
    <input type='hidden' name='username' id='username' value='".$username."'class='form_data' />
    <input type='hidden' name='batchNo' id='batchNo' value='".$batchNo."'class='form_data' />
    <div class='form-control'>
        <label for='appointmentDate'><span class='text-danger'>*</span>Appointment date:</label>
        <input type='date' name='appointmentDate' id='appointmentDate' class='form_data' />
        <small></small>
    </div>
    <button type='submit' name='submit' id='submit' onclick='addAppointment();'>Request</button>
</form>";

echo $output;


}

