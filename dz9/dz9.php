<?php header("content-type: text/html, charset=utf-8"); ?>
<?
error_reporting(E_ERROR | E_NOTICE | E_WARNING | E_PARSE);
ini_set('display_errors', 1);


// put full path to Smarty.class.php
require($_SERVER['DOCUMENT_ROOT'].'/dz9/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;


$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9/smarty/templates';
$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9/smarty/templates_c';
$smarty->cache_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9/smarty/cache';
$smarty->config_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9/smarty/configs';

$db = mysql_connect('localhost', 'root', '123') or die('Не удалось соединиться с сервером');
mysql_select_db('hlamanet', $db) or die('Не удалось соединиться с базой данных '.  mysql_error());
mysql_query('SET NAMES utf8'); 



function mysql_insert($table, $inserts) {
    $values = array_map('mysql_real_escape_string', array_values($inserts));
    $keys = array_keys($inserts);
        
    return mysql_query('INSERT INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')') or die(mysql_error());
}


//блок формирует из файла массив с объявлениями
//    $notice = mysql_query('SELECT ');

  //блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
print_r ($_POST);

   
//$post = array_map('mysql_real_escape_string', array_keys($_POST), $_POST);
//$insert_notice = "INSERT   
//                  INTO notice (whois,first_name,email,subscribe,phone,city,category,title,message,price,active,ipaddr) 
//                  VALUES('{$post[whois]}', $post[name], $post[email],'{$post[subscribe]}',$post[phone],$post[city],$post[category],$post[title],$post[message],$post[price], 1, $_SERVER[REMOTE_ADDR] )" or die(mysql_error());

//$insert_notice = "INSERT INTO `notice` SET whois = '$_POST}' ";
                    
//mysql_query($insert_notice);
    unset($_POST['send']);
    mysql_insert('notice', $_POST);
    header('Location: dz9.php');//Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}







//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    mysql_query("UPDATE notice SET active = 0 WHERE id = " .(int)$_GET[del]);
    header('Location: dz9.php');                        //сделаем редирект сюда же для очистки адресной строки и get 
}

$id = time();                         //в данной задачи для id объявлений используем штамп времени

//если есть задание на изменение задачи, то передадим значение id 
if (array_key_exists('change', $_GET)){
    $id = $notice[$_GET['change']]['id'];
}
//массивы для работы формы
$smarty -> assign('data', array('whois' => array(1 => 'Частное лицо', 2 => 'Компания'), 
                                'subscribe' => 'Я хочу получать жесткий спам на почту',
                                'select_city' => array(100 => 'Новосибирск', 200 => 'Искитим',300 => 'Бердск'),
                                'select_category' => array(100 => 'Одежда', 200 => 'Обувь',300 => 'Техника')                                
                    ));


$smarty -> assign('id', $id);
$smarty -> assign('notice', $notice);


$smarty->display('index.tpl');

