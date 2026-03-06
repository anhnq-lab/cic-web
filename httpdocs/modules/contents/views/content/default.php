<?php
global $tmpl, $config;
$tmpl->addScript('form1');
   $tmpl -> addStylesheet('gioithieu','modules/contents/assets/css');
$tmpl->addScript('content', 'modules/contents/assets/js');
//    $tmpl -> addStylesheet('product','modules/products/assets/css');

$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
//var_dump($url);

$return = base64_encode($url);
$lang = FSInput::get('lang');

//var_dump($return);
// echo 'modules/'.$this->module.'/views/'.$this->view.'/default.php';
?>
<section>
    <h3 class="title-module hidden">
        <span><?php echo FSText::_("Công ty cổ phần công nghệ và tư vấn CIC"); ?></span>
    </h3>
    <div class="container body">
      <h2 class="breadcrum"><?php echo $data->title; ?></h2>
      <div class="bbb">
        <a href="<?php if ($lang == 'vi') { echo URL_ROOT;}else{echo URL_ROOT.'en';} ?>"><?php echo FSText::_("Trang chủ")?> ></a>
        <a href=""><?php echo $data->title; ?></a>
      </div>
      <div class="row cot">
        <div class="rightbody col-xs-12 col-sm-12 col-md-3">
          <div class="menubody">
            <?php
            $Itemid = FSInput::get('Itemid', 1, 'int');
//                    var_dump($Itemid);
            $total = count($menusitem);
            $i = 0;
            $count_children = 0;
            $summner_children = 0;
              foreach ($menusitem as $item) {
                  $link = $item->link ? FSRoute::_($item->link) : '';
//                  var_dump($link);
                  $class = '';
                  if ($link == $url) {
                      $class = 'active';
                  }
                  if ($i == ($total - 1))
                      $class .= ' last-item';

                  $count_children ++;

                  if ($count_children == $summner_children && $summner_children)
                      $class .= ' last-item';
                echo "<div class='tuvan  item $class'>
                  <a class='muiten' target='" . $item->target . "' href='" . $link . "' >" . $item->name . "</a>
                </div>";
                  $i ++;
            } ?>
          </div>          
        </div>
        <div class="col-xs-12 col-sm-12 col-md-9 leftbody">
         <?php echo $data->content; ?>
        </div>
      </div>
    </div>
  </section>





