<?php
global $tmpl, $config;
$tmpl->addStylesheet('sanpham', 'modules/products/assets/css');
$total_ = count($list);
$Itemid = 9;
$tmpl->addScript('home', 'modules/products/assets/js');
$order = FSInput::get('order', 'all');
$return = $_SERVER['REQUEST_URI'];
$key = FSInput::get('key');
$linhvuc = FSInput::get('linhvuc');
//var_dump($linhvuc);
$hangsx = FSInput::get('hangsx');
$ungdung = FSInput::get('ungdung');
$loaisp = FSInput::get('loaisp');
$lang = FSInput::get('lang');
if ($lang == 'vi') {
    $alias_url = 'san-pham';
} else {
    $alias_url = 'products';
}
$alert_info = array(
    0 => FSText::_('Nhập Từ Khóa'),
    1 => FSText::_('Bạn chưa nhập từ khóa'),
    2 => FSText::_('Bạn chưa chọn tỉnh thành'),
    3 => FSText::_('Bạn chưa nhập email'),
    4 => FSText::_('Email không hợp lệ'),
    5 => FSText::_('Bạn chưa nhập số điện thoại'),
    6 => FSText::_('Số điện thoại không hợp lệ'),
    7 => FSText::_('Vui lòng nhập từ'),
    8 => FSText::_('số'),
    9 => FSText::_('đến'),
    10 => FSText::_('Bạn chưa chọn phiên bản'),
    11 => FSText::_('Nhập mã bảo mật'),
);
?>
<input type="hidden" id="alert_info" value='<?php echo json_encode($alert_info) ?>'/>
<section>
    <h1 class="title-module hidden">
        <span><?php echo FSText::_("cic.com.vn"); ?></span>
    </h1>
    <div class="container">
        <h2 class="breadcrum">
            <?php echo FSText::_("Tất cả sản phẩm") ?>
        </h2>
        <div class="bbb">
            <a href="<?php if ($lang == 'vi') {
                echo URL_ROOT;
            } else {
                echo URL_ROOT . 'en';
            } ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
            <a href="<?php if ($lang == 'vi') {
                echo FSRoute::_('index.php?module=products&view=home');
            } else {
                echo FSRoute::_('index.php?module=products&view=home');
            } ?>"><?php echo FSText::_("Sản phẩm") ?> </a>
            <?php if ($linhvuc) { ?>
                <a href=""><?php echo '>' . $bcr_lv->name ?> </a>
            <?php } ?>
        </div>
    </div>

    <!--        NOI DUNG -->
    <div class="container" style="margin-top: 20px  ">
        <div class="row">
            <div class="filter col-md-3">
                <div class="filter-pc">
                    <div class="tieude">
                        <p><i class="fa fa-filter"></i> <?php echo FSText::_("Tìm kiếm sản phẩm") ?></p>
                    </div>
                </div>
                <div class="filter-moblie">
                    <div class="tieude">
                        <a class="openbtn" onclick="openFilter()"><i
                                class="fa fa-filter"></i> <?php echo FSText::_("Tìm kiếm sản phẩm") ?></a>
                    </div>
                </div>
            </div>

            <div class="col-md-9 content">
                <div class="wp-grid-sort-by">
                    <div class="filter-info">
                        <strong><?php echo count($products_all) ?> sản phẩm</strong>
                    </div>
                    <div class="filter-action">
                        <div class="sort-a-z <?php echo $order == 'a_z' ? 'sort-active' : '' ?>" id="gach1" data-wat-link="true" data-wat-val="a-z list"
                             data-wat-loc="content">
                            <?php
                            $url_lv = "";
                            if ($key) {
                                $url_lv .= "&key=$key";
                            }
                            if ($hangsx) {
                                $url_lv .= "&hangsx=$hangsx";
                            }
                            if ($ungdung) {
                                $url_lv .= "&ungdung=" . $ungdung;
                            }
                            if ($loaisp) {
                                $url_lv .= "&loaisp=$loaisp";
                            }
                            if ($linhvuc) {
                                $url_lv .= "&linhvuc=$linhvuc";
                            }
                            ?>
                            <a href="<?php echo $order != 'a_z' ?  URL_ROOT . $alias_url.'.html?order=a_z'.$url_lv :  URL_ROOT . $alias_url.'.html'.$url_lv ?>"><i class="fa fa-sort    "></i> <?php echo FSText::_("Xem danh sách từ A-Z") ?></a>
                        </div>
                        <div class="refresh">
                            <a href="<?php echo URL_ROOT . $alias_url ?>.html" title="Thiết lập lại">
                                <img src="images/logos/replay.png" alt="Thiết lập lại"> Thiết lập lại
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <!--        BỘ LỌC-->
            <div class="filter col-md-3">
                <div class="filter-pc">
                    <?php $prefix_id = 'pc'; include 'filter.php' ?>
                </div>

                <div class="filter-moblie">
                    <div class="slider-filter" id="sliderFilter">
                        <a href="javascript:void(0)" class="closeFilterBtn" onclick="closeFilter()">× Đóng bộ lọc</a>
                        <?php $prefix_id = 'mobile'; include 'filter.php' ?>
                    </div>
                    <script>
                        function openFilter() {
                            document.getElementById("sliderFilter").style.width = "100%";
                            document.getElementById("sliderFilter").style.height = "100%";
                        }

                        function closeFilter() {
                            document.getElementById("sliderFilter").style.width = "0";
                            document.getElementById("sliderFilter").style.height = "100%";
                        }
                    </script>
                </div>

            </div>
            <!--        END BỘ LỌC -->

            <!--    NỘI DUNG TÌM KIẾM        -->
            <div class="col-md-9 content">
                <div class="danhmuc">
                    <div class="row">
                        <?php
                        $i = 1000;
                        $j = 1;
                        foreach ($products_all as $item) {
                            $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias);
                            $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="dobong product">
                                    <div class="khung all_1"
                                         onmouseover="showTuyChon(<?php echo $item->id ?>)"
                                         onmouseout="hideTuyChon(<?php echo $item->id ?>)">
                                        <a class="dpll" href="<?php if ($item->landing_page) {
                                            echo $item->landing_page;
                                        } else {
                                            echo $link;
                                        } ?>" target="<?php if ($item->landing_page) {
                                            echo '_blank';
                                        } ?>">
                                            <div style="display: flex; align-items: center; min-height: 100px">
                                                <img class="logo1" src="<?php echo $item->icon ?>"
                                                     alt="<?php echo $item->name ?>">
                                                <p class="phanmem"
                                                   title="<?php echo $item->name ?>"><?php echo getWord(10, $item->name) ?></p>
                                            </div>
                                            <div class="chitiet">
                                                <div class="hienthi">
                                                    <div class="gia fgia<?php echo $item->id . 'al'; ?>">
                                                        <p><b>Giá: </b><span class="red"><?php if ($item->price) {
                                                                    echo $item->price;
                                                                } else {
                                                                    echo 'Liên hệ';
                                                                } ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <div>
                                            <p class="thuoctinh thuoctinhall"
                                               id="fthuoctinh<?php echo $item->id . 'al'; ?>"><?php echo getWord(17, $item->summary); ?></p>

                                            <div id="ftuychon<?php echo $item->id . 'al'; ?>" class="ftuychonall">
                                                <div class="tuychon clearfix">
                                                    <div class="lienhe">
                                                        <a href="" type="button" class="btn btn1 btn-info"
                                                           data-toggle="modal"
                                                           data-target="#myModal<?php echo $i; ?>"><?php echo FSText::_("Liên hệ") ?></a>
                                                    </div>
                                                    <?php if ($item->file_download1 or $item->link_download1 or $item->link_download2 or $item->file_download2 or $item->link_download3 or $item->file_download3 or $item->link_download4 or $item->file_download4 or $item->link_download5 or $item->file_download5 or $item->link_download6 or $item->file_download6) { ?>
                                                        <div class="lienhe">
                                                            <!-- <button type="button" class="btn btn-success">Download</button> -->
                                                            <a href="" type="button" class="btn btn1 btn-success "
                                                               data-toggle="modal"
                                                               data-target="#myModaldownload<?php echo $i; ?>"><?php echo FSText::_("Download") ?></a>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="lienhe">
                                                        <a href="" type="button" class="btn btn1 btn-warning"
                                                           data-toggle="modal"
                                                           data-target="#myModalmua<?php echo $i; ?>"><?php echo FSText::_("Đăng ký mua") ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="tuychon clearfix" style="height: auto; min-height: 2rem">
                                                <div class="lienhe">
                                                    <div class="modal fade" id="myModal<?php echo $i; ?>"
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
                                                                                    data-dismiss="modal">&times;
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" role="form"
                                                                              method="post"
                                                                              id="contact_nb<?php echo $item->id; ?>"
                                                                              action="#">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="name_nb<?php echo $item->id; ?>"
                                                                                           name="name"
                                                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="job"
                                                                                           name="company"
                                                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="add"
                                                                                           name="address"
                                                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='city'
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
                                                                                           class="form-control"
                                                                                           id="email_nb<?php echo $item->id; ?>"
                                                                                           name="email"
                                                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="tel"
                                                                                           class="form-control"
                                                                                           id="phone_nb<?php echo $item->id; ?>"
                                                                                           name="phone"
                                                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="note"
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
                                                                                <a href="javascript:changeCaptcha1();"
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
                                                                                       title="GỬI"
                                                                                       data_id="<?php echo $item->id; ?>"
                                                                                       data_type="nb"
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
                                                    <div class="modal fade" id="myModalmua<?php echo $i; ?>"
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
                                                                                    data-dismiss="modal">&times;
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form class="form-horizontal" role="form"
                                                                              method="post"
                                                                              id="dangky_nb<?php echo $item->id; ?>"
                                                                              action="#">
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="namedk_nb<?php echo $item->id; ?>"
                                                                                           name="name"
                                                                                           placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="job"
                                                                                           name="company"
                                                                                           placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="text"
                                                                                           class="form-control"
                                                                                           id="add"
                                                                                           name="address"
                                                                                           placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <select class="form-control"
                                                                                            name='city'
                                                                                            id="citydk_nb<?php echo $item->id; ?>">
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
                                                                                           id="emaildk_nb<?php echo $item->id; ?>"
                                                                                           name="email"
                                                                                           placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                                    <input type="tel"
                                                                                           class="form-control"
                                                                                           id="phonedk_nb<?php echo $item->id; ?>"
                                                                                           name="phone"
                                                                                           placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-sm-12">
                                                                        <textarea rows="4" class="form-control"
                                                                                  name='message' id="note"
                                                                                  placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="check_capcha">
                                                                                <input class="form-control txtCaptcha fl-left"
                                                                                       placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                       type="text"
                                                                                       id="txtCaptchadk_nb<?php echo $item->id; ?>"
                                                                                       value="" name="txtCaptcha"
                                                                                       size="5" required/>
                                                                                <a href="javascript:changeCaptcha1();"
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
                                                                                       title="GỬI"
                                                                                       data_id="<?php echo $item->id; ?>"
                                                                                       data_type="nb"
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
                                                             id="myModaldownload<?php echo $i; ?>"
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
                                                                                        data-dismiss="modal">&times;
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form class="form-horizontal"
                                                                                  role="form"
                                                                                  method="post"
                                                                                  id="download_all<?php echo $item->id; ?>"
                                                                                  action="#">
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="namedl_all<?php echo $item->id; ?>"
                                                                                               name="name"
                                                                                               placeholder="<?php echo FSText::_("Họ tên") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="job"
                                                                                               name="company"
                                                                                               placeholder="<?php echo FSText::_("Đơn vị công tác") ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="text"
                                                                                               class="form-control"
                                                                                               id="add"
                                                                                               name="address"
                                                                                               placeholder="<?php echo FSText::_("Địa chỉ") ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <select class="form-control"
                                                                                                name='city'
                                                                                                id="citydl_all<?php echo $item->id; ?>">
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
                                                                                               id="emaildl_all<?php echo $item->id; ?>"
                                                                                               name="email"
                                                                                               placeholder="<?php echo FSText::_("Email") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <input type="tel"
                                                                                               class="form-control"
                                                                                               id="phonedl_all<?php echo $item->id; ?>"
                                                                                               name="phone"
                                                                                               placeholder="<?php echo FSText::_("Điện thoại di động") ?>*">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-sm-12">
                                                                                        <select class="form-control"
                                                                                                name='version'
                                                                                                id="versiondl_all<?php echo $item->id; ?>">
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
                                                                                  name='message' id="note"
                                                                                  placeholder="<?php echo FSText::_("Ghi chú") ?>"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="check_capcha">
                                                                                    <input class="form-control txtCaptcha fl-left"
                                                                                           placeholder="<?php echo FSText::_('Nhập mã bảo mật'); ?>"
                                                                                           type="text"
                                                                                           id="txtCaptchadl_all<?php echo $item->id; ?>"
                                                                                           value=""
                                                                                           name="txtCaptcha"
                                                                                           size="5" required/>
                                                                                    <a href="javascript:changeCaptcha1();"
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
                                                                                           title="GỬI"
                                                                                           data_id="<?php echo $item->id; ?>"
                                                                                           data_type="all"
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
                                                function showTuyChon(i) {
                                                    if (window.innerWidth > 1023) {
                                                        $(".all_1 #ftuychon" + i + 'al').css('display', 'block');
                                                        $(".all_1 #fthuoctinh" + i + 'al').css('display', 'none');
                                                    }
                                                }

                                                function hideTuyChon(i) {
                                                    if (window.innerWidth > 1023) {
                                                        $(".all_1 #ftuychon" + i + 'al').css('display', 'none');
                                                        $(".all_1 #fthuoctinh" + i + 'al').css('display', 'block');
                                                    }
                                                }
                                            </script>
                                        </div>

                                        <a class="abc fabc<?php echo $item->id; ?>" href="<?php echo $link?>"><?php echo FSText::_("Chi tiết sản phẩm") ?></a>
                                    </div>
                                </div>
                                <script>

                                </script>
                            </div>
                            <?php if ($j % 3 == 0) { ?>
                                <div class="clearfix"></div>
                            <?php }
                            $j++; ?>
                            <?php
                            $i++;
                        } ?>
                    </div>
                    <div class="clearfix"></div>
                    <?php
                    if ($pagination) {
                        echo $pagination->showPagination(3);
                    } ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <!--     END NỘI DUNG TÌM KIÊM       -->
        </div>
    </div>

</section>

<?php echo $config['tawk_to']; ?>
