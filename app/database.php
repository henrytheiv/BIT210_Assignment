<?php

// Establish database connection
try{

    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=dahvax', 'root', '');

}catch(PDOException $e){

    $error_message = $e->getMessage();
    include_once "../public/database_error.php";

}


return $pdo;


