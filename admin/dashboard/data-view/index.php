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
<section>
  <img src='../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
<h1>Data Views</h1>
<h4>Select a data view from the list below. An example of each data view is on the corresponding page.</h4>
<ul>
  <li><a href="view-1/">View 1</a></li>
  <li><a href="view-2/">View 2</a></li>
  <li><a href="../">Dashboard</a></li>
</ul>
</div>
</div>
</body>
</html>
