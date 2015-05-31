<?php
//основной класс, имеет только общие свойства для всех объяв
class AdShort {
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




?>