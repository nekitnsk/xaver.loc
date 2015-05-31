<?php header("content-type: text/html, charset=utf-8"); ?>
<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);

require ('lib/dbconnect.php');



require ('controller.php');



//этот блок передает рабочие данные, для формы, виды заказчиков, города, категории объяв.
$smarty->assign('data', array('whois' => $ads->GetWhois($db),
                                'select_city' => $ads->GetCity($db),
                                    'select_category' => $ads->GetCategory($db)
));

//здесь передадим id объявы(оно либо сгенерированное, либо существующее, если надо изменить объяву)
//ad - здесь передается информация по изменяемому объявлению

$smarty->assign('id', $id);
$smarty->assign('adv', $ads->GetAds($db, $id));
$smarty->display('index.tpl');

