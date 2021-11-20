<?php

session_start();

require_once '../app/app.php';

require_once "checkPatientSignIn.php";

$getVaccinesStatement = $pdo->prepare('SELECT * FROM vaccines');
$getVaccinesStatement->execute();
$vaccines = $getVaccinesStatement->fetchAll(PDO::FETCH_ASSOC);


if ($_SESSION['user'] == null) {

    redirect("index.php");
}


// website title show in tab 
$title = "DahVax - Request Vaccination Appointment";


include_once '../views/partials/header.php';

?>
<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
    <span class="navbar-brand mb-0 h1">DahVax</span>
    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <div id="my-custom-ddl">
                    <a onclick="dropDownIconChange()" class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu
                        <i class="fas fa-bars"></i>
                    </a>
                    <div class="dropdown-menu custom-nav-dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="PatientMenu.php">Dashboard <i class="fas fa-user"></i></a>
                        <a class="dropdown-item" href="ViewVaccinationAppointmentStatus.php">View Vaccination Appointment Status</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
    </div>
</nav>


<!-- Available Vaccine Table -->

<h2 class="page-title">Request Vaccination Appointment</h2>
<div class="container mt-3">
    <!-- <h3 class="page-description">Available vaccine:</h3> -->

    <h3 class="instruction">Select a vaccine for vaccination appointment:</h3>

    <div class="scrollable">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Vaccine Name</th>
                    <th scope="col">Manufacturer</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vaccines as $vaccine) : ?>
                    <tr>
                        <td><?php echo $vaccine['vaccineName']; ?></td>
                        <td><?php echo $vaccine['manufacturer']; ?></td>
                        <td>
                            <i class="fas fa-plus-square fa-2x view_centres" id="<?php echo $vaccine['vaccineID']; ?>" data-bs-toggle="modal" href="#viewCentres"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>

<div class="modal fade" id="viewCentres" aria-hidden="true" aria-labelledby="viewCentresTitle" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="viewCentresTitle">Centres that offer the vaccine</h3>
                <i class="fas fa-window-close fa-2x close" data-bs-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">

                <div id="all-centres">

                </div>

            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="viewBatches" aria-hidden="true" aria-labelledby="viewBatchesTitle" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="viewBatchesTitle">All batches</h3>
                <i class="fas fa-window-close fa-2x close" data-bs-target="#viewCentres" data-bs-toggle="modal" data-bs-dismiss="modal"></i>
            </div>
            <div class="modal-body">
                <div class="container text-center">

                    <div id="all-batches">

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="appointmentForm" aria-hidden="true" aria-labelledby="appointmentFormTitle" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="appointmentFormTitle">Select Appointment Date</h3>
                <i class="fas fa-window-close fa-2x close" data-bs-target="#viewBatches" data-bs-toggle="modal" data-bs-dismiss="modal"></i>
            </div>
            <div class="modal-body">
                <div class="container text-center">

                    <div id="appointment-form">

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>



<script>
    $(document).ready(function() {

        $('.view_centres').click(function() {

            var vaccineID = $(this).attr("id");

            $.ajax({
                url: "centre_list.php",
                method: "POST",
                data: {
                    vaccineID: vaccineID
                },
                success: function(data) {

                    $('#all-centres').html(data);

                }
            });
        });


    });

    function viewBatches(id) {
        var centreName = id;

        $.ajax({
            url: "batch_list.php",
            method: "POST",
            data: {
                centreName: centreName
            },
            success: function(data) {

                $('#all-batches').html(data);

            }
        });
    }

    function viewAppointmentForm(id) {
        var batchNo = id;

        $.ajax({
            url: "request_vaccination_form.php",
            method: "POST",
            data: {
                batchNo: batchNo
            },
            success: function(data) {

                $('#appointment-form').html(data);

            }
        });
    }

    // after patient click on the add button in add appointment
    function addAppointment() {
        alert("Added successfully!");
        location.href = "RequestVaccination.php";
    }
</script>

<?php include_once '../views/partials/footer.php'; ?>