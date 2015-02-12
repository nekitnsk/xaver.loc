<?php header("content-type: text/html, charset=utf-8"); ?>
<?
error_reporting(E_ERROR | E_NOTICE | E_WARNING | E_PARSE);
ini_set('display_errors', 1);


// put full path to Smarty.class.php
require($_SERVER['DOCUMENT_ROOT'].'/dz8/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;


$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/dz8/smarty/templates';
$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'/dz8/smarty/templates_c';
$smarty->cache_dir = $_SERVER['DOCUMENT_ROOT'].'/dz8/smarty/cache';
$smarty->config_dir = $_SERVER['DOCUMENT_ROOT'].'/dz8/smarty/configs';


$filedb = 'ad.db';                                      //файл базы данных
//
//блок формирует из файла массив с объявлениями
if (file_exists($filedb)){
    $notice = unserialize(file_get_contents($filedb));
}
  //блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    $notice[$_POST['id']] = $_POST;      
    file_put_contents($filedb, serialize($notice));
    header('Location: dz8.php');//Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}
//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    unset($notice[$_GET['del']]);
    file_put_contents($filedb, serialize($notice));
    header('Location: dz8.php');                        //сделаем редирект сюда же для очистки адресной строки и get 
}

$id = time();                         //в данной задачи для id объявлений используем штамп времени

//если есть задание на изменение задачи, то передадим значение id 
if (array_key_exists('change', $_GET)){
    $id = $notice[$_GET['change']]['id'];
}
//массивы для работы формы
$smarty -> assign('data', array('whois' => array(1 => 'Частное лицо', 2 => 'Компания'), 
                                'subscribe' => array(1 => 'Я хочу получать жесткий спам на почту'),
                                'select_city' => array(100 => 'Новосибирск', 200 => 'Искитим',300 => 'Бердск'),
                                'select_category' => array(100 => 'Одежда', 200 => 'Обувь',300 => 'Техника')                                
                    ));


$smarty -> assign('id', $id);
$smarty -> assign('notice', $notice);


$smarty->display('index.tpl');

