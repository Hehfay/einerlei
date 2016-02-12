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

  $query = "select questionNumber, question from Question LIMIT 0,14"; 
  $result = $mysqli->query($query);

  if($result)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='radio' name='gender' value='Male'> Male";
    echo "<input type='radio' name='gender' value='Female'> Female";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='number' name='age' min='1' max='100'>";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='number' name='yearsStudying' min='1' max='100'>";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='number' name='ageMusicalInstruction' min='1' max='100'>";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='number' name='ageMusicalStudying' min='1' max='100'>";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<select name='currently'>";
    echo "<option value='High school student uncertain of future role of music in life'> High school student uncertain of future role of music in life </option>";
    echo "<option value='High school student looking toward career as a musician'>High school student looking toward career as a musician</option>";
    echo "<option value='Undergraduate music minor'>Undergraduate music minor</option>";
    echo "<option value='Undergraduate music major'>Undergraduate music major</option>";
    echo "<option value='Masters music student'>Masters music student</option>";
    echo "<option value='Doctoral music student'>Doctoral music student</option>";
    echo "<option value='Amateur adult musician'>Amateur adult musician</option>";
    echo "<option value='Part-time professional musician'>Part-time professional musician</option>";
    echo "<option value='Full-time professional musician in early career stage'>Full-time professional musician in early career stage</option>";
    echo "<option value='Full-time professional musician for at least ten years'>Full-time professional musician for at least ten years</option>";
    echo "<option value='Other'>Other</option>";
    echo "</select>";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<select name='primaryInstrument'>";
    echo "<option value='Woodwind'>Woodwind</option>";
    echo "<option value='Brass'>Brass</option>";
    echo "<option value='Strings'>Strings</option>";
    echo "<option value='Percussion'>Percussion</option>";
    echo "<option value='Keyboard'>Keyboard</option>";
    echo "<option value='Vocalist'>Vocalist</option>";
    echo "<option value='Conductor'>Conductor</option>";
    echo "</select>"; 
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<select name='proPerformances'>";
    echo "<option value='0'>0</option>";
    echo "<option value='1'>1</option>";
    echo "<option value='2'>2</option>";
    echo "<option value='3'>3</option>";
    echo "<option value='4'>4</option>";
    echo "<option value='5'>5</option>";
    echo "<option value='6'>6</option>";
    echo "<option value='7'>7</option>";
    echo "<option value='8'>8</option>";
    echo "<option value='9'>9</option>";
    echo "<option value='10'>10</option>";
    echo "<option value='10+'>10+</option>";
    echo "</select>"; 
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<select name='allPerformances'>";
    echo "<option value='0'>0</option>";
    echo "<option value='1'>1</option>";
    echo "<option value='2'>2</option>";
    echo "<option value='3'>3</option>";
    echo "<option value='4'>4</option>";
    echo "<option value='5'>5</option>";
    echo "<option value='6'>6</option>";
    echo "<option value='7'>7</option>";
    echo "<option value='8'>8</option>";
    echo "<option value='9'>9</option>";
    echo "<option value='10'>10</option>";
    echo "<option value='10+'>10+</option>";
    echo "</select>"; 
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='radio' name='medical' value='Yes'> Yes";
    echo "<input type='radio' name='medical' value='No'> No";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='radio' name='drugs' value='Yes'> Yes";
    echo "<input type='radio' name='drugs' value='No'> No";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='radio' name='medication' value='Yes'> Yes";
    echo "<input type='radio' name='medication' value='No'> No";
    echo "<br>";

    $row = $result->fetch_array(MYSQLI_ASSOC);
    echo $row['questionNumber'].".) ";
    echo $row['question'];
    echo "<input type='text' name='goals'>";
    echo "<br>";

  }
  else
  {
    echo "<p>";
    echo "Query Error: " .$mysqli->error;
    echo "<p>";
  }

//-----------------------------------------------------------------------------

  echo "<h3>5-Point Scale Questions</h3>";
  echo "<p>For the following questions, please answer with a number between 1 and 5.<br>
    1 meaning “strongly disagree,”<br> 
    2 meaning “disagree,”<br> 
    3 meaning “undecided” or “neutral,”<br> 
    4 meaning “agree,” and<br> 
    5 meaning “strongly agree.”<br>  
    Select the appropriate number.<br>
  </p>";

  for($j = 1; $j<=158; $j++)
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
        echo "<input type='radio' name='".$row["questionNumber"]."' value='1'> 1";
        echo "<input type='radio' name='".$row["questionNumber"]."' value='2'> 2";
        echo "<input type='radio' name='".$row["questionNumber"]."' value='3'> 3";
        echo "<input type='radio' name='".$row["questionNumber"]."' value='4'> 4";
        echo "<input type='radio' name='".$row["questionNumber"]."' value='5'> 5";
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
  }
  echo "<input type='submit'>";
  echo "</form>";

  $mysqli->close();
}
?>

</body>
</html>
