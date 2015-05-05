<?php
require_once 'languages/'.LANGUAGE.'.common.php';
$menu = array(
    'class' => 'sf-menu',
    'id' => 'menu-main-navigation',
    'active_class' => 'current-menu-item',

    'ua' => array(
        array(
            'link' => '/',
            'title' => 'Головна',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '#',
            'title' => 'Меню',
            'class' => 'sf-with-ul',
            'child_class' => 'sub_menu',
            'children' => array(
                array(
                    'link' => '/ecommerce/category/Bar',
                    'title' => 'Бар',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/Kyhnya',
                    'title' => 'Кухня',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/futshet',
                    'title' => 'Фуршет',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/dopolnitel-nye-uslugi',
                    'title' => 'Додаткові послуги',
                    'class' => null,
                    'children' => null
                )
            )
        ),

        array(
            'link' => '#',
            'title' => 'Блог',
            'class' => 'sf-with-ul',
            'child_class' => 'sub-menu',
            'children' => array(
                array(
                    'link' => '/blog/rubrick/afisha',
                    'title' => 'Афіша',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/actsii',
                    'title' => 'Акції',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/news',
                    'title' => 'Новини',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/video',
                    'title' => 'Відео',
                    'class' => null,
                    'children' => null
                )
            )
        ),

        array(
            'link' => '/gallery',
            'title' => 'Галерея',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '/tickets',
            'title' => 'Купити квиток',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '/contacts',
            'title' => 'Контактна інформація',
            'class' => null,
            'children' => null
        ),
    ),
    'ru' => array(
        array(
            'link' => '/',
            'title' => 'Главная',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '#',
            'title' => 'Меню',
            'class' => 'sf-with-ul',
            'child_class' => 'sub_menu',
            'children' => array(
                array(
                    'link' => '/ecommerce/category/Bar',
                    'title' => 'Бар',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/Kyhnya',
                    'title' => 'Кухня',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/futshet',
                    'title' => 'Фуршет',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/dopolnitel-nye-uslugi',
                    'title' => 'Дополнительные услуги',
                    'class' => null,
                    'children' => null
                )
            )
        ),

        array(
            'link' => '#',
            'title' => 'Блог',
            'class' => 'sf-with-ul',
            'child_class' => 'sub-menu',
            'children' => array(
                array(
                    'link' => '/blog/rubrick/afisha',
                    'title' => 'Афиша',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/actsii',
                    'title' => 'Акции',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/news',
                    'title' => 'Новости',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/video',
                    'title' => 'Видео',
                    'class' => null,
                    'children' => null
                )
            )
        ),

        array(
            'link' => '/gallery',
            'title' => 'Галерея',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '/tickets',
            'title' => 'Купить билет',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '/contacts',
            'title' => 'Контактная информация',
            'class' => null,
            'children' => null
        ),
    ),

    'en' => array(
        array(
            'link' => '/',
            'title' => 'Main',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '#',
            'title' => 'Menu',
            'class' => 'sf-with-ul',
            'child_class' => 'sub_menu',
            'children' => array(
                array(
                    'link' => '/ecommerce/category/Bar',
                    'title' => 'Bar',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/Kyhnya',
                    'title' => 'Kitchen',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/futshet',
                    'title' => 'Cocktail',
                    'class' => null,
                    'children' => null
                ),
                array(
                    'link' => '/ecommerce/category/dopolnitel-nye-uslugi',
                    'title' => 'Additional Services',
                    'class' => null,
                    'children' => null
                )
            )
        ),

        array(
            'link' => '#',
            'title' => 'Blog',
            'class' => 'sf-with-ul',
            'child_class' => 'sub-menu',
            'children' => array(
                array(
                    'link' => '/blog/rubrick/afisha',
                    'title' => 'Poster',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/actsii',
                    'title' => 'Actions',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/news',
                    'title' => 'News',
                    'class' => null,
                    'children' => null
                ),

                array(
                    'link' => '/blog/rubrick/video',
                    'title' => 'Videos',
                    'class' => null,
                    'children' => null
                )
            )
        ),
        array(
            'link' => '/gallery',
            'title' => 'Gallery',
            'class' => null,
            'children' => null
        ),
        array(
            'link' => '/tickets',
            'title' => 'Buy a ticket',
            'class' => null,
            'children' => null
        ),

        array(
            'link' => '/contacts',
            'title' => 'Contacts',
            'class' => null,
            'children' => null
        ),
    )
);

$url = explode('/', $_SERVER['REQUEST_URI']);
switch ($url[1]) {
    case null: {
            global $model;
            LoadModel('blog','blog');
            $articles = $model->getByParam(
                new v_blog(),
                array(
                    'rubrick' => 1,
                    'language' => LANGUAGE
                ),
                'id',
                'desc',
                '5',
                null,
                array(
                    'title', 'alias', 'image'
                )
            );
            require_once 'inc/index.html';
    }
        break;

    default:
        require_once 'inc/blank.html';
        break;
}