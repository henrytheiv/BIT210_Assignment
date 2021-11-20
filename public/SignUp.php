<?php

//header include all the style and boostrap links
$title = "DahVax - Sign Up";
include_once '../views/partials/header.php';

require_once "../app/app.php";


?>

<!-- navigation bar  -->
<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
    <span class="navbar-brand mb-0 h1">DahVax</span>
</nav>

<h2 class="mb-3 page-title">Sign Up</h2>
<h4 class="mb-5 page-description">Select user type by clicking the user icon</h4>

<!-- 2 user icons Patient and Administrator-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-3 text-center">
            <i class="fas fa-user fa-10x sign-up-icon" data-toggle="modal" data-target="#patientForm"></i>
            <h3 class="sign-up-icon-text">Patient</h3>
        </div>

        <div class="col-lg-3 text-center">
            <i class="fas fa-user-md fa-10x sign-up-icon" data-toggle="modal" data-target="#adminForm"></i>
            <h3 class="sign-up-icon-text">Healthcare Administrator</h3>
        </div>

    </div>
</div>

<!-- for patient -->
<div class="modal fade" id="patientForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Sign Up - Patient</h3>
                <i class="fas fa-window-close fa-2x close" data-dismiss="modal" aria-label="Close"></i>
            </div>

            <div class="modal-body">
                <div class="container form-container">
                    <form id="patient-sign-up-form" class="validation-form sign-up-form">

                        <!-- patient username -->
                        <div class="form-control">
                            <label for="patientUsername"><span class="text-danger">*</span>Username:</label>
                            <input type="text" placeholder="username" id="patientUsername" name="patientUsername" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- patient password -->
                        <div class="form-control">
                            <label for="patientPassword"><span class="text-danger">*</span>Password:</label>
                            <input type="password" placeholder="password" id="patientPassword" name="patientPassword" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- patient email -->
                        <div class="form-control">
                            <label for="patientEmail"><span class="text-danger">*</span>Email:</label>
                            <input type="email" placeholder="xxx@urmail.com" id="patientEmail" name="patientEmail" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- patient fullname -->
                        <div class="form-control">
                            <label for="patientFullname"><span class="text-danger">*</span>Full Name:</label>
                            <input type="text" placeholder="fullName" id="patientFullname" name="patientFullname" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- patient icpassport -->
                        <div class="form-control">
                            <label for="patientIcpassport"><span class="text-danger">*</span>IC / Passport No.:</label>
                            <input type="text" placeholder="eg.xxxxxx-xx-xxxx" id="patientIcpassport" name="patientIcpassport" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- button -->
                        <button type="button" name="submit" id="submit" onclick="validatePatient(); return false;">Sign Up</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- for admin -->
<div class="modal fade" id="adminForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Sign Up - Admin</h3>
                <i class="fas fa-window-close fa-2x close" data-dismiss="modal" aria-label="Close"></i>
            </div>

            <div class="modal-body">
                <div class="container form-container">
                    <form id="admin-sign-up-form" class="validation-form sign-up-form">

                        <!-- select centre name -->
                        <div class="form-control">
                            <label for="admincentreName"><span class="text-danger">*</span>Select a Healthcare Centre:</label>


                            <select class="form-select" id="admincentreName" name="admincentreName" class="form_data">
                                <option value="abc abc">Select Centre</option>

                                <?php
                                $statement = $pdo->prepare("SELECT * FROM healthcarecentres");
                                $statement->execute();
                                $centres = $statement->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($centres as $centre) :

                                ?>

                                    <option value='<?php echo $centre['centreName']; ?>'><?php echo $centre['centreName']; ?></option>;

                                <?php

                                endforeach;
                                ?>

                            </select>

                            <small></small>
                        </div>

                        <!-- admin username -->
                        <div class="form-control">
                            <label for="adminUsername"><span class="text-danger">*</span>Username:</label>
                            <input type="text" placeholder="username" id="adminUsername" name="adminUsername" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- admin password -->
                        <div class="form-control">
                            <label for="adminPassword"><span class="text-danger">*</span>Password:</label>
                            <input type="password" placeholder="password" id="adminPassword" name="adminPassword" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- admin email -->
                        <div class="form-control">
                            <label for="adminEmail"><span class="text-danger">*</span>Email:</label>
                            <input type="email" placeholder="xxx@urmail.com" id="adminEmail" name="adminEmail" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- admin fullname -->
                        <div class="form-control">
                            <label for="adminFullname"><span class="text-danger">*</span>Full Name:</label>
                            <input type="text" placeholder="fullName" id="adminFullname" name="adminFullname" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- patient icpassport -->
                        <div class="form-control">
                            <label for="adminStaffid"><span class="text-danger">*</span>Staff ID:</label>
                            <input type="text" placeholder="eg.SXXX" id="adminStaffid" name="adminStaffid" class="form_data" onfocus='this.value = ""' />
                            <small></small>
                        </div>

                        <!-- button -->
                        <button type="button" name="submit" id="submit" onclick="validateAdmin(); return false;">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--  -->
<p class="text-center mt-2">Already have an account? <a href="index.php">Log in here</a></p>


<?php
// footer of the page 
include_once '../views/partials/footer.php';
?>