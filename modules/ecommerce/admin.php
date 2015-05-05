<?php

class admin_ecommerce extends Controller
{
    private $small_width = 400;

    function _index()
    {
        $this->meta['title'] = ECOMMERCE;
        $this->view = 'admin.main';
    }

    function _brands()
    {
        $this->meta['title'] = BRANDS;
        LoadModel('admin', 'menu');
        $this->menu = array();
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL;
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'a';
        $ms->class = 'btn btn-warning';
        $ms->value = '<span class="glyphicon glyphicon-plus"></span>';
        $ms->title = NEW_BRAND;
        $ms->href = MODULE_URL . '/new_brand';
        array_push($this->menu, $ms);
        LoadModel('ecommerce', 'brands');
        global $model;
        $this->data = $model->getAll(new e_brands());
        $this->view = 'admin.brands';
    }

    function _new_brand()
    {
        $this->meta['title'] = NEW_BRAND;
        LoadModel('admin', 'menu');
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL . '/brands';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'button';
        $ms->value = SAVE;
        $ms->form = 'brand';
        $ms->class = 'btn btn-success';
        array_push($this->menu, $ms);
        $this->view = 'admin.new.brand';
    }

    function _brand_edit()
    {
        LoadModel('admin', 'menu');
        LoadModel('ecommerce', 'brands');
        global $model;
        $this->data = $model->getById(new e_brands(), $this->url[5]);
        $this->meta['title'] = $this->data->name;
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL . '/brands';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'button';
        $ms->value = SAVE;
        $ms->form = 'brand';
        $ms->class = 'btn btn-success';
        array_push($this->menu, $ms);
        $this->view = 'admin.edit.brand';
    }

    function _save_brand()
    {
        $this->template = false;
        LoadModel('ecommerce', 'brands');
        $brand = new e_brands();
        $brand->name = $_POST['name'];
        $brand->alias = $_POST['alias'];
        $brand->description = $_POST['description'];
        $_FILES['image']['type'] = strtolower($_FILES['image']['type']);
        if ($_FILES['image']['type'] == 'image/png'
            || $_FILES['image']['type'] == 'image/jpg'
            || $_FILES['image']['type'] == 'image/gif'
            || $_FILES['image']['type'] == 'image/jpeg'
            || $_FILES['image']['type'] == 'image/pjpeg'
        ) {
            $brand->image = md5(date('YmdHis')) . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], 'content/ecommerce/brands/' . $brand->image);

