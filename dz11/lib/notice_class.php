<?php
//основной класс, имеет только общие свойства для всех объяв
class notice {
    protected  $id;
    protected  $name;
    protected  $title;
    protected  $price;
    
    function __construct(array $data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->title = $data['title'];
        $this->price = $data['price'];
            
    }
    
    function getid(){
        return $this->id;
    }
    function getname(){
        return $this->name;
    }
    function gettitle(){
        return $this->title;
    }
    function getprice(){
        return $this->price;
    }
           
}

//расширенный класс, имеет дополнительные свойства объяв
class full_notice extends notice {
    protected   $whois;
    protected   $email;
    protected   $subscribe;
    protected   $phone;
    protected   $city;
    protected   $category;
    protected   $message;
    
    function __construct(array $data) {
        parent::__construct($data);
        $this->whois = $data['whois'];
        $this->email = $data['email'];
        $this->subscribe = $data['subscribe'];
        $this->phone = $data['phone'];
        $this->city = $data['city'];
        $this->category = $data['category'];
        $this->message = $data['message'];
    }
    
    function getwhois(){
        return $this->whois;
    }
    function getemail(){
        return $this->email;
    }
    function getsubscribe(){
        return $this->subscribe;
    }
    function getphone(){
        return $this->phone;
    }
    function getcity(){
        return $this->city;
    }
    function getcategory(){
        return $this->category;
    }
    function getmessage(){
        return $this->message;
    }
           
    
    
    //добавление или обновление объявления в базе (сокращенно от addupdate)
    function addup($db, $table){
        
        $array_object = get_object_vars($this);
        if (count($db->select('SELECT id FROM ?# WHERE id = ? ', $table, $this->id)) == 0) {
            $db->query('INSERT INTO ?# (?#) VALUES (?a)', $table, array_keys($array_object), array_values($array_object));
        } else {
            $db->query('UPDATE ?# SET ?a WHERE id = ? ', $table, $array_object, $array_object['id']);
        }
    }
    
}

class func {
    //модуль удаления объявления
    static function del($db, $get){
        $db->query('UPDATE notice SET active = 0 WHERE id = ?', $get['del']);
    }
    
    //получение объявлений из базы. Сохраняем все объявления в хранилище объектов, объявления класса notice. 
    //Если есть задача на изменение объвы, то именно эту объяву запишем в хранилище типом full_notice
    static function getnotice($db, $id=''){
        $adv = $db->select("SELECT id AS ARRAY_KEY, name, title, price, id FROM notice WHERE active = 1 ORDER BY id LIMIT 30 ");
        
        foreach ($adv as $key=>$value) {
            $notice[$key] = new notice($value); 
        }
        
        if ($id!='') {
            $adv = $db->selectRow('SELECT  id, whois, name,email, subscribe,phone,city,category,title,message,price FROM notice WHERE id = ? ', $id);
            $notice[$id] = new full_notice($adv);
        }
        
        return $notice;
    }
    
}
//класс получения данных для работы формы из базы данных
class getdata {
    //whois - физическое лицо или компания
    static function getwhois($db) {
        $whois = $db->select("SELECT id AS ARRAY_KEY,whois FROM whois");

        foreach ($whois as $key => $value) {
            $whois[$key] = $value['whois'];
        }
        return $whois;
    }
    
    //getcity - блок получения списка городов
    static function getcity($db){
        $city = $db->select('SELECT city_id AS ARRAY_KEY,  name FROM city LIMIT 100');

        foreach ($city as $key => $value) {
            $city[$key] = $value['name'];
        }
        return $city;
        
    }
    
    //getcategory - блок получения списка категорий
    static function getcategory($db){
        $category = $db->select("SELECT id AS ARRAY_KEY, name FROM category");

        foreach ($category as $key => $value) {
            $category[$key] = $value['name'];
        }
        return $category;
    }
    
    
    
}


?>