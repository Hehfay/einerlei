<?php
session_start();
if(!isset($_SESSION["loggedin"]))
{
  header('Location: ../../../');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Text Edit</title>
  <link rel="stylesheet" href="../../../style.css">
</head>
<body>
<h1>Edit Understanding Your Scores Text</h1>
<h4>Select a Sub Category</h4>
<?php
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
  if($mysqli)
  {
    $query = "select id, category from LikertAnswerSubCategory;";
    $result = $mysqli->query($query);
    echo "<form action='edit/' method='post'>";
    echo "<select name='id'>";
    while($li = $result->fetch_array())
    {
      echo "<option value=$li[0]>$li[1]</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Edit'>";
    echo "</form>";
    $mysqli->close();
  }
?>

<ol>
  <li><a href="../">Dashboard</a></li>
</ol>
</body>
</html>
