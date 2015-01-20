
<?
session_start();
if (array_key_exists('title', $_POST)) {                //существует ли ключ title в массиве post 
    $_SESSION['notice'][$_POST['title']] = $_POST;      //если существует то запишем в сессию массив с ключом = название объявления
    unset($_POST);                                      //убьем POST
    header('location: dz6.php');                        //Сделаем редирект на эту же страницу, чтобы избавиться от повторной отправки формы
}
if (array_key_exists('del', $_GET)){                    //проверим пришел ли у нас  в GET запрос на удаление через параметр del
    unset($_SESSION['notice'][$_GET['del']]);           //если пришел то удалим его в сессии
    header('location: dz6.php');                        //сделаем редирект сюда же для очистки адресной строки и get 
}
if (array_key_exists('change', $_GET)){
    change();    
}



function change(){
   echo 'ura'?>
  <script type="text/javascript">
document.getElementsByName('email')[0].value = 'tukov@bk.ru';
//var elem = document.getElementsById('email')[0];
//elem.setAttribute('value', 'bla');

</script>
     <? 
}

?>

<!--<script>
document.getElementsByName('email')[0].value = 'tukov@bk.ru';
</script>-->
<script type="text/javascript">
        function WhereYouWillSend(){document.getElementsByName('email')[0].value = '1';};
        </script>

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
                            <input type="radio" name="whois" value="people">Частное лицо
                            <input type="radio" name="whois" value="company">Компания</div>
                        <dl>
                            <dt><label for="name">Ваше имя</label></dt>
                            <dd><input type="text" name="name" value="" /></dd>
                            <dt><label for="email">Электронная почта</label></dt>
                            <dd><input type="text" name="email" value=""/></dd>
                            <div id="radio">
                                <input type="checkbox" name="delivery" value="delivery" <? echo 'checked'?> >Я хочу получать уведомления на Email
                            </div>
                            <dt><label for="phone">Номер телефона</label></dt>
                            <dd><input type="text" name="phone" /></dd>
                            <dt><label for="city">Город</label></dt>
                            <dd>
                                <select name="city" id="city">
                                    <option>Новосибирск</option>
                                    <option>Бердск</option>
                                    <option>Искитим</option>
                                </select>
                            </dd>
                            <dt><label for="category">Категория</label></dt>
                            <dd>
                                <select name="category" id="category">
                                    <option>Одежда</option>
                                    <option>Бытовая техника</option>
                                    <option>Недвижимость</option>
                                </select>
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
                            . '<td>' . $key . '</td>'
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
                <a href = dz6.php?change=true> бла </a>
                
                
                
            </div>
            <div id="footer">Подвал</div>
        </div>
    </body>
</html>


