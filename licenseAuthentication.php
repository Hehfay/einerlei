<?php

$license = $_POST["license"];

echo $license " - Hashed -> ";
echo hash ("md5",$license);

?>
