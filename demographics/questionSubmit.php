<?php
//header('Content-type: application/json');
session_start();
//require '../src/timeout.php';
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
  echo "Error: File could not be written to.\n";
}
else
{
  if(isset($_POST))
  {
    $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
    if($mysqli->connect_errno)
    {
      fwrite($filehandle, "/* Mysqli connect error: $mysqli->connect_errno */\n");
    }
    else
    {
      fwrite($filehandle, "/************ CONNECTED OK ************/\n");
      foreach($_POST as $key => $value)
      {
        fwrite($filehandle, "key: $key value: $value\n");
      }
      $size = count($_POST) / 2;
      for($i = 0; $i < $size; $i++)
      {
        $query1 = "select id, score_inversely from DemographicQuestion where question=";
        $query2 = $_POST["q$i"];
        $query2 = $mysqli->escape_string($query2);
        $query2 = "'".$query2."';";
        $query = $query1.$query2;
        fwrite($filehandle, $query."\n");
        $result = $mysqli->query($query);
        $result = $result->fetch_assoc();
        $answer = $mysqli->real_escape_string($_POST["a$i"]);
        $answer = stripslashes($answer);
        $answer = htmlentities($answer);
        $answer = strip_tags($answer);
      }
        $query3 = "update DemographicAnswer set answer = $answer where license_id = ".$_SESSION["id"]." and question_id = ".$result["id"].";";
        fwrite($filehandle, $query3."\n");
        //$mysqli->query($query3);
      }
      $result->free();
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
?>
