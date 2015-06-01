<?php

// путь к классу Smarty.class.php
require('smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;

$smarty->template_dir = 'smarty/templates';
$smarty->compile_dir = 'smarty/templates_c';
$smarty->cache_dir = 'smarty/cache';
$smarty->config_dir = 'smarty/configs';

require ('lib/dbconnect.php');
require ('lib/AdsStore.php');
require ('lib/AdShort.php');
require ('lib/Ad.php');

$ads = AdsStore::instance();

//обработчик AJAX запроса добавления объявления

if (array_key_exists('add', $_GET)) {
    unset($_POST['send']);                  //здесь удалю ключ send он мешает записи в талицу
    if (!isset($_POST['subscribe'])) {      //свойство объекта не может быть NULL, поэтому subsribe запишем как 0 если его нет
        $_POST['subscribe'] = 0;
    }

    $result = $ads->AddUp($db, $_POST);
    if ($result['action'] == 'insert') {
        $smarty->assign('value', $ads->getLastAd($db));
    } else if ($result['action'] == 'update') {
        $smarty->assign('value', $ads->getAd($db,$_POST['id']));
    }

    $result['tr'] = $smarty->fetch('tr.tpl');



    echo json_encode($result);


    exit;
}

//блок обрабатывает поступление  нового объявления из POST
//if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
//    unset($_POST['send']);                  //здесь удалю ключ send он мешает записи в талицу
//    if (!isset($_POST['subscribe'])) {      //свойство объекта не может быть NULL, поэтому subsribe запишем как 0 если его нет
//        $_POST['subscribe'] = 0;
//    }
//    $ads->AddUp($db, $_POST);
//
//    header('Location: index.php');                    //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
//    exit;
//}
//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {

    echo json_encode($ads->Del($db, (int) $_GET['del']));
    exit;
}

//если есть задание на изменение задачи, то запросим из хранилища нужное объявление и передадим его в json 
if (array_key_exists('change', $_GET)) {
//    $id = (int) $_GET['change'];

    $ad = $ads->getAd($db, (int) $_GET['change']);
    echo json_encode($ad->getobjectvars());
    exit;
}
?>

