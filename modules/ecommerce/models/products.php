<?php
class e_products {
    public $_id;
    public $alias;
    public $category;
    public $brand;
    public $price;
    public $image;
    public $keywords;
    public $description;
}

class e_product_details {
    public $_id;
    public $title;
    public $language;
    public $content;
    public $product;
}

class v_e_products {
    public $_id;
    public $title;
    public $alias;
    public $image;
    public $price;
    public $keywords;
    public $description;
    public $brand;
    public $category;
    public $content;
    public $language;
}

class v_e_products_admin extends v_e_products {
    public $category_name;
    public $brand_name;
}