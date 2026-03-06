<?php
global $tmpl, $config;
$tmpl->addStylesheet('tinchitiet', 'modules/news/assets/css');
$tmpl->addScript('detail', 'modules/news/assets/js');
$tmpl->addScript('jquery_toc', 'modules/news/assets/js');
$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
$lang = FSInput::get('lang');

//var_dump($url);die;
//var_dump($tinchitiet);
?>
<h3 class="title-module hidden">
    <span><?php echo FSText::_("Công ty cổ phần công nghệ và tư vấn CIC"); ?></span>
</h3>

<section class="tinchitiet">
    <div class="container">
        <div class="section1">
            <p class="bkr"><?php echo $tinchitiet->category_name; ?></p>
            <a href="<?php if ($lang == 'vi') {
                            echo URL_ROOT;
                        } else {
                            echo URL_ROOT . 'en';
                        } ?>"><?php echo FSText::_("Trang chủ") ?> > </a>
            <a href="<?php echo FSRoute::_("index.php?module=news&view=home"); ?>"> <?php echo FSText::_("Tin tức") ?> > </a>
            <a href="<?php echo FSRoute::_("index.php?module=news&view=cat&ccode=" . $tinchitiet->category_alias . "&id=" . $tinchitiet->category_id); ?>"> <?php echo $tinchitiet->category_name; ?>
                > </a>
            <a href="#"> <?php echo $tinchitiet->title; ?> </a>
        </div>



        <div class="section2 row">
            <div class="section2_left col-md-3">
                <div class="section2_left1">
                    <ul>
                        <?php
                        foreach ($danhmuc as $item) {
                            //                            var_dump($item);
                            $link = FSRoute::_('index.php?module=news&view=cat&ccode=' . $item->alias . '&id=' . $item->id);
                            $class = '';
                            //                            var_dump($item->category_id );
                            if ($item->id == $tinchitiet->category_id) {
                                $class = 'active';
                            }
                        ?>
                            <li class="item <?php echo $class; ?>"><a class="muiten " href="<?php echo $link; ?>"><?php echo $item->name; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>

                <!--                BAI VIET NOI BAT -->
                <div class="section2_left2">
                    <strong><?php echo FSText::_("Bài viết nổi bật") ?></strong>
                </div>
                <div class="noibat clearfix">
                    <?php
                    foreach ($is_home as $item) {
                        $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                        $image_resized = URL_ROOT . str_replace('/original/', '/small/', $item->image);
                    ?>
                        <a class="section2_left3 col-xs-12 col-sm-6 col-md-12" href="<?php echo $link ?>">
                            <img src="<?php echo $image_resized; ?>" alt="<?php echo getWord(10, $item->title); ?>">
                            <p><?php echo getWord(12, $item->title); ?></p>
                        </a>
                    <?php } ?>
                </div>
                <?php if ((strpos($tinchitiet->content, 'h2') == true)) { ?>
                    <div class="row">
                        <div class=" col-md-8">
                            <div class="toc-content rounded mb-4" id="left1">
                                <div class="title-toc-list d-flex justify-content-between p-3">
                                    <h3 class="title-toc"><i class="fa fa-bars mr-1 "></i><span style="font-size: 20px; color:#2aaee4" class="title"><?php echo FSText::_('Nội dung chính') ?></span></h3>
                                    <span class="button-select d-flex gap-2 align-items-center">
                                        <span class="tablecontent none">
                                            <img src="/images/index.svg" alt="mục lục">
                                        </span>
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </div>
                                <div class="list-toc">
                                    <ol id="toc" class="p-3 pb-0"></ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                <?php } ?>
                <!--                END -->

            </div>
            <div class="section2_right col-md-9">
                <!-- $image_resized = URL_ROOT . str_replace('/original/', '/small/', $item->image); -->

                <div class="section2_right1">
                    <h1><?php echo $tinchitiet->title; ?></h1>
                </div>
                <div class="section2_right2">
                    <p class="time"><?php echo date('d/m/Y', strtotime($tinchitiet->created_time)); ?></p>
                    <p class="view"><?php echo FSText::_("Lượt xem") ?> <?php echo $data->hits; ?></p>
                    <input type="hidden" name='hits' id="news_id" value='<?php echo $data->id; ?>' />
                    <!--                    <div class="like_fb">-->
                    <!--                        --><?php
                                                    //                        include 'default_share_bottom.php';
                                                    //                        
                                                    ?>
                    <!--                    </div>-->
                </div>
                <div class="section2_right3">
                    <p class="content1" style="text-align: justify;"> <?php echo $tinchitiet->summary; ?></p>
                </div>
                <div class="section2_right4">
                    <p class="content2"><?php echo $tinchitiet->content; ?></p>
                </div>
                <!--                <div class="cmt_fb">-->
                <!--                    --><?php
                                            //                        include 'comment_facebook.php';
                                            //                    
                                            ?>
                <!--                </div>-->
                <!--                <div class="like_fb">-->
                <!--                    --><?php
                                            //                    include 'default_share_bottom.php';
                                            //                    
                                            ?>
                <!--                </div>-->
                <div class="tag">
                    <?php
                    include 'default_tags.php';
                    ?>
                </div>
                <hr>
                <div class="news_related">
                    <?php
                    include 'default_related_news.php';
                    ?>
                </div>
                <div class="products_related">
                    <?php
                    include 'default_related_products.php';
                    ?>
                </div>

            </div>
        </div>
    </div>



    </div>
</section>

