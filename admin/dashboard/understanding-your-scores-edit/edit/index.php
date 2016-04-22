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
    $query = "select text_area1, text_area2, category from LikertAnswerSubCategory where id=".$_POST["id"].";";
    $result = $mysqli->query($query);
    $text = $result->fetch_array();
    echo "<h4>$text[2]</h4>";
    echo "<form action='../confirm/' method='post' id='edit'>";
    echo "<textarea rows=10 form='edit' name='first'>";
    echo $text[0];
    echo "</textarea>";
    echo "<p>The following text is displayed after a user's score for '$text[2].'</p>";
    echo "<textarea rows=10 form='edit' name='second'>";
    echo $text[1];
    echo "</textarea>";
    echo "<input type='hidden' name='id' value=".$_POST["id"].">";
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
</body>
</html>
