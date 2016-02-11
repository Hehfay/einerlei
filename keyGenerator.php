
<?php
function keygen(){
  $key = ' ';
  $length = 10;

  $inputs = array_merge(range("z","a"),range(0,9),range("A","Z"));

  for($i=0; $i<$length; $i++){
    $key .= $inputs{ mt_rand(0,61) };
  }
  return $key;
}

// echo keygen();

$host = "";
$username = " ";
$password = " ";
$database = "performance_anxiety";

$mysqli = new mysqli($host, $username, $password, $database);

if(mysqli_connect_errno()){
  echo "<p>";
  echo "Connect Error; ".mysqli_connect_errno();
  echo "</p>";
}
else{
  $query = " ";
  $result = $mysqli->query($query);

  if($result){
  
  }
  else{
    echo "<p>";
    echo "Query Error: ".$mysqli->error;
    echo "</p>";
  }

// put mysqli stuff in keygen() function
}
?>
