<?php

require_once "dbsimple/config.php";
require_once "dbsimple/DbSimple/Generic.php";

    
        
        $config = parse_ini_file('./config.ini', true);
        $db = DbSimple_Generic::connect('mysqli://'.$config['Database1']['user'].':'.$config['Database1']['password'].'@'.$config['Database1']['host'].'/'.$config['Database1']['database'].'');
        $db->setErrorHandler('databaseErrorHandler');
        
        
    
    
    function getwhois() {
        global $db;
        $whois = $db->select("SELECT id AS ARRAY_KEY,whois FROM whois");

        foreach ($whois as $key => $value) {
            $whois[$key] = $value['whois'];
        }
        return $whois;
    }
    
    //getcity - блок получения списка городов
    function getcity(){
        global $db;
        $city = $db->select('SELECT city_id AS ARRAY_KEY,  name FROM city LIMIT 100');

        foreach ($city as $key => $value) {
            $city[$key] = $value['name'];
        }
        return $city;
        
    }
    
    //getcategory - блок получения списка категорий
    function getcategory(){
        global $db;
        $category = $db->select("SELECT id AS ARRAY_KEY, name FROM category");

        foreach ($category as $key => $value) {
            $category[$key] = $value['name'];
        }
        return $category;
    }
    
    





?>