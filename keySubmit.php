<?php
// mysql stuff
$mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
if($mysqli)
{
  session_start();
  // assign $_POST['key'] to a variable
  $key = $_POST['key'];
  // sanitize the string
  $key = $mysqli->real_escape_string($key);
  $key = stripslashes($key);
  $key = htmlentities($key);
  $key = strip_tags($key);
  echo "Key sanitized: $key"."<br>";
  // md5 hash
  $key = md5($key);
  echo "Hashed: $key"."<br>";
  // check if the key is in DB and is active. Both must be true to start quiz.
  $query = "select count(*) from License where licenseKey='$key'";
  $result = $mysqli->query($query);
  $row = $result->fetch_row();
  $count = $row[0];
  if($count == 1)
  {
    echo "Key exists, check if active."."<br>";
    // The key exists, check if active.
    $query = "select active from License where licenseKey='$key'";
    $result = $mysqli->query($query);
    $is = $result->fetch_assoc();
    if($is['active'])
    {
      // start the quiz
      echo "Key exists and is active!"."<br>";
      $can_start = TRUE;
      $query = "select id from License where licenseKey='$key';";
      $result = $mysqli->query($query);
      $user = $result->fetch_assoc();
      $_SESSION['id'] = $user['id'];
    }
    else
    {
      // You have already taken the quiz.
      echo "You have already taken the quiz"."<br>";
      $can_start = FALSE;
      $errmsg = "This key has expired. Please follow the link below to purchase a key to the questionnaire.";
    }
  }
  else
  {
    // Key does not exist, bounce back.
    echo "Your key does not exist."."<br>";
    $can_start = FALSE;
    $errmsg = "Invalid key. Please follow the link below to purchase a key to the questionnnaire.";
  }
  $_SESSION['errmsg'] = $errmsg;
  $result->free();
  $mysqli->close();
}
else
{
  $can_start = FALSE;
}
if($can_start)
{
  echo "You can start.<br>";
  $result->free();
  $mysqli->close();
  header('Location: start/');
}
else
{
  echo "You cannot start.<br>";
  header('Location: index.php');
}
?>
