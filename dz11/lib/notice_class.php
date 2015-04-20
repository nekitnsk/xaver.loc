<?php
//основной класс, имеет только общие свойства для всех объяв
class notice {
    public $id;
    public $name;
    public $title;
    public $price;
    
    function __construct(array $data) {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->title = $data['title'];
        $this->price = $data['price'];
            
    }
           
}

//расширенный класс, имеет дополнительные свойства объяв
class full_notice extends notice {
    protected $email;
    protected $subscribe;
    protected $phone;
    protected $city;
    protected $category;
    protected $message;
    
    function __construct(array $data) {
        parent::__construct($data);
        $this->email = $data['email'];
        $this->subscribe = $data['subscribe'];
        $this->phone = $data['phone'];
        $this->city = $data['city'];
        $this->category = $data['category'];
        $this->message = $data['message'];
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
    
    static function del($db, $get){
        $db->query('UPDATE notice SET active = 0 WHERE id = ?', $get['del']);
    }
     
    static function getnotice($db){
        $adv2 = $db->select("SELECT id AS ARRAY_KEY, name, title, price, id FROM notice WHERE active = 1 ORDER BY id LIMIT 30 ");
        
        foreach ($adv2 as $key=>$value) {
            $notice[$key] = new notice($value); 
        }
        
        return $notice;
    }
    
}


?>