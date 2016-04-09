<html>

<title>Generated Keys</title>
<head>
<h1>Generated Keys</h1>
</head>
<body>
<?php

  session_start();
  if( !isset($_SESSION["loggedin"]) ){
    header('Location: ../../../'); //back to admin index.php
  }

  $keysOut = $_SESSION['keyOutput'];
  $keysFileOut = $_SESSION['keyFile'];

  echo "<h2>";
  echo $keysOut;
  echo "</h2>";

?>

<textarea readonly style="resize:none" name ="listkeys" cols="12" rows="7" readonly>
<?php
echo $keysFileOut;
?>
</textarea>

<form action = "./downloadKeys.php">
  <input type = "submit" value = "DOWNLOAD">
</form>
</body>
</html>

