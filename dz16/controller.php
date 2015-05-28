<?php

require ('lib/dbconnect.php');
require ('lib/AdsStore.php');
require ('lib/AdShort.php');
require ('lib/Ad.php');
$ads = AdsStore::instance();

//блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    unset($_POST['send']);                  //здесь удалю ключ send он мешает записи в талицу
    if (!isset($_POST['subscribe'])) {      //свойство объекта не может быть NULL, поэтому subsribe запишем как 0 если его нет
        $_POST['subscribe'] = 0;
    }
    $ads->AddUp($db, $_POST);

    header('Location: index.php');                    //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
    exit;
}

//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {
    
    echo json_encode($ads->Del($db, (int)$_GET['del']));
    exit;
    
}

//если есть задание на изменение задачи, то передадим значение id 
if (array_key_exists('change', $_GET)) {
    $id = (int) $_GET['change'];
    
}

?>

