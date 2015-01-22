
<?
session_start();

function select_city($city = '') {
    $citys = array('115100' => 'Новосибирск', '115115' => 'Искитим', '115124' => 'Бердск');
    if (array_key_exists('change', $_GET) && array_key_exists('notice', $_SESSION)){
    $gorod = $_SESSION['notice'][$_GET['change']]['city'];
    }
    ?>
        <select title="Выберите ваш город" name="city" id="city" > 
                    <option value="">..Выберите город..</option>
                    <option  disabled="disabled">..Новосибирская область..</option>
    <?php
    foreach ($citys as $number => $city) {
        $selected = ($number == $gorod) ? 'selected=""' : ''; 
        echo '<option '.$selected.' value="'.$number.'">'.$city.'</option>';
    }
    ?>
        </select>    
    <?php
}

function select_category($type = '') {
    $categoryes = array('2145' => 'Зимняя', '2146' => 'Летняя', '2147' => 'Демисезонная');
    if (array_key_exists('change', $_GET) && array_key_exists('notice', $_SESSION)){
    $gorod = $_SESSION['notice'][$_GET['change']]['category'];
    }
    ?>
        <select title="Выберите категорию объявления" name="category" id="category" > 
                    <option value="">..Категория..</option>
                    <option  disabled="disabled">..Одежда..</option>
    <?php
    foreach ($categoryes as $number => $type) {
        $selected = ($number == $categoryes) ? 'selected=""' : ''; 
        echo '<option '.$selected.' value="'.$number.'">'.$type.'</option>';
    }
    ?>
        </select>    
    <?php
}
if (array_key_exists('title', $_POST)) {                //существует ли ключ title в массиве post 
    $_SESSION['notice'][$_POST['title']] = $_POST;      //если существует то запишем в сессию массив с ключом = название объявления
    unset($_POST);                                      //убьем POST
    header('location: dz6.php');                        //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}
if (array_key_exists('del', $_GET)){                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    unset($_SESSION['notice'][$_GET['del']]);           //если пришел то удалим его в сессии
    header('location: dz6.php');                        //сделаем редирект сюда же для очистки адресной строки и get 
}
$change = false;
$ch_name = '';
if (array_key_exists('change', $_GET)){
    $change = true;
    $ch_name = $_GET['change'];
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
                            <input type="radio" name="whois" value="people" <? if ($change==true && $_SESSION['notice'][$ch_name]['whois']=='people') {echo 'checked';}?>>Частное лицо
                            <input type="radio" name="whois" value="company" <? if ($change==true && $_SESSION['notice'][$ch_name]['whois']=='company') {echo 'checked';}?>>Компания</div>
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="<?echo $change==true?$_SESSION['notice'][$ch_name]['name']:''; ?>" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value="<?echo $change==true?$_SESSION['notice'][$ch_name]['email']:''; ?>" /></dd>
                            <div id="radio">
                                <input type="checkbox" name="delivery" value="<? if ($change==true && $_SESSION['notice'][$ch_name]['delivery']=='delivery') {echo 'checked';}?>" >Я хочу получать уведомления на Email</div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" value="<?echo $change==true?$_SESSION['notice'][$ch_name]['phone']:''; ?>" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                <?
                                if ($change==true){
                                    select_city($ch_name);
                                }else{
                                    select_city();
                                }   
                                ?>
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                <?
                                if ($change==true){
                                    select_category($ch_name);
                                }else{
                                    select_category();
                                }   
                                ?>
                            </dd>
                            <dt><label for="title">Название объявления</label></dt>
                            <dd><input type="text" name="title" /></dd>
                            <dt><label for="message">Описание объявления</label></dt>
                            <dd><textarea cols="" rows=""  name="message"></textarea></dd>
                            <dt><label for="price">Цена</label></dt>
                            <dd><input type="text"  name="price"></textarea>
                                <label> Руб.</label></dd>
                        </dl>
                        <div class="submit">
                            <input type="submit" name="send" value="отправить" />
                        </div>
                    </fieldset>
                </form>
                
                <?
                
                
                echo '<table>';                                     //Делаем таблицу, в которой покажем все объявления из сессии
                foreach ($_SESSION as $key => $value) {                     //перебираем массив сессии
                    if ($key == 'notice') {                          //работаем  с массивом Notice
                        foreach ($value as $key => $value) {            //перебираем массив 
                            echo '<tr>'
                            . '<td>' . '<a href = dz6.php?change='.urlencode($key). '> ' . $key . '</a></td>'
                            . '<td>' . $value['price'] . '</td>'        //цена
                            . '<td>' . $value['name'] . '</td>'         //имя клиента 
                            . '<td>' . '<a href = dz6.php?del='.urlencode($key). '>Удалить' . '</a></td></tr>'    //здесь делаем ссылку на удаление в формате URL
                            ;
                        }
                    }
                }
                echo '</table>';



                print_r($_SESSION);
                print_r($_GET);
                ?>
                
                
                
                
            </div>
            <div id="footer">Подвал</div>
        </div>
    </body>
</html>


