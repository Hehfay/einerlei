<?php
$keys = $_POST["keys"];
session_start();
if( !isset($_SESSION["loggedin"]) ){
  header('Location: ../../');
}
?>

<html>
<title>Generate Keys</title>
<head>
<h1>Generate Keys</h1>
</head>
<body>
<form action = keyGenerator.php method ="post">
Number of Keys to generate: <input type = "number" name="keycount">
<input type="submit" value ="SUBMIT">
</form>
</body>
</html>


