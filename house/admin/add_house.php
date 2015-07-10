<?php

//подключение DBSimple
require_once "../lib/dbsimple/config.php";
require_once "../lib/dbsimple/DbSimple/Generic.php";

$config = parse_ini_file('../config.ini', true);

$db = DbSimple_Generic::connect('mysqli://' . $config['Database1']['user'] . ':' . $config['Database1']['password'] . '@' . $config['Database1']['host'] . '/' . $config['Database1']['database'] . '');

// $db = DbSimple_Generic::connect('mysqli://root:123@localhost/house');

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

$last_id = $db->query('REPLASE INTO ?# (?#) VALUES (?a)', 'dom', array_keys($_POST), array_values($_POST));

echo json_encode($_POST);


?>