<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Memory Game</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>

  <div id="info">
    <h2>
      <?php

      $serverName = "localhost";
      $dbusername = "root";
      $dbPassword = "";
      $dbName = "scoresdatabase";
      $userName = $_SESSION["useruId"];
      $conn = mysqli_connect($serverName, $dbusername, $dbPassword, $dbName);
      $best;
      $rank;
      echo "welcome " . $_SESSION["useruId"];

      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }


      $rankQuery = "SELECT scores,usersUid FROM users ORDER BY scores ASC";

      $sql = "SELECT scores FROM users WHERE usersUid='$userName'";

      $data = array();

      $rankResult = mysqli_query($conn, $rankQuery);

      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $best = $row["scores"];
      }
      while ($row = mysqli_fetch_assoc($rankResult)) {
        $data[$row['usersUid']] = $row['scores'];
      }
      if ($best!=0) {
        $rank=array_search($userName,array_keys($data))+1;

      }else{
        $rank="Unranked";
      }
      mysqli_close($conn);



      ?>
    </h2>
    <form action="gameplease.php" id="scoreform" method="post">
      <label for="counter">
        time
        <br>
        <input id="counter" name="counter" readonly>
      </label>
      <br>
      <label for="best">
        your best
        <br>

        <input id="best" name="best" value="<?php echo $best ?>" readonly>
      </label>
      <br>

      <label for="rank">
        you are ranked
        <br>

        <input id="rank" name="rank" value="<?php echo $rank ?>" readonly>
      </label>
      <br>

      <label for="uploadscore">
        <input id="uploadscore" name="uploadscore" readonly hidden>
      </label>
      <!-- <input  name="submit" type="submit" readonly hidden>
    -->
      <?php

      // $serverName="localhost";
      // $dbusername="root";
      // $dbPassword="";
      // $dbName="scoresdatabase";
      // $userName=$_SESSION["useruId"];
      // $conn= mysqli_connect($serverName,$dbusername,$dbPassword,$dbName);
      //       // Create connection
      //       // Check connection
      //       if (!$conn) {
      //         die("Connection failed: " . mysqli_connect_error());
      //       }

      //       $sql = "SELECT scores FROM users WHERE usersUid='$userName'";
      //       $result = mysqli_query($conn, $sql);
      //       while($row = mysqli_fetch_assoc($result)) {
      //        $_POST["best"]=$row["scores"];
      //       }

      //       mysqli_close($conn);
      ?>

    </form>



  </div>

  <section>

  </section>

  <script src="please.js"></script>
</body>

</html>