<?php
$keys = $_POST["keys"];
session_start();
if( !isset($_SESSION["loggedin"]) ){
  header('Location: ../../');
}
?>
<html>
<head>
  <title>Generate Keys</title>
  <link rel="stylesheet" href="../../../style.css">
</head>
<section>
  <img src='../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
<h1>Generate Keys</h1>
<form action = keyGenerator.php method ="post">
  Number of Keys to generate: <input type = "number" name="keycount">
  <input type="submit" value ="Generate">
</form>
<a href="../">Dashboard</a>
</div>
</div>
</body>
</html>
