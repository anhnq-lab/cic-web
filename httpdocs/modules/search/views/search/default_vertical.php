<?php
global $tmpl, $config;
$class = '';
$keyword_uri = encodeURIComponent($keyword);
?>
<div class="container">
    <h2 class="title-head margin-bottom-20"><?php echo FSText::_("Sản phẩm phù hợp với từ khóa") ?>
        '<?php echo $keyword; ?>'</h2>
</div>

<div class="clearfix"></div>
<div class="products-view-grid products cls_search container">
    <div class="    danhmuc">
        <div class="row">
            <?php
            // var_dump($list);
            $i = 1;
            $j = 1;
            foreach ($list as $item) {
                $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                ?>
                <div class="col-xs-12 col-sm-6 col-md-3">
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
                <?php if ($j % 4 == 0) { ?>
                    <div class="clearfix"></div>
                <?php }
                $j++; ?>
                <?php
                $i++;
            } ?>
        </div>
    </div><!--end: .vertical-->
</div><!--end: .vertical-->
<?php if ($pagination) { ?>
    <div class="text-xs-right col-lg-12 col-sm-12 col-xs-12 col-md-12" style="text-align: center;margin-top: 15px;">
        <nav>
            <?php echo $pagination->showPagination(3); ?>
        </nav>
    </div>
<?php } ?>
<style>
    .pagination {
        float: none;
    }
</style>
