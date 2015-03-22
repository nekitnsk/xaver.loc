<?php header("content-type: text/html, charset=utf-8"); ?>
<?php
error_reporting(E_ERROR |  E_WARNING | E_PARSE);
ini_set('display_errors', 1);

require_once "dbsimple/config.php";
require_once "dbsimple/DbSimple/Generic.php";

// put full path to Smarty.class.php
require($_SERVER['DOCUMENT_ROOT'].'/dz10/smarty/libs/Smarty.class.php');
$smarty = new Smarty();

$smarty->compile_check = true;
$smarty->debugging = false;

$smarty->template_dir = $_SERVER['DOCUMENT_ROOT'].'/dz10/smarty/templates';
$smarty->compile_dir = $_SERVER['DOCUMENT_ROOT'].'/dz10/smarty/templates_c';
$smarty->cache_dir = $_SERVER['DOCUMENT_ROOT'].'/dz10/smarty/cache';
$smarty->config_dir = $_SERVER['DOCUMENT_ROOT'].'/dz10/smarty/configs';


$config = parse_ini_file('./config.ini', true);
//соединение с сервером и базой

// Подключаемся к БД.
$db = DbSimple_Generic::connect('mysqli://'.$config['Database1']['user'].':'.$config['Database1']['password'].'@'.$config['Database1']['host'].'/'.$config['Database1']['database'].'');

// Устанавливаем обработчик ошибок.
$db->setErrorHandler('databaseErrorHandler');
$db->setLogger('MyLogger'); 

// Код обработчика ошибок SQL.
function databaseErrorHandler($message, $info)
{
    // Если использовалась @, ничего не делать.
    if (!error_reporting()) return;
    // Выводим подробную информацию об ошибке.
    echo "SQL Error: $message<br><pre>"; 
    print_r($info);
    echo "</pre>";
    exit();
}
function myLogger($db, $sql)
{
  // Находим контекст вызова этого запроса.
  $caller = $db->findLibraryCaller();
  $tip = "at ".@$caller['file'].' line '.@$caller['line'];
  // Печатаем запрос (конечно, Debug_HackerConsole лучше).
  echo "<xmp title=\"$tip\">"; 
  print_r($sql); 
  echo "</xmp>";
}
//функция вставки массива в таблицу 
function mysqli_insert($db, $table, $inserts) {
    
    $values = array_values($inserts);
    $keys = array_keys($inserts);
    $db -> query('REPLACE INTO `'.$table.'` (`'.implode('`,`', $keys).'`) VALUES (\''.implode('\',\'', $values).'\')');
    return $db; 
}

  //блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    unset($_POST['send']);                  //здесь удалю ключ send он мешает записи в талицу
    mysqli_insert($db, 'notice', $_POST);
    header('Location: index.php');                    //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}

//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {                    
    $db->query('UPDATE notice SET active = 0 WHERE id = ?', $_GET['del']);
    header('Location: index.php');                        
}

$id = time();                         //в данной задаче для id объявлений используем штамп времени

//если есть задание на изменение задачи, то передадим значение id , выберем из базы нужное объявление и потом передадим в smarty
if (array_key_exists('change', $_GET)){
    $id = $_GET['change'];
    $notice = $db->selectRow('SELECT  whois, name,email, subscribe,phone,city,category,title,message,price FROM notice WHERE id = ? ', $id);
}

//блок получения объяв из бд для вывода в таблицу, при условии, что объявление активно
$adv = $db->select("SELECT id AS ARRAY_KEY, name, title, price, id FROM notice WHERE active = 1 ORDER BY id LIMIT 30 ");


//массивы для работы формы

//блок выборки whois из бд
$whois = $db->select("SELECT id AS ARRAY_KEY,whois FROM whois");
foreach ($whois as $key=>$value){
    $whois[$key] = $value['whois'];
}

//блок выборки городов из бд
$city = $db->select('SELECT city_id AS ARRAY_KEY,  name FROM city LIMIT 100');
foreach ($city as $key =>$value){
    $city[$key] = $value['name'];
}

//блок выборки категорий из бд
$category = $db->select("SELECT id AS ARRAY_KEY, name FROM category");
foreach ($category as $key=>$value){
    $category[$key] = $value['name'];
}


//этот блок передает рабочие данные, для формы, виды заказчиков, города, категории объяв.
$smarty -> assign('data', array('whois' => $whois, 
                                'select_city' => $city,
                                'select_category' => $category
                    ));

//здесь передадим id объявы(оно либо сгенерированное, либо существующее, если надо изменить объяву)
//notice - здесь передается информация по изменяемому объявлению
//adv - здесь передается блок данных со всеми объявлениями для вывода в таблицу
$smarty -> assign('id', $id);
$smarty -> assign('notice', $notice);
$smarty -> assign('adv', $adv);


//mysqli_close($db);
$smarty->display('index.tpl');

