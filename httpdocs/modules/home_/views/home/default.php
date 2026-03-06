<?php
   global $tmpl,$config;
   $tmpl -> addStylesheet('home6','modules/home/assets/css');
   $tmpl -> addStylesheet('owl.carousel.min','libraries/owlcarousel/assets');
   $tmpl -> addStylesheet('owl.theme.default','libraries/owlcarousel/assets');
   $tmpl -> addScript('owl.carousel.min','libraries/owlcarousel');
   $tmpl -> addScript('default','modules/home/assets/js');
?>
<div class="content">
    <div class="text1 col-md-12 maua" >
    	<div class="container">
		    <p><?php echo FSText::_("Chúng tôi có thể giúp bạn thành công")?></p>
		     <span class="separator"></span><span class="separator1_1"></span>
    	</div>
    </div>
	<div class="text2 maua" >
		<div class="container">
			<?php foreach ($banner as $value) {?>
		    <div class="itemtd col-md-5ths col-sm-6 col-xs-12">
<!--		    	<a href="--><?php //echo $value->link ?><!--">-->
				    <img src="<?php echo $value->image ?>" alt="<?php echo $value->name ?>">
				    <h2><?php echo $value->name ?></h2>
				    <p class="them"><?php echo $value->description ?></p>
<!--			    </a>-->
		    </div>
			<?php } ?>
		</div>
    </div>
    <div class="text3" id="mauc">
    	<div class="container">
    		<div class="row">
	            <div class="text3_left col-xs-12 col-md-6">
				        <h2>
                            <?php echo FSText::_("Tổng quan về cic")?>
				        </h2>
				        <?php echo html_entity_decode($config['intro']) ?>
				        <span class="xemthem"><a href="<?php echo html_entity_decode($config['intro_link']) ?>"><?php echo FSText::_("Xem thêm")?></a></span>
			    </div>
			    <div class="text3_right col-xs-12 col-md-6">
			        <?php if ($config['video']){
                    echo html_entity_decode($config['video']) ;
                    }else{
                        echo  '<img src="'.URL_ROOT.$config['image_content'].'" class="img_gt" alt="giới thiệu"/>' ;
                    }
                    ?>
			    </div>
    		</div>
    	</div>
    </div>
	<div class="text4 maua" >
		<div class="container">
		    <p>
                <?php echo FSText::_("Thành tựu nổi bật")?>
		    </p>
		    <span class="separator"></span><span class="separator1_1"></span>
		</div>
	</div>
	<div class="text5 maua">
		<div class="container">
		    <div class="tuhao">
			    <p><?php echo FSText::_("Tự hào 30 năm phát triển và trưởng thành")?></p>
		    </div>
		    <div class="imgtuhao owl-carousel">
		    	<?php foreach ($banner_thanhtuu as $value) {?>
				    <div class="item cup">
				    	<div class="boder_img">
					        <img src="<?php echo $value->image ?>" alt="<?php echo $value->name ?>">
				    	</div>
				    	<div class="textimgtuhao">
					        <p><a href="#"><?php echo $value->name ?></a></p>
				    	</div>
				    </div>
				<?php } ?>
		    </div>

		</div>
	</div>
	<div class="text6" id="maug">
		<div class="container">
		    <div class="tintuc">
			    <p><?php echo FSText::_("Tin tức nổi bật")?></p>
			    <span class="separator"></span><span class="separator1_1"></span>
		    </div>
		    <div class="imgtintuc row">
		    	<?php foreach ($news as $item) {
		    		$image_resized = URL_ROOT . str_replace('/original/', '/resized/', $item->image);
                	$link = FSRoute::_('index.php?module=news&view=news&code=' . $item->alias . '&id=' . $item->id);
                    $link1= FSRoute::_("index.php?module=news&view=cat&ccode=" . $item->category_alias . "&id=" . $item->category_id);
	    		?>
			    <div class="col-xs-12 col-sm-6 col-md-3 st">
                    <a href="<?php echo $link ?>" style="display: block;">
				    <img src="<?php echo $image_resized ?>" alt="<?php echo $item->title; ?>"></a>
				    <a href="<?php echo $link ?>" class="tintuca"><?php echo getWord(15, $item->title); ?></a>
				    <p class="icon_time"><?php echo date('d/m/Y',strtotime($item->created_time)) ?> | <a href="<?php echo $link1 ?>" class="tin"><?php echo $item->category_name; ?></a></p>
				    <p class="tintucb"><?php echo getWord(20, $item->summary); ?></p>
			    </div>
				<?php } ?>
		    </div>
		    <div class="xemtatca">
			    <span><a href="<?php echo FSRoute::_("index.php?module=news&view=home"); ?>"><?php echo FSText::_("Xem tất cả")?></a></span>
		    </div>
		</div>
	</div>
	<div class="text7" id="maud">
		<div class="container">
	        <div>
		       <p><?php echo FSText::_("Khách hàng - đối tác")?></p>
		       <span class="separator"></span><span class="separator1_1"></span>
	        </div>
	        <div class="partner owl-carousel">
	        	<?php
                foreach ($partner as $item) {?>
		        <div class="item doi">
		        	<a href="<?php echo $item->item ?>">
			        	<img src="<?php echo $item->image ?>" class="img-responsive" alt="<?php echo $item->name; ?>">
		        	</a>
                </div>
		    	<?php } ?>
            </div>
      	</div>
    </div>
</div>
