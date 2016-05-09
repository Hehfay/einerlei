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
  require_once '../../../../src/login.php';
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
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

  $handle = fopen("../../../../demographics/demographicQuestions.json", "w");
  if(!$handle)
  {
    exit();
  }
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
  if(!$mysqli)
  {
    exit();
  }
  fwrite($handle, "{\n");
  $query = "select question from DemographicQuestion order by question_order;";
  $result = $mysqli->query($query);
  $max = $result->num_rows;
  $row = $result->fetch_array();
  for($i = 1; $i < $max; $i++)
  {
    fwrite($handle, "\"question$i\":\"$row[0]\",\n");
    $row = $result->fetch_array();
  }
  fwrite($handle, "\"question$i\":\"$row[0]\"\n");
  fwrite($handle, "}");
  $mysqli->close();
  fclose($handle);

?>
<ol>
  <li><a href="../">Select Another Question</a></li>
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
