<?php
  session_start();
  if(!isset($_SESSION["loggedin"])){
    header('Location: ../../../../admin');
  }
  
  require_once '../../../../../performanceanxietyquestionnaire.com/src/login.php';

  $oldPass = $_POST['password'];
  $pass1 = $_POST['new_password1'];
  $pass2 = $_POST['new_password2'];

  if($pass1 != $pass2){
    $_SESSION["notMatching"] = "Enter Matching Passwords";
    header('Location: ../');
    exit();
  }

  if($oldPass == $pass1) {
    $_SESSION["notMatching"] = "Enter A new Password";
    header('Location: ../');
    exit();
  }


  $mysqli = new mysqli($host, $user, $pass, $dtbs);

  if(mysqli_connect_errno()){
    echo "<p>";
    echo "Connect Error: ".mysqli_connect_errno();
    echo "</p>";
  }
  else{
  
    $hashedPass = hash("md5", $oldPass);
    
    $query = "SELECT * FROM admins WHERE password ='".$hashedPass."';";

    $result = $mysqli->query($query);

    if( $result->num_rows == 0){
      $_SESSION["notMatching"] = "Incorrect Original Password";
      header('Location: ../'); 
      exit();
    }

    $hashedPass = hash("md5", $pass1);
    $update = "update admins set password='".$hashedPass."' where id=1;";

    $result = $mysqli->query($update);

    if($result){
      header('Location: ./');  
      
    }
    else{
    
      echo "<br>query unsuccessful";
    }
  
}
?>
