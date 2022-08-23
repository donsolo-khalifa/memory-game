<?php
$serverName="localhost";
$dbusername="root";
$dbPassword="";
$dbName="scoresdatabase";
$con= mysqli_connect($serverName,$dbusername,$dbPassword,$dbName);
if (!$con) {
    die("Connection failed".mysqli_connect_error());
}
?>