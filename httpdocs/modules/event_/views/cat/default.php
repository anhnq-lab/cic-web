<?php
global $tmpl;
// $tmpl->addStylesheet('cat', 'modules/news/assets/css');
$tmpl->addStylesheet('tinchuyenmuc', 'modules/news/assets/css');
$total_news_list = count($list);
$Itemid = 7;
FSFactory::include_class('fsstring');
$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
$lang = FSInput::get('lang');
$id = FSInput::get('id');
$type = FSInput::get('type');
?>

<h2 class="title-module hidden">
    <span><?php echo FSText::_("Công ty cổ phần công nghệ và tư vấn CIC"); ?></span>
</h2>

<section class="tinchuyenmuc">
    <div class="container">
        <div class="section1">
            <h1 class="bkr"><?php echo $cat->name ?></h1>
            <a class="chuyenmuc1" href="<?php if ($lang == 'vi') {
                echo URL_ROOT;
            } else {
                echo URL_ROOT . 'en';
            } ?>"><?php echo FSText::_("Trang chủ") ?> ></a>
            <a class="chuyenmuc1"
               href="<?php echo FSRoute::_("index.php?module=news&view=home"); ?>"><?php echo FSText::_("Tin tức") ?>
                ></a>
            <a class="chuyenmuc1"
               href="<?php echo FSRoute::_('index.php?module=news&view=cat&ccode=' . $cat->alias . '&id=' . $cat->id); ?>"><?php echo $cat->name ?></a>
        </div>
        <div class="section2 row">
            <div class="section2_left col-md-3 col-xs-12">
                <div class="section2_left1">
                    <?php if ($id == 11) { ?>
                        <ul class="sort">
                            <?php
                            foreach ($danhmuc1 as $item) {
//                                $link='';
//                                if ($lang = 'vi'){
//                                $link = URL_ROOT.'quan-he-co-dong-cn11.html?type='.$item->alias;
                                $link = FSRoute::_('index.php?module=news&view=cat&ccode=' . $cat->alias . '&id=' . $cat->id) . '?type=' . $item->alias;
//                                } elseif($lang = 'en'){
//                                    $link .= URL_ROOT.'quan-he-co-dong-cne11.html?type='.$item->alias;
//                                }
//                                var_dump($link);
                                $class = '';
//                            var_dump($item->category_id );
                                if ($item->alias == $type) {
                                    $class = 'active';
                                }
                                ?>
                                <li class=" <?php echo $class; ?> sort1"><a class="muiten"
                                                                            href="<?php echo $link; ?>"><?php echo $item->name; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } else { ?>
                        <ul>
                            <?php
                            foreach ($danhmuc as $item) {
                                $link = FSRoute::_('index.php?module=news&view=cat&ccode=' . $item->alias . '&id=' . $item->id);
                                $class = '';
//                            var_dump($item->category_id );
                                if ($item->id == $id) {
                                    $class = 'active';
                                }
                                ?>
                                <li class=" <?php echo $class; ?>"><a class="muiten"
                                                                      href="<?php echo $link; ?>"><?php echo $item->name; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>

                </div>
                <?php if ($id != 11) { ?>
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
                                <img src="<?php echo $image_resized; ?>" alt="<?php echo $item->title; ?>">
                                <p style="text-align: justify"><?php echo getWord(10, $item->title); ?></p>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <div class="section2_right col-md-9">
                <?php if ($total_news_list) { ?>
                    <?php if ($id == 11) { ?>
                        <?php
                        foreach ($tindanhmuc1 as $item)
                            if ($item->file_upload) {
                                // var_dump($item);
                                $link = URL_ROOT . 'index.php?module=news&view=cat&raw=1&task=download&file_download=' . $item->file_upload;

                                ?>
                                <a class="section2_right1 ct" href="<?php echo $link; ?>">
                                    <img src="<?php echo URL_ROOT . $item->image ?>" class="img1" alt="<?php echo $item->title; ?>">
                                    <div class="section2_right1_1 ">
                                        <h3 class="title title_1"
                                            title="<?php echo $item->title; ?>"><?php echo getWord(25, $item->title); ?></h3>
                                        <p class="time time_1"><?php echo date('d/m/Y', strtotime($item->created_time)); ?></p>
                                    </div>
                                    <img class="d img1"
                                         src="<?php echo URL_ROOT . 'modules/news/assets/images/d.png' ?>" alt="download">
                                </a>
                            <?php } ?>
                    <?php } else { ?>
                        <?php
                        foreach ($tindanhmuc as $item) {
                            // var_dump($item);
                            $image_resized = URL_ROOT . str_replace('/original/', '/large/', $item->image);
                            $link = $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                            ?>
                            <a class="section2_right1" href="<?php echo $link; ?>">
                                <img src="<?php echo $image_resized ?>" class="img-responsive img_11"  alt="<?php echo $item->title; ?>">
                                <div class="section2_right1_1">
                                    <h3 class="title"
                                        style="text-align: justify"
                                        title="<?php echo $item->title; ?>"><?php echo getWord(18, $item->title); ?></h3>
                                    <p class="time"><?php echo date('d/m/Y', strtotime($item->created_time)); ?></p>
                                    <p class="mota" style="text-align: justify"><?php echo getWord(20, $item->summary); ?></p>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
                <?php if ($pagination) { ?>
                    <div class="text-xs-right col-lg-12 col-sm-12 col-xs-12 col-md-12">
                        <nav>
                            <?php echo $pagination->showPagination(3); ?>
                        </nav>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

