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
<section>
  <img src='../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
<h1>Edit Questions</h1>
<ol>
  <li><a href="../">Dashboard</a></li>
</ol>
</div>
</div>
</body>
</html>
