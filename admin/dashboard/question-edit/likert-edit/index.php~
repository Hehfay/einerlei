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
<h1>Edit Understanding Your Scores Text</h1>
<?php
  $mysqli = new mysqli("", "imeisner", "imeisner", "Quiz");
  if($mysqli)
  {
    $query = "select id, question from LikertQuestion where id=".$_POST["id"].";";
    $result = $mysqli->query($query);
    $text = $result->fetch_array();
    echo "<p>$text[2]</p>";
    echo "<form action='../confirm/' method='post' id='edit'>";
    echo "<p>Question Text:</p>";
    echo "<textarea rows=2 form='edit' name='questionText'>";
    echo $text[1];
    echo "</textarea>";
    echo "<input type='hidden' name='id' value=".$_POST["id"].">";
    echo "<input type='hidden' name='tableName' value='Likert'>";
    echo "<input type='submit' value='Submit'>";
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
</body>
</html>
