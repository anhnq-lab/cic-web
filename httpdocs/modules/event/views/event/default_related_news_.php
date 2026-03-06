<!--	RELATE EVENT		-->
<?php
$total_content_relate = count($news_related);
if ($total_content_relate) { ?>
    <div class="news-related-main">
        <div class="news-head">
            <h4 class="title text-uppercase"><?php echo FSText::_('Tin bài nổi bật') ?></h4>
        </div>

        <div class="section3">
            <div class="box-related">

                <?php
                foreach ($news_related as $item) {
                    $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                    $image_small = URL_ROOT . str_replace('/original/', '/original/', $item->image);
                    // print_r($item);
                ?>
                    <div class="box-ev">
                        <div class="box-img">
                            <a href="<?php echo $link; ?>" class="anhdemo"><img src="<?php echo $image_small ?>" alt="<?php echo $item->title; ?>"></a>
                        </div>
                        <div class="box-content">
                            <div class="content">
                                <a href="<?php echo $link ?> " class="title_demo">
                                    <?php echo $item->title; ?>
                                </a>
                            </div>
                        </div>

                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <!--	end RELATE CONTENT		-->