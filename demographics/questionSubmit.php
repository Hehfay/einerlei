<?php
header("Location: ../likert/likertScaleFormJSON.html");
foreach($_POST as $item => $value)
{
  echo "$item => $value";
  echo "<br>";
}

?>
