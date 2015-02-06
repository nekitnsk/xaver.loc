<?php header("content-type: text/html, charset=utf-8"); ?>
<?
error_reporting(E_ERROR | E_NOTICE | E_WARNING | E_PARSE);
ini_set('display_errors', 1);

$filedb = 'ad.db';                                      //файл базы данных
//
//блок формирует из файла массив с объявлениями
if (file_exists($filedb)){
    $notice = unserialize(file_get_contents($filedb));
}
  //блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    $notice[$_POST['id']] = $_POST;      
    file_put_contents($filedb, serialize($notice));
    header('Location: dz7_2.php');//Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}
//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    unset($notice[$_GET['del']]);
    file_put_contents($filedb, serialize($notice));
    header('Location: dz7_2.php');                        //сделаем редирект сюда же для очистки адресной строки и get 
}


// функция строит селект с выбором города, также может подставить город при изменении объявл.
function select_city($city = '') {
    global $notice;
    $selected = '';                                                                             //объявим переменную, чтобы попусту не ругался php
    $citys = array('115100' => 'Новосибирск', '115115' => 'Искитим', '115124' => 'Бердск');     //запилим массивчик с городами
    if (!empty($city)) {                                                //если существуют ключи change  то пойдем дальше
        $gorod = $notice[$city]['city'];                                             //запомним город из массива
    }
    ?>
    <select title="Выберите ваш город" name="city" id="city" >                                  
        <option value="">..Выберите город..</option>
        <option  disabled="disabled">..Новосибирская область..</option>
        <?php                                                                                   //формируем автоматическое создание формы
        foreach ($citys as $number => $sity) {
            if (isset($gorod)) {                                                                //тут надо проверить на существование переменной
                $selected = ($number == $gorod) ? 'selected=""' : '';                           //при перерборе массива провим на соответствие номера города городу 
            }                                                                                   //в массиве и если тру, то сформируем слово selected которое потом передадим в параметры option
            echo '<option ' . $selected . ' value="' . $number . '">' . $sity . '</option>';
        }
        ?>
    </select>    
    <?php
}
// функция строит селект с выбором категории объвления, также может подставить категорию при изменении объявл.
function select_category($type = '') {
    global $notice;
    $selected = '';
    $categoryes = array('2145' => 'Зимняя', '2146' => 'Летняя', '2147' => 'Демисезонная');
    if (!empty($type)) {
        $category = $notice[$type]['category'];
    }
    ?>
    <select title="Выберите категорию объявления" name="category" id="category" > 
        <option value="">..Категория..</option>
        <option  disabled="disabled">..Одежда..</option>
        <?php
        foreach ($categoryes as $number => $cat) {
            if (isset($category)) {
                $selected = ($number == $category) ? 'selected=""' : '';
            }
            echo '<option ' . $selected . ' value="' . $number . '">' . $cat . '</option>';
        }
        ?>
    </select>    
    <?php
}
?>

<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>hlama.net</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div id="maket">
            <div id="header">
                <h1> HLAMA.NET - лучшая барахолка рунета</h1>
            </div>
            <div id="left">Левая колонка</div>
            <div id="content">
                <form  id = "notice"  method="POST">
                    <fieldset>
                        <div id="radio">
                            <input type="radio" name="whois" value="people" checked>Частное лицо 
                            <input type="radio" name="whois" value="company" <? if (array_key_exists('change', $_GET) && $notice[$_GET['change']]['whois'] == 'company') {echo 'checked';} ?>>Компания</div>  
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="<? echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['name'] : ''; ?>" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="<? echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['email'] : ''; ?>" /></dd>
                            <div id="radio">
                                <input type="checkbox" name="delivery" value="delivery" <? if (array_key_exists('change', $_GET) && array_key_exists('delivery', $notice[$_GET['change']])) {echo 'checked';} ?>>Я хочу получать уведомления на Email</div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="<? echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['phone'] : ''; ?>" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                <?
                                if (array_key_exists('change', $_GET)){
                                    select_city($_GET['change']);
                                }else{
                                    select_city();
                                }
                                ?>
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                <?
                                if (isset($_GET['change'])){    
                                    select_category($_GET['change']);
                                }else{
                                    select_category();
                                }
                                ?>
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="<? echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['title'] : ''; ?>"/></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message" ><? echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['message'] : ''; ?></textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="<? echo array_key_exists('change', $_GET)  ? $notice[$_GET['change']]['price'] : ''; ?>"></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="отправить" />
                            <input type="hidden" name="id" value="<? echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['id'] : mt_rand(1, 10000) ?>">
                        </div>
                    </fieldset>
                </form>

                <?
                echo '<table>';                                     //Делаем таблицу, в которой покажем все объявления из сессии
                    if (isset($notice)) {                          //работаем  с массивом Notice
                        foreach ($notice as $key => $value) {            //перебираем массив 
                            echo '<tr>'
                            . '<td>' . '<a href = dz7_2.php?change=' . $key . '> ' . $value['title'] . '</a></td>'    //формируем ссылку с названием объявления, в качестве параметра ID объявления 
                            . '<td>' . $value['price'] . ' руб. </td>'        //цена
                            . '<td>' . $value['name'] . '</td>'         //имя клиента 
                            . '<td>' . '<a href = dz7_2.php?del=' . $key . '>Удалить' . '</a></td></tr>'    //здесь делаем ссылку на удаление
                            ;
                        }
                    }
                
                echo '</table>';
                ?>
            </div>
            <div id="footer">Подвал</div>
        </div>
    </body>
</html>


