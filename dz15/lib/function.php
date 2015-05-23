<?php

//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {
    $ads->Del($db, (int)$_GET['del']);
    header('Location: index.php');
    exit;
}

//если есть задание на изменение задачи, то передадим значение id 
if (array_key_exists('change', $_GET)) {
    $id = (int) $_GET['change'];
    exit;
}

?>

