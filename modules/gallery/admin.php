<?php
class admin_gallery extends Controller {
    function _index() {
        $this->view = 'admin.index';
        $this->meta['title'] = GALLERY;
        global $model;
        LoadModel('admin','menu');
        LoadModel('gallery','album');

        $this->data = $model->getAll(new gallery_album());
    }

    function _upload() {
        $this->view = 'admin.upload';
        $this->meta['title'] = UPLOAD;

        global $model;
        LoadModel('admin','menu');
        LoadModel('gallery', 'gallery');

        $menu = new menu();
        $menu->tag = 'a';
        $menu->href = MODULE_URL;
        $menu->class = 'btn btn-danger';
        $menu->value = '<span class="glyphicon glyphicon-circle-arrow-left"></span>';
        $this->menu = array($menu);

        $this->data['album'] = $this->url[5];
        $this->data['images'] = $model->getByParam(
            new gallery(),
            array(
                'album_id' => $this->url[5]
            )
        );
    }
}