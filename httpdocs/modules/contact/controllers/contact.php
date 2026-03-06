<?php
/*
 * Huy write
 */
// controller

class ContactControllersContact extends FSControllers
{

    function display()
    {
        $model = $this->model;

        $submitbt = FSInput::get('submitbt');
        $msg = '';
        $address = $model->get_address_list();

        $array_breadcrumb[] = array(0 => array('name' => FSText::_('Contact'), 'link' => '', 'selected' => 0));
        // breadcrumbs
        $breadcrumbs = array();
        $breadcrumbs [] = array(0 => FSText::_('Liên hệ'), 1 => '');
        global $tmpl;
        $tmpl->assign('breadcrumbs', $breadcrumbs);
        $tmpl->set_seo_special();
        // call views
        include 'modules/' . $this->module . '/views/' . $this->view . '/' . 'default.php';
    }

    /*
     * save contact
     */
    function save()
    {
        // echo "1";die;
        $model = $this->model;

        if ($this->check_captcha() == false) {
            $link = FSRoute::_("index.php?module=contact&Itemid=14");
            $msg = FSText::_("Bạn đã nhập sai mã capcha. ");
            setRedirect($link, $msg);
        }
        $id = $model->save();
        $link = FSRoute::_("index.php?module=contact&Itemid=14");
        if ($id) {
            $this->save_dskh();
            $msg = FSText::_(" Cám ơn bạn đã liên lạc với chúng tôi. ");
            setRedirect($link, $msg);
        } else {
            $msg = FSText::_(" Chưa thêm vào liên hệ. ");
            setRedirect($link, $msg);
        }
    }

//		========================================================================================================================================
    function save_dskh()
    {
        // http://dskh.cic.com.vn/addcustomer.php?Name=Ho%C3%A0ng%20H%C3%A0&Company=C%C3%B4ng%20ty&Address=%C4%90%E1%BB%8Ba%20ch%E1%BB%89&City=Th%C3%A0nh%20ph%E1%BB%91&Email=hoangha@cic.com.vn&Mobile=0987654321&Comment=Ghi%20ch%C3%BA%20ghi%20ch%C3%BA
        $contact_fullname = FSInput::get('fullname');
        $address = FSInput::get('address');
        $contact_telephone = FSInput::get('telephone');
        $contact_email = FSInput::get('email');
        $title = FSInput::get('title');
        $content = htmlspecialchars_decode(FSInput::get('message'));

        $param = 'Name=' . $contact_fullname . '&Address=' . $address . '&Email=' . $contact_email . '&Mobile=' . $contact_telephone . '&Comment=' . $content;
        $param = str_replace(" ", "%20", $param);

        $url = 'https://dskh.cic.com.vn/addcustomer.php?' . $param;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
    }

