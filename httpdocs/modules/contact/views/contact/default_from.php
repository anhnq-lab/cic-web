<?php
$return = $_SERVER['REQUEST_URI'];
// $return = base64_encode($url);
?>
<div class="contact_form row-item">
    <form method="post" action="index.php?module=contact&view=contact&task=save" name="contact" class="form"
          enctype="multipart/form-data">
        <div class="form1 row">
            <div class="item1 col-md-6 col-sm-6 col-xs-12">
                <input type="text" maxlength="255" name="fullname" id="fullname" class="form-control"
                       placeholder="<?php echo FSText::_("Tên đầy đủ"); ?>" required/>
            </div>
            <div class="item1 col-md-6 col-sm-6 col-xs-12">
                <input type="text" maxlength="255" name="address" id="address"
                       class="form-control" placeholder="<?php echo FSText::_("Địa chỉ"); ?>" required/>
            </div>
            <div class="item1 col-md-6 col-sm-6 col-xs-12">
                <input type="email" maxlength="255" name="email" id="email"
                       class="form-control" placeholder="<?php echo FSText::_("Email"); ?>" required/>
            </div>
            <div class="item1 col-md-6 col-sm-6 col-xs-12">
                <input type="tel" maxlength="255" name="telephone" id="telephone" class="form-control"
                       placeholder="<?php echo FSText::_("Điện thoại"); ?>" required/>
            </div>
            <div class="item1 col-md-12">
                <input type="text" maxlength="255" name="title" id="title"
                       class="form-control" placeholder="<?php echo FSText::_("Tiêu đề"); ?>" required/>
            </div>
        </div>
        <textarea type="text" rows="6" cols="30" name='message' id='message'
                  placeholder="<?php echo FSText::_("Nội dung"); ?>"></textarea>
        <div class="row-item xacthuc">
            <span>
                <input class="form-control txtCaptcha fl-left" placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                       type="text" id="txtCaptcha" value="" name="txtCaptcha" size="5" required/>
                <a href="javascript:changeCaptcha();" title="Click here to change the captcha"
                   class="code-view fl-left">
                    <img id="imgCaptcha" class="fl-left"
                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php" required alt="captcha"/>
<!--                    <i class="fa fa-sync"></i>-->
                    <img src="<?php echo URL_ROOT.'modules/contact/assets/images/lienhe.png' ?>" alt="captcha" class="img_capcha">
                </a>
            </span>
            <button class="button fl-left submitbt"><?php echo FSText::_('Gửi liên hệ'); ?></button>
        </div>

        <input type="hidden" name='return' value='<?php echo $return; ?>'/>
        <input type="hidden" name="module" value="contact"/>
        <input type="hidden" name="task" value="save"/>
        <input type="hidden" name="view" value="contact"/>
        <input type="hidden" name="Itemid" value="<?php echo $Itemid; ?>"/>
    </form>
    <!--	end FORM				-->
    <div class="clear"></div>
</div>