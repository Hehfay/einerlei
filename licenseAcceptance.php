<!DOCTYPE html>
<html>
<head>
  <title> License input page </title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1> Enter License </h1>

<form action = "licenseAuthentication.php" method = "post">
  License: <input type = "text" name="license"><br>
<?php 
  $value = $_POST['key'];
  echo "<input type='submit'>";
  echo "<input type='hidden' value=$value name='key'>";
?>
</form>


</body>
</html>
