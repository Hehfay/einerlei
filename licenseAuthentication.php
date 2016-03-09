<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php

$license = $_POST["license"];
$key = $_POST["key"];
$goback = "index.html";
if($license != $key)
{
  echo "<h1>Your key is invalid.</h1>";
  echo "<form action= ".$goback;
  echo "> <input type ='submit' value = 'Go Back'> </form>";
}
else
{
  echo "<h1>Sample Key Hashed Using md5:</h1>";
  echo "<h4>";
  echo $license ;
  echo "</h4>";
  echo "  ---------------->  ";
  echo "<h4>";
  echo hash ("md5",$license);
  echo "</h4>";

  $beginning = "JSON/likertScaleFormJSON.html";

  echo "<br>";

  echo "<form action= ".$beginning;
  echo "> <input type ='submit' value = 'Continute'> </form>";
  echo "<h4>Press Continue to Start the Quiz</h4>";
}


?>
