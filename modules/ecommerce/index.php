<?php

class c_ecommerce extends Controller
{
    function __construct()
    {
        if (!isset($_COOKIE['user_id']))
            setcookie('user_id', md5(microtime()), null, '/');
    }

    function _category()
    {
        global $model;
        LoadModel('ecommerce', 'products');
        LoadModel('ecommerce', 'categories');

        $category = $model->getRowByParam(
            new v_e_categories(),
            array(
                'alias' => $this->url[3],
                'language' => LANGUAGE
            )
        );
		
	
        $child_count = $model->getCount(
            new e_categories(),
            array(
                'parent' => $category->_id
            )
        );

        if ($child_count > 0) {
            $this->data['children'] = $model->getByParam(
                new v_e_categories(),
                array(
                    'language' => LANGUAGE,
                    'parent' => $category->_id
                )
            );

            $this->data['products'] = $model->getByParam(
                new v_e_products(),
                array(
                    'category' => $this->data['children'][0]->_id,
                    'language' => LANGUAGE
                ),
                'price',
                'DESC'
            );
        } else {
            $this->data['products'] = $model->getByParam(
                new v_e_products(),
                array(
                    'category' => $category->_id,
                    'language' => LANGUAGE
                ),
                'price',
                'DESC',
                null, null,
                array(
                    'id', 'title', 'price', 'image', 'content'
                )
            );
            if ($category->parent !== '0')
                $this->data['children'] = $model->getByParam(
                    new v_e_categories(),
                    array(
                        'language' => LANGUAGE,
                        'parent' => $category->parent
                    )
                );
        }

        $this->data['parents'] = $model->getByParam(
            new v_e_categories(),
            array(
                'parent' => 0,
                'language' => LANGUAGE
            )
        );

        $this->data['current_category'] = $category;

        $this->view = 'list';
        $this->meta['title'] = $category->name;
    }

    function _addtocart()
    {
        $info = array(
            'type' => 'insert',
            'product' => ''
        );

        $this->template = false;
        global $model;
        LoadModel('ecommerce', 'shopcart');
        LoadModel('ecommerce', 'products');

        $this->data = $model->getRowByParam(
            new v_e_products(),
            array(
                'language' => LANGUAGE,
                'id' => $_POST['id']
            )
        );

        $info['product'] = $this->data->title;

        $cart = $model->getRowByParam(
            new e_cart(),
            array(
                'u_id' => $_COOKIE['user_id'],
                'product' => $_POST['id']
            )
        );

        if (is_null($cart)) {
            $model->save(new e_cart());
        } else {
            $cart->count++;
            $info['type'] = 'update';
            $model->update($cart);
        }

        echo json_encode($info);
    }

    function _getcart()
    {
        global $model;
        $this->template = false;
        LoadModel('ecommerce', 'shopcart');
        $this->data = $model->getByParam(
            new v_cart(),
            array(
                'u_id' => $_COOKIE['user_id'],
                'language' => LANGUAGE
            ),
            'id',
            'desc'
        );

        LoadView('ecommerce', 'small_cart', $this->data);
    }

    function _shopcart()
    {
        $this->meta['title'] = SHOP_CART;
        $this->view = 'shopcart';
        global $model;
        LoadModel('ecommerce', 'shopcart');

        $this->data = $model->getByParam(
            new v_cart(),
            array(
                'u_id' => $_COOKIE['user_id'],
                'language' => LANGUAGE
            ),
            'id',
            'desc'
        );
    }

    function _updatecart()
    {
        $this->template = false;
        global $model;
        LoadModel('ecommerce', 'shopcart');
        $cart = $model->getById(new e_cart(), $_POST['id']);
        $cart->count = $_POST['count'];
        $model->update($cart);
    }

    function _removefromcart()
    {
        $this->template = false;
        global $model;
        LoadModel('ecommerce', 'shopcart');
        $cart = $model->getById(new e_cart(), $this->url[3]);
        $model->delete($cart);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function _checkout()
    {
        $this->meta['title'] = CHECK_OUT;
        $this->view = 'checkout';
        global $model;
        LoadModel('ecommerce', 'orders');
        $this->data = $model->getByParam(
            new v_delivery(),
            array(
                'language' => LANGUAGE
            )
        );
    }

    function _order()
    {
        global $model;
        LoadModel('ecommerce', 'orders');
        LoadModel('ecommerce', 'shopcart');

        if ($model->getCount(new e_cart(), array('u_id' => $_COOKIE['user_id'])) > 0 and (isset($_COOKIE['user_id'])) and $_POST['fio'] !== '') {
            $this->template = false;
            $order = new e_order();
            $order->fio = $_POST['fio'];
            $order->address = $_POST['address'];
            $order->email = $_POST['email'];
            $order->delivery = $_POST['delivery'];
            $order->description = $_POST['description'];
            $order->telephone = $_POST['telephone'];

            $order->total = 0;

            $products = $model->getByParam(
                new v_cart(),
                array(
                    'u_id' => $_COOKIE['user_id'],
                    'language' => LANGUAGE
                ),
                null, null,
                null, null,
                array(
                    'id', 'price', 'count', 'product'
                )
            );

            foreach ($products as $pr) {
                $order->total += $pr->price * $pr->count;
            }

            $model->save($order);
            $order->_id = $model->getMaxId($order);

            foreach ($products as $pr) {
                $p = new e_order_products();
                $p->order = $order->_id;
                $p->product = $pr->product;
                $p->count = $pr->count;
                $model->save($p);
            }
            mysql_query("DELETE FROM e_cart WHERE u_id = '{$_COOKIE['user_id']}'");



            LoadModel('admin', 'user');

            $delivery = $model->getById(new v_delivery(), $order->delivery);

            $subject = "Поступил новый заказ '".SITE_NAME."'";
            $headers  = "Content-type: text/html; charset=utf-8;";
            $message = '
            <h3>
			Поступил новый заказ "Chelsea Pub"
		</h3>
		<b>ФИО : </b>' . $_POST['name'] . '<br>
		<b>Номер телефона : </b>' . $_POST['telephone'] . '<br>
		<b>Email : </b>' . $_POST['email'] . '<br>
		<b>Способ доставки : </b>' . $delivery->name . '<br>
            ';

            $users = $model->getByParam(new users(), array('group_id' => 1));
            foreach ($users as $user) {
                $info = $model->getRowByParam(new user_info(), array('user_id' => $user->_user_id));

                if ($info->email !== '') {
                    echo mail($info->email, $subject, $message, $headers);
                }
            }

            header('Location: /ecommerce/success');
        } else {
            $this->view = 'empty_cart';
            $this->meta['title'] = CART_IS_EMPTY;
        }
    }

    function _success() {
        $this->view = 'success';
        $this->meta['title'] = SUCCESS;
    }
}