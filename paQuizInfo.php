<?php

$logUsername = $_POST["username"];
$logPassword = $_POST["password"];

echo $logUsername;
echo $logPassword;
echo $hashedPwd = hash("md5",$logPassword);

$host = "";
$username = "tbroadus";
$password = "tbroadus";
$database = "Quiz";

$mysqli = new mysqli($host, $username, $password, $database);
$correctPass = false;
if(mysqli_connect_errno()){
  echo "<p>";
  echo "Connect Error; ".mysqli_connect_errno();
  echo "</p>";
}
else{
  $query = " Select password from admins where username = '".$logUsername;
  $query = $query."'";
  $result = $mysqli->query($query);

    echo "<p>";
    echo "Password Entered:  ".$logPassword;
    echo "<br>";
    echo "Password Hashed:   ".$hashedPwd;
    echo "<br>";
    echo "Password Database: ".$result;
    echo "</p>";

  if($result){
      if($result != null && $result == hash("md5",$logPassword)){
        $correctPass = true;
      }
  }
  else{
    echo "<p>";
    echo "Query Error: ".$mysqli->error;
    echo "</p>";
  }
      $myqli->close();
}
if ($correctPass == true){
  echo "<p>";
  echo "Hellll YEAH";
  echo "</p>";
}
?>
