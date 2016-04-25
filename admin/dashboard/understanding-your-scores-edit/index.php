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
<section>
  <img src='../../../images/einerlei_publishing_site001005.png'>
</section>
<div id="container">
<div id="content">
<h1>Edit Understanding Your Scores Text</h1>
<?php
  echo "<h4>Select a Broad Category</h4>";
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
  if($mysqli)
  {
    $query = "select id, category from LikertAnswerBroadCategory;";
    $result = $mysqli->query($query);
    echo "<form action='edit-broad/' method='post'>";
    echo "<select name='id' required>";
    echo "<option disabled selected value>-- select an option --</option>";
    while($li = $result->fetch_array())
    {
      echo "<option value=$li[0]>$li[1]</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Edit'>";
    echo "</form>";

    echo "<h4>Select a Sub Category</h4>";
    $query = "select id, category from LikertAnswerSubCategory;";
    $result = $mysqli->query($query);
    echo "<form action='edit-sub/' method='post'>";
    echo "<select name='id' required>";
    echo "<option disabled selected value>-- select an option --</option>";
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
</div>
</div>
</body>
</html>
