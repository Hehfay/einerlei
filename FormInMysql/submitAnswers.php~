<?php
$gender = $_POST["gender"];
$age = $_POST["gender"];
$yearsStudying = $_POST["yearsStudying"];
$ageMusicalInstruction = $_POST["ageMusicalInstruction"];
$ageMusicalStudying = $_POST["ageMusicalStudying"];
$currently = $_POST["currently"];
$primaryInstrument = $_POST["primaryInstrument"];
$proPerformances = $_POST["proPerformances"];
$allPerformances = $_POST["numPerformances"];
$medical = $_POST["medical"];
$numDrinks = $_POST["numDrinks"];
$drugs = $_POST["drugs"];
$medication = $_POST["medication"];
$goals = $_POST["goals"];

$host = "";
$username = "imeisner";
$password = "imeisner";
$database = "Quiz";

$mysqli = new mysqli( $host, $username, $password, $database);

if( mysqli_connect_errno())
{
  echo "Error connecting: ".mysqli_connect_errno();
}
else
{
  $query = "insert into Answers (";
  $query = $query.");";

  $result = $mysqli->query($query);

  $mysqli->close();
}
?>
