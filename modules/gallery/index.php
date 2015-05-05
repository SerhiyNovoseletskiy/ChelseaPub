<?php
class c_gallery extends  Controller {
    function _index() {
        if (!empty($this->url[2]))
            $this->album();
        else
            $this->index();
    }

    private function  album() {
        $this->view = 'album';
        global $model;
        LoadModel('gallery','album');
        LoadModel('gallery','gallery');

        $album = $model->getRowByParam(
            new gallery_album(),
            array(
                'alias' => $this->url[2]
            )
        );

        $this->meta['title'] = $album->title;
        $this->data = $model->getByParam(
            new gallery(),
            array(
                'album_id' => $album->_id
            )
        );
    }

    private function index() {
        $this->view = 'index';
        $this->meta['title'] = GALLERY;

        global $model;
        LoadModel('gallery','album');
        LoadModel('gallery','gallery');

        $this->data['albums'] = $model->getAll(new gallery_album());

        foreach($this->data['albums'] as $al)
            $this->data['photo_'.$al->_id] = $model->getRowByParam(
                new gallery(),
                array(
                    'album_id' => $al->_id
                )
            );
    }
}