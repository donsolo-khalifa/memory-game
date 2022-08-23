<?php

if(isset($_POST["submit"])){
    $name=$_POST["name"];
    $email=$_POST["email"];
    $userName=$_POST["userId"];
    $password=$_POST["password"];
    $passwordrepeat=$_POST["passwordrepeat"];
    require_once "dbhandler.php";
    require_once 'functions.php';

    if (emptyInputSignup($name,$email,$userName,$password,$passwordrepeat)!== false) {
        header("location: signup.html?error=emptyinput");
        exit();

    }
    if (invalidUid($userName)!==false) {
        header("location: signup.html?error=invaliduid");
        exit();

    }
    if (invalidEmail($email)!==false) {
        header("location: signup.html?error=invalidemail");
        exit();

    }
    if (pwdmatch($password,$passwordrepeat)!==false) {
        header("location: signup.html?error=passwordmismatch");
        exit();

    }
    if (uidexists($con,$userName,$email)!==false) {
        header("location: signup.html?error=usernametaken");
        exit();

    }
createUser($con,$name,$email,$userName,$password);


}else{
    header("location: signup.html");
    exit();
}
