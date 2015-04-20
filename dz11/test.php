<?php header("content-type: text/html, charset=utf-8"); ?>
<?php
error_reporting(E_ERROR |  E_WARNING | E_PARSE | E_ALL);
ini_set('display_errors', 1);

class test {
    public $test;
    
    function __construct(){
        $this->test = '123';
    }
    
    
}

$a = new test;

echo $a->test;

$b = get_object_vars($a);

print_r ($b);

?>

