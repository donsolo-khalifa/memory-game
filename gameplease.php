<?php
session_start();
if (isset($_POST["uploadscore"])) {
  $scores = $_POST["uploadscore"];
}
$userName = $_SESSION["useruId"];
require_once "dbhandler.php";


$sqli = "SELECT scores FROM users WHERE  usersUid='$userName'";
$rankQuery = "SELECT scores,usersUid FROM users WHERE NOT (scores=0) ORDER BY scores ASC";
$result = mysqli_query($con, $sqli);
$rankResult = mysqli_query($con, $rankQuery);
echo '<a href="game.php">Go back to game</a>'.'<br>';

// output data of each row
while ($row = mysqli_fetch_assoc($result)) {
  if (isset($scores)) {
    if ( $row["scores"] > $scores || $row["scores"] == 0) {
    
      updatedb($con, $scores, $userName);
    } else {
      echo "You did not pass your high score";
    }
  }
 
}
echo '<h2> leaderbords</h2>'."<br>";

$position=0;

while ($row = mysqli_fetch_assoc($rankResult)) {
  $data=array();

  // echo $row['usersUid']." ". $row['scores'] .'<br>';
  $data[$row['usersUid']] = $row['scores'];
  foreach ($data as $key => $value) {
    $position++;
    if ($userName ==$key ) {

      echo  '<h1 style="font-style: italic; color:cyan;">' .$position."\t". $key . "\t" . $value . '</h1>' . '<br>';
    } else{
      echo $position . "\t" . $key . "\t" . $value . '<br>';

    }
    
  }
}



function updatedb($con, $scores, $userName)
{

  if (!$con) {
    die("Connection failed" . mysqli_connect_error());
  }

  $sql = "UPDATE users SET scores='$scores' WHERE usersUid='$userName'";

  if (mysqli_query($con, $sql)) {
    echo "Record updated successfully" . '<br>';
  } else {
    echo "Error updating record: " . mysqli_error($con);
  }

  mysqli_close($con);
}
