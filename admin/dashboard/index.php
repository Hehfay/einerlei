<?php
session_start();
if( !isset($_SESSION["loggedin"]) ){
  header('Location: ../'); //redirect to login page
}
?>
<html>
<head>
  <title>Admin</title>
  <link rel="stylesheet" href="../../style.css">
</head>
<body>
  <h1>Admin Page Dashboard</h1>
  <ul>
    <li><a href = "keygen/">Generate Keys</a></li>
    <li><a href = "data-view/">Review Answers</a></li>
    <li><a href = "question-edit/">Edit Questions</a></li>
    <li><a href = "understanding-your-scores-edit/">Edit Understanding Your Scores Text</a></li>
  </ul>
</body>
</html>
