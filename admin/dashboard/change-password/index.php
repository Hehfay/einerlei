<?php
  session_start();
  if(!isset($_SESSION["loggedin"])){
    header('Location: ../../../admin');
  }

  $errorMssg = "";

  if(isset($_SESSION["notMatching"])){
    $errorMssg = $_SESSION["notMatching"];
  }
?>

<html>
<head>
  <title>Change Password</title>
  <link rel="stylesheet" href="../../../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<section>
  <img src='../../../images/einerlei_publishing_site001005.png'>
</section>
<body>
<div id="container">
<div id="content">
  <h1>Change Your Password</h1> 
  <h4>To change your password, enter your current password followed by your new desired password twice.</h4><br>
  <form action="./changePassword/authenticatePass.php"method="post">
    Current Password:<input type = "password" placeholder="current password" name="password" id="button-no-float"required autofocus></br>
    New Password:<input type = "password" placeholder="new password" name="new_password1" id="button-no-float" required></br>
    Re-Enter New Password:<input type = "password" placeholder="new password" name="new_password2" id="button-no-float" required ></br>
    <input type="submit" id="button-no-float" value="Continue" name="login")> 
  </form>

<?php
  echo "<p id='errmsg'>".$errorMssg."</p>";
  unset($_SESSION['notMatching']);
?>

  <a href="http://performanceanxietyquestionnaire.com/admin/dashboard">Dashboard</a><br> 

</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
