<?php

require_once '../app/app.php';

session_start();

require_once "checkAdminSignIn.php";

// Fetch all the vaccines available from the database
$getVaccinesStatement = $pdo->prepare('SELECT * FROM vaccines');
$getVaccinesStatement->execute();
$vaccines = $getVaccinesStatement->fetchAll(PDO::FETCH_ASSOC);


$title = "DahVax - Record New Vaccine Batch";

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
                        <a class="dropdown-item" href="AdminMenu.php">Dashboard <i class="fas fa-user"></i></a>
                        <a class="dropdown-item" href="ViewVaccineBatchInfo.php">View Vaccine Batch Info</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
            </li>
        </ul>
    </div>
</nav>

<h2 class="page-title">Record New Vaccine Batch</h2>

<!-- Vaccine table -->

<div class="container mt-3">
    <h3 class="instruction">Select a vaccine to record new batch:</h3>

    <div class="scrollable">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Vaccine ID</th>
                    <th scope="col">Vaccine Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vaccines as $vaccine) : ?>
                    <tr>
                        <td><?php echo $vaccine["vaccineID"]; ?></td>
                        <td><?php echo $vaccine["vaccineName"]; ?></td>
                        <td>
                            <i class="fas fa-plus-square fa-2x view_data" id="<?php echo $vaccine['vaccineID']; ?>" data-toggle="modal" data-target="#batchRecordForm" onclick="clearBatchCSS()"></i>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade" id="batchRecordForm" tabindex="-1" role="dialog" aria-labelledby="batchRecordFormTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="batchRecordFormTitle">Record New Batch</h3>
                <i class="fas fa-window-close fa-2x close" data-dismiss="modal" aria-label="Close"></i>
            </div>
            <div class="modal-body">
                <div class="information" id="vaccine-detail">

                </div>
                <div class="container form-container">
                    <form id="form" class="validation-form">
                        <div class="form-control">
                            <label for="batchNo"><span class="text-danger">*</span>Batch no.:</label>
                            <input type="text" placeholder="eg. BXXX" name="batchNo" id="batchNo" class="form_data" />
                            <small></small>
                        </div>
                        <div class="form-control">
                            <label for="expiryDate"><span class="text-danger">*</span>Expiry date:</label>
                            <input type="date" name="expiryDate" id="expiryDate" class="form_data" />
                            <small></small>
                        </div>
                        <div class="form-control">
                            <label for="quantiy"><span class="text-danger">*</span>Quantity of doses available:</label>
                            <input type="number" placeholder=">10" name="quantityAvailable" id="quantity" class="form_data" />
                            <small></small>
                        </div>
                        <button type="button" name="submit" id="submit" onclick="validateBatch(); return false;">Record</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>




<?php include_once '../views/partials/footer.php'; ?>


<script>
    // Ajax request sent to retrieve vaccine details from database
    $(document).ready(function() {

        $('.view_data').click(function() {

            var vaccineID = $(this).attr("id");

            $.ajax({

                url: "selected_vaccine.php",
                method: "POST",
                data: {
                    vaccineID: vaccineID
                },
                success: function(data) {

                    $('#vaccine-detail').html(data);

                }
            });
        });

    });
</script>