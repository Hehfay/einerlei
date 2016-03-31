<?php

$logUsername = $_POST["username"];
$logPassword = $_POST["password"];

echo $logUsername;
echo "<br>";
echo $logPassword;
$hashedPwd = hash("md5",$logPassword);

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
  //$query = "Select password from admins where username ='".$logUsername."' ;";
  $query = "Select password from admins where username=user1 ;";

  echo "<br>".$query;
  $result = $mysqli->query($query);

  echo "<br>".$result;
  $row = mysql_fetch_assoc($result);
  echo $dataPass=$row['password'];

    echo "<p>";
    echo "Password Entered:  ".$logPassword;
    echo "<br>";
    echo "Password Hashed:   ".$hashedPwd;
    echo "<br>";
    echo "Password Database: ".$dataPass;
    echo "</p>";
/*
  if($result){
      if( $dataPass == $hashedPwd)){
        $correctPass = true;
        echo "IT WORKED BY GOD";
      }
      else{
        echo "here";
      }
  }
  else{
    echo "<p>";
    echo "Query Error: ".$mysqli->error;
    echo "</p>";
  }
      $myqli->close();
*/
}
/*
if ($correctPass == true){
  echo "<p>";
  echo "Hellll YEAH";
  echo "</p>";
}
*/
?>
