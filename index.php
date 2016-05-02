<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome</title>
  <link rel="stylesheet" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0, width=device-width">
</head>
<body>
<section>
  <img src='images/einerlei_publishing_site001005.png'>
</section>
<div id ="container">
<div id = "content">
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
    session_unset();
    session_destroy();
  }
  ?>
  <p>Don't have a key? Purchase one at <a href="http://www.einerleipublishing.com/einerlei_publishing_site_002.htm" id="einerlei-link" target="_blank">einerleipublishing.com</a></p>
  <p>If you have already taken the quiz, enter your key to view your results again.</p>
</div>
</div>
<footer>
  <h1>Einerlei Publishing</h1>
  <p>general@einerleipublishing.com | <a href="http://einerleipublishing.com">EinerleiPublishing.com</a></p>
</footer>
</body>
</html>
