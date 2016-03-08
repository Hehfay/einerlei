<?php
function keygen(){

  $email = $_POST["email"];
  $key = ' ';
  $length = 10;

  $inputs = array_merge(range("z","a"),range(0,9),range("A","Z"));

  for($i=0; $i<$length; $i++){
    $key .= $inputs{ mt_rand(0,61) };
  }
  echo "Key".$key;
  return $key;
}

$licKey = keygen();

echo $licKey;

/*
$host = "";
$username = "tbroadus";
$password = "tbroadus";
$database = "Quiz";

$mysqli = new mysqli($host, $username, $password, $database);

if(mysqli_connect_errno()){
  echo "<p>";
  echo "Connect Error; ".mysqli_connect_errno();
  echo "</p>";
}
else{
  $query = " Select licenseKey from License where licenseKey = ".$licKey;
  $result = $mysqli->query($query);

  if($result){
    while (result != null){
        $licKey = keygen();
        $query = "Select licenseKey from License where licenseKey = ".$licKey;
        $result = $mysqli->query($query);

        if($result){
          echo "<p>";
          echo "Successfully queried database";
          echo "</p>">;
        }
        else{
          echo "<p>";
          echo "Error: ".$mysqli->error;
          echo "</p>";
        }
    }

    $insert = "insert into License (id, email, licenseKey, active) values (";
    $insert = $insert."0";
    $insert = $insert.", ".$email;
    $insert = $insert.", ".$licKey;
    $insert = $insert.", true )";

    $result = mysqli->query($insert);

    if($result){
      echo "<p>";
      echo "Successfully queried database";
      echo "</p>";
    }
    else{
      echo "<p>";
      echo "Error: ".$mysqli->error;
      echo "</p>";
    }
  }
  else{
    echo "<p>";
    echo "Query Error: ".$mysqli->error;
    echo "</p>";
  }
  $myqli->close();
}
*/
?>
