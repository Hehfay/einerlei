<?php
header("Location: likertScaleFormJSON.html");
foreach($_POST as $item => $value)
{
  echo "$item => $value";
  echo "<br>";
}
?>
