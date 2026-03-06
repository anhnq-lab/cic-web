<?php
global $tmpl, $config;
// $tmpl->addStylesheet('cat', 'modules/news/assets/css');
$tmpl->addStylesheet('tintuc', 'modules/news/assets/css');
$total_news_list = count($list);
$Itemid = 7;
FSFactory::include_class('fsstring');
$lang = FSInput::get('lang');

?>
<h1 class="title-module hidden">
    <span><?php echo FSText::_("cic.com.vn"); ?></span>
</h1>

<h2 class="title-module hidden">
    <span><?php echo FSText::_("Công ty cổ phần công nghệ và tư vấn CIC"); ?></span>
</h2>
<section class="tintuc">
    <div class="container">
        <div class="section1">
            <p class="content1"><?php echo FSText::_("Tin tức") ?></p>
            <a href="<?php if ($lang == 'vi') {
                echo URL_ROOT;
            } else {
                echo URL_ROOT . 'en';
            } ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
            <a href="#"><?php echo FSText::_("Tin tức") ?></a>
        </div>

        <div id="carousel-example-generic" class="carousel slide section2" data-ride="carousel">
            <!-- Indicators -->
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <?php
                $i = 1;
                foreach ($show_home as $item) {
                    $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                    $image_resized = URL_ROOT . str_replace('/original/', '/large/', $item->image);
                    $active = '';
                    if ($i == 1) {
                        $active = 'active';
                    }
                    ?>

                    <div class="item row  <?php echo $active ?>">
                        <div class=" col-md-6 section2_left">
                            <a href="<?php echo $link; ?>">
                                <img src="<?php echo $image_resized ?>" class="img-responsive" alt="<?php echo $item->title; ?>">
                            </a>
                        </div>
                        <div class="col-md-6 section2_right">
                            <a href="<?php echo $link; ?>">
                                <h3 class="title" style="text-align: justify"><?php echo getWord(12, $item->title); ?></h3>
                            </a>
                            <p class="time"><?php echo date('d/m/Y', strtotime($item->created_time)); ?></p>
                            <h4 class="summary" style="text-align: justify"><?php echo getWord(50, $item->summary); ?></h4>
                            <a type="button" class="btn btn-info"
                               href="<?php echo $link; ?>"><?php echo FSText::_("Xem chi tiết") ?></a>
                        </div>
                    </div>
                    <?php $i++;
                } ?>

            </div>

            <!-- Controls -->
            <a class="left carousel-control prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control prev" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>

        <div class="section3 row">
            <?php
            foreach ($news_hot as $item) {
                $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                ?>
                <div class="col-xs-12 col-sm-6 col-md-3">
                    <a href="<?php echo $link; ?>" class="anhdemo"><img src="<?php echo $image_resized ?>" alt="<?php echo $item->title; ?>"></a>
                    <p><a href="#"><?php echo getWord(12, $item->title); ?></a></p>
                </div>
            <?php } ?>

        </div>

        <div class="section4">
            <img src="<?php echo URL_ROOT . $config['banner_new']; ?>" alt="hình ảnh">
        </div>
        <div class="section5 row">
            <?php
            $j = 1;
            //            var_dump($news2);
            foreach ($news2 as $item) {
                $link = FSRoute::_('index.php?module=news&view=cat&ccode=' . $item->alias . '&id=' . $item->id);
                $news_hot = $model->get_tinnoibat1($item->id);
                // var_dump($news_hot);
//var_dump($link);
                ?>
                <div class="section5_left col-md-6">
                    <a class="section5_l" href="<?php echo $link; ?>">
                        <p><?php echo $item->name; ?></p>
                    </a>

                    <?php
                    $i = 1;
                    foreach ($news_hot as $key) {
                        $link = FSRoute::_('index.php?module=news&view=news&code=' . $key->alias . '&id=' . $key->id);
                        $image_resized = URL_ROOT . str_replace('/original/', '/large/', $key->image);
                        // var_dump($news_hot);
                        ?>
                        <?php if ($i == 1) { ?>
                            <a class="section5_left2" href="<?php echo $link; ?>">
                                <img src="<?php echo $image_resized ?>" class="img-responsive" alt="<?php echo $key->title; ?>">
                                <div>
                                    <h3 class="new_title" style="text-align: justify"><?php echo getWord(25, $key->title); ?></h3>
                                    <p class="section5_text" style="text-align: justify"><?php echo getWord(20, $key->summary); ?></p>
                                </div>
                            </a>
                        <?php } else { ?>
                            <a href="<?php echo $link; ?>"
                               class="section5_a"><?php echo getWord(15, $key->title); ?></a>
                        <?php } ?>


                        <?php $i++;
                    } ?>
                </div>

                <?php if ($j % 2 == 0) { ?>
                    <div class="clearfix"></div>
                <?php }
                $j++; ?>

            <?php } ?>
        </div>
    </div>
</section>