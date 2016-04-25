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
<h1>Edit Understanding Your Scores Text</h1>
<?php
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
  if($mysqli)
  {
    $query = "select text_area1, text_area2 from LikertAnswerSubCategory where id=".$_POST["id"].";";
    $result = $mysqli->query($query);
    $text = $result->fetch_array();
    echo "<form action='submit' method='post'>";
    echo "<textarea rows=10>";
    echo $text[0];
    echo "</textarea>";
    echo "<h4>The following text is displayed after a user's score is displayed.</h4>";
    echo "<textarea rows=10>";
    echo $text[1];
    echo "</textarea>";
    echo "<input type='submit' value='Submit'>";
    echo "</form>";
  }
  else
  {
    exit();
  }
?>
<ol>
  <li><a href="../../">Dashboard</a></li>
</ol>
</body>
</html>
