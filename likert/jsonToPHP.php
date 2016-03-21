<?php

//$str = file_get_contents('http://gchpcc.georgetowncollege.edu/~imeisner/EinerleiRepo/demographicQuestions.json');

echo "start";


$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';

var_dump(json_decode($json));

//echo '<pre>' . print_r($json, true) . '</pre>';
echo "end";

?>
