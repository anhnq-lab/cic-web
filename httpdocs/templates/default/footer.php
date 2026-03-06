<?php

/**
 * Created by PhpStorm.
 * User: ANHPT
 * Date: 11/25/2018
 * Time: 4:14 PM
 */
$module = FSInput::get('module');
// print_r($module);
?>

<div class="footer">
    <div class="text8" id="mauj">
        <div class="container">
            <div class="text8_left col-md-5">
                <?php echo $config['footer'] ?>
            </div>
            <div class="text8_center col-md-2 res">
                <div class="congtycic">
                    <p><?php echo FSText::_('Sản phẩm') ?></p>
                </div>
                <?php echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'bottom', 'group' => '2')); ?>
            </div>
            <div class="text8_center col-md-3 res">
                <div class="congtycic">
                    <p><?php echo FSText::_('Dịch vụ') ?></p>
                </div>
                <?php echo $tmpl->load_direct_blocks('mainmenu', array('style' => 'bottom', 'group' => '5')); ?>
            </div>

            <div class="text8_right col-md-2 res">
                <div class="congtycic">
                    <p><?php echo FSText::_('Kết nối facebook') ?></p>
                </div>
                <div class="fb">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FCIC-Construction-Informatics-Consultancy-JSC-192074964188183%2F&tabs=timeline&width=270&height=190&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=490851365096298" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="text9">
        <div class="container" style="display:flex; justify-content: center; align-items: center; gap:15px; color :#FFF ">
            <div class="mb-0"><?php echo $config['fotter_bottom'] ?> </div>
            <span class="icon10">
                <a target="_blank" href="<?php echo $config['facebook']; ?>"><img src="<?php echo URL_ROOT; ?>images/logos/icon10.png" alt="facebook"></a>
                <a target="_blank" href="<?php echo $config['youtube']; ?>"><img class="ytb" style="max-width: 41px;" src="<?php echo URL_ROOT; ?>images/ytb.png" alt="youtube"></a>
                <!--                <a target="_blank" href="--><?php //echo $config['google']; 
                                                                ?><!--"><img-->
                <!--                            src="--><?php //echo URL_ROOT; 
                                                        ?><!--images/logos/icon12.png"></a>-->
            </span>
        </div>
    </div>
</div>
<style>
    .trang{
        color: #FFF;
    }
</style>
<?php if ($module == 'home') { ?>
    <?php echo $config['tawk_to']; ?>
<?php } ?>