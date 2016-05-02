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

/* Broad Categories */
$delete_stuff = "delete from BroadCategoryResult where license_id = ".$_SESSION["id"].";";
$mysqli->query($delete_stuff);
$average = 0;
$counter = 0;
$overall_total = 0;
$overall_counter = 0;
for($i = 1; $i <= 3; $i++)
{
  $query = "select result from SubCategoryResult where sub_category_id = $i and license_id=".$_SESSION["id"].";";
  $result = $mysqli->query($query);
  $score = $result->fetch_row();
  if($score[0] != -1)
  {
    $overall_total += $score[0];
    $overall_counter++;
    $average += $score[0];
    $counter++;
  }
}
if($counter == 0)
{
  $average = -1;
}
else
{
  $average /= $counter;
  $average = round($average);
}
$query = "insert into BroadCategoryResult(license_id, broad_category_id, result) values(".$_SESSION["id"].", 1, ".$average.");";
$mysqli->query($query);

$average = 0;
$counter = 0;
for($i = 4; $i <= 24; $i++)
{
  $query = "select result from SubCategoryResult where sub_category_id = $i and license_id=".$_SESSION["id"].";";
  $result = $mysqli->query($query);
  $score = $result->fetch_row();
  if($score[0] != -1)
  {
    $average += $score[0];
    $counter++;
    $overall_total += $score[0];
    $overall_counter++;
  }
}
if($counter == 0)
{
  $average = -1;
}
else
{
  $average /= $counter;
  $average = round($average);
}
$query = "insert into BroadCategoryResult(license_id, broad_category_id, result) values(".$_SESSION["id"].", 2, ".$average.");";
$mysqli->query($query);

/* Overall Score */
if($overall_counter == 0)
{
  $overall_total = -1;
}
else
{
  $overall_total /= $overall_counter;
  round($overall_total);
}
$query = "insert into BroadCategoryResult(license_id, broad_category_id, result) values(".$_SESSION["id"].", 3, ".$average.");";
$mysqli->query($query);

$mysqli1->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Results</title>
  <link rel="stylesheet" href="../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<body>
<a name='0'></a>
<section>
  <img src='../images/einerlei_publishing_site001005.png'>
