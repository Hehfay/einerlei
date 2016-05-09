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
  <title>View 2</title>
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
<h1>View 2</h1>
<h4>View 2 has 3 columns: <strong>User</strong>, <strong>Question</strong>, and <strong>Answer</strong>.</h4>
<?php
require_once '../../../../src/login.php';
$fname = 'View2.csv';
$mode = 'w';
$filehandle = fopen($fname, $mode);
if($filehandle == false)
{
  echo "Error: File could not be written to.\n";
}
else
{
  fwrite($filehandle, "User, Question, Answer\n");
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
  if($mysqli->connect_errno)
  {
    fwrite($filehandle, "/* Mysqli connect error: $mysqli->connect_errno */\n");
    exit();
  }
  else
  {
    $query = "select id from License where active = false;";
    $result = $mysqli->query($query);
    while($license_id = $result->fetch_row())
    {
      $query = "select DemographicAnswer.license_id, DemographicQuestion.question, DemographicAnswer.answer from DemographicQuestion join DemographicAnswer on DemographicQuestion.id = DemographicAnswer.demographic_question_id and license_id = $license_id[0];";
      $result1 = $mysqli->query($query);
      while($answer = $result1->fetch_assoc())
      {
        $answer["question"] = str_replace(",", " ", $answer["question"]);
        fwrite($filehandle, $answer["license_id"].",".$answer["question"].","."'".$answer["answer"]."\n");
      }

      $query = "select LikertAnswer.license_id, LikertQuestion.question, LikertAnswer.answer from LikertQuestion join LikertAnswer on LikertQuestion.id = LikertAnswer.question_id and license_id = $license_id[0];";
      $result1 = $mysqli->query($query);
      while($answer = $result1->fetch_assoc())
      {
        $answer["question"] = str_replace(",", " ", $answer["question"]);
        fwrite($filehandle, $answer["license_id"].",".$answer["question"].",".$answer["answer"]."\n");
      }
    }
    $mysqli->close();
  }
  fclose($filehandle);
}
echo "<p>Click <a href='$fname' download>here</a> to download the latest data in this view.</p>";
?>
<ol>
  <li><a href="../">Go Back</a></li>
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
