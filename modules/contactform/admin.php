<?php
class admin_contactform extends Controller {
    function _index() {
        $this->meta['title'] = CONTACTS;
        global $model;
        LoadModel('contactform','contact_form');
        $this->data = $model->getAll(new contact_form(),'contakt_id','DESC');
        $this->view = 'admin.index';
    }

    function _view() {
        global $model;
        LoadModel('contactform','contact_form');

        $message = $model->getById(new contact_form(),$this->url[5]);
        $this->meta['title'] = $message->username." | ".CONTACTS;
        $this->data = $message;
        $this->view = 'admin.view';

        LoadModel('admin','menu');

        $ms = new menu();
        $ms->tag = 'a';
        $ms->href = MODULE_URL;
        $ms->class = 'btn btn-danger';
        $ms->value = '<span class="glyphicon glyphicon-arrow-left"></span>';

        $this->menu = array($ms);

        if ($message->view == 0) {
            $message->view = 1;
            $model->update($message);
        }
    }

    function _delete() {
        $this->template = false;
        global $model;
        LoadModel('contactform','contact_form');
        $message = $model->getById(new contact_form(),$this->url[5]);
        $model->delete($message);

        header("Location: ".MODULE_URL);
    }
}