<?php
  session_start();
  if( !isset($_SESSION["loggedin"]) ){
    header('Location: ../../../'); //back to admin index.php
  }

  $keysOut = $_SESSION['keyOutput'];
  $keysFileOut = $_SESSION['keyFile'];

?>
<html>
<head>
  <title>Generated Keys</title>
  <link rel="stylesheet" href="../../../../style.css">
</head>
<section>
  <img src='../../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
<h1>Generated Keys</h1>

<textarea readonly style="resize:none" name ="listkeys" cols="12" rows="7" readonly>
<?php
echo $keysFileOut;
?>
</textarea>

<form action = "./downloadKeys.php">
  <input type = "submit" value = "DOWNLOAD">
</form>

<ol>
  <li><a href="../">Generate More Keys</a></li>
  <li><a href="../../">Dashboard</a></li>
</ol>

</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>

