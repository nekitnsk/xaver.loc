<?php header("content-type: text/html, charset=UTF-8"); ?>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
//$change = false;                                        //по умолчанию команда на изменение выключена
//$ch_name = '';
  //блок обрабатывает поступление  нового объявления из POST
if (array_key_exists('id', $_POST)) {                //существует ли ключ id в массиве post 
    setcookie("notice[$_POST[id]]", serialize($_POST), time()+3600*24*7);       //запишем куку типа в виде массива notice 
    header('location: dz7_1.php');                        //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}
//блок обрабатывает удаление объявления при запросе из GET
if (array_key_exists('del', $_GET)) {                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    setcookie("notice[$_GET[del]]","",1);
    header('location: dz7_1.php');                        //сделаем редирект сюда же для очистки адресной строки и get 
}

//блок формирует из COOKIE массив с объявлениями
if (isset($_COOKIE['notice'])){
    foreach ($_COOKIE['notice'] as $key => $value) {                     //вытащим из кук информацию в виде массива по всем объявлениям
        $notice[$key] = unserialize($value);
        }
ksort($notice);
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
                <form  id = "notice"  method="POST">
                    <fieldset>
                        <div id="radio">
                            <input type="radio" name="whois" value="people" checked>Частное лицо 
                            <input type="radio" name="whois" value="company" <?php if (array_key_exists('change', $_GET) && $notice[$_GET['change']]['whois'] == 'company') {echo 'checked';} ?>>Компания</div>  
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="<?php echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['name'] : ''; ?>" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="<?php echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['email'] : ''; ?>" /></dd>
                            <div id="radio">
                                <input type="checkbox" name="delivery" value="delivery" <?php if (array_key_exists('change', $_GET) && array_key_exists('delivery', $notice[$_GET['change']])) {echo 'checked';} ?>>Я хочу получать уведомления на Email</div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="<?php echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['phone'] : ''; ?>" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                <?php
                                    select_city($_GET['change']);
                                ?>
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                <?php
                                    select_category($_GET['change']);
                                ?>
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" value="<?php echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['title'] : ''; ?>"/></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message" ><?php echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['message'] : ''; ?></textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price" value="<?php echo array_key_exists('change', $_GET)  ? $notice[$_GET['change']]['price'] : ''; ?>"></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="отправить" />
                            <input type="hidden" name="id" value="<?php echo array_key_exists('change', $_GET) ? $notice[$_GET['change']]['id'] : time() ?>">
                        </div>
                    </fieldset>
                </form>

                <?php
                echo '<table>';                                     //Делаем таблицу, в которой покажем все объявления из сессии
                
                    if (isset($notice)) {                          //работаем  с массивом Notice
                        foreach ($notice as $key2 => $value2) {            //перебираем массив 
                            echo '<tr>'
                            . '<td>' . '<a href = dz7_1.php?change=' . $key2 . '> ' . $value2['title'] . '</a></td>'    //формируем ссылку с названием объявления, в качестве параметра ID объявления 
                            . '<td>' . $value2['price'] . ' руб. </td>'        //цена
                            . '<td>' . $value2['name'] . '</td>'         //имя клиента 
                            . '<td>' . '<a href = dz7_1.php?del=' . $key2 . '>Удалить' . '</a></td></tr>'    //здесь делаем ссылку на удаление
                            ;
                        }
                    }
                
                echo '</table>';
//                print_r($_COOKIE['notice']);
//                print_r($notice);
                ?>
            </div>
            <div id="footer">Подвал</div>
        </div>
    </body>
</html>


