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
<h1>Edit Demographic and Likert Questions</h1>
<?php
  echo "<h4>Select Demographic Question</h4>";
  $mysqli = new mysqli("", "imeisner", "imeisner", "Quiz");
  if($mysqli)
  {
    $query = "select id, question from DemographicQuestion;";
    $result = $mysqli->query($query);
    echo "<form action='edit-dem/' method='post'>";
    echo "<select name='id' required>";
    echo "<option disabled selected value>-- select an option --</option>";
    while($li = $result->fetch_array())
    {
      echo "<option value=$li[0]>$li[1]</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Edit'>";
    echo "</form>";

    echo "<h4>Select Likert Question</h4>";
    $query = "select id, question category from LikertQuestion;";
    $result = $mysqli->query($query);
    echo "<form action='edit-likert/' method='post'>";
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
