<?php
session_start();
if(!isset($_SESSION["loggedin"])){
  header('Location: ../../../../admin');
}
?>

<html>
<head>
  <title>Password Change Success</title>
  <link rel="stylesheet" href="../../../../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<section>
  <img src='../../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
  <h1>You have successfully changed your password!</h1> 
  <h4>Your password has been changed.</h4>
  <a href="http://performanceanxietyquestionnaire.com/admin/dashboard">Dashboard</a><br> 
<?php
  echo "<p id='errmsg'>".$errorMssg."</p>";
  unset($_SESSION['notMatching']);
?>

</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
