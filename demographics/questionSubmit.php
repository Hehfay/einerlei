<?php
header("Location: ../likert/");
session_start();
$handle = fopen("output.mysql", "a");
$query = $_SESSION["userid"]." has these variables:";
fwrite($handle, $query."\n");
foreach($_POST as $item => $value)
{
  fwrite($handle, "$item => $value\n");
}
fwrite($handle, "====================================================\n");
fclose();