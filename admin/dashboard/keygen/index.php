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
<h1>Generate Keys</h1>
<body>
<form action = keyGenerator.php method ="post">
  Number of Keys to generate: <input type = "number" name="keycount">
  <input type="submit" value ="Generate">
</form>
<a href="../">Dashboard</a>
</body>
</html>
