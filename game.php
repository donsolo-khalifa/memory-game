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

      require_once "dbhandler.php";

      $userName = $_SESSION["useruId"];
      $best;
      $rank;
      echo "welcome " . $_SESSION["useruId"];



      $rankQuery = "SELECT scores,usersUid FROM users WHERE NOT (scores=0) ORDER BY scores ASC";

      $sql = "SELECT scores FROM users WHERE usersUid='$userName'";

      $data = array();

      $rankResult = mysqli_query($con, $rankQuery);

      $result = mysqli_query($con, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $best = $row["scores"];
      }
      while ($row = mysqli_fetch_assoc($rankResult)) {
        $data[$row['usersUid']] = $row['scores'];
      }
      if ($best != 0) {
        $rank = array_search($userName, array_keys($data)) + 1;
      } else {
        $rank = "Unranked";
      }
      mysqli_close($con);



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
    
     

    </form>



  </div>

  <section>

  </section>

  <script src="please.js"></script>
</body>

</html>