</section>
<div id="container">
<div id="content">
<h1>Your Results</h1>
<h4>Note you can view your results at any time by entering your code at the home page.</h4>
<?php
  // Build list
  // Overall
  echo "<ul id='sub-category-links'>";
  $query = "select category from LikertAnswerBroadCategory where id = 3;";
  $result = $mysqli->query($query);
  $row = $result->fetch_row();
  echo "<li id='link'><a href='#$row[0]'>$row[0]</a></li>";
  echo "</ul>";

  // Category Scoring
  echo "<ul id='sub-category-links'>";
  $query = "select category from LikertAnswerBroadCategory where id = 4;";
  $result = $mysqli->query($query);
  $row = $result->fetch_row();
  echo "<li id='link'><a href='#$row[0]'>$row[0]</a></li>";
  echo "</ul>";

  // Symptomatology
  echo "<ul>";
  $query = "select category from LikertAnswerBroadCategory where id = 1;";
  $result = $mysqli->query($query);
  $row = $result->fetch_row();
  echo "<li id='link'><a href='#$row[0]'>$row[0]</a></li>";

  echo "<ul id='sub-category-links'>";
  /* Grab the category and the text areas */
  for($i = 1; $i <= 3; $i++)
  {
    $query = "select category, text_area1, text_area2 from LikertAnswerSubCategory where id = $i;";
    $result = $mysqli->query($query);
    while($row = $result->fetch_row())
    {
      echo "<li id='link'><a href='#$row[0]'>$row[0]</a></li>";
    }
  }
  echo "</ul>";
  echo "</ul>";

  // Contributing factors
  echo "<ul>";
  $query = "select category from LikertAnswerBroadCategory where id = 2;";
  $result = $mysqli->query($query);
  $row = $result->fetch_row();
  echo "<li id='link'><a href='#$row[0]'>$row[0]</a></li>";
  echo "<ul id='sub-category-links'>";
  /* Grab the category and the text areas */
  for($i = 4; $i <= 24; $i++)
  {
    $query = "select category, text_area1, text_area2 from LikertAnswerSubCategory where id = $i;";
    $result = $mysqli->query($query);
    while($row = $result->fetch_row())
    {
      echo "<li id='link'><a href='#$row[0]'>$row[0]</a></li>";
    }
  }
  echo "</ul>";
  echo "</ul>";

  $query = "select category, text_area1, text_area2 from LikertAnswerBroadCategory where id = 3;";
  $usr_answ_query = "select result from BroadCategoryResult where broad_category_id = 3 and license_id = ".$_SESSION["id"].";";
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
  echo "<a name='$row[0]'></a>";
  echo "<h4 id='result'>".$row[0]."</h4>";
  echo "<p>".$row[1]."</p>";
  echo "<h4 id='result'>Your ".$row[0]." Score: ".$answer[0]."."."</h4>"."<p id='p-result'>".$row[2]."</p>";
  echo "<a id='a-result' href='#0'>Top</a>";

  $query = "select category, text_area1, text_area2 from LikertAnswerBroadCategory where id = 4;";
  $result = $mysqli->query($query);
  $row = $result->fetch_row();
  echo "<a name='$row[0]'></a>";
  echo "<h4 id='result'>".$row[0]."</h4>";
  echo "<p>".$row[1]."</p>";
  echo "<h4 id='result'>".$row[0]."</h4>"."<p id='p-result'>".$row[2]."</p>";
  echo "<a id='a-result' href='#0'>Top</a>";

  $query = "select category, text_area1, text_area2 from LikertAnswerBroadCategory where id = 1;";
  $usr_answ_query = "select result from BroadCategoryResult where broad_category_id = 1 and license_id = ".$_SESSION["id"].";";
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
  echo "<a name='$row[0]'></a>";
  echo "<h4 id='result'>".$row[0]."</h4>";
  echo "<p>".$row[1]."</p>";
  echo "<h4 id='result'>Your Score for ".$row[0].": ".$answer[0]."."."</h4>"."<p id='p-result'>".$row[2]."</p>";
  echo "<a id='a-result' href='#0'>Top</a>";
  for($i = 1; $i <= 3; $i++)
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
    echo "<a name='$row[0]'></a>";
    echo "<h4 id='result'>".$row[0]."</h4>";
    echo "<p>".$row[1]."</p>";
    echo "<h4 id='result'>Your Score for ".$row[0].": ".$answer[0]."."."</h4>"."<p id='p-result'>".$row[2]."</p>";
    echo "<a id='a-result' href='#0'>Top</a>";
  }
  $query = "select category, text_area1, text_area2 from LikertAnswerBroadCategory where id = 2;";
  $usr_answ_query = "select result from BroadCategoryResult where broad_category_id = 2 and license_id = ".$_SESSION["id"].";";
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
  echo "<a name='$row[0]'></a>";
  echo "<h4 id='result'>".$row[0]."</h4>";
  echo "<p>".$row[1]."</p>";
  echo "<h4 id='result'>Your Score for ".$row[0].": ".$answer[0]."."."</h4>"."<p id='p-result'>".$row[2]."</p>";
  echo "<a id='a-result' href='#0'>Top</a>";
  for($i = 4; $i <= 24; $i++)
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
    echo "<a name='$row[0]'></a>";
    echo "<h4 id='result'>".$row[0]."</h4>";
    echo "<p>".$row[1]."</p>";
    echo "<h4 id='result'>Your Score for ".$row[0].": ".$answer[0]."."."</h4>"."<p id='p-result'>".$row[2]."</p>";
    echo "<a id='a-result' href='#0'>Top</a>";
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
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
