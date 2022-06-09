<?php
$databaseHost = 'localhost';
$databaseName = 'ppinfo';
$databaseUsername = 'root';
$databasePassword = '';
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

session_start();

require_once 'functions.php';
?>