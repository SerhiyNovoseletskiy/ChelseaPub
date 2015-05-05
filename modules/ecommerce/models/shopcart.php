<?php
class e_cart {
    public $_id;
    public $u_id;
    public $product;
    public $count;
    public $time;

    function __construct() {
        $this->time = time();
        $this->u_id = $_COOKIE['user_id'];
        $this->count = 1;
        $this->product = $_POST['id'];
    }
}

class v_cart extends e_cart {
    public $title;
    public $alias;
    public $price;
    public $image;
    public $language;
}