<?php
define("DB_HOST", 'localhost');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB", 'chelseapub');

define("SITE_NAME", 'Chelsea Pub');
define("APP_VERSION", 0.2);
define("DEFAULT_LANGUAGE", 'ru');

if (!isset($_COOKIE['language']))
    define('LANGUAGE', 'ua');
else
    define('LANGUAGE', $_COOKIE['language']);

define('TEMPLATE', 'chelseapub');
define('DEBUG',true);