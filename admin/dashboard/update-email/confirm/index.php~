<?php
session_start();
if(!isset($_SESSION["loggedin"]))
{
  header('Location: ../../../');
}
if(!isset($_POST['email']))
{
  header('Location:../');
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Text Edit</title>
  <link rel="stylesheet" href="../../../../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<body>
<section>
  <img src='../../../../images/einerlei_publishing_site001005.png'>
</section>
<div id="container">
<div id="content">
<h1>Update Email</h1>
<?php
require_once '../../../../src/login.php';
$mysqli = new mysqli($host, $user, $pass, $dtbs);
if($mysqli)
{
  $email = $_POST['email'];
//  $email = $mysqli->real_escape_string($email);
//  $email = stripslashes($email);
//  $email = htmlentities($email);
//  $email = strip_tags($email);
  $query = "update admins set username = '$email' where id = 1;";
  if($mysqli->query($query))
  {
    echo "<h4>Update Successful</h4>";
  }
  else
  {
    echo "<h4>Update Unsuccessful. Try again later.</h4>";
  }

}
?>
<ol>
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
