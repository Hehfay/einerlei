<?php
session_start();
if(!isset($_SESSION['id']))
{
  header('Location: ../please-login/');
  exit();
}
$mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
if($mysqli)
{
  $query1 = "delete from DemographicAnswer where license_id = ".$_SESSION["id"].";";
  $mysqli->query($query1);
  for($i = 1; $i <= 14; $i++)
  {
    $query1 = "insert into DemographicAnswer(license_id, demographic_question_id, answer) values(".$_SESSION["id"].", $i, '');";
    $mysqli->query($query1);
  }

  $query1 = "delete from LikertAnswer where license_id = ".$_SESSION["id"].";";
  $mysqli->query($query1);
  for($i = 1718; $i <= 1874; $i++)
  {
    $query1 = "insert into LikertAnswer(license_id, question_id, answer) values(".$_SESSION["id"].", $i, 6);";
    $mysqli->query($query1);
  }
}
$mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>MPADQ Online Diagnostics Test</title>
  <link rel="stylesheet" href="../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<body>
<section>
  <img src='../images/einerlei_publishing_site001005.png'>
</section>
<div id="container">
<div id="content">
  <p>Welcome to the online performance anxiety diagnostic questionnaire for <em>Take Charge of Your Performance Anxiety: A Personalized Approach to Conquering Stage Fright</em>.</p>
  <p>Completion of this questionnaire will provide you with information regarding your individual performance anxiety that will aid you in getting the most out of the book.</p>
  <p>The combined responses of all participants may be utilized for statistical research regarding performance anxiety prevalence, symptomatology, and other factors, but your individual responses will remain confidential.</p>
  <p>Please answer all of the questions on this questionnaire as truthfully as possible for the most accurate results.  While some questions may seem irrelevant to performing, your perspective on them contributes to your overall psychological state, which is a large part of performance anxiety.</p>
  <p><strong>You must complete the questionnaire in one sitting: you cannot save progress a partially complete questionnaire.</strong>  Most people find half an hour to be enough time to thoughtfully complete it.</p>
  <p>Taking this diagnostic questionnaire is voluntary and you may choose to disengage at any time. Your unique code will not be unusable again until you click the final submit at the end of the questionnaire.</p>
  <div id="button">
    <a href="../demographics/">Click Here To Begin Questionnaire</a>
  </div>
  </div>
  </div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
