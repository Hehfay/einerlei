<?php

session_start();
if( !isset($_SESSION["loggedin"]) ){
  header('Location: ../../');
}


$count = $_POST["keycount"];

$host = "";
$username = "tbroadus";
$password = "tbroadus";
$database = "Quiz";

$mysqli = new mysqli($host, $username, $password, $database);

if(mysqli_connect_errno()){
  
  echo "<p>";
  echo "Connect Error: ".mysqli_connect_errno();
  echo "</p>";
}
else{
  
  for($i=0; $i < $count; $i++){
  
    $licKey = keygen();
    $hashedKey = hash("md5", $licKey);
    
    $query = "SELECT * FROM License WHERE licenseKey = '".$hashedKey."';";

    $result = $mysqli->query($query);

    while( $result == ""){
    
      //echo "<br>".$hashedKey;
      $licKey = keygen();
      $hashedKey = hash("md5", $licKey);

      $query = "SELECT * FROM License WHERE licenseKey ='".$hashedKey."';";
      $result = $mysqli->query($query);

    }

    $insert =  "INSERT into License (id, licenseKey, active) VALUES (";
    $insert .= "0";
    $insert .= ", '".$hashedKey."'";
    $insert .= ", 1);";

    //echo "<br>".$insert;

    $result = $mysqli->query($insert);

    if($result){
      
      $keyFile .="\n".$licKey;
      $keyOutput .="<br>".$licKey;

      //echo "<br>successfully inserted";

    }
    else{
    
      echo "<br>query unsuccessful";

    }

  }

  $_SESSION['keyOutput'] = $keyOutput;
  $_SESSION['keyFile'] = $keyFile;

  header('Location: ./keys');
}
function keygen(){

  $key = ' ';
  $length = 10;

  $inputs = array_merge( range("a","z"), range(0,9), range("A","Z") );

  for($i=0; $i<$length; $i++){
    $key .= $inputs{ mt_rand(0,61) };
  }
  
  return $key;
}
?>
