<?php
require_once '../../src/login.php';
/*
  This Code compares an entered username and password to
  a username and password stored in a database.
*/
$logUsername = $_POST["username"];
$logPassword = $_POST["password"];

//echo $logUsername;
//echo "<br>";
//echo $logPassword;

$hashedPwd = hash("md5",$logPassword);

//Begin Query of Database

$mysqli = new mysqli($host, $user, $pass, $dtbs);

$correctPass = false;

if(mysqli_connect_errno()){
  echo "<p>";
  echo "Connect Error; ".mysqli_connect_errno();
  echo "</p>";
}
else{
  //MYSQL Query to database
  $query = "SELECT password FROM admins WHERE username='".$logUsername."';";

  $result = $mysqli->query($query);
  if($result){
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $dataPass=$row['password'];

    //Compare hashed password to entered password
      if($dataPass == $hashedPwd){
        $correctPass = TRUE;
      }
      else{
        $correctPass = FALSE;
        //echo "WRONG PASSWORD ENTERED";
      }
  }
  else{
    echo "<p>";
    echo "Query Error: ".$mysqli->error;
    echo "</p>";
  }

  //convert result object to value

   // echo "<p>";
   // echo "Password Entered:  ".$logPassword;
   // echo "<br>";
   // echo "Password Hashed: __".$hashedPwd;
   // echo "<br>";
   // echo "Password Database:_".$dataPass;
   // echo "</p>";

  $mysqli->close();
  if($correctPass == true){
    session_start();
    $_SESSION["loggedin"]=true;
    header('Location: index.php');  // index.php
  }
  else{
    header('Location: ../'); //refreshes page if incorrect password is entered
  }
}
?>
