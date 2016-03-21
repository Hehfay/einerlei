<!DOCTYPE html>
<html>
<head>
  <title>License Input</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <h1> Enter License </h1>
<ul>
<li>A link within the email will take the user to this page.</li>
</ul>

<form action = "../authenticate/" method = "post">
  License: <input type = "text" name="license"><br>
<?php 
  $value = $_POST['key'];
  echo "<input type='submit'>";
  echo "<input type='hidden' value=$value name='key'>";
?>
</form>


</body>
</html>
