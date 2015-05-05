<?php
class c_contactform extends Controller {
    function _index() {
        $this->meta['title'] = CONTACTS;
    }

    function _send() {
        $this->template = false;
        LoadModel('contactform','contact_form');

        $form = new contact_form();
        $form->email = $_POST['email'];
        $form->message = $_POST['message'];
        $form->username = $_POST['name'];
        $form->telephone = $_POST['telephone'];

        global $model;
        $model->save($form);

        header("Location: /contactform/success");
    }

    function _success()
    {
        $this->meta['title'] = CONTACT_FORM_SUCCESS;
        $this->view = 'success';
    }
}