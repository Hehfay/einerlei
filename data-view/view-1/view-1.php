<?php
$fname = 'output.csv';
$mode = 'a';
$filehandle = fopen($fname, $mode);
if($filehandle == false)
{
  echo "Error: File could not be written to.\n";
}
else
{
  fwrite($filehandle, "User,");
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
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
        fwrite($filehandle, $answer["answer"].",");
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
?>
