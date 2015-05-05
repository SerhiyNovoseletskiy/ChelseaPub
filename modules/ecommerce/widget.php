<?php
class widget_new_order  extends Widget{
    function _index() {
        $this->view = 'widget.new.orders';
        global $model;
        LoadModel('ecommerce','orders');
        $this->data = $model->getByParam(new e_order(), array('status'=>'new'));
    }
}