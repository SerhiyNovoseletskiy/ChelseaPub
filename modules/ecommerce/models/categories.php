<?php
class e_categories {
    public $_id;
    public $alias;
    public $parent;
}

class e_category_details {
    public $_id;
    public $name;
    public $language;
    public $category;
}

class v_e_categories extends e_categories {
    public $name;
    public $language;
}