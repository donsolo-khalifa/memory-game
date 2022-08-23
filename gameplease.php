<?php
session_start();
$serverName="localhost";
$dbusername="root";
$dbPassword="";
$dbName="scoresdatabase";
$scores=$_POST["uploadscore"];
$userName=$_SESSION["useruId"];
$con= mysqli_connect($serverName,$dbusername,$dbPassword,$dbName);

$sqli="SELECT scores FROM users WHERE  usersUid='$userName'";
$result = mysqli_query($con, $sqli);

  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    if ($row["scores"]>$scores||$row["scores"]==0) {
        updatedb($con,$scores,$userName);
    }
    else{
        echo "You did not pass your high score";
    }
  }


function updatedb($con,$scores,$userName){

    if (!$con) {
        die("Connection failed".mysqli_connect_error());
    }
    
    $sql = "UPDATE users SET scores='$scores' WHERE usersUid='$userName'";
    
    if (mysqli_query($con, $sql)) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . mysqli_error($con);
    }
    
    mysqli_close($con);
}