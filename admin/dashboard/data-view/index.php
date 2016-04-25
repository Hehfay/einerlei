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
  <title>Data View</title>
  <link rel="stylesheet" href="../../../style.css">
</head>
<body>
<h1>Data Views</h1>
<h4>Select a data view from the list below. An example of each data view is on the corresponding page.<h4>
<ol>
  <li><a href="view-1/">View 1</a></li>
  <li><a href="view-2/">View 2</a></li>
  <li><a href="../">Dashboard</a></li>
</ol>
</body>
</html>
