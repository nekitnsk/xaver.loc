
<?PHP
require_once("./include/membersite_config.php");

if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("login.php");
    exit;
}

?>
<!DOCTYPE html>
<?php
//подключение DBSimple
require_once "../lib/dbsimple/config.php";
require_once "../lib/dbsimple/DbSimple/Generic.php";

$config = parse_ini_file('../config.ini', true);

$db = DbSimple_Generic::connect('mysqli://' . $config['Database1']['user'] . ':' . $config['Database1']['password'] . '@' . $config['Database1']['host'] . '/' . $config['Database1']['database'] . '');




$house = $db->select('SELECT seo_name AS ARRAY_KEY, id, name, seo_name, space, cost, category, default_house, main_photo FROM dom ');
?>

<html>

    <head>
        <meta charset="utf-8"/>
        <title>Форма добавления дома в каталог</title>

        <!-- Google web fonts -->
        <link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />

        <!-- The main CSS file -->
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="assets/css/jumbotron.css" rel="stylesheet" />
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="assets/css/dataTables.bootstrap.css" rel="stylesheet" />
        <link href="assets/css/highslide.css" rel="stylesheet" />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        
        
        <script src="assets/js/jquery.dataTables.min.js"></script>
        
        <script src="assets/js/dataTables.bootstrap.js"></script>
        <script src="assets/js/highslide.js"></script>
        <script src="assets/js/jquery.form.js"></script>
        <script src="assets/js/script.js"></script>
        <script type="text/javascript">
            hs.graphicsDir = 'graphics/';
            hs.wrapperClassName = 'wide-border';
        </script>
		


    </head>


    <body>

        <div class="container">
            <div class="header clearfix">
                <nav>
                    <ul class="nav nav-pills pull-right">
                        <li role="presentation" class="active"><a href="#">Главная</a></li>
                        <li role="presentation"><a href='change-pwd.php'>Сменить пароль</a></li>
                        <li role="presentation"><a href='logout.php'>Выйти</a></li>
                    </ul>
                </nav>
                <h3 class="text-muted">Каталог домов. Административная панель</h3>
            </div>

            <div class="jumbotron">
                <h2>Форма добавления домов в каталог</h2>
                <p class="lead">Пожалуйста, следуйте рекомендациями в описании блоков</p>

            </div>

            <div class="row marketing" >
                <div class = "toggle">
                    <a onclick="$('#add_house_form').slideToggle('slow');" href="javascript://">Свернуть/Развернуть форму добавления дома</a>
                </div>
                <div id="add_house_form">
                    <form class="form-horizontal"  id = "addHouse" method="POST" action="">

                        <h4>Наименование дома</h4>
                        <hr>
                        <div class="form-group">
                            <label for="name" class="col-sm-4 control-label">Название дома
                                <p><span class="comment">Название каждого дома должно быть уникально. Это название будет использовано в названии файлов и картинок. А также отображаться над главной странице каталога в качестве названия дома.</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="name" onKeyUp="javascript: cyrtolat();" placeholder="Например, Aero Polar 42">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="seo_name" class="col-sm-4 control-label">СЕО Название дома(АВТОМАТИЧЕСКОЕ)
                                <p><span class="comment">Это название будет использовано в названии файлов и картинок. Пожалуйста обращайте внимание на это поле, чтобы проверить корректность написания. Здесь должны отсутствовать заглавные буквы, кирилические символы и пробелы.</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="seo_name" name="seo_name" placeholder="Например, Aero Polar 42">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="space" class="col-sm-4 control-label">Площадь дома
                                <p><span class="comment">Введите площадь дома, без использования м2</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="space" name="space" placeholder="Например, 42">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="head1" class="col-sm-4 control-label">Заголовок описания
                                <p><span class="comment">Это большой заголовок в подробном описании дома</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="head1" name="head1" placeholder="Например, ДОМ AERO POLAR 42 ИЗ ДВОЙНОГО БРУСА">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="head2" class="col-sm-4 control-label">Заголовок №2 
                                <p><span class="comment">Это подзаголовок в разделе описания дома</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="head2" name="head2" placeholder="Например, Дом из двойного бруса">
                            </div>
                        </div>


                        <h4>Используемые материалы</h4>
                        <hr>

                        <div class="form-group">
                            <label for="roof" class="col-sm-4 control-label">Материал крыши
                                <p><span class="comment">Введите материал крыши</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="roof" name="roof" placeholder="Например, Металлочерепица">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="wall" class="col-sm-4 control-label">Материал стен
                                <p><span class="comment">Введите материал стен</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="wall" name="wall" placeholder="Например, Двойной брус 150х150">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fundament" class="col-sm-4 control-label">Тип фундамента
                                <p><span class="comment">Введите тип фундамента</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="fundament" name="fundament" placeholder="Например, Винтовые сваи">
                            </div>
                        </div>
                        <h4>Конструктивные особенности дома</h4>
                        <h6>В каждом пункте два поля,в первое поле следует ввести название, например, Лестница.<br>
                            во втором поле следует ввести описание данной характеристики</h6>
                        <hr>


                            <?php
                            for ($i = 0; $i < 10; $i++) {
                                ?>
                            <div class="form-group">
                                <label for="feature<?php echo $i + 1 ?>" class="col-sm-2 control-label"><?php echo $i + 1 ?></label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="feature<?php echo $i + 1 ?>" name="feature<?php echo $i + 1 ?>" placeholder="Например, Утепление">
                                    <input type="text" class="form-control" id="feature<?php echo $i + 1 ?>_desc" name="feature<?php echo $i + 1 ?>_desc" placeholder="Например, Экстра вата,толщиной 100мм.">
                                </div>
                            </div>
                                    <?php
                                }
                                ?>

                        <h4>Описание дома</h4>
                        <hr>
                        <div class="form-group">
                            <label for="description1" class="col-sm-4 control-label">Описание дома
                                <p><span class="comment">Здесь можете написать описание дома, кому здесь хорошо жить, чем он интересен, чем уникален, для кого подходит и т.п.</span></p></label>
                            <div class="col-sm-8">
                                <textarea rows = 15 class="form-control" id="description1" name="description1" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description2" class="col-sm-4 control-label">Дополнительно
                                <p><span class="comment">Дополнительный блок. Будет показан отдельным разделом, как описание дома, например. Введите название блока и описание.</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="title_description2" name="title_description2" placeholder="Например, Стоимость дома с участком">
                                <textarea rows = 10 class="form-control" id="description2" name="description2" placeholder=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description3" class="col-sm-4 control-label">Дополнительно 2
                                <p><span class="comment">Дополнительный блок. Будет показан отдельным разделом, как описание дома, например. Введите название блока и описание.</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="title_description3" name="title_description3" placeholder="Например, В стоимость дома входит">
                                <textarea rows = 10 class="form-control" id="description3" name="description3" placeholder=""></textarea>
                            </div>
                        </div>

                        <h4>Стоимость дома</h4>
                        <hr>
                        <div class="form-group">
                            <label for="cost" class="col-sm-4 control-label">Стоимость дома
                                <p><span class="comment">Здесь введите стоимость дома используя только цифры, без знаков РУБ и т.п.</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="cost" name="cost" placeholder="Например, 790000">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-sm-4 control-label">Стоимость дома произвольное
                                <p><span class="comment">Эта строка будет отображаться в подробном описании дома, поэтому можете ввести стоимость дома в произвольной форме, не только цифры, а какую либо добавочную информацию</span></p></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="price" name="price" placeholder="Например, 790 000 рублей до конца лета ">
                            </div>
                        </div>

                        <h4>Управление домом</h4>
                        <hr>
                        <!-- Single button -->
                        <div class="form-group">
                            <label for="category" class="col-sm-4 control-label">Выберите категорию 
                                <p><span class="comment">Раздел в котором будет отображаться дом</span></p></label>
                            <div class="col-sm-8">

                                <select class="form-control" name = "category" id="category">
                                    <option disabled>Выберите раздел</option>
                                    <option value="brick">Кирпич</option>
                                    <option value="log">Оцилиндрованное бревно</option>
                                    <option value="sandwich">Сэндвич панели</option>
                                    <option value="rod">Двойной брус</option>
                                    <option value="sibit">Сибит</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="default_house" class="col-sm-4 control-label">Показывать на главной странице
                                <p><span class="comment">Показывать дом на главной странице. Не рекомендуется показывать много домов, чтобы не перегружать страницу</span></p></label>
                            <div class="col-sm-8">
                                <input type="checkbox" class="form-control" value="true" id="default_house" name="default_house">
                            </div>
                        </div>

                        <hr>
                        <input type="hidden" id="main_photo" name="main_photo" value="" />
                        <input type="hidden" id="id" name="id" value="" />

                    </form>

                    <form class="form-horizontal"  id = "upload" method="post" action="upload.php" enctype="multipart/form-data">
                        <h4>Загрузка файлов</h4>
                        <hr>

                        <div class="form-group">
                            <label for = "upl" class="col-sm-4 control-label">Выберите файлы для загрузки</label>
                            <div class="col-sm-8">

                                <input type="file" name="upl" multiple />
                                <input type="hidden" id="file_name" name="file_name" value="123" />
                                


                                <ul>
                                    <!-- The file uploads will be shown here -->
                                </ul>
                            </div>
                        </div>


                    </form>

                    <form class="form-horizontal"  id = "select_main_photo">
                        <h4>Управление фотографиями</h4>
                        <hr>
                        <div class="form-group">
                            <label for = "select" class="col-sm-4 control-label">Выберите основную фотографию</label>
                            <div class="col-sm-8" id="selectors">
                                <div class="cc-selector">
                                    <!-- The PREVIEW IMAGE uploads will be shown here -->	


                                </div>


                            </div>
                        </div>

                    </form>
                    <div class="form-group">
                        <div id="container" class="alert alert-info alert-dismissible" style="display:none;" role="alert">
                            <button type="button" class="close"  aria-label="Закрыть" onclick="$('#container').fadeOut('slow');
                                    return false;">
                                <span aria-hidden="true">&times;</span></button>
                            <div id="container_info"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-8">


                            <button type="submit" id = "saveHouse" class="btn btn-default">Добавить дом в каталог</button>
                        </div>	
                    </div>
                </div>


                <div class = "toggle">
                    <a onclick="$('#house_table').slideToggle('slow');" href="javascript://">Свернуть/Развернуть таблицу с домами</a>
                </div>

                <div id="house_table">
                    <h4>Таблица имеющихся домов в базе данных</h4>
                    <hr>
                    
                    <div id="message_delete" class="alert alert-info alert-dismissible" style="display:none;" role="alert">
                            <button type="button" class="close"  aria-label="Закрыть" onclick="$('#message_delete').fadeOut('slow');
                                    return false;">
                                <span aria-hidden="true">&times;</span></button>
                            <div id="message_delete_info"></div>
                        </div>
                    
                    <table id="table_house" class="table table-stripped table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Главное фото</th>
                                <th>Название дома</th>
                                <th>SEO</th>
                                <th>Цена</th>
                                <th>Категория</th>
                                <th>Показывать по умолчанию</th>
                               
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>

                                <?php
                                foreach ($house as $key => $value) {
                                    
                                    ?>
                            <tr>
                                <td class="id"><?php echo($value['id']);?></td>
                                <td><a href="../files/images/house/<?php echo($value['seo_name']);?>/<?php echo($value['main_photo']);?>" class="highslide" onclick="return hs.expand(this)">
                                    <img style="width: 80%" src="../files/images/house/<?php echo($value['seo_name']);?>/<?php echo($value['main_photo']);?>"></a></td>
                                <td><?php echo($value['name']);?></td>
                                <td><?php echo($key);?></td>
                                <td><?php echo($value['cost']);?></td>
                                <td><?php 
                                        switch ($value['category']) {
                                            case 'rod':
                                                echo "Двойной брус";
                                                break;
                                            case 'brick':
                                                echo "Кирпич";
                                                break;
                                            case 'sandwich':
                                                echo "Сэндвич панели";
                                                break;
                                            case 'log':
                                                echo "Оцилиндрованное бревно";
                                                break;
                                            case 'sibit':
                                                echo "Сибит";
                                                break;
                                        }
                                         
                                    ?></td>
                                <td><?php if ($value['default_house']=='true'){echo('Да');}?></td>
                                <td><a class="delete">Удалить </a><br><a class="change"> Изменить</a></td>
                            </tr>
                            
                                    <?php
                                }
                                ?>

                        </tbody>

                    </table>



                </div>


                <footer class="footer">
                    <p>&copy; Company 2015</p>
                </footer>

            </div> <!-- /container -->


            <!-- JavaScript Includes -->
            
            <script src="assets/js/jquery.knob.js"></script>

            <!-- jQuery File Upload Dependencies -->
            <script src="assets/js/jquery.ui.widget.js"></script>
            <script src="assets/js/jquery.iframe-transport.js"></script>
            <script src="assets/js/jquery.fileupload.js"></script>
            <script src="assets/js/cyrtolat.js"></script>
            
           



            <!-- Our main JS file -->
            




    </body>

</html>