<?php
session_start();
if(!isset($_SESSION["loggedin"]))
{
  header('Location: ../../../');
  exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Text Edit</title>
  <link rel="stylesheet" href="../../../../style.css">
</head>
<body>
<section>
  <img src='../../../../images/einerlei_publishing_site001005.png'>
</section>
<div id="container">
<div id="content">
<h1>Changes Saved</h1>
<?php
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
  if($mysqli)
  {
    $p1 = $_POST["questionText"];
    $p1 = $mysqli->real_escape_string($p1);
    $p1 = stripslashes($p1);
    $p1 = htmlentities($p1);
    $p1 = strip_tags($p1);
    $query = "update ".$_POST["tableName"]."Question set question = \"".$p1."\" where id = ".$_POST['id'].";";
    $mysqli->query($query);
    echo "<p>".$_POST["questionText"]."</p>";
    $mysqli->close();
  }
  else
  {
    exit();
  }
?>
<ol>
  <li><a href="../">Select Another Question</a></li>
  <li><a href="../../">Dashboard</a></li>
</ol>
</div>
</div>
</body>
</html>
