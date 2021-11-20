<?php

require_once "../app/app.php";

session_start();

require_once "checkAdminSignIn.php";

$sql = $pdo->prepare("SELECT * FROM admins WHERE username = :username");
$sql->bindValue(':username', $_SESSION['user']);
$sql->execute();
$admin = $sql->fetch();

$_SESSION['centreName'] = $admin['centreName'];

$title = "DahVax - Dashboard";

include_once '../views/partials/header.php';


?>
<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
  <span class="navbar-brand mb-0 h1">DahVax</span>

  <ul class="navbar-nav ms-auto">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Log Out <i class="fas fa-sign-out-alt"></i></a>
    </li>
  </ul>
</nav>

<h2 class="page-title">Dashboard</h2>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-4 text-center">
      <i class="fas fa-user fa-10x user-icon mb-2"></i>
      <h2><?php echo $admin['fullName']; ?></h2>
      <p><?php echo $admin['centreName']; ?></p>
    </div>
    <div class="col-lg-4">
      <!-- record new vaccine batch -->
      <div class="row">
        <a class="btn btn-primary btn-lg mb-3 function-button" href="RecordNewVaccineBatch.php" role="button">
          Record New Vaccine Batch
        </a>
      </div>
      <!-- view vaccine bath info button -->
      <div class="row">
        <a class="btn btn-primary btn-lg mb-3 function-button" href="ViewVaccineBatchInfo.php" role="button">
          View Vaccine Batch Info
        </a>
      </div>
      <!-- add new centre button -->
      <div class="row">
        <a class="btn btn-primary btn-lg mb-3 function-button" class="fas fa-plus-square fa-1x" data-toggle="modal" data-target="#centreForm" role="button">
          Add new centre
        </a>
      </div>
    </div>
  </div>


  <!-- a pop up model for admin to add new centre -->
  <div class="modal fade" id="centreForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-header">
          <h3 class="modal-title" id="signUpPatient">Add New Centre</h3>
          <i class="fas fa-window-close fa-2x close" data-dismiss="modal" aria-label="Close"></i>
        </div>

        <div class="modal-body">
          <div class="container form-container">
            <form id="add-centre-form" class="validation-form add-centre-form">

              <!-- patient username -->
              <div class="form-control">
                <label for="centreName"><span class="text-danger">*</span>New centre name:</label>
                <input type="text" placeholder="centre name" id="centreName" name="centreName" class="form_data" />
                <small></small>
              </div>

              <!-- patient password -->
              <div class="form-control">
                <label for="centreAddress"><span class="text-danger">*</span>New centre address:</label>
                <input type="text" placeholder="centre address" id="centreAddress" name="centreAddress" class="form_data" />
                <small></small>
              </div>

              <!-- button -->
              <button type="button" name="submit" id="submit" onclick="validateCentre(); return false;">Add</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php

include_once '../views/partials/footer.php';

?>