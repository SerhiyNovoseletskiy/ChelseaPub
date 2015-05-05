<?php
class contact_form {
    public $_contakt_id;
    public $username;
    public $email;
    public $telephone;
    public $message;
    public $view = 0;
    public $time;

    function __construct() {
        $this->time = time();
    }
}