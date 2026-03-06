<!--	RELATE EVENT		-->
<?php
$total_content_relate = count($products_related);
if($total_content_relate){ ?>
    <h4 class="title text-uppercase"><?php echo FSText::_('Sản phẩm liên quan')?></h4>

    <div class="section3">
        <div class="box-related">
            <?php
            foreach ($products_related as $item) {
                $link = FSRoute::_('index.php?module=products&view=products&code=' . $item->alias . '&id=' . $item->id);
                $image_small = URL_ROOT . str_replace('/original/', '/small/', $item->image);
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
            <?php } ?>
        </div>
    </div>
<?php } ?>
<!--	end RELATE CONTENT		-->
