<?php
session_start();
$keys = $_POST["keys"];
if( !isset($_SESSION["loggedin"]) ){
  header('Location: ../../');
}
?>
<html>
<head>
  <title>Generate Keys</title>
  <link rel="stylesheet" href="../../../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<section>
  <img src='../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
<h1>Generate Keys</h1>
<form action = keyGenerator.php method ="post">
  Number of Keys to generate: <input type = "number" name="keycount" max="1000" min="1" id='button-no-float'>
  <input id='button-no-float' type="submit" value ="Generate">
</form>
<a href="../">Dashboard</a>
</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
