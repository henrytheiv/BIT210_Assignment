<?php


require_once "../app/database.php";


$getCentresSql = $pdo->prepare("SELECT * FROM healthcarecentres");
$getCentresSql->execute();
$centres = $getCentresSql->fetchAll(PDO::FETCH_ASSOC);


?>