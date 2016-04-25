<html>

<title>Purchased Key</title>
<head>
<h1>Purchased Key</h1>
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

</body>
</html>

