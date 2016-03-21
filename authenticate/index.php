<!DOCTYPE html>
<html>
<head>
  <title>Authenticate</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<?php

$license = $_POST["license"];
$key = $_POST["key"];
$goback = "../";
if($license != $key)
{
  echo "<h1>Your key is invalid.</h1>";
  echo "<form action= ".$goback;
  echo "> <input type ='submit' value = 'Go Back'> </form>";
  echo "<ul>";
  echo "<li>";
  echo "This page exists to show we are validating keys. On the final version, an invalid key would simply reload the previous page with this error message.";
  echo "</li>";
  echo "</ul>";
}
else
{
  echo "<h1>Sample Key Hashed Using md5:</h1>";
  echo "<h4>";
  echo "User's key: ".$license;
  echo "</h4>";
  echo "  ---------------->  ";
  echo "<h4>";
  echo "Value stored in Database: ".hash("md5",$license);
  echo "</h4>";

  $beginning = "../start/";
echo <<<_HTML
<ul>
  <li>The purpose of this hash is to protect anonymity between a user and their answers.</li>
</ul>
_HTML;
  echo "<br>";

  echo "<form action= ".$beginning;
  echo "> <input type ='submit' value = 'Continute'> </form>";
  echo "<h4>Press Continue to Start the Quiz</h4>";
}
?>

