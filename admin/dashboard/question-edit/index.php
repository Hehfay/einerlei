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
  <title>Edit Questions</title>
  <link rel="stylesheet" href="../../../style.css">
</head>
<body>
<h1>Edit Questions</h1>
<ol>
  <li><a href="../">Dashboard</a></li>
</ol>
</body>
</html>
