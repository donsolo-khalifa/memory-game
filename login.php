<?php
if (isset($_POST["submit"])) {
   $username=$_POST["username"];
   $password=$_POST["password"];
require_once "dbhandler.php";
require_once "functions.php";

if (emptyInputlogin($username,$password)!== false) {
    header("location:login.html?error=emptyinput");
    exit();

}
loginUser($con,$username,$password);
}
else {
    header("location:login.html");
    exit();
}