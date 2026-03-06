<?php
    global $config,$tmpl; 
    $tmpl -> addScript('form');
    $tmpl -> addScript('contact','modules/contact/assets/js');
    $tmpl->addStylesheet('contact','modules/contact/assets/css'); 

    $Itemid = FSInput::get('Itemid',0);
    $contact_email = FSInput::get('contact_email');
    $contact_name = FSInput::get('contact_name');
    $contact_address = FSInput::get('contact_address');
    $contact_phone = FSInput::get('contact_phone');
    $contact_title = FSInput::get('contact_title');
    $message = htmlspecialchars_decode(FSInput::get('message'));
    $lang = FSInput::get('lang');
?>
<section>
    <div class="container tieude"> 
        <h2 class="breadcrum" style="text-transform: uppercase;">
            <?php echo FSText::_("Liên hệ")?>
        </h2>
        <p class="cc2">
            <a class="chuyenmuc1" href="<?php if ($lang == 'vi') {
                echo URL_ROOT;
            } else {
                echo URL_ROOT . 'en';
            } ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
            <a href="" class="cc1"><?php echo FSText::_("Liên hệ")?></a>
        </p>
</section>
<div class="contact-main row-item container">
<!--	<h3 class="title-module hidden">-->
<!--		<span>--><?php //echo FSText::_("Công ty cổ phần công nghệ và tư vấn CIC"); ?><!--</span>-->
<!--	</h3><!-- END: .name-contact-->

    <div class="row">
        <div class="col-md-6 col-xs-12">
             <?php  include_once 'default_info.php'; ?>
             <?php include_once 'default_from.php'; ?>
        </div>
        
        <div class="col-md-6 col-xs-12 map">
            <?php  foreach($address as $item){ ?>
                <?php echo html_entity_decode( $item->map);?>
            <?php } ?>
        </div>
        
    </div>
        <!--<div class="col-xs-12 col-sm-6"> 
	       <?php // include_once 'default_map.php';?>
	   </div><!-- END: .map -->
</div><!-- END: .contact -->
