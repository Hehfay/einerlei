<html>
<head>
  <title>Generated Keys</title>
  <link rel="stylesheet" href="../../../../style.css">
</head>
<body>
<h1>Generated Keys</h1>
<?php
  session_start();
  if( !isset($_SESSION["loggedin"]) ){
    header('Location: ../../../'); //back to admin index.php
  }

  $keysOut = $_SESSION['keyOutput'];
  $keysFileOut = $_SESSION['keyFile'];

?>

<textarea readonly style="resize:none" name ="listkeys" cols="12" rows="7" readonly>
<?php
echo $keysFileOut;
?>
</textarea>

<form action = "./downloadKeys.php">
  <input type = "submit" value = "DOWNLOAD">
</form>

<?php
  echo "<h2>";
  echo $keysOut;
  echo "</h2>";

?>

<ol>
  <li><a href="../">Generate More Keys</a></li>
  <li><a href="../../">Dashboard</a></li>
</ol>

</body>
</html>

