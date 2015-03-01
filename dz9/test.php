<?php

$test = array('one' => 1, 'two'=>2, 'three'=>3);

$update = 'UPDATE notice SET ';

$comma = ',';
$count = 0;
foreach ($test as $key=>$value){
    $count++;
    if ($count == count($test)){
        $comma = '';
        
    }
    $update = $update . $key . '=' . $value . $comma;
    
}
print_r($update);

var_dump($test);



?>