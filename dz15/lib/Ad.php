<?php
//расширенный класс, имеет дополнительные свойства объяв
class Ad extends AdShort {
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
    
    function getobjectvars(){
        return get_object_vars($this);
    }
           
}

?>