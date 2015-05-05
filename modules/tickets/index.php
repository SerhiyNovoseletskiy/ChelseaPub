<?php

class c_tickets extends Controller
{
    function _get_ticket()
    {
        $this->template = false;
        global $model;
        LoadModel('tickets', 'ticket');
        LoadModel('admin', 'user');

        $ticket = new tickets();
        $ticket->fio = $_POST['fio'];
        $ticket->email = $_POST['email'];
        $ticket->telephone = $_POST['tel'];
        $ticket->date = $_POST['date'];
        $model->save($ticket);

        $id = $model->getMaxId($ticket);

        $body = '
		<h3>
			Куплен новый билет "Chelsea Pub"
		</h3>
		<b>ФИО : </b>' . $_POST['fio'] . '<br>
		<b>Номер телефона : </b>' . $_POST['tel'] . '<br>
		<b>Email : </b>' . $_POST['email'] . '<br>
		<b>Дата рождения : </b>' . $_POST['date'] . '<br>
	';

        $users = $model->getByParam(new users(), array('group_id' => 1));
        foreach ($users as $user) {
            $info = $model->getRowByParam(new user_info(), array('user_id' => $user->_user_id));
            if ($info->email !== '') {
                $to = $info->email;
                $subject = "Куплен новый билет Chelsea Pub";
                $headers = "Content-type: text/html; charset=utf-8;";
                mail($to, $subject, $body, $headers);
            }
        }

        $body = '
		<h3>Держите свой билет</h3>
		<img src = "http://chelsea-pub.com/tickets/image/' . $id . '" style = "width: 100%;"/>
	';
        mail($_POST['email'], 'Держите свой билет Chelsea Pub', $body, $headers);
        header('Location: /tickets/success/'.$id);
    }

    function _success() {
        $this->view = 'success';
        $this->data = $this->url[3];
        $this->meta['title'] = SITE_NAME;
    }

    function _image() {
        $this->template = false;
        $img = ImageCreateFromJPEG('modules/tickets/image.jpg');
        global $model;
        LoadModel('tickets','ticket');
        $ticket = $model->getById(new tickets(), $this->url[3]);
        $color = imagecolorallocate($img, 0, 0, 0);
        $font = 'modules/tickets/arial.ttf';
        imagettftext($img, 37, 0, 650, 720, $color, $font, $ticket->fio);
        header('Content-type: image/jpeg');
        imagejpeg($img, NULL, 100);
    }
}