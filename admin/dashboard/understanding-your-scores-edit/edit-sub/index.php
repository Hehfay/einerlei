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
<h1>Edit Understanding Your Scores Text</h1>
<?php
  require_once '../../../../src/login.php';
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
  if($mysqli)
  {
    $query = "select text_area1, text_area2, category from LikertAnswerSubCategory where id=".$_POST["id"].";";
    $result = $mysqli->query($query);
    $text = $result->fetch_array();
    echo "<p>$text[2]</p>";
    echo "<form action='../confirm/' method='post' id='edit'>";
    echo "<textarea rows=10 form='edit' name='first'>";
    echo $text[0];
    echo "</textarea>";
    echo "<p>The following text is displayed after a user's score for '$text[2].'</p>";
    echo "<textarea rows=10 form='edit' name='second'>";
    echo $text[1];
    echo "</textarea>";
    echo "<input type='hidden' name='id' value=".$_POST["id"].">";
    echo "<input type='hidden' name='cat_type' value='Sub'>";
    echo "<input type='submit' value='Submit' id='button-no-float'>";
    echo "</form>";
    $mysqli->close();
  }
  else
  {
    exit();
  }
?>
<ol>
  <li><a href="../">Back</a></li>
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
