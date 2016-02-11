<!DOCTYPE html>
<html>
<head>
<title>Performance Anxiety Diagnostic Questionnaire</title>
</head>
<body>
<h1>Performance Anxiety Diagnostic Questionnaire</h1>
<h3>5-Point Scale Questions</h3>
<p>For the following questions, please answer with a number between 1 and 5.<br>
  1 meaning “strongly disagree,”<br> 
  2 meaning “disagree,”<br> 
  3 meaning “undecided” or “neutral,”<br> 
  4 meaning “agree,” and<br> 
  5 meaning “strongly agree.”<br>  
  Select the appropriate number.<br>
</p>

<?php

$host = "";
$username = "imeisner";
$password = "imeisner";
$database = "imeisner";

$mysqli = new mysqli($host, $username, $password, $database);

if ( mysqli_connect_errno())
{
  echo "<p>";
  echo "Connect Error: " .mysqli_connect_errno();
  echo "</p>";
}
else
{
  echo "<form action='./questionSubmit.php'>";
  echo "<table>";
  for($i = 1; $i<=100; $i++)
  {
    $query = "select * from Question where questionNumber='".$i."b';";
    $result = $mysqli->query($query);

    if($result)
    {
      $num_rows = $result->num_rows;
      if($num_rows==1)
      {
        $num_cols = $result->field_count;
        $row = $result->fetch_assoc();

        echo $row["questionNumber"].".) ";
        echo $row["question"];
        echo "<br>";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='1'> 1<br>";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='2'> 2<br>";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='3'> 3<br>";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='4'> 4<br>";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='5'> 5<br><br>";

      }
      else
      {
        echo "Oops, should't get multiple rows!";
      }
    }
    else
    {
      echo "<p>";
      echo "Query Error: " .$mysqli->error;
      echo "<p>";
    }
  }
  echo "<input type='submit'>";
  echo "</form>";

  $mysqli->close();
}
?>

</body>
</html>
