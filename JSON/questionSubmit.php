<!DOCTYPE html>
<html>
<head>
<title>Performance Anxiety Diagostic Questionnaire</title>
<link rel="stylesheet" href="../style.css">
</head>
<body>
<?php
if(isset($_POST))
{
  $lines = file('identifiers.txt');
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
    echo "FUCK!!!"."<br>";
  }
  else
  {
    echo "CONNECTED OKAY"."<br>";
    for($i = 0; $i < count($answers); $i++)
    {
      $query = "select id, score_inversely from LikertQuestion where question=".$variable[$i].";";
      echo "$query"."<br>";
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
      echo "$query1"."<br><br>";
    }
    $result->free();
    $mysqli->close();
  }
}
else
{
  echo "DAMN!";
}
?>
</body>
</html>
