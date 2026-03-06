<!--	RELATE NEWS		-->
<?php
$total_content_relate = count($news_related);
if($total_content_relate){ ?>
    <h4 class="title">Tin liên quan</h4>

    <div class="section3">
        <div class="row">
            <?php
            foreach ($news_related as $item) {
                $link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                $image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                ?>
                <div class="col-md-4 tinlienquan">
                    <a href="<?php echo $link; ?>"><img src="<?php echo $image_resized; ?>" alt="<?php echo getWord(10, $item->title); ?>"></a>
                    <p><a href="<?php echo $link; ?>"><?php echo getWord(12, $item->title); ?></a></p>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<!--	end RELATE CONTENT		-->
