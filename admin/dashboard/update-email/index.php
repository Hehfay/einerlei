<?php
session_start();
if(!isset($_SESSION["loggedin"]))
{
  header('Location: ../../../');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Text Edit</title>
  <link rel="stylesheet" href="../../../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<body>
<section>
  <img src='../../../images/einerlei_publishing_site001005.png'>
</section>
<div id="container">
<div id="content">
<h1>Update Email</h1>
<h4>This is the email you will use to login. Recovery passwords will also be sent to this email.</h4>

  <form action="confirm/" method="post">
    <input type = "email" placeholder="Ex: user@isp.com" name="email" id="button-no-float"required autofocus>
    <input type="submit" id="button-no-float" value="Update Email"> 
  </form>

<?php
  require_once '../../../src/login.php';
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
  if($mysqli)
  {
    $query = "";
  }
?>

<ol>
  <li><a href="../">Dashboard</a></li>
</ol>
</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
