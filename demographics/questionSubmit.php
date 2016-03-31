<?php
header("Location: ../likert/");
session_start();
$handle = fopen("output.mysql", "a");
fwrite($handle, "Session ID: ".$_SESSION["userid"]."\n");
foreach($_POST as $item => $value)
{
  fwrite($handle, "$item => $value\n");
}
fwrite($handle, "====================================================\n");
