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
    $alias_list_url = 'danh-sach-san-pham';
} else {
    $alias_url = 'products';
    $alias_list_url = 'products-list';
}
?>
<section >
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
    <div class="container" style="margin-top: 20px  " data-url="<?php echo URL_ROOT . $alias_list_url . '.html' ?>" id="section-product-list">
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
                        <div><strong><span id="product_count">0</span> sản phẩm</strong></div>
                        <div class="wp-selected-tags">
                            <ul id="filter-tags">
                                <?php
                                $array = explode(',', $linhvuc);
                                foreach ($result_cat as $item) {
                                    if (in_array($item->alias, $array)) { ?>
                                        <li id="<?php echo 'product-linhvuc-'.$item->alias?>"
                                                data-param="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'linhvuc'.'&&'.$item->alias.'&&'.$item->name ?>">
                                            <span><?php echo $item->name?></span> <button type="button">x</button>
                                        </li>
                                   <?php } ?>
                                <?php } ?>
                                <?php
                                $array = explode(',', $hangsx);
                                foreach ($result_manufactories as $item) {
                                    if (in_array($item->alias, $array)) { ?>
                                        <li id="<?php echo 'product-hangsx-'.$item->alias?>"
                                            data-param="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'hangsx'.'&&'.$item->alias.'&&'.$item->name ?>">
                                            <span><?php echo $item->name?></span> <button type="button">x</button>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                $array = explode(',', $ungdung);
                                foreach ($result_app as $item) {
                                    if (in_array($item->alias, $array)) { ?>
                                        <li id="<?php echo 'product-ungdung-'.$item->alias?>"
                                            data-param="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'ungdung'.'&&'.$item->alias.'&&'.$item->name ?>">
                                            <span><?php echo $item->name?></span> <button type="button">x</button>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                $array = explode(',', $loaisp);
                                foreach ($result_types as $item) {
                                    if (in_array($item->alias, $array)) { ?>
                                        <li id="<?php echo 'product-loaisp-'.$item->alias?>"
                                            data-param="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'loaisp'.'&&'.$item->alias.'&&'.$item->name ?>">
                                            <span><?php echo $item->name?></span> <button type="button">x</button>
                                        </li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <div class="filter-action">
                        <div class="sort-a-z <?php echo $order == 'a_z' ? 'sort-active' : '' ?>" id="sort-a-z"
                             data-wat-link="true" data-wat-val="a-z list"
                             data-wat-loc="content">
                            <button data-url="<?php echo URL_ROOT . $alias_list_url . '.html' ?>"
                                    id="sort-a-z-btn"
                            ><i class="fa fa-sort"></i> <?php echo FSText::_("Xem danh sách từ A-Z") ?></button>
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
                    <?php $prefix_id = 'pc';
                    include 'filter.php' ?>
                </div>

                <div class="filter-moblie">
                    <div class="slider-filter" id="sliderFilter">
                        <a href="javascript:void(0)" class="closeFilterBtn" onclick="closeFilter()">× Đóng bộ lọc</a>
                        <?php $prefix_id = 'mobile';
                        include 'filter.php' ?>
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
            <div class="col-md-9 content" id="products-list-content">
                <div class="clearfix"></div>
            </div>
            <!--     END NỘI DUNG TÌM KIÊM       -->
        </div>
    </div>

    <!-- DANH SÁCH SẢN PHẨM   -->
    <div class="container" style="margin-top: 20px; border-top: solid 2px #c4c4c4 ">
        <h2>Danh sách sản phẩm từ A-Z</h2>
        <div class="row" id="products_az">
            <?php
            $j = 0;
            foreach ($products_az as $item) {
                $link = FSRoute::_("index.php?module=products&view=product&id=" . $item->id . "&code=" . $item->alias); ?>
                <div class="col-xs-12 col-sm-8 col-md-3">
                    <div style="margin-bottom: 2rem" class="product-item">
                        <a href="<?php echo $link?>"><?php echo $item->name ?></a>
                    </div>
                </div>

            <?php $j++; if ($j % 4 == 0) { ?>
            <div class="clearfix"></div>
            <?php }} ?>
        </div>
    </div>
</section>
<?php echo $config['tawk_to']; ?>
