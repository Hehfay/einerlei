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
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
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
  require_once('../../../src/login.php');
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
  if($mysqli)
  {
    $query = "select id, question from DemographicQuestion;";
    $result = $mysqli->query($query);
    if($result)
    {
      //echo $result;
      echo "<form action='dem-edit/' method='post'>";
      echo "<select name='id' required>";
      echo "BING";
      echo "<option disabled selected value>-- select an option --</option>";
      while($li = $result->fetch_array())
      {
        echo "<option value=$li[0]>$li[1]</option>";
      }
      echo "</select>";
      echo "<input type='submit' value='Edit' id='button-no-float'>";
      echo "</form>";
    }else
    {
      echo "Query failed!";
    }

    echo "<h4>Select Likert Question</h4>";
    $query = "select id, question category from LikertQuestion;";
    $result = $mysqli->query($query);
    echo "<form action='likert-edit/' method='post'>";
    echo "<select name='id' required>";
    echo "<option disabled selected value>-- select an option --</option>";
    while($li = $result->fetch_array())
    {
      echo "<option value=$li[0]>$li[1]</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='Edit' id='button-no-float'>";
    echo "</form>";
    $mysqli->close();
  }
   
?>

<ol>
  <li><a href="../">Dashboard</a></li>
</ol>
</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
