<?php
require '../src/classes/Database.php';

$database = new Database();
$pdo = $database->getConnection();
?>
