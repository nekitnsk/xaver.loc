
<?php header("content-type: text/html, charset=UTF-8"); ?>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<?
error_reporting(E_ERROR | E_NOTICE | E_WARNING | E_PARSE);
ini_set('display_errors', 1);


//GET

$news='Четыре новосибирские компании вошли в сотню лучших работодателей
Выставка университетов США: открой новые горизонты
Оценку «неудовлетворительно» по качеству получает каждая 5-я квартира в новостройке
Студент-изобретатель раскрыл запутанное преступление
Хоккей: «Сибирь» выстояла против «Ак Барса» в пятом матче плей-офф
Здоровое питание: вегетарианская кулинария
День святого Патрика: угощения, пивной теннис и уличные гуляния с огнем
«Красный факел» пустит публику на ночные экскурсии за кулисы и по закоулкам столетнего здания
Звезды телешоу «Голос» Наргиз Закирова и Гела Гуралиа споют в «Маяковском»';
$news=  explode("\n", $news);
//print_r($news);

if (!array_key_exists('id', $_GET)){        //проверяем существует ли у нас в массиве GET ключ с именем id (т.е. был ли в URL передан параметр id)
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
    echo 'Страница не найдена';
    exit;        
}

if ($_GET['id']=== 'all') {                 //кодовое слово all - выводит весь список новостей, если нет то поехали дальше
    all_news($news);
}else{

        if (array_key_exists($_GET['id'], $news)){    //теперь проверяем есть ли новость в массиве news с таким номером если да, то выводим эту новость, 
            echo $news[$_GET['id']];
        }else {                                     //если нет выводим весь массив через функ all_news
               all_news($news);
         }
}

function all_news($news){                    //функция вывода всех новостей из переданного массива
    
    for ($i = 0; $i < count($news); $i++) {
    echo $news[$i]. '<br>';
    }
}


// Функция вывода всего списка новостей.

// Функция вывода конкретной новости.

// Точка входа.
// Если новость присутствует - вывести ее на сайте, иначе мы выводим весь список

// Был ли передан id новости в качестве параметра?
// если параметр не был передан - выводить 404 ошибку
// http://php.net/manual/ru/function.header.php


?>