            $image = LoadPlugin('ImageResize');
            $size = getimagesize('content/ecommerce/brands/' . $brand->image);
            $pr = $size[0] / $size[1];
            $image->resize('content/ecommerce/brands/' . $brand->image, 'content/ecommerce/brands/small_' . $brand->image,
                $this->small_width, $this->small_width / $pr);
        }
        global $model;
        $model->save($brand);
        $url = MODULE_URL;
        header("Location: {$url}/brands");
    }

    function _update_brand()
    {
        $this->template = false;
        LoadModel('ecommerce', 'brands');
        global $model;
        $brand = $model->getById(new e_brands(), $_POST['id']);
        $brand->name = $_POST['name'];
        $brand->alias = $_POST['alias'];
        $brand->description = $_POST['description'];
        $_FILES['image']['type'] = strtolower($_FILES['image']['type']);
        if ($_FILES['image']['type'] == 'image/png'
            || $_FILES['image']['type'] == 'image/jpg'
            || $_FILES['image']['type'] == 'image/gif'
            || $_FILES['image']['type'] == 'image/jpeg'
            || $_FILES['image']['type'] == 'image/pjpeg'
        ) {
            if ($brand->image !== '') {
                unlink('content/ecommerce/brands/' . $brand->image);
                unlink('content/ecommerce/brands/small_' . $brand->image);
            }

            $brand->image = md5(date('YmdHis')) . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], 'content/ecommerce/brands/' . $brand->image);

            $image = LoadPlugin('ImageResize');
            $size = getimagesize('content/ecommerce/brands/' . $brand->image);
            $pr = $size[0] / $size[1];
            $image->resize('content/ecommerce/brands/' . $brand->image, 'content/ecommerce/brands/small_' . $brand->image,
                $this->small_width, $this->small_width / $pr);
        }
        $model->update($brand);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    function _brand_remove()
    {
        LoadModel('ecommerce', 'brands');
        global $model;
        $brand = $model->getById(new e_brands(), $this->url[5]);
        if ($brand->image !== '') {
            unlink('content/ecommerce/brands/' . $brand->image);
            unlink('content/ecommerce/brands/small_' . $brand->image);
        }
        $model->delete($brand);
        $url = MODULE_URL;
        header("Location: {$url}/brands");
    }

    function _categories()
    {
        $this->meta['title'] = CATEGORIES;
        LoadModel('admin', 'menu');
        $this->menu = array();
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL;
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'a';
        $ms->class = 'btn btn-warning';
        $ms->value = '<span class="glyphicon glyphicon-plus"></span>';
        $ms->title = NEW_BRAND;
        $ms->href = MODULE_URL . '/new_category';
        array_push($this->menu, $ms);
        LoadModel('ecommerce', 'categories');
        global $model;
        $this->data = $model->getAll(new e_categories());
        $this->view = 'admin.categories';
    }

    function _new_category()
    {
        $this->meta['title'] = NEW_CATEGORY;
        LoadModel('admin', 'menu');
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL . '/categories';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'button';
        $ms->value = SAVE;
        $ms->form = 'category';
        $ms->class = 'btn btn-success';
        array_push($this->menu, $ms);
        $this->view = 'admin.new.category';
    }

    function _category_edit()
    {
        LoadModel('admin', 'menu');
        LoadModel('ecommerce', 'categories');
        global $model;
        $this->data = $model->getById(new e_categories(), $this->url[5]);
        $this->meta['title'] = $this->data->name;
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL . '/categories';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'button';
        $ms->value = SAVE;
        $ms->form = 'category';
        $ms->class = 'btn btn-success';
        array_push($this->menu, $ms);
        $this->view = 'admin.edit.category';
    }

    function _save_category()
    {
        $this->template = false;
        LoadModel('ecommerce', 'categories');
        $category = new e_categories();
        $category->name = $_POST['name'];
        $category->alias = $_POST['alias'];
        $category->description = $_POST['description'];
        $_FILES['image']['type'] = strtolower($_FILES['image']['type']);
        if ($_FILES['image']['type'] == 'image/png'
            || $_FILES['image']['type'] == 'image/jpg'
            || $_FILES['image']['type'] == 'image/gif'
            || $_FILES['image']['type'] == 'image/jpeg'
            || $_FILES['image']['type'] == 'image/pjpeg'
        ) {
            $category->image = md5(date('YmdHis')) . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], 'content/ecommerce/categories/' . $category->image);

            $image = LoadPlugin('ImageResize');
            $size = getimagesize('content/ecommerce/categories/' . $category->image);
            $pr = $size[0] / $size[1];
            $image->resize('content/ecommerce/categories/' . $category->image, 'content/ecommerce/categories/small_' . $category->image,
                $this->small_width, $this->small_width / $pr);
        }
        global $model;
        $model->save($category);
        $url = MODULE_URL;
        header("Location: {$url}/categories");
    }

    function _update_category()
    {
        $this->template = false;
        LoadModel('ecommerce', 'categories');
        global $model;
        $category = $model->getById(new e_categories(), $_POST['id']);
        $category->name = $_POST['name'];
        $category->alias = $_POST['alias'];
        $category->description = $_POST['description'];
        $_FILES['image']['type'] = strtolower($_FILES['image']['type']);
        if ($_FILES['image']['type'] == 'image/png'
            || $_FILES['image']['type'] == 'image/jpg'
            || $_FILES['image']['type'] == 'image/gif'
            || $_FILES['image']['type'] == 'image/jpeg'
            || $_FILES['image']['type'] == 'image/pjpeg'
        ) {
            if ($category->image !== '') {
                unlink('content/ecommerce/categories/' . $category->image);
                unlink('content/ecommerce/categories/small_' . $category->image);
            }

            $category->image = md5(date('YmdHis')) . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], 'content/ecommerce/categories/' . $category->image);

            $image = LoadPlugin('ImageResize');
            $size = getimagesize('content/ecommerce/categories/' . $category->image);
            $pr = $size[0] / $size[1];
            $image->resize('content/ecommerce/categories/' . $category->image, 'content/ecommerce/categories/small_' . $category->image,
                $this->small_width, $this->small_width / $pr);
        }
        $model->update($category);
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    function _category_remove()
    {
        LoadModel('ecommerce', 'categories');
        global $model;
        $category = $model->getById(new e_categories(), $this->url[5]);
        if ($category->image !== '') {
            unlink('content/ecommerce/categories/' . $category->image);
            unlink('content/ecommerce/categories/small_' . $category->image);
        }
        $model->delete($category);
        $url = MODULE_URL;
        header("Location: {$url}/categories");
    }

    function _products()
    {
        $this->view = 'admin.products';
        $this->meta['title'] = PRODUCTS;
        LoadModel('admin', 'menu');
        $this->menu = array();
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL;
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'a';
        $ms->class = 'btn btn-warning';
        $ms->value = '<span class="glyphicon glyphicon-plus"></span>';
        $ms->title = NEW_BRAND;
        $ms->href = MODULE_URL . '/new_product';
        array_push($this->menu, $ms);

        global $model;
        LoadModel('ecommerce', 'products');
        LoadModel('ecommerce','categories');

        $this->data['products'] = $model->getByParam(
            new v_e_products_admin(),
            array(
                'language' => DEFAULT_LANGUAGE
            ),
            'id',
            'desc'
        );

        $this->data['categories'] = $model->getByParam(
            new v_e_categories(),
            array(
                'language' => DEFAULT_LANGUAGE
            ),
            'id',
            'desc'
        );

    }

    function _new_product()
    {
        global $model;
        LoadModel('admin', 'menu');
        LoadModel('ecommerce', 'categories');
        LoadModel('ecommerce', 'brands');
        LoadModel('admin','languages');

        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL . '/products';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'button';
        $ms->value = SAVE;
        $ms->form = 'product';
        $ms->class = 'btn btn-success';
        array_push($this->menu, $ms);


        $this->data['categories'] = $model->getByParam(
            new v_e_categories(),
            array(
                'language' => DEFAULT_LANGUAGE
            ),
            'id',
            'DESC',
            null,
            null,
            array(
                'id',
                'name'
            )
        );

        $this->data['brands'] = $model->getAll(new e_brands());
        $this->data['languages'] = $model->getAll(new languages());

        $this->view = 'admin.new.product';
        $this->meta['title'] = NEW_PRODUCT;
    }

    function _product_save()
    {
        global $model;
        LoadModel('ecommerce', 'products');
        LoadModel('admin', 'languages');

        $this->template = false;
        $product = new e_products();
        $product->alias = $_POST['alias'];
        $product->price = $_POST['price'];
        $product->category = $_POST['category'];
        $product->brand = $_POST['brand'];
        $product->keywords = $_POST['keywords'];
        $product->description = $_POST['description'];

        if ($_FILES['image']['type'] == 'image/png'
            || $_FILES['image']['type'] == 'image/jpg'
            || $_FILES['image']['type'] == 'image/gif'
            || $_FILES['image']['type'] == 'image/jpeg'
            || $_FILES['image']['type'] == 'image/pjpeg'
        ) {
            $product->image = md5(date('YmdHis')) . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], 'content/ecommerce/products/' . $product->image);

            $image = LoadPlugin('ImageResize');
            $size = getimagesize('content/ecommerce/products/' . $product->image);
            $pr = $size[0] / $size[1];
            $image->resize('content/ecommerce/products/' . $product->image, 'content/ecommerce/products/small_' . $product->image,
                600, 600/ $pr);
        }

        $model->save($product);
        $id = $model->getMaxId($product);

        $languages = $model->getAll(new languages());

        foreach($languages as $lang) {
            $det = new e_product_details();
            $det->content = $_POST['content_'.$lang->code];
            $det->title = $_POST['title_'.$lang->code];
            $det->language = $lang->code;
            $det->product = $id;

            $model->save($det);
        }

        header('Location: ' . MODULE_URL . '/product_edit/'.$id);
    }

    function _product_edit()
    {
        $this->view = 'admin.product.edit';
        global $model;
        LoadModel('ecommerce', 'products');
        LoadModel('admin', 'languages');
        $this->data['product'] = $model->getById(new e_products(), $this->url[5]);

        $languages = $model->getAll(new languages());
        $this->data['languages'] = $languages;

        foreach($languages as $lang) {
            $this->data[$lang->code] = $model->getRowByParam(
                new e_product_details(),
                array(
                    'language' => $lang->code,
                    'product' => $this->data['product']->_id
                )
            );
        }

        $this->meta['title'] = $this->data[DEFAULT_LANGUAGE]->title;

        LoadModel('admin', 'menu');
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL . '/products';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $ms = new menu();
        $ms->tag = 'button';
        $ms->value = SAVE;
        $ms->form = 'product';
        $ms->class = 'btn btn-success';
        array_push($this->menu, $ms);

        LoadModel('ecommerce', 'categories');
        LoadModel('ecommerce', 'brands');

        $this->data['categories'] = $model->getBYParam(
            new v_e_categories(),
            array(
                'language' => DEFAULT_LANGUAGE
            )
        );
        $this->data['brands'] = $model->getAll(new e_brands());
    }

    function _product_update()
    {
        $this->template = false;
        global $model;
        LoadModel('ecommerce', 'products');
        LoadModel('admin','languages');

        $this->template = false;

        $product = $model->getById(new e_products(), $_POST['id']);

        $product->alias = $_POST['alias'];
        $product->price = $_POST['price'];
        $product->category = $_POST['category'];
        $product->brand = $_POST['brand'];
        $product->keywords = $_POST['keywords'];
        $product->description = $_POST['description'];

        if ($_FILES['image']['type'] == 'image/png'
            || $_FILES['image']['type'] == 'image/jpg'
            || $_FILES['image']['type'] == 'image/gif'
            || $_FILES['image']['type'] == 'image/jpeg'
            || $_FILES['image']['type'] == 'image/pjpeg'
        ) {
            if (is_file('content/ecommerce/products/' . $product->image)) {
                unlink('content/ecommerce/products/' . $product->image);
                unlink('content/ecommerce/products/small_' . $product->image);
            }

            $product->image = md5(date('YmdHis')) . '.jpg';
            move_uploaded_file($_FILES['image']['tmp_name'], 'content/ecommerce/products/' . $product->image);

            $image = LoadPlugin('ImageResize');
            $size = getimagesize('content/ecommerce/products/' . $product->image);
            $pr = $size[0] / $size[1];
            $image->resize('content/ecommerce/products/' . $product->image, 'content/ecommerce/products/small_' . $product->image,
                600, 600/ $pr);
        }

        $languages = $model->getAll(
            new languages()
        );

        foreach($languages as $lang) {
            $det = $model->getRowByParam(
                new e_product_details(),
                array(
                    'language' => $lang->code,
                    'product' => $product->_id
                )
            );

            $det->content = $_POST['content_'.$lang->code];
            $det->title = $_POST['title_'.$lang->code];

            $model->update($det);
        }

        $model->update($product);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function _product_delete()
    {
        $this->template = false;
        global $model;
        LoadModel('ecommerce', 'products');
        LoadModel('admin', 'languages');
        $this->template = false;

        $product = $model->getById(new e_products(), $this->url[5]);

        $languages = $model->getAll(new languages());

        foreach($languages as $lang) {
            $det = $model->getRowByParam(
                new e_product_details(),
                array(
                    'language' => $lang->code,
                    'product' => $product->_id
                )
            );

            $model->delete($det);
        }

        if (is_file('content/ecommerce/products/' . $product->image)) {
            unlink('content/ecommerce/products/' . $product->image);
            unlink('content/ecommerce/products/small_' . $product->image);
        }
        $model->delete($product);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    function _orders()
    {
        LoadModel('admin','menu');
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL;
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        $this->meta['title'] = ORDERS;
        $this->view = 'admin.orders';
        global $model;
        LoadModel('ecommerce', 'orders');
        $this->data['new'] = $model->getByParam(new e_order(), array('status' => 'new'), 'id', 'DESC');
        $this->data['calculate'] = $model->getByParam(new e_order(), array('status' => 'calculate'), 'id', 'DESC');
        $this->data['calculated'] = $model->getByParam(new e_order(), array('status' => 'calculated'), 'id', 'DESC');
        $this->data['cancel'] = $model->getByParam(new e_order(), array('status' => 'cancel'), 'id', 'DESC');
    }

    function _order()
    {
        LoadModel('admin','menu');
        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL.'/orders';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';
        $ms->class = 'btn btn-danger';
        $this->menu = array($ms);
        global $model;

        $this->view = 'admin.order';
        LoadModel('ecommerce', 'orders');
        LoadModel('admin','user');
        $this->data['order'] = $model->getById(
            new e_order(),
            $this->url[5]
        );

        $this->meta['title'] = $this->data['order']->fio;

        $this->data['products'] = $model->getByParam(
            new v_e_order_products(),
            array(
                'order'=>$this->data['order']->_id,
                'language' => DEFAULT_LANGUAGE
            )
        );

        $this->data['delivery'] = $model->getRowByParam(
            new v_delivery(),
            array(
                'id' => $this->data['order']->delivery,
                'language' => DEFAULT_LANGUAGE
            )
        );

        if ($this->data['order']->status == 'new') {
            $this->data['order']->status = 'calculate';
            $model->update($this->data['order']);
        }
    }

    function _change_status() {
        $this->template = false;
        global $model;
        LoadModel('ecommerce','orders');
        $order = $model->getById(new e_order(),$_POST['id']);
        $order->status = $_POST['status'];
        $model->update($order);
    }

    function _order_delete() {
        $this->template = false;
        global $model;
        LoadModel('ecommerce','orders');
        $order = $model->getById(new e_order(),$this->url[5]);
        $sql = LoadPlugin('SafeMySQL');
        $sql->query("DELETE FROM e_order_products WHERE `order` = ?i",$order->_id);
        $model->delete($order);
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

}
