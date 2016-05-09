<?php
function gen_key(){
  require_once'../../performanceanxietyquestionnaire.com/src/login.php';

  $mysqli = new mysqli($host, $user, $pass, $dtbs);

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

      while( $result->num_rows != 0){
      
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

      for($i = 1; $i <= 15; $i++)
      {
        $query1 = "insert into DemographicAnswer(license_id, demographic_question_id, answer) values($hashedKey, $i, '');";
        $mysqli->query($query1);
      }

      for($i = 1718; $i <= 1874; $i++)
      {
        $query1 = "insert into LikertAnswer(license_id, question_id, answer) values($hashedKey, $i, 6);";
        $mysqli->query($query1);
      }

      //echo "<br>".$insert;

      $result = $mysqli->query($insert);

      if($result){
       // echo "<br>successfully inserted";
        

      }
      else{
        //echo "<br>query unsuccessful";
      }
  }
  return $licKey;
}

function keygen(){

  $key = '';
  $length = 10;

  $inputs = array_merge( range("a","z"), range(0,9), range("A","Z") );

  for($i=0; $i<$length; $i++){
    $key .= $inputs{ mt_rand(0,61) };
  }
  
  return $key;
}
?>
