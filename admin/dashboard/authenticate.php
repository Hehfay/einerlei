<?php
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
  //MYSQL Query to database
  $query = "SELECT password FROM admins WHERE username='".$logUsername."';";

  $result = $mysqli->query($query);

  //convert result object to value
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

  $dataPass=$row['password'];

   // echo "<p>";
   // echo "Password Entered:  ".$logPassword;
   // echo "<br>";
   // echo "Password Hashed: __".$hashedPwd;
   // echo "<br>";
   // echo "Password Database:_".$dataPass;
   // echo "</p>";

  if($result){
    //Compare hashed password to entered password
      if($dataPass == $hashedPwd){
        $correctPass = TRUE;
      }
      else{
        echo "WRONG PASSWORD ENTERED";
      }
  }
  else{
    echo "<p>";
    echo "Query Error: ".$mysqli->error;
    echo "</p>";
  }
  $mysqli->close();
  if($correctPass == true){
    session_start();
    $_SESSION["loggedin"]=true;
    header('Location: .');  // index.php
  }
  else{
    header('Location: ../'); //refreshes page if incorrect password is entered
  }
}
?>
