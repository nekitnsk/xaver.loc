<?php
//хранилище объявлений
//и все что связано с объявлениями - список городов, категорий, видов клиентов
class AdsStore{
    private static $instance=NULL;
    protected $ads = array();
    protected $city = array();
    protected $whois = array();
    protected $category = array();
    
    
    public static function instance() {
        if (self::$instance == NULL) {
            self::$instance = new AdsStore();
        }
        return self::$instance;
    }
    //добавление объявления
    function AddUp($db, $post) {        
        
        
        $this->ads[$post['id']] = new Ad($post);
        $array_object = $this->ads[$post['id']]->getobjectvars();
        if (count($db->select('SELECT id FROM ?# WHERE id = ? ', 'ad', $post['id'])) == 0) {
            $db->query('INSERT INTO ?# (?#) VALUES (?a)', 'ad', array_keys($array_object), array_values($array_object));
        } else {
            $db->query('UPDATE ?# SET ?a WHERE id = ? ', 'ad', $array_object, $array_object['id']);
        }
    }

    //получение объявлений из базы. Сохраняем все объявления в хранилище объектов, объявления класса ad. 
    //Если есть задача на изменение объвы, то именно эту объяву запишем в хранилище типом full_ad
    function GetAds($db, $id=''){
        
        
        $adv = $db->select("SELECT id AS ARRAY_KEY, name, title, price, id FROM ad WHERE active = 1 ORDER BY id LIMIT 30 ");

        foreach ($adv as $key => $value) {
            $this->ads[$key] = new AdShort($value);
        }

        if ($id != '') {
            $adv = $db->selectRow('SELECT  id, whois, name,email, subscribe,phone,city,category,title,message,price FROM ad WHERE id = ? ', $id);
            $this->ads[$id] = new Ad($adv);
        }

        return $this->ads;
    }

    //метод удаления объявления из базы и хранилища
    function Del($db, $id){
        if (($db->query('UPDATE ad SET active = 0 WHERE id = ?', $id))>0){
            $result['status']='success';
            $result['message'] = "Объявление удалено успешно";
            
        }else{
            $result['status']='error';
            $result['message'] = "Произошла ошибка, попробуйте еще раз";
            
        }
        
        unset($this->ads[$id]);
        return $result;
    }   
    
    //метод получения видов клиентов объявлений
    function GetWhois($db) {
        $this->whois = $db->select("SELECT id AS ARRAY_KEY,whois FROM whois");

        foreach ($this->whois as $key => $value) {
            $this->whois[$key] = $value['whois'];
        }
        return $this->whois;
    }
    
    //getcity - блок получения списка городов
    function GetCity($db){
        $this->city = $db->select('SELECT city_id AS ARRAY_KEY,  name FROM city LIMIT 100');

        foreach ($this->city as $key => $value) {
            $this->city[$key] = $value['name'];
        }
        return $this->city;
    }
    
    //getcategory - блок получения списка категорий
    function GetCategory($db){
        $this->category = $db->select("SELECT id AS ARRAY_KEY, name FROM category");

        foreach ($this->category as $key => $value) {
            $this->category[$key] = $value['name'];
        }
        return $this->category;
    }

}



?>