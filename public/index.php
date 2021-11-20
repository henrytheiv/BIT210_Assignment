<?php

$title = "DahVax";

include_once '../views/partials/header.php';

session_start();
session_destroy();
// require_once 'form-validation/signIn_validation.php';

?>

<!-- navigation bar with Logo and log out icon -->
<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
    <span class="navbar-brand mb-0 h1">DahVax</span>
</nav>

<h2 class="page-title">Sign In</h2>

<!-- Log in form-->

<div class="container form-container">
    <form id="form" class="validation-form">
        <div class="form-control">
            <label for="username"><span class="text-danger">*</span>Username:</label>
            <input type="text" placeholder="Username" name="username" id="username" class="form_data" />
            <small></small>
        </div>
        <div class="form-control">
            <label for="password"><span class="text-danger">*</span>Password:</label>
            <input type="password" name="password" id="password" class="form_data" />
            <small></small>
        </div>

        <button type="button" name="submit" id="submit" onclick="signIn(); return false;">Sign In</button>
    </form>

</div>


<p class="text-center mt-2">Doesn't have an account? <a href="SignUp.php">Sign up here</a></p>

<?php include_once '../views/partials/footer.php'; ?>

