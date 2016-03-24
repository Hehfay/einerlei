<?php
$fname = 'output.mysql';
$mode = 'a';
$filehandle = fopen($fname, $mode);
if($filehandle == false)
{
  echo "Error: File could not be written to.";
}
else
{
  if(isset($_POST))
  {
    foreach($_POST as $item => $value)
    {
      fwrite($filehandle, "$item $value\n");
    }
    $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
    if($mysqli->connect_errno)
    {
      fwrite($filehandle, "Mysqli connect error $mysqli->connect_errno.\n");
    }
    else
    {
      $size = count($_POST) / 2;
      fwrite($filehandle, "/* Connected okay. */\n");
      fwrite($filehandle, "POST / 2 is $size\n");
      for($i = 0; $i < $size; $i++)
      {
        $answers[$i] = $_POST["a$i"];
        fwrite($filehandle, "$answers[$i]\n");
      }
      for($i = 0; $i < $size; $i++)
      {
        $query1 = "select id, score_inversely from LikertQuestion where question=";
        $query2 = $_POST["q$i"];
        $query2 = $mysqli->escape_string($query2);
        $query2 = "'".$query2."';";
        $query = $query1.$query2;
        fwrite($filehandle, $query."\n");
        $result = $mysqli->query($query);
        $result = $result->fetch_assoc();
        if($result['score_inversely'])
        {
          if($answers[$i] == 1)
          {
            $answers[$i] = 100;
          }
          elseif($answers[$i] == 2)
          {
            $answers[$i] = 75;
          }
          elseif($answers[$i] == 3)
          {
            $answers[$i] = 50;
          }
          elseif($answers[$i] == 4)
          {
            $answers[$i] = 25;
          }
          elseif($answers[$i] == 5)
          {
            $answers[$i] = 0;
          }
          elseif($answers[$i] == 6)
          {
            $answers[$i] = 0;
          }
        }
        else
        {
          if($answers[$i] == 1)
          {
            $answers[$i] = 0;
          }
          elseif($answers[$i] == 2)
          {
            $answers[$i] = 25;
          }
          elseif($answers[$i] == 3)
          {
            $answers[$i] = 50;
          }
          elseif($answers[$i] == 4)
          {
            $answers[$i] = 75;
          }
          elseif($answers[$i] == 5)
          {
            $answers[$i] = 100;
          }
          elseif($answers[$i] == 6)
          {
            $answers[$i] = 0;
          }
        }
        $query1 = "insert into LikertAnswer(license_id, question_id, answer) values(1, ".$result['id'].", ".$answers[$i].");";
        fwrite($filehandle, $query1."\n");
      }
      echo "<script>";
      echo "";
      echo "</script>";
      $result->free();
      $mysqli->close();
    }
  }
  else
  {
    fwrite($filehandle, "/* POST array not set. */\n");
  }
  fclose($filehandle);
}
