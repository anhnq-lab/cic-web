<div class="noidung">
    <div class="row cot">
        <div class="hang hang1">
            <input value="<?php echo @$key; ?>" data-url="<?php echo URL_ROOT. $alias_list_url.'.html' ?>"
                   data-key="key"
                   type="text"
                   class="form-control ipput1" id="input2"
                   name=""
                   placeholder="<?php echo FSText::_('Nhập từ khóa') ?>...">
            <a href="javascrip:void(0)" class="btn_search">
                <img src="images/logos/search2.png" alt="Tìm kiếm">
            </a>
        </div>

        <div class="hang hang1 filter-checkbox-group">
            <label class="collapsible collapsible-active">
                <?php echo FSText::_('Lọc theo lĩnh vực'); ?>
            </label>
            <div class="collapsible-content" id="<?php echo $prefix_id . 'linhvuc' ?>">
                <?php
                $array = explode(',', $linhvuc);
                foreach ($result_cat as $item) {
                    if (in_array($item->alias, $array)) {
                        $a = 'checked';
                    } else {
                        $a = '';
                    }
                    ?>
                    <label class="menu-checkbox">
                        <?php echo $item->name; ?>
                        <input onchange="loadData(this.value)" type="checkbox" name="linhvuc"
                               id="<?php echo 'checkbox-linhvuc-'.$item->alias ?>"
                               value="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'linhvuc'.'&&'.$item->alias.'&&'.$item->name ?>" <?php echo $a; ?>/><span
                                class="checkmark"></span>
                    </label>
                <?php } ?>
            </div>
        </div>
        <div class="hang hang1 filter-checkbox-group">
            <label class="collapsible collapsible-active"><?php echo FSText::_('Lọc theo hãng sản xuất'); ?></label>
            <div class="collapsible-content" id="<?php echo $prefix_id . 'hangsx' ?>">
                <?php
                $array = explode(',', $hangsx);

                foreach ($result_manufactories as $item) {

                    if (in_array($item->alias, $array)) {
                        $a = 'checked';
                    } else {
                        $a = '';
                    }
                    ?>
                    <label class="menu-checkbox">
                        <?php echo $item->name; ?>
                        <input onchange="loadData(this.value)" type="checkbox" name="hangsx"
                               id="<?php echo 'checkbox-hangsx-'.$item->alias ?>"
                               value="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'hangsx'.'&&'.$item->alias.'&&'.$item->name ?>" <?php echo $a; ?>/><span
                                class="checkmark"></span>
                    </label>
                <?php } ?>
            </div>
        </div>
        <div class="hang hang1 filter-checkbox-group">
            <label class="collapsible collapsible-active"><?php echo FSText::_('Lọc theo ứng dụng'); ?></label>
            <div class="collapsible-content" id="<?php echo $prefix_id . 'ungdung' ?>">
                <?php
                $array = explode(',', $ungdung);

                foreach ($result_app as $item) {
                    if (in_array($item->alias, $array)) {
                        $a = 'checked';
                    } else {
                        $a = '';
                    }

                    ?>
                    <label class="menu-checkbox">
                        <?php echo $item->name; ?>
                        <input onchange="loadData(this.value)" type="checkbox" name="ungdung"
                               id="<?php echo 'checkbox-ungdung-'.$item->alias ?>"
                               value="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'ungdung'.'&&'.$item->alias.'&&'.$item->name ?>" <?php echo $a; ?>/><span
                                class="checkmark"></span>
                    </label>
                <?php } ?>
            </div>
        </div>
        <div class="hang hang1 filter-checkbox-group">
            <label class="collapsible collapsible-active"><?php echo FSText::_('Loại sản phẩm'); ?></label>
            <div class="collapsible-content" id="<?php echo $prefix_id . 'loaisp' ?>">
                <?php
                $array = explode(',', $loaisp);

                foreach ($result_types as $item) {
                    if (in_array($item->alias, $array)) {
                        $a = 'checked';
                    } else {
                        $a = '';
                    }
                    ?>
                    <label class="menu-checkbox">
                        <?php echo $item->name ?>
                        <input onchange="loadData(this.value)" type="checkbox" name="loaisp"
                               id="<?php echo 'checkbox-loaisp-'.$item->alias ?>"
                               value="<?php echo URL_ROOT . $alias_list_url.'.html'.'&&'.'loaisp'.'&&'.$item->alias.'&&'.$item->name ?>" <?php echo $a; ?>/><span
                                class="checkmark"></span>
                    </label>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
