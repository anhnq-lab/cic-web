<?php
global $tmpl, $config;
$total_relative = count(@$relate_products_list);
$tmpl->addStylesheet('sanphamchitiet', 'modules/products/assets/css');
$Itemid = 6;
$noWord = 80;
$url = $_SERVER['REQUEST_URI'];
$return = base64_encode($url);
FSFactory::include_class('FSString');

$tmpl->addScript('product', 'modules/products/assets/js');
$return = $_SERVER['REQUEST_URI'];
// $return = base64_encode($url);
$lang = FSInput::get('lang');
// print_r($lang);die;
?>

<input type="hidden" id="alert_info" value='<?php echo json_encode($alert_info) ?>'/>

<section>
    <!--    --><?php //echo $tmpl->load_direct_blocks('onlinesupport', array('style' => 'default')); ?>

    <div class="container body">
        <p class="breadcrum"><?php echo $products_content->code; ?></p>
        <div class="bbb">
            <a href="<?php if ($lang == 'vi') {
                echo URL_ROOT;
            } else {
                echo URL_ROOT . 'en';
            } ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
            <a href="<?php echo FSRoute::_("index.php?module=products&view=home"); ?>"><?php echo FSText::_("Sản phẩm") ?>
                ></a>
            <!--            <a href="">--><?php //echo $products_content->category_name; ?><!--</a>-->
            <a href=""><?php echo $products_content->code; ?></a>
        </div>
        <div class="infor row cot">
            <div class="col-xs-12 col-sm-6 col-md-5 hang">
                <?php
                include('images/lightslider.php');
                ?>
                <!-- <img src="<?php echo $products_content->image; ?>"> -->
            </div>
            <div class="col-xs-12 col-sm-6 col-md-7 hang">
                <h1 class="ten"><?php echo $products_content->name; ?></h1>
                <strong class="gia"><?php echo FSText::_("Giá") ?>: <span
                            style="color: #e11428"><?php if ($products_content->price) {
                            echo $products_content->price;
                        } else {
                            echo 'Liên hệ';
                        } ?></span></strong>
                <div class="tinhnang">
                    <strong><?php echo FSText::_("Giới thiệu") ?>:</strong>
                </div>
                <div class="content">
                    <p><?php echo getWord(45, $products_content->summary); ?></p>
                </div>
                <div class="lienhe">
                    <a href="" type="button" class="btn btn-info btn-lg" data-toggle="modal"
                       data-target="#myModal_pd_lh<?php echo $products_content->id; ?>"><?php echo FSText::_("Liên hệ"); ?></a>
                    <div class="modal fade" id="myModal_pd_lh<?php echo $products_content->id; ?>" role="dialog">
                        <div class="modal-dialog size">
                            <div class="modal-content size1">
                                <div class="header-modal">
                                    <div class="modal-header row">
                                        <div class="col-xs-10 col-sm-10 col-md-9">
                                            <h4 class="modal-title"><?php echo FSText::_("Liên hệ sản phẩm") ?></h4>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                            <button type="button" class="close"
                                                    data-modal-id="myModal_pd_lh<?php echo $products_content->id; ?>"
                                                    onclick="closeModal(this)">&times;</button>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" role="form" method="post" id="form_pd_lh<?php echo $products_content->id; ?>">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name_pdlh<?php echo $products_content->id; ?>" name="name"
                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*"
                                                    >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="company_pdlh<?php echo $products_content->id; ?>" name="company"
                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="address_pdlh<?php echo $products_content->id; ?>" name="address"
                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select class="form-control" name='city' id="city_pdlh<?php echo $products_content->id; ?>">
                                                        <option value=""><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                            *
                                                        </option>
                                                        <?php
                                                        foreach ($city as $key) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" id="email_pdlh<?php echo $products_content->id; ?>"
                                                           name="email" placeholder="<?php echo FSText::_("Email") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="tel" class="form-control" id="phone_pdlh<?php echo $products_content->id; ?>" name="phone"
                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message_pdlh<?php echo $products_content->id; ?>"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="check_capcha">
                                                <input class="form-control txtCaptcha fl-left"
                                                       placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                       type="text" id="txtCaptcha_pdlh<?php echo $products_content->id; ?>" value="" name="txtCaptcha" size="5"
                                                       required/>
                                                <a href="javascript:void (0);"
                                                   onclick="changeCaptcha2(this)"
                                                   data-url="<?php echo URL_ROOT ?>"
                                                   title="Click here to change the captcha"
                                                   class="code-view fl-left">
                                                    <img class="fl-left imgCaptcha"
                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                         alt="captcha"/>
                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                    <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                         alt="captcha" class="img_capcha">
                                                </a>
                                            </div>
                                            <div class="form-group  md_ft">
                                                <div class="col-md-8 col-sm-12 notemd">
                                                    <p class="note12">*Vui lòng điền đúng thông tin, chúng tôi sẽ liên
                                                        hệ qua email của bạn</p>
                                                </div>
                                                <div class="col-md-4 col-sm-12 sbm">
                                                    <a href="javascript:void(0)"
                                                       type="button"
                                                       title="GỬI"
                                                       data-id="<?php echo $products_content->id; ?>"
                                                       data-modal-id="myModal_pd_lh<?php echo $products_content->id; ?>"
                                                       data-type="pdlh"
                                                       data-form-id="form_pd_lh<?php echo $products_content->id; ?>"
                                                       data-base-url="<?php echo URL_ROOT ?>"
                                                       data-lang="<?php echo $lang ?>"
                                                       onclick="submitForm(this)"
                                                       class="btn btn-info send"
                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                </div>
                                            </div>
                                            <input type="hidden" name='module'
                                                   value='products'/>
                                            <input type="hidden" name='view'
                                                   value='product'/>
                                            <input type="hidden" name='task'
                                                   value='save'/>
                                            <input type="hidden" name='id'
                                                   value='<?php echo $products_content->id; ?>'/>
                                            <input type="hidden" name='alias'
                                                   value='<?php echo $products_content->alias; ?>'/>
                                            <input type="hidden" name='products_name'
                                                   id="products_name_pdlh<?php echo $products_content->id; ?>"
                                                   value='<?php echo $products_content->name; ?>'/>
                                            <input type="hidden" name='type' value='liên hệ sản phẩm'/>
                                            <input type="hidden" name='return'
                                                   value='<?php echo $return; ?>'/>
                                            <!--                                            <input type="hidden" name='module' value='products'/>-->
                                            <!--                                            <input type="hidden" name='view' value='product'/>-->
                                            <!--                                            <input type="hidden" name='task' value='save'/>-->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($products_content->file_download1 or $products_content->link_download1 or $products_content->link_download2 or $products_content->file_download2 or $products_content->link_download3 or $products_content->file_download3 or $products_content->link_download4 or $products_content->file_download4 or $products_content->link_download5 or $products_content->file_download5 or $products_content->link_download6 or $products_content->file_download6) { ?>
                    <div class="download">
                        <!-- <a href="" type="button" class="btn btn-success">Download</a> -->
                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                           data-target="#myModaldownload_pd_dl<?php echo $products_content->id; ?>"><?php echo FSText::_("Download") ?></a>
                        <div class="modal fade" id="myModaldownload_pd_dl<?php echo $products_content->id; ?>" role="dialog">
                            <div class="modal-dialog size">
                                <div class="modal-content size1">
                                    <div class="header-modal">
                                        <div class="modal-header row">
                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                <button type="button" class="close"
                                                        data-modal-id="myModaldownload_pd_dl<?php echo $products_content->id; ?>"
                                                        onclick="closeModal(this)">&times;</button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" method="post" name="contact1112"
                                                  id="form_pd_dl<?php echo $products_content->id; ?>">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name_pddl<?php echo $products_content->id; ?>" name="name"
                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="company_pddl<?php echo $products_content->id; ?>" name="company"
                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="address_pddl<?php echo $products_content->id; ?>" name="address"
                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='city' id="city_pddl<?php echo $products_content->id; ?>">
                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            foreach ($city as $key) {
                                                                # code...
                                                                ?>
                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email_pddl<?php echo $products_content->id; ?>"
                                                               name="email"
                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="tel" class="form-control" id="phone_pddl<?php echo $products_content->id; ?>" name="phone"
                                                               placeholder="<?php echo FSText::_("Điện thoại") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='version'
                                                                id="version_pddl<?php echo $products_content->id; ?>">
                                                            <option value="0"><?php echo FSText::_("Chọn phiên bản") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            if ($products_content->file_download1 or $products_content->link_download1) { ?>
                                                                <option value="<?php echo $products_content->file_name1; ?>"><?php echo $products_content->file_name1; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download2 or $products_content->link_download2) { ?>
                                                                <option value="<?php echo $products_content->file_name2; ?>"><?php echo $products_content->file_name2; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download3 or $products_content->link_download3) { ?>
                                                                <option value="<?php echo $products_content->file_name3; ?>"><?php echo $products_content->file_name3; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download4 or $products_content->link_download4) { ?>
                                                                <option value="<?php echo $products_content->file_name4; ?>"><?php echo $products_content->file_name4; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download5 or $products_content->link_download5) { ?>
                                                                <option value="<?php echo $products_content->file_name5; ?>"><?php echo $products_content->file_name5; ?> </option>
                                                            <?php } ?>
                                                            <?php
                                                            if ($products_content->file_download or $products_content->link_download6) { ?>
                                                                <option value="<?php echo $products_content->file_name6; ?>"><?php echo $products_content->file_name6; ?> </option>
                                                            <?php } ?>


                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message_pddl<?php echo $products_content->id; ?>"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="check_capcha">
                                                    <input class="form-control txtCaptcha fl-left"
                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                           type="text" id="txtCaptcha_pddl<?php echo $products_content->id; ?>" value="" name="txtCaptcha"
                                                           size="5" required/>
                                                    <a href="javascript:void(0);"
                                                       onclick="changeCaptcha2(this)"
                                                       data-url="<?php echo URL_ROOT ?>"
                                                       title="Click here to change the captcha"
                                                       class="code-view fl-left">
                                                        <img class="fl-left imgCaptcha"
                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                             alt="captcha"/>
                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                             alt="captcha" class="img_capcha">
                                                    </a>
                                                </div>
                                                <div class="form-group  md_ft">
                                                    <div class="col-md-8 col-sm-12 notemd">
                                                        <p class="note12">*Vui lòng điền đúng thông tin, chúng tôi sẽ
                                                            liên hệ qua email của bạn</p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 sbm">
                                                        <a href="javascript:void(0)"
                                                           type="button"
                                                           title="GỬI"
                                                           data-id="<?php echo $products_content->id; ?>"
                                                           data-modal-id="myModaldownload_pd_dl<?php echo $products_content->id; ?>"
                                                           data-type="pddl"
                                                           data-form-id="form_pd_dl<?php echo $products_content->id; ?>"
                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                           data-lang="<?php echo $lang ?>"
                                                           onclick="submitForm(this)"
                                                           class="btn btn-info send"
                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name='module'
                                                       value='products'/>
                                                <input type="hidden" name='view'
                                                       value='product'/>
                                                <input type="hidden" name='task'
                                                       value='save'/>
                                                <input type="hidden" name='id'
                                                       value='<?php echo $products_content->id; ?>'/>
                                                <input type="hidden" name='alias'
                                                       value='<?php echo $products_content->alias; ?>'/>
                                                <input type="hidden" name='products_name'
                                                       id="products_name_pddl<?php echo $products_content->id; ?>"
                                                       value='<?php echo $products_content->name; ?>'/>
                                                <input type="hidden" name='type' value='Download sản phẩm'/>
                                                <input type="hidden" name='return'
                                                       value='<?php echo $return; ?>'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="dangkymua">
                    <a href="" type="button" class="btn btn1 btn-warning" data-toggle="modal"
                       data-target="#myModalmua_pddk<?php echo $products_content->id; ?>"><?php echo FSText::_("Đăng ký mua") ?></a>
                    <div class="modal fade" id="myModalmua_pddk<?php echo $products_content->id; ?>" role="dialog">
                        <div class="modal-dialog size">
                            <div class="modal-content size1">
                                <div class="header-modal">
                                    <div class="modal-header row">
                                        <div class="col-xs-10 col-sm-10 col-md-9">
                                            <h4 class="modal-title"><?php echo FSText::_("Đăng ký mua") ?></h4>
                                        </div>
                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                            <button type="button" class="close"
                                                    data-modal-id="myModalmua_pddk<?php echo $products_content->id; ?>"
                                                    onclick="closeModal(this)">&times;
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <form class="form-horizontal" role="form" method="post" name="order100"
                                        id="form_pd_dk<?php echo $products_content->id; ?>"
                                        >
                                            <!--                                            #-->
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                           id="name_pddk<?php echo $products_content->id; ?>" name="name"
                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="company_pddk<?php echo $products_content->id; ?>"
                                                           name="company"
                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="address_pddk<?php echo $products_content->id; ?>"
                                                           name="address"
                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <select class="form-control" name='city'
                                                            id="city_pddk<?php echo $products_content->id; ?>">
                                                        <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                            *
                                                        </option>
                                                        <?php
                                                        foreach ($city as $key) {
                                                            # code...
                                                            ?>
                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control"
                                                           id="email_pddk<?php echo $products_content->id; ?>" name="email"
                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <input type="tel" class="form-control"
                                                           id="phone_pddk<?php echo $products_content->id; ?>" name="phone"
                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                <textarea rows="4" class="form-control"
                                                          name='message' id="message_pddk<?php echo $products_content->id; ?>"
                                                          placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                </div>
                                            </div>
                                            <div class="check_capcha">
                                                <input class="form-control txtCaptcha fl-left"
                                                       placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                       type="text" id="txtCaptcha_pddk<?php echo $products_content->id; ?>" value="" name="txtCaptcha" size="5"
                                                       required/>
                                                <a href="javascript:void (0);"
                                                   onclick="changeCaptcha2(this)"
                                                   data-url="<?php echo URL_ROOT ?>"
                                                   title="Click here to change the captcha"
                                                   class="code-view fl-left">
                                                    <img class="fl-left imgCaptcha"
                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                         alt="captcha"/>
                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                    <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                         alt="captcha" class="img_capcha">
                                                </a>
                                            </div>
                                            <div class="form-group  md_ft">
                                                <div class="col-md-8 col-sm-12 notemd">
                                                    <p class="note12">*Vui lòng điền đúng thông tin, chúng tôi sẽ liên
                                                        hệ qua email của bạn</p>
                                                </div>
                                                <div class="col-md-4 col-sm-12 sbm">
                                                    <a href="javascript:void(0)"
                                                       type="button"
                                                       title="GỬI"
                                                       data-id="<?php echo $products_content->id; ?>"
                                                       data-modal-id="myModalmua_pddk<?php echo $products_content->id; ?>"
                                                       data-type="pddk"
                                                       data-form-id="form_pd_dk<?php echo $products_content->id; ?>"
                                                       data-base-url="<?php echo URL_ROOT ?>"
                                                       data-lang="<?php echo $lang ?>"
                                                       onclick="submitForm(this)"
                                                       class="btn btn-info send"
                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                </div>
                                            </div>
                                            <input type="hidden" name='module'
                                                   value='products'/>
                                            <input type="hidden" name='view'
                                                   value='product'/>
                                            <input type="hidden" name='task'
                                                   value='save'/>
                                            <input type="hidden" name='id'
                                                   value='<?php echo $products_content->id; ?>'/>
                                            <input type="hidden" name='alias'
                                                   value='<?php echo $products_content->alias; ?>'/>
                                            <input type="hidden" name='products_name'
                                                   id="products_name_pddk<?php echo $products_content->id; ?>"
                                                   value='<?php echo $products_content->name; ?>'/>
                                            <input type="hidden" name='type' value='Đăng ký mua'/>
                                            <input type="hidden" name='return'
                                                   value='<?php echo $return; ?>'/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--                --><?php //if($products_content->landing_page){ ?>
                <!--                    <div class="landingpage">-->
                <!--                        <p>--><?php //echo FSText::_("Landing page");?><!--:<a href="-->
                <?php //echo $products_content->landing_page ?><!-- " target="_blank">  -->
                <?php //echo $products_content->landing_page ?><!--</a>-->
                <!--                        </p>-->
                <!--                    </div>-->
                <!--                --><?php //} ?>
                <div class="tag">
                    <?php
                    include 'default_tags.php';
                    ?>
                </div>
                <div class="bottom">
<!--                                        --><?php
//                                        include 'default_share_bottom.php';
//                                        ?>
                </div>
            </div>
        </div>

        <div class="row bodymenu">
            <div class=" col-md-9 lbody">
                <div class="menu1">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#home"><?php echo FSText::_("Tổng quan") ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu1"><?php echo FSText::_("Chi tiết tính năng") ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu2"><?php echo FSText::_("Video") ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#menu3"><?php echo FSText::_("Tài liệu sản phẩm") ?></a>
                        </li>
                    </ul>
                    <!-- </div> -->
                    <div class="tab-content product-content">
                        <!-- //home -->
                        <div id="home" class="tab-pane fade in active">
                            <?php if ($products_content->description != null && $products_content->description != '') { ?>
                                <div class="contentt boxdesc" id="boxdesc" style="height: 650px;" data-height="650">
                                    <p><?php echo html_entity_decode($products_content->description); ?></p>
                                </div>
                                <div class="show">
                                    <a class="btn btn-info details_click clickmore " data-id="boxdesc" data-class="1">
                                        <?php echo FSText::_("Xem thông tin đầy đủ") ?></a>
                                </div>
                            <?php } else {?>
                                <div class="contentt boxdesc text-center" id="boxdesc" style="height: 100px;">
                                    <p>Chưa có thông tin</p>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- // menu1 -->
                        <div id="menu1" class="tab-pane fade">
                            <?php if ($products_content->feature_details != null && $products_content->feature_details != '') { ?>

                                <div class="contentt boxdex" id="boxdex" style="height: 300px;" data-height="300">
                                    <p><?php echo html_entity_decode($products_content->feature_details); ?></p>
                                </div>
                                <div class="show">
                                    <a class="btn btn-info details_click clickmore " data-id="boxdex" data-class="1">
                                        <?php echo FSText::_("Xem thông tin đầy đủ") ?></a>
                                </div>
                            <?php } else {?>
                                <div class="contentt boxdex text-center" id="boxdex" style="height: 100px;">
                                    <p>Chưa có thông tin</p>
                                </div>
                            <?php } ?>

                        </div>
                        <!-- //menu2 -->
                        <div id="menu2" class="tab-pane fade">
                            <?php if ($products_content->video != null) { ?>
                                <div class="video">
                                    <?php echo html_entity_decode($products_content->video); ?>
                                </div>
                            <?php } else {?>
                                <div class="video text-center">
                                    <p>Chưa có video mô tả</p>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- //menu3 -->
                        <div id="menu3" class="tab-pane fade">
                            <?php if ($products_content->file_download1 or $products_content->link_download1) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name1 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModal4"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModal4" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModal4">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact1113" id="form_4">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name_4" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="company_4"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="address_4"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city_4">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email_4"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone_4" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                            <textarea rows="4" class="form-control" name='message'
                                                                      id="message_4"
                                                                      placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left"
                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha_4" value=""
                                                                           name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:void (0);"
                                                                       onclick="changeCaptcha2(this)"
                                                                       data-url="<?php echo URL_ROOT ?>"
                                                                       title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img class="fl-left imgCaptcha"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                             alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                             alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)"
                                                                           type="button"
                                                                           title="GỬI"
                                                                           data-id="4"
                                                                           data-modal-id="myModal4"
                                                                           data-type=""
                                                                           data-form-id="form_4"
                                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                                           data-lang="<?php echo $lang ?>"
                                                                           onclick="submitForm(this)"
                                                                           class="btn btn-info send"
                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       id="products_name_4"
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name1; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>

                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit1; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download2 or $products_content->link_download2) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản ") ?><?php echo $products_content->file_name2 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModal5"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModal5" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModal5">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact1114" id="form_5">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name_5" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="company_5"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="address_5"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city_5">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email_5"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone_5" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                    <textarea rows="4" class="form-control"
                                                                              name='message'
                                                                              id="message_5"
                                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left"
                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha_5" value=""
                                                                           name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:void (0);"
                                                                       onclick="changeCaptcha2(this)"
                                                                       data-url="<?php echo URL_ROOT ?>"
                                                                       title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img class="fl-left imgCaptcha"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                             alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                             alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)"
                                                                           type="button"
                                                                           title="GỬI"
                                                                           data-id="5"
                                                                           data-modal-id="myModal5"
                                                                           data-type=""
                                                                           data-form-id="form_5"
                                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                                           data-lang="<?php echo $lang ?>"
                                                                           onclick="submitForm(this)"
                                                                           class="btn btn-info send"
                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       id="products_name_5"
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name3; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit2; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download3 or $products_content->link_download3) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name3 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModal6"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModal6" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModal6">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact1116" id="form_6">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name_6" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="company_6"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="address_6"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city_6">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email_6"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone_6" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message_6"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left"
                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha_6" value=""
                                                                           name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:void (0);"
                                                                       onclick="changeCaptcha2(this)"
                                                                       data-url="<?php echo URL_ROOT ?>"
                                                                       title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img class="fl-left imgCaptcha"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                             alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                             alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)"
                                                                           type="button"
                                                                           title="GỬI"
                                                                           data-id="6"
                                                                           data-modal-id="myModal6"
                                                                           data-type=""
                                                                           data-form-id="form_6"
                                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                                           data-lang="<?php echo $lang ?>"
                                                                           onclick="submitForm(this)"
                                                                           class="btn btn-info send"
                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       id="products_name_6"
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name3; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit3; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download4 or $products_content->link_download4) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name4 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModal7"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModal7" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModal7">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact7" id="form_7">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name_7" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="company_7"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="address_7"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city_7">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email_7"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone_7" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left"
                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha_7" value=""
                                                                           name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:void (0);"
                                                                       onclick="changeCaptcha2(this)"
                                                                       data-url="<?php echo URL_ROOT ?>"
                                                                       title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img class="fl-left imgCaptcha"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                             alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                             alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)"
                                                                           type="button"
                                                                           title="GỬI"
                                                                           data-id="7"
                                                                           data-modal-id="myModal7"
                                                                           data-type=""
                                                                           data-form-id="form_7"
                                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                                           data-lang="<?php echo $lang ?>"
                                                                           onclick="submitForm(this)"
                                                                           class="btn btn-info send"
                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       id="products_name_7"
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name4; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit4; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download5 or $products_content->link_download5) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat"><?php echo FSText::_("Bộ cài đặt phần mềm") ?> <?php echo $products_content->name; ?>
                                        .
                                        Phiên
                                        bản <?php echo $products_content->file_name5 ?>.</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModal8">Download</a>
                                        <div class="modal fade" id="myModal8" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title">Download</h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModal8">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact8" id="form_8">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name_8" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="company_8"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="address_8"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city_8">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email_8"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone_8" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message_8"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left"
                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha_8" value=""
                                                                           name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:void (0);"
                                                                       onclick="changeCaptcha2(this)"
                                                                       data-url="<?php echo URL_ROOT ?>"
                                                                       title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img class="fl-left imgCaptcha"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                             alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                             alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)"
                                                                           type="button"
                                                                           title="GỬI"
                                                                           data-id="8"
                                                                           data-modal-id="myModal8"
                                                                           data-type=""
                                                                           data-form-id="form_8"
                                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                                           data-lang="<?php echo $lang ?>"
                                                                           onclick="submitForm(this)"
                                                                           class="btn btn-info send"
                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       id="products_name_8"
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name5; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit5; ?></p>
                                </div>
                            <?php } ?>
                            <?php if ($products_content->file_download6 or $products_content->link_download6) { ?>
                                <div class="tailieu relative">
                                    <p class="caidat">Bộ cài đặt phần mềm <?php echo $products_content->name; ?>.
                                        <?php echo FSText::_("Phiên bản") ?> <?php echo $products_content->file_name6 ?>
                                        .</p>
                                    <div class="download absolute">
                                        <!--                                    <a href="" type="button" class="btn btn-success">Download</a>-->
                                        <a href="" type="button" class="btn btn-success" data-toggle="modal"
                                           data-target="#myModalfile9"><?php echo FSText::_("Download") ?></a>
                                        <div class="modal fade" id="myModalfile9" role="dialog">
                                            <div class="modal-dialog size">
                                                <div class="modal-content size1">
                                                    <div class="header-modal">
                                                        <div class="modal-header row">
                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                            </div>
                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModalfile9">&times;
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="form-horizontal" role="form" method="post"
                                                                  name="contact9" id="form_9">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="name_9" name="name"
                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="company_9"
                                                                               name="company"
                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                               id="address_id"
                                                                               name="address"
                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" name='city'
                                                                                id="city_9">
                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                *
                                                                            </option>
                                                                            <?php
                                                                            foreach ($city as $key) {
                                                                                # code...
                                                                                ?>
                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <input type="email" class="form-control"
                                                                               id="email_9"
                                                                               name="email"
                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-">
                                                                        <input type="tel" class="form-control"
                                                                               id="phone_9" name="phone"
                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message_9"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="check_capcha">
                                                                    <input class="form-control txtCaptcha fl-left"
                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                           type="text" id="txtCaptcha_9" value=""
                                                                           name="txtCaptcha" size="5" required/>
                                                                    <a href="javascript:void (0);"
                                                                       onclick="changeCaptcha2(this)"
                                                                       data-url="<?php echo URL_ROOT ?>"
                                                                       title="Click here to change the captcha"
                                                                       class="code-view fl-left">
                                                                        <img class="fl-left imgCaptcha"
                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                             alt="captcha"/>
                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                             alt="captcha" class="img_capcha">
                                                                    </a>
                                                                </div>
                                                                <div class="form-group  md_ft">
                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                                    </div>
                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                        <a href="javascript:void(0)"
                                                                           type="button"
                                                                           title="GỬI"
                                                                           data-id="9"
                                                                           data-modal-id="myModalfile9"
                                                                           data-type=""
                                                                           data-form-id="form_9"
                                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                                           data-lang="<?php echo $lang ?>"
                                                                           onclick="submitForm(this)"
                                                                           class="btn btn-info send"
                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name='id'
                                                                <input type="hidden" name='id'
                                                                       value='<?php echo $products_content->id; ?>'/>
                                                                <input type="hidden" name='alias'
                                                                       value='<?php echo $products_content->alias; ?>'/>
                                                                <input type="hidden" name='products_name'
                                                                       id="products_name_9"
                                                                       value='<?php echo $products_content->name; ?>'/>
                                                                <input type="hidden" name='version'
                                                                       value='<?php echo $products_content->file_name6; ?>'/>
                                                                <input type="hidden" name='type'
                                                                       value='<?php echo FSText::_("Download sản phẩm"); ?>'/>
                                                                <input type="hidden" name='return'
                                                                       value='<?php echo $return; ?>'/>
                                                                <input type="hidden" name='module'
                                                                       value='products'/>
                                                                <input type="hidden" name='view'
                                                                       value='product'/>
                                                                <input type="hidden" name='task'
                                                                       value='save'/>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="dem absolute"><?php echo $products_content->hit6; ?></p>
                                </div>
                            <?php } ?>
                            <?php if (!$products_content->file_download6 and !$products_content->link_download6
                                and !$products_content->file_download1 and !$products_content->link_download1
                                and !$products_content->file_download2 and !$products_content->link_download2
                                and !$products_content->file_download3 and !$products_content->link_download3
                                and !$products_content->file_download4 and !$products_content->link_download4
                                and !$products_content->file_download5 and !$products_content->link_download5
                            ) { ?>
                                <div class="text-center"><p>Chưa có tài liệu</p></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php if ($products_content->products_relates) { ?>
                    <div class="row lienquan">
                        <p class="tieude col-md-12">Sản phẩm liên quan</p>
                        <?php
                        // var_dump($list);
                        $i = 1;
                        $j = 1;
                        foreach ($products_relates as $item) {
                            $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                            $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="dobong product"
                                     onmouseover="showTuyChonHot(<?php echo $item->id ?>)"
                                     onmouseout="hideTuyChonHot(<?php echo $item->id ?>)">
                                    <div class="khung hotsp">
                                        <a class="dpll" href="<?php if ($item->landing_page) {
                                            echo $item->landing_page;
                                        } else {
                                            echo $link;
                                        } ?>" target="<?php if ($item->landing_page) {
                                            echo '_blank';
                                        } ?>">
                                            <div style="display: flex; align-items: center; min-height: 100px">
                                                <img class="logo1" src="<?php echo URL_ROOT . $item->icon ?>"
                                                     alt="<?php echo $item->name ?>">
                                                <p class="phanmem" href="<?php echo $link; ?>"
                                                   title="<?php echo $item->name ?>"> <?php echo getWord(10, $item->name) ?></p>
                                            </div>
                                            <div class="chitiet">
                                                <div class="hienthi">
                                                    <div class="gia fgia<?php echo $item->id; ?>">
                                                        <p><b><?php echo FSText::_("Giá") ?>: </b><span
                                                                    class="red"> <?php if ($item->price) {
                                                                    echo $item->price;
                                                                } else {
                                                                    echo 'Liên hệ';
                                                                } ?></span></p>
                                                    </div>
                                                </div>
                                            </div>

                                        </a>
                                        <div>
                                            <p class="thuoctinh"
                                               id="fthuoctinh<?php echo $item->id; ?>"><?php echo getWord(15, $item->summary); ?></p>
                                            <div id="ftuychon<?php echo $item->id; ?>" class="ftuychon">
                                                <div class="tuychon clearfix">
                                                    <div class="lienhe">
                                                        <a href="" type="button" class="btn btn1 btn-info"
                                                           data-toggle="modal"
                                                           data-target="#myModal<?php echo $item->id; ?>"><?php echo FSText::_("Liên hệ") ?></a>
                                                    </div>
                                                    <?php if ($item->file_download1 or $item->link_download1 or $item->link_download2 or $item->file_download2 or $item->link_download3 or $item->file_download3 or $item->link_download4 or $item->file_download4 or $item->link_download5 or $item->file_download5 or $item->link_download6 or $item->file_download6) { ?>
                                                        <div class="lienhe">
                                                            <!-- <button type="button" class="btn btn-success">Download</button> -->
                                                            <a href="" type="button" class="btn btn1 btn-success "
                                                               data-toggle="modal"
                                                               data-target="#myModaldownload<?php echo $item->id; ?>"><?php echo FSText::_("Download") ?></a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="lienhe">
                                                        <a href="" type="button" class="btn btn1 btn-warning"
                                                           data-toggle="modal"
                                                           data-target="#myModalmua<?php echo $item->id; ?>"><?php echo FSText::_("Đăng ký mua") ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tuychon clearfix" style="height: auto; min-height: 2rem">
                                                <div class="lienhe">
                                                    <div class="modal fade" id="myModal<?php echo $item->id; ?>"
                                                         role="dialog">
                                                        <div class="modal-dialog size">
                                                            <div class="modal-content size1">
                                                                <div class="header-modal">
                                                                    <div class="modal-header row">
                                                                        <div class="col-xs-10 col-sm-10 col-md-9">
                                                                            <h4 class="modal-title"><?php echo FSText::_("Liên hệ sản phẩm") ?></h4>
                                                                        </div>
                                                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                                                            <button type="button" class="close"
                                                                                    data-modal-id="myModal<?php echo $item->id; ?>"
                                                                                    onclick="closeModal(this)">&times;
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" role="form"
                                                                              id="contact_nb<?php echo $item->id; ?>"
                                                                              enctype="multipart/form-data">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           required
                                                                                           class="form-control"
                                                                                           id="name_nb<?php echo $item->id; ?>"
                                                                                           name="name"
                                                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           required
                                                                                           class="form-control"
                                                                                           id="company_nb<?php echo $item->id; ?>"
                                                                                           name="company"
                                                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           required
                                                                                           class="form-control"
                                                                                           id="address_nb<?php echo $item->id; ?>"
                                                                                           name="address"
                                                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='city'
                                                                                            required
                                                                                            id="city_nb<?php echo $item->id; ?>">
                                                                                        <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                            *
                                                                                        </option>
                                                                                        <?php
                                                                                        foreach ($city as $key) {
                                                                                            # code...
                                                                                            ?>
                                                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="email"
                                                                                           required
                                                                                           class="form-control"
                                                                                           id="email_nb<?php echo $item->id; ?>"
                                                                                           name="email"
                                                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="tel"
                                                                                           required
                                                                                           class="form-control"
                                                                                           id="phone_nb<?php echo $item->id; ?>"
                                                                                           name="phone"
                                                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="message_nb<?php echo $item->id; ?>"
                                                                                  placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="check_capcha">
                                                                                <input class="form-control txtCaptcha fl-left"
                                                                                       placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                       type="text"
                                                                                       id="txtCaptcha_nb<?php echo $item->id; ?>"
                                                                                       value="" name="txtCaptcha"
                                                                                       size="5" required/>
                                                                                <a href="javascript:void (0);"
                                                                                   onclick="changeCaptcha2(this)"
                                                                                   data-url="<?php echo URL_ROOT ?>"
                                                                                   title="Click here to change the captcha"
                                                                                   class="code-view fl-left">
                                                                                    <img class="fl-left imgCaptcha"
                                                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                                         alt="captcha"/>
                                                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                                                    <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                                         alt="captcha"
                                                                                         class="img_capcha">
                                                                                </a>
                                                                            </div>
                                                                            <div class="form-group md_ft">
                                                                                <div class="col-md-8 col-sm-12 notemd">
                                                                                    <p class="note12">*Vui lòng điền
                                                                                        đúng
                                                                                        thông tin, chúng tôi sẽ liên
                                                                                        hệ qua
                                                                                        email của bạn</p>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-12 sbm">
                                                                                    <a href="javascript:void(0)"
                                                                                       type="button"
                                                                                       title="GỬI"
                                                                                       data-id="<?php echo $item->id; ?>"
                                                                                       data-modal-id="myModal<?php echo $item->id; ?>"
                                                                                       data-type="nb"
                                                                                       data-form-id="contact_nb<?php echo $item->id; ?>"
                                                                                       data-base-url="<?php echo URL_ROOT ?>"
                                                                                       data-lang="<?php echo $lang ?>"
                                                                                       onclick="submitForm(this)"
                                                                                       class="btn btn-info send"
                                                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name='id'
                                                                                   value='<?php echo $item->id; ?>'/>
                                                                            <input type="hidden" name='alias'
                                                                                   value='<?php echo $item->alias; ?>'/>
                                                                            <input type="hidden"
                                                                                   name="products_name"
                                                                                   id='products_name_nb<?php echo $item->id; ?>'
                                                                                   value='<?php echo $item->name; ?>'/>
                                                                            <input type="hidden" name='type'
                                                                                   value='liên hệ sản phẩm'/>
                                                                            <input type="hidden" name='return'
                                                                                   value='<?php echo $return; ?>'/>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal fade" id="myModalmua<?php echo $item->id; ?>"
                                                         role="dialog">
                                                        <div class="modal-dialog size">
                                                            <div class="modal-content size1">
                                                                <div class="header-modal">
                                                                    <div class="modal-header row">
                                                                        <div class="col-xs-10 col-sm-10 col-md-9">
                                                                            <h4 class="modal-title"><?php echo FSText::_("Đăng ký mua") ?></h4>
                                                                        </div>
                                                                        <div class="col-xs-2 col-sm-2 col-md-3">
                                                                            <button type="button" class="close"
                                                                                    data-modal-id="myModalmua<?php echo $item->id; ?>"
                                                                                    onclick="closeModal(this)">&times;
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" role="form"
                                                                              method="post"
                                                                              id="dangky_dk<?php echo $item->id; ?>"
                                                                              action="#"
                                                                              enctype="multipart/form-data">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="name_dk<?php echo $item->id; ?>"
                                                                                           name="name"
                                                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="company_dk<?php echo $item->id; ?>"
                                                                                           name="company"
                                                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="address_dk<?php echo $item->id; ?>"
                                                                                           name="address"
                                                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='city'
                                                                                            id="city_dk<?php echo $item->id; ?>">
                                                                                        <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                            *
                                                                                        </option>
                                                                                        <?php
                                                                                        foreach ($city as $key) {
                                                                                            # code...
                                                                                            ?>
                                                                                            <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="email"
                                                                                           class="form-control"
                                                                                           id="email_dk<?php echo $item->id; ?>"
                                                                                           name="email"
                                                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="tel"
                                                                                           class="form-control"
                                                                                           id="phone_dk<?php echo $item->id; ?>"
                                                                                           name="phone"
                                                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="message_dk<?php echo $item->id; ?>"
                                                                                  placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="check_capcha">
                                                                                <input class="form-control txtCaptcha fl-left"
                                                                                       placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                       type="text"
                                                                                       id="txtCaptcha_dk<?php echo $item->id; ?>"
                                                                                       value="" name="txtCaptcha"
                                                                                       size="5" required/>
                                                                                <a href="javascript:void(0);"
                                                                                   onclick="changeCaptcha2(this)"
                                                                                   data-url="<?php echo URL_ROOT ?>"
                                                                                   title="Click here to change the captcha"
                                                                                   class="code-view fl-left">
                                                                                    <img class="fl-left imgCaptcha"
                                                                                         src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                                         alt="captcha"/>
                                                                                    <!--                    <i class="fa fa-sync"></i>-->
                                                                                    <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                                         alt="captcha"
                                                                                         class="img_capcha">
                                                                                </a>
                                                                            </div>
                                                                            <div class="form-group md_ft">
                                                                                <div class="col-md-8 col-sm-12 notemd">
                                                                                    <p class="note12">*Vui lòng điền
                                                                                        đúng
                                                                                        thông tin, chúng tôi sẽ liên
                                                                                        hệ qua
                                                                                        email của bạn</p>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-12 sbm">
                                                                                    <a href="javascript:void(0)"
                                                                                       type="button"
                                                                                       title="GỬI"
                                                                                       data-id="<?php echo $item->id; ?>"
                                                                                       data-modal-id="myModalmua<?php echo $item->id; ?>"
                                                                                       data-type="dk"
                                                                                       data-form-id="dangky_dk<?php echo $item->id; ?>"
                                                                                       onclick="submitForm(this)"
                                                                                       data-form-id="contact_nb<?php echo $item->id; ?>"
                                                                                       data-base-url="<?php echo URL_ROOT ?>"
                                                                                       data-lang="<?php echo $lang ?>"
                                                                                       class="btn btn-info send"
                                                                                       id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                                </div>
                                                                            </div>
                                                                            <input type="hidden" name='id'
                                                                                   value='<?php echo $item->id; ?>'/>
                                                                            <input type="hidden" name='alias'
                                                                                   value='<?php echo $item->alias; ?>'/>
                                                                            <input type="hidden"
                                                                                   name='products_name'
                                                                                   id="products_name_dk<?php echo $item->id; ?>"
                                                                                   value='<?php echo $item->name; ?>'/>
                                                                            <input type="hidden" name='type'
                                                                                   value='Đăng ký mua'/>
                                                                            <input type="hidden" name='return'
                                                                                   value='<?php echo $return; ?>'/>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if ($item->file_download1 or $item->link_download1 or $item->link_download2 or $item->file_download2 or $item->link_download3 or $item->file_download3 or $item->link_download4 or $item->file_download4 or $item->link_download5 or $item->file_download5 or $item->link_download6 or $item->file_download6) { ?>
                                                        <div class="modal fade"
                                                             id="myModaldownload<?php echo $item->id; ?>"
                                                             role="dialog">
                                                            <div class="modal-dialog size">
                                                                <div class="modal-content size1">
                                                                    <div class="header-modal">
                                                                        <div class="modal-header row">
                                                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                                                <h4 class="modal-title"><?php echo FSText::_("Download") ?></h4>
                                                                            </div>
                                                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                                                <button type="button" class="close"
                                                                                        data-modal-id="myModaldownload<?php echo $item->id; ?>"
                                                                                        onclick="closeModal(this)">&times;
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal"
                                                                                  role="form"
                                                                                  method="post"
                                                                                  id="download_dl<?php echo $item->id; ?>"
                                                                                  action="#"
                                                                                  enctype="multipart/form-data">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="name_dl<?php echo $item->id; ?>"
                                                                                               name="name"
                                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="company_dl<?php echo $item->id; ?>"
                                                                                               name="company"
                                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="address_dl<?php echo $item->id; ?>"
                                                                                               name="address"
                                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <select class="form-control"
                                                                                                name='city'
                                                                                                id="city_dl<?php echo $item->id; ?>">
                                                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                                                *
                                                                                            </option>
                                                                                            <?php
                                                                                            foreach ($city as $key) {
                                                                                                # code...
                                                                                                ?>
                                                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                                                            <?php } ?>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="email"
                                                                                               class="form-control"
                                                                                               id="email_dl<?php echo $item->id; ?>"
                                                                                               name="email"
                                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="tel"
                                                                                               class="form-control"
                                                                                               id="phone_dl<?php echo $item->id; ?>"
                                                                                               name="phone"
                                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <select class="form-control"
                                                                                                name='version'
                                                                                                id="version_dl<?php echo $item->id; ?>">
                                                                                            <option value="0"><?php echo FSText::_("Chọn phiên bản") ?>
                                                                                                *
                                                                                            </option>
                                                                                            <?php
                                                                                            if ($item->file_download1 or $item->link_download1) { ?>
                                                                                                <option value="<?php echo $item->file_name1; ?>"><?php echo $item->file_name1; ?> </option>
                                                                                            <?php } ?>
                                                                                            <?php
                                                                                            if ($item->file_download2 or $item->link_download2) { ?>
                                                                                                <option value="<?php echo $item->file_name2; ?>"><?php echo $item->file_name2; ?> </option>
                                                                                            <?php } ?>
                                                                                            <?php
                                                                                            if ($item->file_download3 or $item->link_download3) { ?>
                                                                                                <option value="<?php echo $item->file_name3; ?>"><?php echo $item->file_name3; ?> </option>
                                                                                            <?php } ?>
                                                                                            <?php
                                                                                            if ($item->file_download4 or $item->link_download4) { ?>
                                                                                                <option value="<?php echo $item->file_name4; ?>"><?php echo $item->file_name4; ?> </option>
                                                                                            <?php } ?>
                                                                                            <?php
                                                                                            if ($item->file_download5 or $item->link_download5) { ?>
                                                                                                <option value="<?php echo $item->file_name5; ?>"><?php echo $item->file_name5; ?> </option>
                                                                                            <?php } ?>
                                                                                            <?php
                                                                                            if ($item->file_download or $item->link_download6) { ?>
                                                                                                <option value="<?php echo $item->file_name6; ?>"><?php echo $item->file_name6; ?> </option>
                                                                                            <?php } ?>


                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="message_dl<?php echo $item->id; ?>"
                                                                                  placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="check_capcha">
                                                                                    <input class="form-control txtCaptcha fl-left"
                                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                           type="text"
                                                                                           id="txtCaptcha_dl<?php echo $item->id; ?>"
                                                                                           value=""
                                                                                           name="txtCaptcha"
                                                                                           size="5" required/>
                                                                                    <a href="javascript:void(0);"
                                                                                       onclick="changeCaptcha2(this)"
                                                                                       data-url="<?php echo URL_ROOT ?>"
                                                                                       title="Click here to change the captcha"
                                                                                       class="code-view fl-left">
                                                                                        <img class="fl-left imgCaptcha"
                                                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                                                             alt="captcha"/>
                                                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                                                             alt="captcha"
                                                                                             class="img_capcha">
                                                                                    </a>
                                                                                </div>
                                                                                <div class="form-group md_ft">
                                                                                    <div class="col-md-8 col-sm-12 notemd">
                                                                                        <p class="note12">*Vui lòng
                                                                                            điền
                                                                                            đúng thông tin, chúng
                                                                                            tôi sẽ
                                                                                            liên hệ qua email của
                                                                                            bạn</p>
                                                                                    </div>
                                                                                    <div class="col-md-4 col-sm-12 sbm">
                                                                                        <a href="javascript:void(0)"
                                                                                           type="button"
                                                                                           title="GỬI"
                                                                                           data-id="<?php echo $item->id; ?>"
                                                                                           data-modal-id="myModaldownload<?php echo $item->id; ?>"
                                                                                           data-type="dl"
                                                                                           data-form-id="download_dl<?php echo $item->id; ?>"
                                                                                           onclick="submitForm(this)"
                                                                                           data-form-id="contact_nb<?php echo $item->id; ?>"
                                                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                                                           data-lang="<?php echo $lang ?>"
                                                                                           class="btn btn-info send"
                                                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="hidden" name='id'
                                                                                       value='<?php echo $item->id; ?>'/>
                                                                                <input type="hidden" name='alias'
                                                                                       value='<?php echo $item->alias; ?>'/>
                                                                                <input type="hidden"
                                                                                       id="products_name_dl<?php echo $item->id; ?>"
                                                                                       name='products_name'
                                                                                       value='<?php echo $item->name; ?>'/>
                                                                                <input type="hidden" name='type'
                                                                                       value='Download sản phẩm'/>
                                                                                <input type="hidden" name='return'
                                                                                       value='<?php echo $return; ?>'/>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                            <script>
                                                function showTuyChonHot(i) {
                                                    $(".hotsp #ftuychon" + i).css('display', 'block');
                                                    $(".hotsp #fthuoctinh" + i).css('display', 'none');
                                                }

                                                function hideTuyChonHot(i) {
                                                    $(".hotsp #ftuychon" + i).css('display', 'none');
                                                    $(".hotsp #fthuoctinh" + i).css('display', 'block');
                                                }
                                            </script>
                                            <a class="abc fabc<?php echo $item->id; ?>"
                                               href="<?php echo $link ?>"><?php echo FSText::_("Chi tiết sản phẩm") ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if ($j % 3 == 0) { ?>
                                <div class="clearfix"></div>
                            <?php }
                            $j++; ?>
                            <?php
                            $i++;
                        } ?>

                    </div>
                <?php } ?>
            </div>
            <div class="col-md-3 rbody">
                <?php if ($products_content->file_price or $products_content->link_catalogue or $products_content->file_driver or $products_content->link_driver or $products_content->teamview == 1 && !$config['teamview']) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Download tài liệu") ?></a>
                    </div>
                <?php } ?>
                <div class="taituychon">
                    <!-- tải báo giá -->
                    <?php if ($products_content->file_price or $products_content->link_catalogue) { ?>
                        <a class="mo mot" href="" type="button" data-toggle="modal"
                           data-target="#myModalbaogia"><?php echo FSText::_("Tải báo giá") ?></a>
                        <!-- <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModaldownload">Download</a> -->
                        <div class="modal fade" id="myModalbaogia" role="dialog">
                            <div class="modal-dialog size">
                                <div class="modal-content size1">
                                    <div class="header-modal">
                                        <div class="modal-header row">
                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                <h4 class="modal-title"><?php echo FSText::_("Tải báo giá") ?></h4>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModalbaogia">&times;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" method="post" name="contact10"
                                                  id="form_10">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name_10"
                                                               name="name"
                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="company_10"
                                                               name="company"
                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="address_10"
                                                               name="address"
                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='city' id="city_10">
                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            foreach ($city as $key) {
                                                                # code...
                                                                ?>
                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email_10"
                                                               name="email"
                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="tel" class="form-control" id="phone_10"
                                                               name="phone"
                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message_10"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="check_capcha">
                                                    <input class="form-control txtCaptcha fl-left"
                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                           type="text" id="txtCaptcha_10" value="" name="txtCaptcha"
                                                           size="5" required/>
                                                    <a href="javascript:void (0);"
                                                       onclick="changeCaptcha2(this)"
                                                       data-url="<?php echo URL_ROOT ?>"
                                                       title="Click here to change the captcha"
                                                       class="code-view fl-left">
                                                        <img class="fl-left imgCaptcha"
                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                             alt="captcha"/>
                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                             alt="captcha" class="img_capcha">
                                                    </a>
                                                </div>
                                                <div class="form-group  md_ft">
                                                    <div class="col-md-8 col-sm-12 notemd">
                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 sbm">
                                                        <a href="javascript:void(0)"
                                                           type="button"
                                                           title="GỬI"
                                                           data-id="10"
                                                           data-modal-id="myModalbaogia"
                                                           data-type=""
                                                           data-form-id="form_10"
                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                           data-lang="<?php echo $lang ?>"
                                                           onclick="submitForm(this)"
                                                           class="btn btn-info send"
                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name='id'
                                                       value='<?php echo $products_content->id; ?>'/>
                                                <input type="hidden" name='alias'
                                                       value='<?php echo $products_content->alias; ?>'/>
                                                <input type="hidden" name='products_name'
                                                       id="products_name_10"
                                                       value='<?php echo $products_content->name; ?>'/>
                                                <input type="hidden" name='type' value='Tải báo giá'/>
                                                <input type="hidden" name='module'
                                                       value='products'/>
                                                <input type="hidden" name='view'
                                                       value='product'/>
                                                <input type="hidden" name='task'
                                                       value='save'/>
                                                <input type="hidden" name='return'
                                                       value='<?php echo $return; ?>'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- tải khóa cứng -->
                    <?php if ($products_content->file_driver or $products_content->link_driver) { ?>
                        <a class="mo mot" href="" type="button" data-toggle="modal"
                           data-target="#myModaldriver"><?php echo FSText::_("Tải Driver khóa cứng") ?></a>
                        <!-- <a href="" type="button" class="btn btn-success" data-toggle="modal" data-target="#myModaldownload">Download</a> -->
                        <div class="modal fade" id="myModaldriver" role="dialog">
                            <div class="modal-dialog size">
                                <div class="modal-content size1">
                                    <div class="header-modal">
                                        <div class="modal-header row">
                                            <div class="col-xs-10 col-sm-10 col-md-9">
                                                <h4 class="modal-title"><?php echo FSText::_("Tải driver khóa cứng") ?></h4>
                                            </div>
                                            <div class="col-xs-2 col-sm-2 col-md-3">
                                                <button type="button" class="close" onclick="closeModal(this)" data-modal-id="myModaldriver">&times;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-horizontal" role="form" method="post" name="contact11"
                                                  id="form_11"
                                                  action="#">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="name_11"
                                                               name="name"
                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="company_11"
                                                               name="company"
                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="text" class="form-control" id="address_11"
                                                               name="address"
                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <select class="form-control" name='city' id="city_11">
                                                            <option value="0"><?php echo FSText::_("Chọn tỉnh/thành phố") ?>
                                                                *
                                                            </option>
                                                            <?php
                                                            foreach ($city as $key) {
                                                                # code...
                                                                ?>
                                                                <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?> </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="email" class="form-control" id="email_11"
                                                               name="email"
                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input type="tel" class="form-control" id="phone_11"
                                                               name="phone"
                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>* ">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                    <textarea rows="4" class="form-control" name='message'
                                                              id="message_11"
                                                              placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                    </div>
                                                </div>
                                                <div class="check_capcha">
                                                    <input class="form-control txtCaptcha fl-left"
                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                           type="text" id="txtCaptcha_11" value="" name="txtCaptcha"
                                                           size="5" required/>
                                                    <a href="javascript:void (0);"
                                                       onclick="changeCaptcha2(this)"
                                                       data-url="<?php echo URL_ROOT ?>"
                                                       title="Click here to change the captcha"
                                                       class="code-view fl-left">
                                                        <img class="fl-left imgCaptcha"
                                                             src="<?php echo URL_ROOT ?>libraries/jquery/ajax_captcha/create_image.php"
                                                             alt="captcha"/>
                                                        <!--                    <i class="fa fa-sync"></i>-->
                                                        <img src="<?php echo URL_ROOT . 'modules/contact/assets/images/lienhe.png' ?>"
                                                             alt="captcha" class="img_capcha">
                                                    </a>
                                                </div>
                                                <div class="form-group  md_ft">
                                                    <div class="col-md-8 col-sm-12 notemd">
                                                        <p class="note12">*<?php echo FSText::_('Vui lòng điền đúng thông tin,
                                                                            chúng tôi sẽ liên hệ qua email của bạn') ?></p>
                                                    </div>
                                                    <div class="col-md-4 col-sm-12 sbm">
                                                        <a href="javascript:void(0)"
                                                           type="button"
                                                           title="GỬI"
                                                           data-id="11"
                                                           data-modal-id="myModaldriver"
                                                           data-type=""
                                                           data-form-id="form_11"
                                                           data-base-url="<?php echo URL_ROOT ?>"
                                                           data-lang="<?php echo $lang ?>"
                                                           onclick="submitForm(this)"
                                                           class="btn btn-info send"
                                                           id="btnn"><?php echo FSText::_("GỬI") ?></a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name='id'
                                                       value='<?php echo $products_content->id; ?>'/>
                                                <input type="hidden" name='alias'
                                                       value='<?php echo $products_content->alias; ?>'/>
                                                <input type="hidden" name='products_name'
                                                       id="products_name_11"
                                                       value='<?php echo $products_content->name; ?>'/>
                                                <input type="hidden" name='type' value='Tải driver khóa cứng'/>
                                                <input type="hidden" name='module'
                                                       value='products'/>
                                                <input type="hidden" name='view'
                                                       value='product'/>
                                                <input type="hidden" name='task'
                                                       value='save'/>
                                                <input type="hidden" name='return'
                                                       value='<?php echo $return; ?>'/>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <?php
                    //                    var_dump($products_content);
                    if ($products_content->teamview == 1) {
                        ?>
                        <a class="mo mot"
                           href="<?php echo $config['teamview']; ?>"><?php echo FSText::_("Phần mềm hỗ trợ từ xa Teamview") ?></a>
                    <?php } ?>
                </div>
                <?php
                $lienhe = $model->getlienhe($products_content->id);
                if ($lienhe) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ") ?></a>
                    </div>
                    <?php
                    foreach ($lienhe as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kd = $model->getlienhe_kd($products_content->id);
                if ($lienhe_kd) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ kinh doanh") ?></a>
                    </div>
                    <?php

                    foreach ($lienhe_kd as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kt = $model->getlienhe_kt($products_content->id);
                if ($lienhe_kt) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ hỗ trợ kỹ thuật") ?></a>
                    </div>
                    <?php
                    foreach ($lienhe_kt as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kdmb = $model->getlienhe_kdmb($products_content->id);
                if ($lienhe_kdmb) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ kinh doanh Miền Bắc") ?></a>
                    </div>
                    <?php
                    foreach ($lienhe_kdmb as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>

                        </div>
                    <?php } ?>
                <?php } ?>
                <?php
                $lienhe_kdmn = $model->getlienhe_kdmn($products_content->id);
                if ($lienhe_kdmn) { ?>
                    <div class="them1">
                        <a href=""><?php echo FSText::_("Liên hệ kinh doanh Miền Nam") ?></a>
                    </div>
                    <?php

                    foreach ($lienhe_kdmn as $key) {
                        ?>
                        <div class="taituychon">
                            <div class="kdmbac">
                                <div class="muoi">
                                    <p><?php echo $key->name; ?></p>
                                    <a href="tel:<?php echo str_replace('.', '', $key->phone); ?>"
                                       rel="nofollow"> <?php echo $key->phone; ?></a>
                                </div>
                                <?php if ($key->Zalo) { ?>
                                    <a class="nam" href="http://zalo.me/<?php echo $key->Zalo; ?>" rel="noopener"
                                       target="_blank"></a>
                                <?php } ?>
                                <?php if ($key->Skype) { ?>
                                    <a class="bon" href="skype:<?php echo $key->Skype; ?>?chat" rel="nofollow"></a>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>


            </div>
        </div>
    </div>
</section>
<?php if ($products_content->tawk_to) { 
    ?>
    <?php echo $products_content->tawk_to ?>
<?php } ?>

