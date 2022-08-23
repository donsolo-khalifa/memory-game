<?php

function emptyInputSignup($name, $email, $userName, $password, $passwordrepeat)
{
    $result;
    if (empty($name) || empty($email) || empty($userName) || empty($password) || empty($passwordrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidUid($userName)
{
    $result;
    if (!preg_match("/^[a-zA-Z0-9]*/", $userName)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidEmail($email)
{
    $result;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function pwdmatch($password, $passwordrepeat)
{
    $result;
    if ($password !== $passwordrepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function uidexists($con, $userName, $email)
{
    $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.html?error=statementfaliure");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}
function createUser($con, $name, $email, $userName, $password)
{
    $sql = "INSERT INTO users (usersName,usersEmail, usersUid, usersPwd) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($con);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: signup.html?error=statementfaliure");
        exit();
    }
    $saltpwd = password_hash($password, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $userName, $saltpwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    session_start();
    $_SESSION["useruId"]=$userName;
    header("location: game.php?error=none");
}
function emptyInputlogin($userName, $password)
{
    $result;
    if (empty($userName) || empty($password)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function loginUser($con, $userName, $password)
{
    $exists = uidexists($con, $userName, $userName);
    if ($exists == false) {
        header("location: login.html?error=wronglogin");
        exit();
    }
    $saltpwd = $exists["usersPwd"];
    $checkPwd = password_verify($password, $saltpwd);
    if ($checkPwd == false) {
        header("location: login.html?error=wronglogin");
        exit();
    } elseif ($checkPwd == true) {
        session_start();
        $_SESSION["userId"] = $exists["usersId"];
        $_SESSION["useruId"] = $exists["usersUid"];
        header("location: game.php?error=nada");
        exit();
    }
}
