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
  <title>View 1</title>
  <link rel="stylesheet" href="../../style.css">
</head>
<body>
<h1>View 1</h1>
<h4>View 1 displays each question as a column and has corresponding answers as row entires.</h4>
<p>Example:</p>

<table>
<tr>
  <th nowrap>USER</th>
  <th nowrap>Age when starting musical instrument of any kind:</th>
  <th nowrap>Age when starting musical study of primary instrument:</th>
  <th nowrap>...</th>
  <th nowrap>I am mentally tough enough for my musical/performance plan.</th>
</tr>
<tr>
  <td nowrap>34</td>
  <td nowrap>10-11</td>
  <td nowrap>10-11</td>
  <td nowrap>...</td>
  <td nowrap>75</td>
</tr>
<tr>
  <td nowrap>35</td>
  <td nowrap>16-17</td>
  <td nowrap>18-19</td>
  <td nowrap>...</td>
  <td nowrap>50</td>
</tr>
</table>
<ol>
  <li><a href="../">Go Back</a></li>
</ol>
</body>
</html>
