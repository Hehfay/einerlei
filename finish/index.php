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
$delete_stuff = "delete from SubCategoryResult where license_id = ".$_SESSION["id"].";";
$query1 = "select count(*) from LikertAnswerSubCategory;";
$result1 = $mysqli->query($query1);
$num_sub_categories = $result1->fetch_row();
$_SESSION["num_sub_categories"] = $num_sub_categories[0];
for($i = 1; $i <= $num_sub_categories[0]; $i++)
{
  $query0 = "select LikertAnswer.answer from LikertAnswer join LikertQuestion on LikertAnswer.question_id = LikertQuestion.id and LikertQuestion.sub_category_id1 = $i and LikertAnswer.license_id = ".$_SESSION["id"].";";
  /*Compute average*/
  if($result2 = $mysqli->query($query0))
  {
    $k_max = $result2->num_rows;
    $sum = 0;
    while($score = $result2->fetch_row())
    {
      $sum += $score[0];
    }
    $average = $sum / $k_max;
    //printf("k_max: %d\n", $k_max);
    //printf("Sub Category ID: %d\nAverage: %d\n", $i, $average);

    /*Store results*/
    $average = round($average);
    $query2 = "insert into SubCategoryResult(license_id, sub_category_id, result) values(".$_SESSION["id"].", $i, $average);";
    $mysqli->query($query2);
    //printf("Query: %s\n", $query2);
    //printf("%s\n", $query2);
  }
  else
  {
    //printf("Your Query is fucked up\n");
  }
  //printf("================================================================\n");
}
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
  //printf("%s\n%s\nYour score for %s: %d%s. %s\n", $row[0], $row[1], $row[0], $answer[0], "%", $row[2]);
  //printf("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\n");
  echo "<h4>".$row[0]."</h4>";
  echo "<p>".$row[1]."</p>";
  echo "<h4>Your Score for ".$row[0].": ".$answer[0]."%."."</h4>"."<p>".$row[2]."</p>";
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
