<?php
  if(!isset($_POST['user-change-password']))
  {
    header("Location: index.php");
    exit();
  }
  require_once '../src/login.php';
  $mysqli = new mysqli($host, $user, $pass, $dtbs);
  if($mysqli)
  {
    $get_email = "select username from admins;";
    $result = $mysqli->query($get_email);
    $email = $result->fetch_assoc();
    $new_password = "123resetpassword456";
    $new_hash = md5($new_password);
    $update_password = "update admins set password = '$new_hash' where id = 1;";
    $mysqli->query($update_password);
    mail($email['username'], "Your Password Has Been Updated", "Hello\n Your performance anxiety questionnaire admin password has been reset to:\n $new_password\nLog in using this password at http://performanceanxietyquestionnaire.com\n- Einerlei Publishing");
  }
  else
  {
    exit();
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="../style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<body>
<section>
  <img src='../../images/einerlei_publishing_site001005.png'>
</section>
  <div id="container">
  <div id="content">
   <body>
    <p>A new password has been sent to your recovery email.</p>
    <ul>
      <li>
        <a href=".">Go Back</a>
      </li>
    </ul>
    </div>
    </div>
   </body>
  <footer>
    <h1>Einerlei Publishing</h1>
    <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
  </footer>
</html>
