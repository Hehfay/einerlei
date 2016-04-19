<?php
//header('Content-type: application/json');
session_start();
require '../src/timeout.php';
//if(time() - $_SESSION["time"] > $timeout)
//{
//  session_unset();
//  session_destroy();
//  echo json_encode(array("time"=>"timeout"));
//  exit();
//}
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
      $reg = 0;
      $inv = 100;
      for($i = 1; $i <= 5; $i++)
      {
        $score_reg[$i] = $reg;
        $score_inv[$i] = $inv;
        $reg += 25;
        $inv -= 25;
      }
      $size = count($_POST) / 2;
      for($i = 0; $i < $size; $i++)
      {
        if($_POST["a$i"] == 6)
        {
          $answer = 6;
          $query1 = "select id from LikertQuestion where question=";
        }
        else
        {
          $query1 = "select id, score_inversely from LikertQuestion where question=";
        }
        $query2 = $_POST["q$i"];
        $query2 = $mysqli->escape_string($query2);
        $query2 = "'".$query2."';";
        $query = $query1.$query2;
        //fwrite($filehandle, $query."\n");
        $result = $mysqli->query($query);
        $result = $result->fetch_assoc();
        if($_POST["a$i"] != 6)
        {
          if($result['score_inversely'])
          {
            $answer = $score_inv[$_POST["a$i"]];
          }
          else
          {
            $answer = $score_reg[$_POST["a$i"]];
          }
        }
        $query3 = "update LikertAnswer set answer = $answer where license_id = ".$_SESSION["id"]." and question_id = ".$result["id"].";";
//        $query3 = "insert into LikertAnswer(license_id, question_id, answer) values(".$_SESSION["id"].", ".$result["id"].", ".$answer.");";
        fwrite($filehandle, $query3."\n");
        $mysqli->query($query3);
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
