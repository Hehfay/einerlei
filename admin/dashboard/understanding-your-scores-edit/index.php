<?php
session_start();
if(!isset($_SESSION["loggedin"]))
{
  header('Location: ../../');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Text Edit</title>
  <link rel="stylesheet" href="../../../style.css">
</head>
<body>
<h1>Edit Understanding Your Scores Text</h1>
<ol>
  <li><a href="../">Dashboard</a></li>
</ol>
</body>
</html>
