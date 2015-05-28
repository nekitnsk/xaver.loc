<?php

//подключение DBSimple
require_once "dbsimple/config.php";
require_once "dbsimple/DbSimple/Generic.php";

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

?>
