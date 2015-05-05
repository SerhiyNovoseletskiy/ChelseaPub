<?php
class c_sitemap extends Controller {
    function _index() {
        $this->template = false;
        global $model;
        LoadModel('admin','languages');
        LoadModel('blog','blog');
        LoadModel('page','page');

        $this->data['languages'] = $model->getAll(new languages());
        $this->data['articles'] = $model->getAll(new v_blog());
        $this->data['pages'] = $model->getAll(new v_page());
        LoadView('sitemap','index',$this->data);
    }
}