<?php
/*
session_start();
if(!isset($_SESSION["loggedin"]))
{
  header('Location: ../../../');
}
 */
?>
<!DOCTYPE html>
<html>
<head>
  <title>View 2</title>
  <link rel="stylesheet" href="../../style.css">
</head>
<body>
<h1>View 2</h1>
<h4>View 2 has 3 columns: <strong>User</strong>, <strong>Question</strong>, and <strong>Answer</strong>.</h4>
<p>Example:</p>

<table>
<tr>
  <th nowrap>USER</th>
  <th nowrap>QUESTION</th>
  <th nowrap>ANSWER</th>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>Age when starting musical instruction of any kind: </td>
  <td nowrap>10-11</td>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>Age when starting musical instruction of primary instrument:</td>
  <td nowrap>10-11</td>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>Age:</td>
  <td nowrap>51-60</td>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>etc.</td>
  <td nowrap>etc.</td>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>etc.</td>
  <td nowrap>etc.</td>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>etc.</td>
  <td nowrap>etc.</td>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>etc.</td>
  <td nowrap>etc.</td>
</tr>
  <td nowrap>35</td>
  <td nowrap>Age when starting musical instruction of any kind: </td>
  <td nowrap>16-17</td>
</tr>
<tr>
  <td nowrap>35</td>
  <td nowrap>Age when starting musical instruction of primary instrument:</td>
  <td nowrap>18-19</td>
</tr>
<tr>
  <td nowrap>35</td>
  <td nowrap>Age:</td>
  <td nowrap>24-30</td>
</tr>
<tr>
  <td nowrap>35</td>
  <td nowrap>etc.</td>
  <td nowrap>etc.</td>
</tr>
<tr>
  <td nowrap>35</td>
  <td nowrap>etc.</td>
  <td nowrap>etc.</td>
</tr>
<tr>
  <td nowrap>35</td>
  <td nowrap>etc.</td>
  <td nowrap>etc.</td>
</tr>
</table>

<?php
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
  $mysqli = new mysqli("", "jhartma0", "jhartma0", "Quiz");
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
        fwrite($filehandle, $answer["license_id"].",".$answer["question"].",".$answer["answer"]."\n");
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
</ol>
</body>
</html>
