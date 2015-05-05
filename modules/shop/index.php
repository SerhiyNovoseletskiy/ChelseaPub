<?php
class c_shop extends Controller {
    function _index() {
        header('Location: /ecommerce');
    }

    function _category(){
        header('Location: /ecommerce/category/'.$this->url[3]);
    }
}