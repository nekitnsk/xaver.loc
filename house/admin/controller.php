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
//блок добавления\изменения дома в каталоге

if (array_key_exists('add', $_GET)){
$last_id = $db->query('REPLACE INTO ?# (?#) VALUES (?a)', 'dom', array_keys($_POST), array_values($_POST));

if (!$last_id == 0) {
	$res['status'] = "success";
	$res['message'] = "Дом успешно добавлен\изменен в базе данных ";

}else{
	$res['status'] = "error";
	$res['message'] = "Произошла ошибка, проверьте правильность введенных данных и повторите попытку";
}

echo json_encode($res);
exit;
}




if (array_key_exists('del', $_GET)) {
    
    if (($db->query('DELETE FROM dom WHERE id = ?', $_GET['del']))>0){
            $result['status']='success';
            $result['message'] = "Дом удален успешно";
            
        }else{
            $result['status']='error';
            $result['message'] = "Произошла ошибка, попробуйте еще раз";
            
        }
    
    echo json_encode($result);
    exit;
}

if (array_key_exists('change', $_GET)) {
//    $id = (int) $_GET['change'];

    $dom['info'] = $db->selectRow('SELECT  * FROM dom WHERE id = ? ', $_GET['change']);
    $directory = '../files/images/house/'.$dom['info']['seo_name'];
    $image_list = array_diff(scandir($directory), array('..', '.'));
    $dom['code'] = "";
    foreach ($image_list as $value) {
        
        $dom['code'] .= '<input id="'.$value.'" type="radio" name="'.$dom['info']['seo_name'].'" value="'.$value.'" /><label class="house-cc" style="background-image:url(../files/images/house/'.$dom['info']['seo_name'].'/'.$value.');" for="'.$value.'"></label>' ;
    }
    
    echo json_encode($dom);
    exit;
}


?>