<?php
header("Location: ../likert/");
session_start();
$handle = fopen("output.mysql", "a");
$query = "insert into License(licenseKey, active) values(".$_SESSION["userid"].", TRUE)";
fwrite($handle, $query."\n");
foreach($_POST as $item => $value)
{
  fwrite($handle, "$item => $value\n");
}
fwrite($handle, "====================================================\n");
