<!--	RELATE CONTENT		-->
<?php
$total_content_relate = count($products_related);
if ($total_content_relate) { ?>

    <div class="product-related-main">
        <div class="product-head">
            <h4 class="title text-uppercase"><?php echo FSText::_('Sản phẩm liên quan') ?></h4>
        </div>
        <?php
        for ($i = 0; $i < $total_content_relate; $i++) {
            $item = $products_related[$i];
            $link = FSRoute::_('index.php?module=products&view=product&code=' . $item->alias . '&ccode=' . $item->category_alias . '&id=' . $item->id);
        ?>
            <div class="box-ev">
                <div class="item-product">
                    <a class="item-image" href="<?php echo $link; ?>" title="<?php echo $item->name ?>">
                        <img class="img-responsive img_news" alt="<?php echo $item->name; ?>" src="<?php echo URL_ROOT . str_replace('/original/', '/large/', $item->image); ?>" />
                    </a>
                    <div class="box-content">
                        <div class="content" style="margin: 20px 0;">
                            <a href="<?php echo $link ?> " class="title_demo">
                                <?php echo $item->name; ?>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <?php //echo ($i+1)%4==0? '<div class="clearfix"></div>':'' 
            ?>
        <?php } ?>
    </div>
<?php } ?>
<!--	end RELATE CONTENT		-->