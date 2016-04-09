<?php
session_start();
if( !isset($_SESSION["loggedin"]) ){
  header('Location: ../'); //redirect to login page
}
?>
<html>
<head>
<title>Admin Page</title>
</head>
<body>
  <h1>Admin Page</h1>
  <ul>
    <li><a href = "keygen/">Generate Keys</a></li>
    <li><a href = "dataview/">Review Answers</a></li>
    <li><a href = "question-edit/">Edit Questions</a></li>
  </ul>
</body>
</html>
