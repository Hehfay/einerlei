<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Welcome to Dr. Hunnicut's performance anxiety questionnaire.</h1>
  <p>A questionnaire to guide readers through the book <em>Take Charge of Your Performance Anxiety</em> written by Dr. Heather Hunnicut.</p>
  <p>Enter your key below to start the quiz.</p>
  <form action="keySubmit.php" method="post">
    <input type="text" name="key" required>
    <input type="submit">
  </form>
  <?php
  if(isset($_SESSION['errmsg']))
  {
    echo "<p>".$_SESSION['errmsg']."</p>";
    unset($_SESSION['errmsg']);
  }
  ?>
  <p>Don't have a key? Purchase one at <a href="http://www.einerleipublishing.com/einerlei_publishing_site_002.htm" target="_blank">einerleipublishing.com</a></p>
</body>
</html>
