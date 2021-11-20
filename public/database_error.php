<?php

// This file is to display error when database can't function properly
include_once "../views/partials/header.php";
require_once "../app/database.php"

?>

<nav class="navbar navbar-expand-lg custom-navbar" id="navbarNav">
    <span class="navbar-brand mb-0 h1">DahVax</span>
</nav>

<div class="container">
  <div class="row">
    <div class="col-md">
    <h2 class="page-title">Database Error!</h2>
    </div>
  </div>

  <div class="row">
    <div class="col-md mt-5 text-center">
        <p><?php echo $error_message; ?></p>
    </div>
  </div>
</div>






<?php

include_once "../views/partials/footer.php"

?>