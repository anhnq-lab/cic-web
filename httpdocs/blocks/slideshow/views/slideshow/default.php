<?php
global $tmpl, $config;
//$tmpl->addStylesheet('1657a', 'modules/home/assets/css');

$tmpl->addStylesheet('style2', 'blocks/library/assets/css');
$tmpl->addScript('TweenLite.min', 'blocks/library/assets/js');
$tmpl->addScript('EasePack.min', 'blocks/library/assets/js');
$tmpl->addScript('demo', 'blocks/library/assets/js');

?>
<div class="container-fluid demo slide11">
    <div class="content content22">
        <div id="large-header" class="large-header">
            <canvas id="demo-canvas"></canvas>
            <!-- <h1 class="main-title"><span class="thin">Explore</span> Space</h1> -->
            <div class="container main-title">
                <div class="row">
                    <div class="col-lg-3 col1 col-sm-6 col-xs-6">
                        <a class="row" href="<?php echo $slideshow[0]->url;?>">
                            <div class="item-box type1">
                                <img class="rotate3601 circle1" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-1.png" height="auto" width="100%" alt="hình ảnh">
                                <img class="rotate360 circle2" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-2.png" height="auto" width="87%" alt="hình ảnh">
                                <img class="rotate3602 circle3" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-3.png" height="auto" width="80%" alt="hình ảnh">
                                <img class="circle4" src="<?php echo URL_ROOT.$slideshow[0]->image; ?>" height="auto" width="60%" alt="<?php echo $slideshow[0]->name; ?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col1 col-sm-6 col-xs-6 style1">
                        <a class="row" href="<?php echo $slideshow[1]->url;?>">
                            <div class="item-box type1">
                                <img class="rotate3601 circle1" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-1.png" height="auto" width="100%" alt="hình ảnh">
                                <img class="rotate360 circle2" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-2.png" height="auto" width="87%" alt="hình ảnh">
                                <img class="rotate3602 circle3" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-3.png" height="auto" width="80%" alt="hình ảnh">
                                <img class="circle4" src="<?php echo URL_ROOT.$slideshow[1]->image; ?>" height="auto" width="80%" style="margin: 10% 12%;" alt="<?php echo $slideshow[1]->name; ?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col2 col-sm-12 style2">
                        <a class="row" href="<?php echo $slideshow[2]->url;?>">
                            <div class="item-box type3">
                                <img class="rotate3601 circle1" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-1.png" height="auto" width="100%" alt="hình ảnh">
                                <img class="rotate360 circle2" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-2.png" height="auto" width="87%" alt="hình ảnh">
                                <img class="rotate3602 circle3" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-3.png" height="auto" width="80%" alt="hình ảnh">
                                <img class="circle4" src="<?php echo URL_ROOT.$slideshow[2]->image; ?>" height="auto" width="60%"  alt="<?php echo $slideshow[2]->name; ?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col1 col-sm-6 col-xs-6 style1">
                        <a class="row" href="<?php echo $slideshow[3]->url;?>">
                            <div class="item-box type2">
                                <img class="rotate3601 circle1" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-1.png" height="auto" width="100%" alt="hình ảnh">
                                <img class="rotate360 circle2" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-2.png" height="auto" width="87%" alt="hình ảnh">
                                <img class="rotate3602 circle3" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-3.png" height="auto" width="80%" alt="hình ảnh">
                                <img class="circle4" src="<?php echo URL_ROOT.$slideshow[3]->image; ?>" height="auto" width="60%" alt="<?php echo $slideshow[3]->name; ?>">
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col1 col-sm-6 col-xs-6">
                        <a class="row" href="<?php echo $slideshow[4]->url;?>">
                            <div class="item-box type2">
                                <img class="rotate3601 circle1" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-1.png" height="auto" width="100%" alt="hình ảnh">
                                <img class="rotate360 circle2" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-2.png" height="auto" width="87%" alt="hình ảnh">
                                <img class="rotate3602 circle3" src="<?php echo URL_ROOT; ?>blocks/library/assets/images/1-3.png" height="auto" width="80%" alt="hình ảnh">
                                <img class="circle4" src="<?php echo URL_ROOT.$slideshow[4]->image; ?>" height="auto" width="60%" alt="<?php echo $slideshow[4]->name; ?>">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

