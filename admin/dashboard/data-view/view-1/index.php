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
  <title>View 1</title>
  <link rel="stylesheet" href="../../../../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<section>
  <img src='../../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
<h1>View 1</h1>
<h4>View 1 displays each question as a column and has corresponding answers as row entires.</h4>
<?php
require_once '../../../../src/login.php';
$fname = 'View1.csv';
$mode = 'w';
$filehandle = fopen($fname, $mode);
if($filehandle == false)
{
  echo "Error: File could not be written to.\n";
}
else
{
  fwrite($filehandle, "User,");
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
  if($mysqli->connect_errno)
  {
    fwrite($filehandle, "/* Mysqli connect error: $mysqli->connect_errno */\n");
    exit();
  }
  else
  {
    $query2 = "select count(*) from DemographicQuestion;";
    if($result = $mysqli->query($query2))
    {
      $result = $result->fetch_row();
      $count = $result[0];
    }
    else
    {
      exit();
    }

    $query1 = "select id, question from DemographicQuestion;";
    if($result = $mysqli->query($query1))
    {
      $i = 0;
      for($k = 0; $k < $count; $k++)
      {
        $row = $result->fetch_assoc();
        $demo_id[$i++] = $row["id"];
        $row["question"] = str_replace(",", " ", $row["question"]);
        fwrite($filehandle, $row["question"].",");
      }
    }
    else
    {
      exit();
    }
    $query2 = "select count(*) from LikertQuestion;";
    if($result = $mysqli->query($query2))
    {
      $result = $result->fetch_row();
      $count = $result[0];
    }
    else
    {
      exit();
    }
    $query2 = "select id, question from LikertQuestion;";
    if($result = $mysqli->query($query2))
    {
      $i = 0;
      for($k = 0; $k < $count; $k++)
      {
        $row = $result->fetch_assoc();
        $likert_id[$i++] = $row["id"];
        $row["question"] = str_replace(",", " ", $row["question"]);
        fwrite($filehandle, $row["question"]);
        if($k == $count-1)
        {
          fwrite($filehandle, "\n");
        }
        else
        {
          fwrite($filehandle, ",");
        }
      }
    }
    // The file header is set up.
    $query = "select id from License where active = false;";
    $result = $mysqli->query($query);
    $likert_id_count = count($likert_id);
    while($license_id = $result->fetch_row())
    {
      fwrite($filehandle, $license_id[0].",");
      for($i = 0; $i < count($demo_id); $i++)
      {
        $query = "select answer from DemographicAnswer where license_id = $license_id[0] and demographic_question_id = $demo_id[$i];";
        $result1 = $mysqli->query($query);
        $answer = $result1->fetch_assoc();
        fwrite($filehandle, "'".$answer["answer"].",");
      }
      for($i = 0; $i < $likert_id_count; $i++)
      {
        $query = "select answer from LikertAnswer where license_id = $license_id[0] and question_id = $likert_id[$i];";
        $result2 = $mysqli->query($query);
        $answer2 = $result2->fetch_assoc();
        fwrite($filehandle, $answer2["answer"]);
        if($i == $likert_id_count - 1)
        {
          fwrite($filehandle, "\n");
        }
        else
        {
          fwrite($filehandle, ",");
        }
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
