
<?php header("content-type: text/html, charset=UTF-8"); ?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<?
error_reporting(E_ERROR | E_NOTICE | E_WARNING | E_PARSE);
ini_set('display_errors', 1);

$name = 'Nikita';
$age = 26;
echo 'Меня зовут ' .$name; 
echo '<br>Мой возраст ' .$age. ' лет';

unset($name, $age);

//Второе задание

define('CITY', 'Искитим');
if(defined('CITY')){
    echo '<br> Город: '.CITY;
}else { echo 'Нет информации';
    }
//Третье задание
    
$book = array();
$book['title'] = 'Шантарам';
$book['author'] = 'Грегори Дэвид Робертс';
$book['pages'] = '600';

echo '<br>Недавно я прочитал книгу ' .$book['title']. ' автором которой является ' .$book['author']. ' в ней ' .$book['pages']. ' страниц '.' Очень сильная книга';

unset ($book);

//Четвертое задание

$books = array();
$books['book1'] = array ('title1' => 'Кот по имени Боб', 'author1' => 'Unknown', 'page1' => 200);
$books['book2'] = array ('title2' => 'Шантарам', 'author2'=> 'Roberts', 'page2' => 600);

echo '<br> Недавно я прочитал книги ' .$books['book1']['title1']. ' и ' .$books['book2']['title2'].  ' авторы: ' .$books['book1']['author1']. ' и ' .$books['book2']['author2']. 'в сумме страниц: ' . ($books['book1']['page1'] + $books['book2']['page2']); 


        





    
    

    
    
?>