<?php

session_start();
if( !isset($_SESSION["loggedin"]) ){
  header('Location: ../../');
}

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
      
      //echo "<br>successfully inserted";

      $_SESSION['key'] = $licKey;
      $email = $_SESSION["customer_email"]; 
      $mail_mssg  = "  Thank you for purchasing a key.\n Your key is".$licKey.".";
      $mail_mssg .= "\n This key can be used at http://performanceanxietyquestionnaire.com/";
      $mail_mssg .= "\n \n Contact information:";
      $mail_mssg .= "\n  heathernicolesoprano@gmail.com";
      

      mail($email,"Einerlei Publishing: License Key",$mail_mssg);

      header('Location: ~');

    }
    else{
    
      echo "<br>query unsuccessful";
      header('Location: ~');

    }

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
