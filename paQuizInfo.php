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
  $query = "SELECT password FROM admins WHERE username='".$logUsername."';";

  echo "<br>".$query;
  $result = $mysqli->query($query);

  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $dataPass=$row['password'];

    echo "<p>";
    echo "Password Entered:  ".$logPassword;
    echo "<br>";
    echo "Password Hashed: __".$hashedPwd;
    echo "<br>";
    echo "Password Database:_".$dataPass;
    echo "</p>";
  if($result != NULL){
      if( $dataPass == $hashedPwd)){
        $correctPass = TRUE;
        echo "<br> IT WORKED BY GOD";
      }
      else{
        echo "<br> here";
      }
  }

/*
  else{
    echo "<p>";
    echo "Query Error: ".$mysqli->error;
    echo "</p>";
  }

  $myqli->close();

  if ($correctPass == true){
    echo "<p>";
    echo "Hellll YEAH";
    echo "</p>";
  }

*/
}

?>
