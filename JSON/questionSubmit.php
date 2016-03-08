<!DOCTYPE html>
<html>
<head>
<title>Performance Anxiety Diagostic Questionnaire</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<?php
$fname = "output.txt";
$mode = "a+";
$filehandle = fopen($fname, $mode);
if($filehandle == false)
{
  echo "FUCK EVERYTHING";
}
else
{
  echo "Output written to output.txt"."<br>";
}
if(isset($_POST))
{
  $i = 0;
  foreach($_POST as $item => $value)
  {
    $variable[$i] = $item;
    $answers[$i] = $value;
    $i++;
  }
  for($i = 0; $i < count($variable); $i++)
  {
    $temp = trim($variable[$i]);
    $temp = str_split($temp);
    for($k = 0; $k < count($temp); $k++)
    {
      if($temp[$k] == "_")
      {
        $temp[$k] = " ";
      }
    }
    $variable[$i] = implode($temp);
    $variable[$i] = trim($variable[$i]);
    $variable[$i] = "'".$variable[$i].".'";
  }
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
  if($mysqli->connect_errno)
  {
    fwrite($filehandle, "Mysqli connect error.\n");
  }
  else
  {
    fwrite($filehandle, "Connected okay.\n");
    for($i = 0; $i < count($answers); $i++)
    {
      $query = "select id, score_inversely from LikertQuestion where question=".$variable[$i].";";
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
  fwrite($filehandle, "POST array not set.\n");
}
?>
</body>
</html>
