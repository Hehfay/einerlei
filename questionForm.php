<!DOCTYPE html>
<html>
<head>
<title>Performance Anxiety Diagnostic Questionnaire</title>
</head>
<body>
<h1>Performance Anxiety Diagnostic Questionnaire</h1>

<?php


$host = "";
$username = "imeisner";
$password = "imeisner";
$database = "Quiz";

$mysqli = new mysqli($host, $username, $password, $database);

if ( mysqli_connect_errno())
{
  echo "<p>";
  echo "Connect Error: " .mysqli_connect_errno();
  echo "</p>";
}
else
{
  echo "<h3>Demographics Information</h3>";

  echo "<form action='./questionSubmit.php'>";
  echo "<table>";

  $i = 1;
  //while($i <=14)
  //{
    $demQuery = "select * from Question where questionNumber='".$i."a'"; 
    $demResult = $mysqli->query($demQuery);

    if($demResult)
    {
      $num_demRows = $demResult->num_rows;
      if($num_demRows == 1)
      {
        $num_demCols = $demResult->field_count;
        $demRow = $demResult->fetch_assoc();

        echo $demRow["questionNumber"].".) ";
        echo $demRow["question"];
        echo "<input type='radio' ";
        echo "name='gender' ";
        echo "value='Male'> Male";
        echo "<input type='radio' ";
        echo "name='gender' ";
        echo "value='Female'> Female";
        echo "<br>";


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
  //}


  echo "<h3>5-Point Scale Questions</h3>";
  echo "<p>For the following questions, please answer with a number between 1 and 5.<br>
    1 meaning “strongly disagree,”<br> 
    2 meaning “disagree,”<br> 
    3 meaning “undecided” or “neutral,”<br> 
    4 meaning “agree,” and<br> 
    5 meaning “strongly agree.”<br>  
    Select the appropriate number.<br>
  </p>";

  for($j = 1; $j<=100; $j++)
  {
    $query = "select * from Question where questionNumber='".$j."b';";
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
        echo "value='1'> 1";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='2'> 2";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='3'> 3";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='4'> 4";
        echo "<input type='radio' ";
        echo "name='".$questionNumber."' ";
        echo "value='5'> 5<br>";

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
