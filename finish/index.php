<?php
session_start();
if(!isset($_SESSION['id']))
{
  header('Location: ../please-login/');
}
if(!isset($_SESSION['demo_complete']))
{
  header('Location: ../demographics/');
}
/* Compute Results */
/* Sub Categories First */
$mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
$query1 = "select count(*) from LikertAnswerSubCategory;";
$result1 = $mysqli->query($query1);
$num_sub_categories = $result1->fetch_row();
for($i = 1; $i <= $num_sub_categories[0]; $i++)
{
  $query0 = "select LikertAnswer.answer from LikertAnswer join LikertQuestion on LikertAnswer.question_id = LikertQuestion.id and LikertQuestion.sub_category_id1 = $i and LikertAnswer.license_id = "."$_SESSION['id']".";";
  /*Compute average*/
  if($result2 = $mysqli->query($query0))
  {
    $k_max = $result2->num_rows;
    $average = 0;
    while($score = $result2->fetch_row())
    {
      $average += $score[0];
    }
    $average /= $k_max;
    printf("k_max: %d\n", $k_max);
    printf("Sub Category ID: %d\nAverage: %d\n", $i, $average);

    /*Store results*/
    $average = round($average);
    $query2 = "insert into SubCategoryResult(license_id, sub_category_id, result) values($_SESSION['id'], $i, $average);";
    printf("Query: %s\n", $query2);
    printf("%s\n", $query2);
  }
  else
  {
    printf("Your Query is fucked up\n");
  }
  printf("================================================================\n");
}

/* Grab the category and the text areas */
for($i = 1; $i <= $num_sub_categories[0]; $i++)
{
  $query = "select category, text_area1, text_area2 from LikertAnswerSubCategory where id = $i;";
  $usr_answ_query = "select result from SubCategoryResult where sub_category_id = $i and license_id = $_SESSION['id'];";
  $result = $mysqli->query($query);
  $result3 = $mysqli->query($usr_answ_query);
  $row = $result->fetch_row();
  $answer = $result3->fetch_row();
  printf("%s\n%s\nYour score for %s: %d%s. %s\n", $row[0], $row[1], $row[0], $answer[0], "%", $row[2]);
  printf("++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++\n");
}
?>
