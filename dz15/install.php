<?php
error_reporting(E_ERROR |  E_WARNING | E_PARSE | E_ALL);
ini_set('display_errors', 1);

//функция для создания файла config.ini где будут хранится настройки доступа к базе. 

function write_ini_file($assoc_arr, $path, $has_sections=FALSE) { 
    $content = ""; 
    if ($has_sections) { 
        foreach ($assoc_arr as $key=>$elem) { 
            $content .= "[".$key."]\n"; 
            foreach ($elem as $key2=>$elem2) { 
                if(is_array($elem2)) 
                { 
                    for($i=0;$i<count($elem2);$i++) 
                    { 
                        $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                    } 
                } 
                else if($elem2=="") $content .= $key2." = \n"; 
                else $content .= $key2." = \"".$elem2."\"\n"; 
            } 
        } 
    } 
    else { 
        foreach ($assoc_arr as $key=>$elem) { 
            if(is_array($elem)) 
            { 
                for($i=0;$i<count($elem);$i++) 
                { 
                    $content .= $key."[] = \"".$elem[$i]."\"\n"; 
                } 
            } 
            else if($elem=="") $content .= $key." = \n"; 
            else $content .= $key." = \"".$elem."\"\n"; 
        } 
    } 

    if (!$handle = fopen($path, 'w')) { 
        
        return false; 
    }


    $success = fwrite($handle, $content);
    fclose($handle); 
}
//функция удаляет любые таблицы из базы
function delete_table($db) {

    $query = 'SHOW TABLES FROM `' . $_POST['database'] . '` ';
    $result = mysqli_query($db, $query);

    //получаем список всех таблиц из указанной базы данных и удаляем их 
    while ($arr = mysqli_fetch_row($result)) {
        $arr2[] = $arr[0];
    }
    mysqli_free_result($result);
    if (!empty($arr2)) {
        $delete = '';

        foreach ($arr2 as $value) {
            $delete .= 'DROP TABLE IF EXISTS `' . $value . '`;';
        }
        mysqli_multi_query($db, $delete) or die(mysqli_error($db));
        while (mysqli_next_result($db)) {;}
//        print_r($arr2);
    }
}

function create_table($db) {
//создаем базу из дампа
    $create_table = file_get_contents('hlamanet.sql');
    mysqli_multi_query($db, $create_table) or die(mysqli_error($db));
    while (mysqli_next_result($db)) {;}
}

if (array_key_exists('send', $_POST)){
    //сформируем массив для записи в файл
    $Data = array(
                'Database1' => array(
                    'host' => $_POST['host'],
                    'user' => $_POST['user'],
                    'password' => $_POST['pass'],
                    'database' => $_POST['database'],
                ));
    
    //функция записи ini файла
    write_ini_file($Data, './config.ini', true);
//    print_r($_POST);
    $db = new mysqli($_POST['host'], $_POST['user'], $_POST['pass'], $_POST['database']) or die (mysqli_error($db));

if (mysqli_connect_errno($db)) {
    echo "Не удалось подключиться к MySQL: (" . mysqli_connect_errno() . ") " . mysqli_connect_error($db);
}
    delete_table($db);
    create_table($db);
    mysqli_close($db);
    header('Location: index.php');
}


?>

<form  id = "dataform" action="install.php" method="POST">
                                            
                            <label for="host">Server name</label><br>
                            <input type="text" name="host" value="" /><br>
                            <label for="user">User name</label><br>
                            <input type="text" name="user" value="" /><br>
                            <label for="pass">Password</label><br>
                            <input type="password" name="pass" value="" /><br>
                            <label for="database">Database</label><br>
                            <input type="text" name="database" value="" /><br>
                                                        
                            <input type="submit" name="send" value="Install" />


