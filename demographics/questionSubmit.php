<?php
session_start();
?>
<!--
  questionSubmit.php in demographics folder

  This file takes the input from the index.php file and inserts the answers
  into the DemographicAnswer table.

-->

<?php
require '../src/login.php';
/*
if(time() - $_SESSION["time"] > $timeout)
{
  session_unset();
  session_destroy();
  echo json_encode(array("time"=>"timeout"));
  exit();
}
 */
$fname = 'output.mysql';
$mode = 'a';
$filehandle = fopen($fname, $mode);
if($filehandle == false)
{
  //echo "Error: File could not be written to.\n";
}
else
{
  if(isset($_POST))
  {
    foreach($_POST as $key => $value)
    {
      fwrite($filehandle, "$key: $value\n");
    }
    $mysqli = new mysqli($host, $user, $pass, $dtbs);
    if($mysqli->connect_errno)
    {
      fwrite($filehandle, "/* Mysqli connect error: $mysqli->connect_errno */\n");
    }
    else
    {
      foreach($_POST as $key => $value)
      {
        fwrite($filehandle, "$key: $value\n");
      }
      fwrite($filehandle, "/************ CONNECTED OK ************/\n");
      $size = count($_POST) / 2;
      for($i = 0; $i < $size; $i++)
      {
        $query1 = "select id from DemographicQuestion where question=";
        $query2 = $_POST["q$i"];
        $query2 = $mysqli->escape_string($query2);
        $query2 = stripslashes($query2);
        $query2 = htmlentities($query2);
        $query2 = strip_tags($query2);
        $query2 = "'".$query2."';";
        $query = $query1.$query2;
        //fwrite($filehandle, $query."\n");
        $result = $mysqli->query($query);
        $result = $result->fetch_assoc();
        $answer = stripslashes($answer);
        $answer = htmlentities($answer);
        $answer = strip_tags($answer);
        $answer = $mysqli->escape_string($_POST["a$i"]);
        $query3 = "update DemographicAnswer set answer = '$answer' where license_id = ".$_SESSION["id"]." and demographic_question_id = ".$result["id"].";";
        fwrite($filehandle, $query3."\n");
        $mysqli->query($query3);
      }
      $_SESSION['demo_complete'] = 1;
      $mysqli->close();
    }
  }
  else
  {
    fwrite($filehandle, "/* POST array not set. */\n");
  }
  fwrite($filehandle, "/*===========================================================*/\n");
  fclose($filehandle);
}
// header('Location: ../likert/');
?>
