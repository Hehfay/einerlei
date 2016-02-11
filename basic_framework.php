<!DOCTYPE html>
<html>
<head>
<title>Course Read</title>
</head>
<body>
<h1>Course Read</h1>
<h2>List the rows of the Course table.</h2>
<?php
$host = "";
$username = "imeisner";
$password = "imeisner";
$database = "imeisner";

$mysqli = new mysqli( $host, $username, $password, $database);

if( mysqli_connect_errno())
{
  echo "Error connecting: ".mysqli_connect_errno();
}
else
{
  //do stuff with the mysqli connection
  $query = "select * from Course;";

  $result = $mysqli->query($query);

  if( $result)
  {
    //do something
  }
  else
  {
    echo "Query Error: ".$mysqli->error;
  }
  $mysqli->close();
}
?>
</body>
</html>
