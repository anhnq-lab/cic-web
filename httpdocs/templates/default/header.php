<?php
/**
 * Created by PhpStorm.
 * User: ANHPT
 * Date: 11/25/2018
 * Time: 4:14 PM
 */
$Itemid = FSInput::get('Itemid', 1, 'int');
$module = FSInput::get('module');
$lang = FSInput::get('lang');

?>
<script type="application/ld+json">
{
"@content": "http://schema.org",
"@type": "WebPage",
"name": "CIC",
"logo": {
    "@type": "ImageObject",
	"url": "https://www.cic.com.vn/images/config/logo-cic---copy_1588153964.png",
	"width": {
	      "@type": "QuantitativeValue",
		  "value": 248
		  },
    "height": {
	      "@type": "QuantitativeValue",
		  "value": 112
		  }
 },
"@id": "https://www.cic.com.vn",
"url": "https://www.cic.com.vn",
"image": "https://www.cic.com.vn/images/config/logo-cic---copy_1588153964.png",
"description": "Công ty Cổ phần Công nghệ và Tư vấn CIC đi đầu của dòng sản phẩm phần mềm truyền thống do CIC phát triển trong lĩnh vực xây dựng, quản lý, quy hoạch hay các thiết bị công nghệ mang hàm lượng khoa học cao",
"address": {
       "@type": "PostalAddress",
       "addressLocality": "Hai Bà Trưng",
       "addressCountry": "Việt Nam",
       "addressRegion": "Hà Nội",
       "postalCode": "100000",
       "streetAddress": "Số 37 Lê Đại Hành, P.Lê Đại Hành, Q.Hai Bà Trưng, TP.Hà Nội"
},
"geo": {
   "@type": "GeoCoordinates",
   "latitude": 21.009062,
   "longtitude": 105.847997
},
"potentialAction":{
"@type": "Reservation",
"target": {
   "@type": "EntryPoint",
   "urlTemplate": "https://www.cic.com.vn/lien-he.html",
   "inLanguage": "vn",
   "actionPlatform": [
                "http://schema.org/DesktopWebPlatform",
                "http://schema.org/IOSPlatform",
                "hhtp://schema.org/AndroidPlatform"
                ]
   },
 "result": {
     "@type": "Reservation",
     "name": "lien-he"
     }
  },
 "openingHoursSpecification": [
  {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday"
    ],
    "opens": "8:00",
    "closes": "17:00"
    }
 ],
 "samAs" : [ "https://www.facebook.com/CICTechnologyandConsultancyVN/",
             "https://www.youtube.com/channel/UCVrD2Lw1V96ggdwQNs87qEQ",
             "https://www.linkedin.com/in/c%C3%B4ng-ty-cp-c%C3%B4ng-ngh%E1%BB%87-v%C3%A0-t%C6%B0-v%E1%BA%A5n-cic/"]
}</script>
    <header id="boder" class="module_<?php echo $module ?>">
        <!--    <img class="bg_home" src="../../images/bg_home.jpg" alt="">-->
        <nav id="navmenu">
            <div class="container navtotal relative">

                <div class="language">
                    <?php if ($lang == 'vi') { ?>
                        <a href="<?php echo URL_ROOT ?>"><img class="logo"
                                                              src="<?php echo $module == 'home' ? URL_ROOT . $config['logo_white'] : URL_ROOT . $config['logo'] ?>" alt="CIC"></a>
                    <?php } else { ?>
                        <a href="<?php echo URL_ROOT . 'en' ?>"><img class="logo"
                                                                     src="<?php echo $module == 'home' ? URL_ROOT . $config['logo_white'] : URL_ROOT . $config['logo'] ?>" alt="CIC"></a>
                    <?php } ?>
                </div>
                <?php if ($module == 'home' or $module == 'contents' or $module == 'contact' or $module == 'images' or $module == 'services' or $module == 'search') {
                    ?>
                    <h1 class="title_comp"><?php echo FSText::_('Công ty Cổ phần Công nghệ và Tư vấn CIC') ?></h1>
                <?php } ?>
                <div class="manu">
                    <!--block main menu-->
                    <?php echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'megamenu', 'group' => '1')); ?>
                </div>
                <div class="col-md-3 col-sm-2 col-xs-2 tab pd">
                    <div id="page">
                        <div class="header_menu">
                            <a href="#mySidenav">
<!--                                <i class="fa fa-bars"></i>-->
                                <?php if ($Itemid ==1) {?>
                                    <img src="<?php echo URL_ROOT.'templates/default/images/Path 441.svg' ?>" alt="search">
                                <?php }else{ ?>
                                    <img src="<?php echo URL_ROOT.'templates/default/images/Path 44.svg' ?>" alt="search">

                                <?php } ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="search_mobile">
                    <a class="searchh" data-toggle="collapse" href="#collapseExample" role="button">
<!--                        <i class="fa fa-search"></i>-->
                        <?php if ($Itemid ==1) {?>
                            <img src="<?php echo URL_ROOT.'templates/default/images/search1.png' ?>" alt="search">
                        <?php }else{ ?>
                            <img src="<?php echo URL_ROOT.'templates/default/images/search.png' ?>" alt="search">

                        <?php } ?>
                    </a>
<!--                    <div id="collapseOne" class="panel-collapse collapse in">-->
<!--                        -->
<!--                    </div>-->
                </div>
                <div class="timkiem absolute">
                    <div class="flr fll collapse" id="collapseExample">
                        <!--block searh-->
                        <?php echo $tmpl->load_direct_blocks('search', array('style' => 'default')); ?>
                    </div>
                </div>
                <div class="flr flr1">
                    <?php if ($lang == 'vi') { ?>
                        <a href="<?php echo URL_ROOT . 'en'; ?>">
                            <img class="imgcc" src="<?php echo URL_ROOT; ?>images/logos/logo.png" alt="ngôn ngữ">
                            <p class="lang"><?php echo  FSText::_('EN') ?></p>
                        </a>
                    <?php } else { ?>
                        <a href="<?php echo URL_ROOT; ?>">
                            <img class="imgcc" style="width: 24px; height: 19px;"
                                 src="<?php echo URL_ROOT; ?>images/logos/vi.jpg" alt="ngôn ngữ">
                            <p class="lang"><?php echo  FSText::_('VI') ?></p>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </nav>
        <?php echo $module == 'home' ? $tmpl->load_direct_blocks('slideshow', array('style' => 'default')) : ''; ?>
    </header>
<?php if ($module != 'home') { ?>
    <div class="bot"></div>
    <div class="headerbotom">
        <img id="anh" src="<?php echo URL_ROOT ?>images/logo/a3.png">
    </div>
<?php } ?>