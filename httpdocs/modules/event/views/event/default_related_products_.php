<!--	RELATE EVENT		-->
<?php
$total_content_relate = count($products_related);
if ($total_content_relate) { ?>

    <div class="product-related-main">
        <div class="product-head">
            <h4 class="title text-uppercase"><?php echo FSText::_('Sản phẩm liên quan') ?></h4>
        </div>
        <div class="section3">
            <div class="box-related">
                <?php
                foreach ($products_related as $item) {
                    $link = FSRoute::_('index.php?module=products&view=products&code=' . $item->alias . '&id=' . $item->id);
                    // print_r($item);
                ?>
                    <div class="box-ev">
                        <div class="box-img">
                            <img class="logo" src="<?php echo $item->icon ?>" alt="<?php echo $item->name; ?>">
                        </div>
                        <div class="box-content">
                            <div class="content">
                                <a href="<?php echo $link ?> " class="title_demo">
                                    <?php echo $item->name; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>