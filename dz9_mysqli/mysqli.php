<?php header("content-type: text/html, charset=utf-8"); ?>
<?php
error_reporting(E_ERROR |  E_WARNING | E_PARSE);
ini_set('display_errors', 1);


// put full path to Smarty.class.php
require($_SERVER['DOCUMENT_ROOT'].'/dz9_mysqli/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;


$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9_mysqli/smarty/templates';
$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9_mysqli/smarty/templates_c';
$smarty->cache_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9_mysqli/smarty/cache';
$smarty->config_dir = $_SERVER['DOCUMENT_ROOT'].'/dz9_mysqli/smarty/configs';


$config = parse_ini_file('./config.ini', true);
//соединение с сервером и базой

$db = new mysqli($config['Database1']['host'], $config['Database1']['user'], $config['Database1']['password'], $config['Database1']['database']);
if (mysqli_connect_error()) {
    die('Ошибка подключения (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}
if (!mysqli_set_charset($db, "utf8")) {
    printf("Ошибка при загрузке набора символов utf8: ", mysqli_error($db));
}



//функция вставки\обновления  записи  в таблицу. Делится на 2 блока: 
//1. проверяем существует ли такая запись в таблице, если нет, то применяем INSERT 
//2. если да, то применяем UPDATE к этой записи 
//в table передаем таблицу в которую надо сделать запись, в inserts передаем массив который надо записать.

function mysqli_insert($db, $table, $inserts) {

    if (mysqli_num_rows(mysqli_query($db, 'SELECT id FROM '. $table .' WHERE id = '. $inserts['id'])) == 0) {
    //здесь разобьем массив на ключи и значения, по значениям пройдемся функцией real_escape 
        $values = array_values($inserts);
        array_walk($values, function(&$string) use ($db) {
            $string = mysqli_real_escape_string($db, $string);
        });
        $keys = array_keys($inserts);
        //здесь сформируем запрос для вставки в таблицу 
        $insert_notice = ('INSERT INTO `' . $table . '` (`' . implode('`,`', $keys) . '`) VALUES (\'' . implode('\',\'', $values) . '\')');
        return mysqli_query($db, $insert_notice) or die(mysqli_error($db));
        
    }else {
        
        $update = 'UPDATE `' . $table . '` SET ';
        $comma = ',';
        $count = 0;
        //переберем массив и соберем большой запрос на обновление записи. В цикле обойдем запись ID потому что не надо ее переписывать в базе, скажется на индексации ключевых полей
        foreach ($inserts as $key => $value) {
            $count++;
            if ($key == 'id') {
                continue;
            }
        //так как мы одну запись обойдем, то и здесь нам надо на один элемент меньше посчитать, и как мы дойдем до последнего элемента, отменить запятую
            if ($count == count($inserts)-1) {
                $comma = '';
            }
            
            $value = mysqli_real_escape_string($db, $value);
            $update = $update . '`'. $key . '` = \'' . $value . '\''. $comma;
        }
        $update = $update . ' WHERE id = '. $inserts['id'];
        return mysqli_query($db, $update) or die(mysqli_error($db));
//        
//        echo($update);
//        exit;
    }
}

//функция, которая из результата выборки возращает массив для использования в элементах формы 
//$query - передаем SQL запрос, $key - какое значение должно быть ключом элементов массива, $value - значения элементов массива
function normal_array($db, $query, $key, $value){
    
    $result = mysqli_query($db, $query);
    
    while ($array[] = mysqli_fetch_assoc($result)){};
    array_pop($array);
    
    foreach($array as $val){
    $normal_array[$val[$key]] = $val[$value];
    }
    
    mysqli_free_result($result);
    
    return $normal_array;
}


  //блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    unset($_POST['send']);                  //здесь удалю ключ send он мешает записи в талицу
    mysqli_insert($db, 'notice', $_POST);
    header('Location: mysqli.php');                    //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}

//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {                    
    mysqli_query($db, "UPDATE notice SET active = 0 WHERE id = " .(int)$_GET[del]) or die(mysqli_error($db));
    header('Location: mysqli.php');                        
}

//$id = time();                         //в данной задачи для id объявлений используем штамп времени

//если есть задание на изменение задачи, то передадим значение id , выберем из базы нужное объявление и потом передадим в smarty
if (array_key_exists('change', $_GET)){
    if (mysqli_num_rows(mysqli_query($db, 'SELECT id FROM notice WHERE id = ' . $_GET['change'] .' AND active=1 ')) != 0)
    $id = $_GET['change'];
    $select_notice = "SELECT whois, name,email,	subscribe,phone,city,category,title,message,price FROM notice WHERE id = '{$id}'";
    $result = mysqli_query($db, $select_notice) or die(mysqli_error($db));
    $notice=mysqli_fetch_assoc($result);
    mysqli_free_result($result);
}

//блок получения объяв из бд для вывода в таблицу, при условии, что объявление активно
$select_adv = "SELECT id, name, title, price FROM notice WHERE active = 1 ORDER BY id LIMIT 30 ";
$result = mysqli_query($db, $select_adv) or die(mysqli_error($db));
while ($adv[] = mysqli_fetch_assoc($result)){}
array_pop($adv);                                //при использовании fetch_assoc появляются NULL элементы в конце массива, поэтому удалим их здесь
mysqli_free_result($result);

//массивы для работы формы

//блок выборки whois из бд
$select_whois = "SELECT id,whois FROM whois";

//блок выборки городов из бд
$select_city = "SELECT city_id,name FROM city LIMIT 100";

//блок выборки категорий из бд
$select_category = "SELECT id, name FROM category";


$smarty -> assign('data', array('whois' => normal_array($db, $select_whois, 'id', 'whois'), 
                                'select_city' => normal_array($db, $select_city, 'city_id', 'name'),
                                'select_category' => normal_array($db, $select_category, 'id', 'name')                                
                    ));


$smarty -> assign('id', $id);
$smarty -> assign('notice', $notice);
$smarty -> assign('adv', $adv);


mysqli_close($db);
$smarty->display('index.tpl');

