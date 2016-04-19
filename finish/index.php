<?php
session_start();
if(!isset($_SESSION['id']))
{
  header('Location: ../please-login/');
  exit();
}
if(!isset($_SESSION['demo_complete']))
{
  header('Location: ../demographics/');
  exit();
}
/* Compute Results */
/* Sub Categories For Now */
$mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
$mysqli1 = new mysqli("", "jhartma0", "jhartma0", "Quiz");
if(!$mysqli || !$mysqli1)
{
  exit();
}
$delete_stuff = "delete from SubCategoryResult where license_id = ".$_SESSION["id"].";";
$mysqli->query($delete_stuff);
$query1 = "select count(*) from LikertAnswerSubCategory;";
$result1 = $mysqli->query($query1);
$num_sub_categories = $result1->fetch_row();
$_SESSION["num_sub_categories"] = $num_sub_categories[0];
for($i = 1; $i <= $num_sub_categories[0]; $i++)
{
  $query0 = "select LikertAnswer.answer from LikertAnswer join LikertQuestion on LikertAnswer.question_id = LikertQuestion.id and LikertQuestion.sub_category_id1 = $i and LikertAnswer.license_id = ".$_SESSION["id"].";";
  $subID2 = "select LikertAnswer.answer from LikertAnswer join LikertQuestion on LikertAnswer.question_id = LikertQuestion.id and LikertQuestion.sub_category_id2 = $i and LikertAnswer.license_id = ".$_SESSION["id"].";";
  /*Compute average*/
  $result2 = $mysqli->query($query0);
  $result3 = $mysqli->query($subID2);
  if($result2 && $result3)
  {
    $sum = 0;
    $NA_Total = 0;
    $Question_Total = 0;
    $num_rows = $result2->num_rows;
    $num_rows += $result3->num_rows;
    if($num_rows == 2)
    {
      $min_req_answered = 1;
    }
    else
    {
      $min_req_answered = 2;
    }
    while($score = $result2->fetch_row())
    {
      if($score[0] == 6)
      {
        $NA_Total++;
      }
      else
      {
        $sum += $score[0];
        $Question_Total++;
      }
    }

    while($score = $result3->fetch_row())
    {
      if($score[0] == 6)
      {
        $NA_Total++;
      }
      else
      {
        $sum += $score[0];
        $Question_Total++;
      }
    }

    if($NA_Total > $min_req_answered)
    {
      $average = -1; /* NA */
    }
    else
    {
      $average = $sum / $Question_Total;
      $average = round($average);
    }
    /*Store results*/
    $query2 = "insert into SubCategoryResult(license_id, sub_category_id, result) values(".$_SESSION["id"].", $i, $average);";
    $mysqli->query($query2);
  }
  else
  {
    echo "<p>Error Try Later</p>";
  }
}
$mysqli1->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Results</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
<div id="introduction">
<h1>Your Results</h1>
<?php
  /* Grab the category and the text areas */
  for($i = 1; $i <= $_SESSION["num_sub_categories"]; $i++)
  {
    $query = "select category, text_area1, text_area2 from LikertAnswerSubCategory where id = $i;";
    $usr_answ_query = "select result from SubCategoryResult where sub_category_id = $i and license_id = ".$_SESSION["id"].";";
    $result = $mysqli->query($query);
    $result3 = $mysqli->query($usr_answ_query);
    $row = $result->fetch_row();
    $answer = $result3->fetch_row();
    if($answer[0] == -1)
    {
      $answer[0] = "N/A";
    }
    else
    {
      $answer[0] = $answer[0]."%";
    }
    echo "<h4>".$row[0]."</h4>";
    echo "<p>".$row[1]."</p>";
    echo "<h4>Your Score for ".$row[0].": ".$answer[0]."."."</h4>"."<p>".$row[2]."</p>";
  }
  $query = "update License set active = false where id = ".$_SESSION["id"].";";
  $mysqli->query($query);
  $mysqli->close();
  session_unset();
  session_destroy();
?>
<p><a href="../" id="einerlei-link">Home</a></p>
<p><a href="http://www.einerleipublishing.com/einerlei_publishing_site_002.htm" id="einerlei-link" target="_blank">einerleipublishing.com</a></p>
</div>
</body>
</html>
