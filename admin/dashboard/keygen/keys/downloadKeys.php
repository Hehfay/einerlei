<?php

  session_start();
  if( !isset($_SESSION["loggedin"]) ){
    header('Location: ../../../'); //back to admin index.php
  }

  $keyList = $_SESSION['keyFile'];

  $keyOutput = print_r($keyList, true);

  $today = date("m-d-Y");

  $fileName = "./keyArchive/keys_".$today.".csv";

  $output = fopen($fileName, "w") or die ("Unable to open file!");

  file_put_contents($fileName, $keyOutput, FILE_APPEND);

  fclose($output);

  if (file_exists($fileName)) {
    
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($fileName).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fileName));
    readfile($fileName);
    exit;

 }
?>

