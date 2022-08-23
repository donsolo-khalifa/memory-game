<?php
session_start();
if (isset($_POST["uploadscore"])) {
    $score=$_POST["uploadscore"];
    $username=$_SESSION["useruId"];
    require_once "dbhandler.php";
    require_once "functions.php";

    inputindb($con,$username,$score);

}
