<?php
class e_order {
    public $_id;
    public $fio;
    public $email;
    public $telephone;
    public $address;
    public $delivery;
    public $status;
    public $time;
    public $total;
    public $description;

    function __construct(){
        $this->time = time();
        $this->status = 'new';
    }
}

class e_order_products{
    public $_id;
    public $order;
    public $product;
    public $count;
}

class v_delivery {
    public $_id;
    public $name;
    public $language;
}

class v_e_order_products {
    public $_id;
    public $title;
    public $price;
    public $order;
    public $language;
    public $count;
}