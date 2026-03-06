<?php
global $config, $tmpl, $user;
$Itemid = FSInput::get('Itemid', 1, 'int');
$lang = FSInput::get('lang');
$logo = URL_ROOT . $config['logo'];
$tmpl->addStylesheet('fontawesome-all.min', 'libraries/font-awesome/css');
$tmpl -> addStylesheet('home6','modules/home/assets/css');
$tmpl->addScript('form1', 'templates/default/js');
?>
<div>
    <div class="hidden-md hidden-lg opacity_menu"></div>
    <div class="opacity_filter"></div>
    <div class="body_opactiy"></div>


<?php include 'header.php';  // thong bao ?>

<?php if ($Itemid == 4) { ?>
    <?php // echo $tmpl->load_direct_blocks('breadcrumbs', array('style' => 'simple')); ?>
<?php } ?>

<?php
include 'main.php';  // thong bao
include 'footer.php';  // thong bao
include 'notification.php';  // thong bao
?>



<?php  echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'megamenu_moblie', 'group' => '1')); ?>