    function save_dskh2()
    {
        if (!isset($_POST['name']) || !isset($_POST['company'])  || !isset($_POST['city']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['software'])) {
            echo 'invalid';
        }
        // http://dskh.cic.com.vn/addcustomer.php?Name=Ho%C3%A0ng%20H%C3%A0&Company=C%C3%B4ng%20ty&Address=%C4%90%E1%BB%8Ba%20ch%E1%BB%89&City=Th%C3%A0nh%20ph%E1%BB%91&Email=hoangha@cic.com.vn&Mobile=0987654321&Comment=Ghi%20ch%C3%BA%20ghi%20ch%C3%BA
        $name = $_POST['name'];
        $company = $_POST['company'];
        $address = !isset($_POST['address']) ?  $_POST['address'] : "";
        $city = $_POST['city'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $soffware = $_POST['software'];
        $message = htmlspecialchars_decode(isset($_POST['message']) ? $_POST['message'] : "");

        $param = 'Name=' . $name . '&Company='.$company .'&Address=' .$address . '&City='.$city. '&Email=' . $email . '&Mobile=' . $phone . '&Comment=' . $message.'&Software='.$soffware;
        $param = str_replace(" ", "%20", $param);

        $url = 'https://dskh.cic.com.vn/addcustomer.php?' . $param;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        echo($url);
    }
    //==========================================================================================================

    // function sendmail
    function send_mail($sender_name = '', $sender_email = '', $data_html = '')
    {
        include 'libraries/errors.php';
        // send Mail()
        $model = $this->model;
        $global = new FsGlobal();
        $mailer = FSFactory::getClass('Email', 'mail');
        $mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        // sender
        $sender_title = FSInput::get('contact_title');

        // Recipient
//						echo 1;die;
        $to = $global->getConfig('admin_email');
//				var_dump($to);die;

        $site_name = $global->getConfig('site_name');
//				var_dump($site_name);die;
        $ip = $_SERVER['REMOTE_ADDR'];
        global $config;
        $subject = ' -  Contact from customer';

        $contact_fullname = FSInput::get('contact_name');
        $address = FSInput::get('contact_address');
        $contact_telephone = FSInput::get('contact_phone');
        $contact_email = FSInput::get('contact_email');
        $title = FSInput::get('contact_tieude');
//                $message = FSInput::get('contact_message');

//				$fax = FSInput::get('contact_fax');
        $content = htmlspecialchars_decode(FSInput::get('contact_message'));
//				var_dump($content);die;

        $mailer->isHTML(true);
        $mailer->setSender(array($sender_email, $sender_name));
        $mailer->AddAddress($to, 'admin');

        //$mailer -> AddCC('tuananh@finalstyle.com','Phạm tuấn Anh');
        $mailer->setSubject('' . html_entity_decode($site_name) . ' ' . $subject . '(IP: ' . $ip . ')');
        // body

        $body = '';
        $body .= '<p align="left"><strong>' . FSText::_('Full name') . ': </strong> ' . $contact_fullname . '</p>';
        $body .= '<p align="left"><strong>' . FSText::_('Email') . ': </strong> ' . $contact_email . '</p>';
//				$body .= '<p align="left"><strong>Điện thoại : </strong> '.$fax.'</p>';
        $body .= '<p align="left"><strong>' . FSText::_('Phone') . ': </strong> ' . $contact_telephone . '</p>';
        //$body .= '<p align="left"><strong>Title : </strong> '.$contact_title.'</p>';
        $body .= '<p align="left"><strong>' . FSText::_('Địa chỉ') . ': </strong> ' . $address . '</p>';
        $body .= '<p align="left"><strong>' . FSText::_('Tiêu đề') . ': </strong> ' . $title . '</p>';
        $body .= '<p align="left"><strong>' . FSText::_('Content') . ': </strong> ' . $content . '</p>';
//                if($data_html){
//                    $data_html .= $quantity? FSText::_('Số lượng').' '.$quantity:'';
//                    $body .= '<div align="left"><strong>'.FSText::_('Tôi muốn đặt hàng sản phẩm').': </strong> '.$data_html.'</div>';
//				}
//				$body .= '<p align="left"><strong>Started work time: </strong> '.$date_work .' '.$hour_work.':'.$minute_work.'</p>';
//				$body .= $message;
        $mailer->setBody($body);
        if (!$mailer->Send())
            return false;
        return true;
    }

    /*
     * function check Captcha
     */
    function check_captcha()
    {
        $captcha = FSInput::get('txtCaptcha');

        if ($captcha == $_SESSION["security_code"]) {
            return true;
        } else {
        }
        return false;
    }
    //	function map(){
//			$model = new ContactModelsContact();
//			$google_map = $model -> get_address_current();
//			$str_des = '';
//			$str_des .= '<center>';
//            $str_des .= '    	<h3>'.@$google_map -> name. '</h3>';
//            $str_des .= '    	<p><strong>Add: </strong>'.@$google_map -> address. '</p>';
//            $str_des .= '    	<p><strong>Telephone: </strong>'.@$google_map -> phone. '</p>';
//            $str_des .= '    	</center>';
//            include 'modules/'.$this->module.'/views/'.$this->view.'/'.'map.php';
//		}
    function map()
    {
        $model = new ContactModelsContact();
        $list = $model->get_address_current();
        $data = array(
            'error' => true,
            'message' => '',
            'html' => ''
        );
        //<p><strong>Địa chỉ: </strong>'.$list -> address. '</p>
        $data['html'] .= '  
                                <h3>' . $list->name . '</h3>
                            ';

        $data['error'] = false;
        echo json_encode($data);
    }
}

?>