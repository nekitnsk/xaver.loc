<?php header("content-type: text/html, charset=utf-8"); ?>
<?php
error_reporting(E_ERROR |  E_WARNING | E_PARSE);
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

$config = parse_ini_file('./config.ini', true);

//соединение с сервером и базой
$db = mysql_connect($config['Database1']['host'], $config['Database1']['user'], $config['Database1']['password']) or die('Не удалось соединиться с сервером');
mysql_select_db($config['Database1']['database'], $db) or die('Не удалось соединиться с базой данных '.  mysql_error());
mysql_query('SET NAMES utf8'); 

//функция вставки массива в таблицу 
function mysql_insert($table, $inserts) {
    $values = array_map('mysql_real_escape_string', array_values($inserts));
    $keys = array_keys($inserts);
    $insert_notice = ('REPLACE INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
    return mysql_query($insert_notice) or die(mysql_error());
}

//функция, которая из результата выборки возращает массив для использования в элементах формы 
//$query - передаем SQL запрос, $key - какое значение должно быть ключом элементов массива, $value - значения элементов массива
function normal_array($query, $key, $value){
    
    $result = mysql_query($query);
    
    while ($array[] = mysql_fetch_assoc($result)){};
    array_pop($array);
    
    foreach($array as $val){
    $normal_array[$val[$key]] = $val[$value];
    }
    
    mysql_free_result($result);
    
    return $normal_array;
}


  //блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    unset($_POST['send']);                  //здесь удалю ключ send он мешает записи в талицу
    mysql_insert('notice', $_POST);
    header('Location: dz9.php');                    //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}

//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {                    
    mysql_query("UPDATE notice SET active = 0 WHERE id = " .(int)$_GET[del]);
    header('Location: dz9.php');                        
}

$id = time();                         //в данной задачи для id объявлений используем штамп времени

//если есть задание на изменение задачи, то передадим значение id , выберем из базы нужное объявление и потом передадим в smarty
if (array_key_exists('change', $_GET)){
    $id = $_GET['change'];
    $select_notice = "SELECT whois, name,email,	subscribe,phone,city,category,title,message,price FROM notice WHERE id = '{$id}' ";
    $result = mysql_query($select_notice) or die(mysql_error());
    $notice=mysql_fetch_assoc($result);
    mysql_free_result($result);
    
}

//блок получения объяв из бд для вывода в таблицу, при условии, что объявление активно
$select_adv = "SELECT id, name, title, price FROM notice WHERE active = 1 ORDER BY id LIMIT 30 ";
$result = mysql_query($select_adv) or die(mysql_error());
while ($adv[] = mysql_fetch_assoc($result)){}
array_pop($adv);                                //при использовании fetch_assoc появляются NULL элементы в конце массива, поэтому удалим их здесь
mysql_free_result($result);

//массивы для работы формы

//блок выборки whois из бд
$select_whois = "SELECT id,whois FROM whois";

//блок выборки городов из бд
$select_city = "SELECT city_id,name FROM city LIMIT 100";

//блок выборки категорий из бд
$select_category = "SELECT id, name FROM category";


$smarty -> assign('data', array('whois' => normal_array($select_whois, 'id', 'whois'), 
                                'select_city' => normal_array($select_city, 'city_id', 'name'),
                                'select_category' => normal_array($select_category, 'id', 'name')                                
                    ));


$smarty -> assign('id', $id);
$smarty -> assign('notice', $notice);
$smarty -> assign('adv', $adv);


mysql_close($db);
$smarty->display('index.tpl');

