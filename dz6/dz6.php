
<?php
session_start();
$change = false;                                        //по умолчанию команда на изменение выключена
$ch_name = '';                                          //сюда будем записывать что пришло из get


function select_city($city = '') {
    $selected = '';                                                                             //объявим переменную, чтобы попусту не ругался php
    $citys = array('115100' => 'Новосибирск', '115115' => 'Искитим', '115124' => 'Бердск');     //запилим массивчик с городами
    if (array_key_exists('change', $_GET) && array_key_exists('notice', $_SESSION)) {           //если существуют ключи change и notice то пойдем дальше
        $gorod = $_SESSION['notice'][$_GET['change']]['city'];                                  //запомним город из массива
    }
    ?>
    <select title="Выберите ваш город" name="city" id="city" >                                  
        <option value="">..Выберите город..</option>
        <option  disabled="disabled">..Новосибирская область..</option>
        <?php                                                                                   //формируем автоматическое создание формы
        foreach ($citys as $number => $city) {
            if (isset($gorod)) {                                                                //тут надо проверить на существование переменной
                $selected = ($number == $gorod) ? 'selected=""' : '';                           //при перерборе массива провим на соответствие номера города городу 
            }                                                                                   //в массиве и если тру, то сформируем слово selected которое потом передадим в параметры option
            echo '<option ' . $selected . ' value="' . $number . '">' . $city . '</option>';
        }
        ?>
    </select>    
    <?php


function select_category($type = '') {
    $selected = '';
    $categoryes = array('2145' => 'Зимняя', '2146' => 'Летняя', '2147' => 'Демисезонная');
    if (array_key_exists('change', $_GET) && array_key_exists('notice', $_SESSION)) {
        $category = $_SESSION['notice'][$_GET['change']]['category'];
    }
    ?>
    <select title="Выберите категорию объявления" name="category" id="category" > 
        <option value="">..Категория..</option>
        <option  disabled="disabled">..Одежда..</option>
        <?php
        foreach ($categoryes as $number => $type) {
            if (isset($category)) {
                $selected = ($number == $category) ? 'selected=""' : '';
            }
            echo '<option ' . $selected . ' value="' . $number . '">' . $type . '</option>';
        }
        ?>
    </select>    
    <?php
}

if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    $_SESSION['notice'][$_POST['id']] = $_POST;      //если существует то запишем в сессию массив с ключом = название объявления
    unset($_POST);                                      //убьем POST
    header('location: dz6.php');                        //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}
if (array_key_exists('del', $_GET)) {                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    unset($_SESSION['notice'][$_GET['del']]);           //если пришел то удалим его в сессии
    header('location: dz6.php');                        //сделаем редирект сюда же для очистки адресной строки и get 
}
if (array_key_exists('change', $_GET)) {                //проверим пришел ли из GET параметр change 
    $change = true;                                     //включим команду изменения данных 
    $ch_name = $_GET['change'];                         //запомним что пришло
}
?>

<html>
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
                <form  id = "notice" action="dz6.php" method="POST">
                    <fieldset>
                        <div id="radio">
                            <input type="radio" name="whois" value="people" checked>Частное лицо <!-- asd--> 
                            <input type="radio" name="whois" value="company" <? if ($change && $_SESSION['notice'][$ch_name]['whois'] == 'company') {echo 'checked';} ?>>Компания</div>  
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="<? echo $change ? $_SESSION['notice'][$ch_name]['name'] : ''; ?>" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="<? echo $change ? $_SESSION['notice'][$ch_name]['email'] : ''; ?>" /></dd>
                            <div id="radio">
                                <input type="checkbox" name="delivery" value="delivery" <? if ($change && array_key_exists('delivery', $_SESSION['notice'][$ch_name])) {echo 'checked';} ?>>Я хочу получать уведомления на Email</div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="<? echo $change ? $_SESSION['notice'][$ch_name]['phone'] : ''; ?>" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                <?
                                select_city($ch_name);
                                
                                ?>
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                <?
                                    select_category($ch_name);
                                ?>
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="<? echo $change ? $_SESSION['notice'][$ch_name]['title'] : ''; ?>"/></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message" ><? echo $change ? $_SESSION['notice'][$ch_name]['message'] : ''; ?></textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="<? echo $change  ? $_SESSION['notice'][$ch_name]['price'] : ''; ?>"></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="отправить" />
                            <input type="hidden" name="id" value="<? echo $change ? $_SESSION['notice'][$ch_name]['id'] : mt_rand(1, 10000) ?>">
                        </div>
                    </fieldset>
                </form>

                <?
                echo '<table>';                                     //Делаем таблицу, в которой покажем все объявления из сессии
                foreach ($_SESSION as $key => $value) {                     //перебираем массив сессии
                    if ($key == 'notice') {                          //работаем  с массивом Notice
                        foreach ($value as $key => $value) {            //перебираем массив 
                            echo '<tr>'
                            . '<td>' . '<a href = dz6.php?change=' . $key . '> ' . $value['title'] . '</a></td>'    //формируем ссылку с названием объявления, в качестве параметра ID объявления 
                            . '<td>' . $value['price'] . ' руб. </td>'        //цена
                            . '<td>' . $value['name'] . '</td>'         //имя клиента 
                            . '<td>' . '<a href = dz6.php?del=' . $key . '>Удалить' . '</a></td></tr>'    //здесь делаем ссылку на удаление
                            ;
                        }
                    }
                }
                echo '</table>';
//                print_r($_SESSION);
//                print_r($_GET);
                ?>
            </div>
            <div id="footer">Подвал</div>
        </div>
    </body>
</html>


