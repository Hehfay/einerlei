<?php
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
/* BROAD CATEGORY STUFF
  $query = "select category, text_area1, text_area2 from LikertAnswerBroadCategory;";
  $result = $mysqli->query($query);
  while($row = $result->fetch_row())
  {
    for($i = 0; $i < 3; $i++)
    {
      if($i == 2)
      {
        printf("Your score for %s is . %s\n", $row[0], $row[$i]);
      }
      else
      {
        printf("%s\n", $row[$i]);
      }
    }
    printf("\n");
  }
 */

  $query = "select category, text_area1, text_area2 from LikertAnswerSubCategory;";
  $result = $mysqli->query($query);
  while($row = $result->fetch_row())
  {
    for($i = 0; $i < 3; $i++)
    {
      if($i == 2)
      {
        printf("Your score for %s is . %s\n", $row[0], $row[$i]);
      }
      else
      {
        printf("%s\n", $row[$i]);
      }
    }
    printf("\n");
  }
?>
