<?php header("content-type: text/html, charset=utf-8"); ?>
<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_ALL);
ini_set('display_errors', 1);

//подключение DBSimple
require_once "dbsimple/config.php";
require_once "dbsimple/DbSimple/Generic.php";

//путь к классу работы с объявлениями
require ($_SERVER['DOCUMENT_ROOT'] . '/dz11/lib/ad_class.php');
require ($_SERVER['DOCUMENT_ROOT'] . '/dz11/lib/ads.php');

// путь к классу Smarty.class.php
require($_SERVER['DOCUMENT_ROOT'] . '/dz11/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;

$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'] . '/dz11/smarty/templates';
$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'] . '/dz11/smarty/templates_c';
$smarty->cache_dir = $_SERVER['DOCUMENT_ROOT'] . '/dz11/smarty/cache';
$smarty->config_dir = $_SERVER['DOCUMENT_ROOT'] . '/dz11/smarty/configs';

$config = parse_ini_file('./config.ini', true);
//соединение с сервером и базой
// Подключаемся к БД.
$db = DbSimple_Generic::connect('mysqli://' . $config['Database1']['user'] . ':' . $config['Database1']['password'] . '@' . $config['Database1']['host'] . '/' . $config['Database1']['database'] . '');

// Устанавливаем обработчик ошибок.
$db->setErrorHandler('databaseErrorHandler');

// $db->setLogger('MyLogger'); 
// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info) {
    // Если использовалась @, ничего не делать.
    if (!error_reporting())
        return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>";
    print_r($info);
    echo "</pre>";
    exit();
}

//новое хранилище объявлений
$ads = new ads;

//блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    unset($_POST['send']);                  //здесь удалю ключ send он мешает записи в талицу
    if (!isset($_POST['subscribe'])) {      //свойство объекта не может быть NULL, поэтому subsribe запишем как 0 если его нет
        $_POST['subscribe'] = 0;
    }
    $ads->addup($db, $_POST);

    header('Location: index.php');                    //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
    exit;
}

//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {
    $ads->del($db, $_GET['del']);
    header('Location: index.php');
    exit;
}

//если есть задание на изменение задачи, то передадим значение id 
if (array_key_exists('change', $_GET)) {
    $id = (int) $_GET['change'];
}

//этот блок передает рабочие данные, для формы, виды заказчиков, города, категории объяв.
$smarty->assign('data', array('whois' => $ads->getwhois($db),
                                'select_city' => $ads->getcity($db),
                                    'select_category' => $ads->getcategory($db)
));

//здесь передадим id объявы(оно либо сгенерированное, либо существующее, если надо изменить объяву)
//ad - здесь передается информация по изменяемому объявлению

$smarty->assign('id', $id);
$smarty->assign('adv', $ads->getads($db, $id));
$smarty->display('index.tpl');

