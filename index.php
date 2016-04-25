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
<div id ="introduction">
  <p>Welcome to the home of the MPADQ, the companion assessment questionnaire for <em>Take Charge of Your Performance Anxiety: A Personalized Approach to Conquering Stage Fright</em> by Dr. Heather Nicole Winter.</p>
  <p>Enter your key below to start your assessment. Your key is the ten-digit code found on the insert of your print copy or sent to you via email after the purchase of your ebook or audio book format of <em>Take Charge of Your Performance Anxiety</em>.</p>
  <form action="keySubmit.php" method="post">
    <input type="text" name="key" required>
    <input type="submit">
  </form>
  <?php
  if(isset($_SESSION['errmsg']))
  {
    echo "<p id='errmsg'><strong>".$_SESSION['errmsg']."</strong></p>";
    unset($_SESSION['errmsg']);
    session_write_close();
  }
  ?>
  <p>Don't have a key? Purchase one at <a href="http://www.einerleipublishing.com/einerlei_publishing_site_002.htm" id="einerlei-link" target="_blank">einerleipublishing.com</a></p>
</div>
</body>
</html>
