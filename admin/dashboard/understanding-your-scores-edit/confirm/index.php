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
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
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
    $p1 = $_POST["first"];
    $p1 = $mysqli->real_escape_string($p1);
    $p1 = stripslashes($p1);
    $p1 = htmlentities($p1);
    $p1 = strip_tags($p1);
    $p2 = $_POST["second"];
    $p2 = $mysqli->real_escape_string($p2);
    $p2 = stripslashes($p2);
    $p2 = htmlentities($p2);
    $p2 = strip_tags($p2);
    $query = "update LikertAnswer".$_POST["cat_type"]."Category set text_area1 = \"".$p1."\" where id = ".$_POST['id'].";";
    $mysqli->query($query);
    $query = "update LikertAnswer".$_POST["cat_type"]."Category set text_area2 = '".$p2."' where id = ".$_POST['id'].";";
    $mysqli->query($query);
    echo "<p>".$_POST["first"]."</p>";
    echo "<p>".$_POST["second"]."</p>";
    $mysqli->close();
  }
  else
  {
    exit();
  }
?>
<ol>
  <li><a href="../">Select Category</a></li>
  <li><a href="../../">Dashboard</a></li>
</ol>
</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
