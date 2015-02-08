<?php
error_reporting(E_ERROR|E_WARNING|E_PARSE|E_NOTICE);
ini_set('display_errors', 1);
header("Content-Type: text/html; charset=utf-8");

$project_root=$_SERVER['DOCUMENT_ROOT'];
$smarty_dir=$project_root.'/smarty/';

// put full path to Smarty.class.php
require($smarty_dir.'/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;

$smarty->template_dir = $smarty_dir.'templates';
$smarty->compile_dir = $smarty_dir.'templates_c';
$smarty->cache_dir = $smarty_dir.'cache';
$smarty->config_dir = $smarty_dir.'configs';

$massive = array('first'=>'Mary','John','Ted');

if(isset($_GET['mobile'])){
    $smarty->assign('header_template', 'header_mobile');
}else{
    $smarty->assign('header_template', 'header');
}

$smarty->assign('title', 'Наш сайт');
$smarty->assign('name', 'Антон2');
$smarty->assign('names', $massive);

$smarty->assign('raz', time());
$smarty->assign('dva', time()+12000);

$smarty->assign('Contacts',
    array('fax' => '555-222-9876',
          'email' => 'zaphod@slartibartfast.example.com',
          'phone' => array('home' => '555-444-3333',
                           'cell' => '555-111-1234')
                           )
         );

$items_list = array(23 => array('no' => 2456, 'label' => 'Salad'),
                    96 => array('no' => 4889, 'label' => 'Cream')
                    );
$smarty->assign('items', $items_list);

$not_smarty = 'test';

$smarty->assign('cust_options', array(
                                1000 => 'Joe Schmoe',
                                1001 => 'Jack Smith',
                                1002 => 'Jane Johnson',
                                1003 => 'Charlie Brown')
                                );
$smarty->assign('customer_id', 1001); //кто выбран по умолчанию

$smarty->assign('data',array(1,2,3,4,5,6,7,8,9));
$smarty->assign('tr',array('bgcolor="#eeeeee"','bgcolor="#dddddd"'));



$smarty->display('index.tpl');
//$file = $smarty->fetch('index.tpl');
//echo $file;

//$vars = $smarty->get_template_vars();
//print_r($vars);




