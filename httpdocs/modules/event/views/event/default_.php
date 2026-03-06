<?php
global $tmpl, $config;
$tmpl->addStylesheet('chitietsukien', 'modules/event/assets/css');
// $tmpl->addScript('detail', 'modules/news/assets/js');
$url = $_SERVER['REQUEST_URI'];
$url = substr(URL_ROOT, 0, strlen(URL_ROOT) - 1) . $url;
$lang = FSInput::get('lang');
//var_dump($url);die;
//var_dump($tinchitiet);
?>
<h3 class="title-module hidden">
    <span><?php echo FSText::_("Công ty cổ phần công nghệ và tư vấn CIC"); ?></span>
</h3>
<div class="box-chitiet container">
    <div class="section-one">
        <a href="<?php if ($lang == 'vi') {
                        echo URL_ROOT;
                    } else {
                        echo URL_ROOT . 'en';
                    } ?>"><?php echo FSText::_("Trang chủ") ?> > </a>
        <a href="<?php echo FSRoute::_("index.php?module=event&view=home"); ?>"> <?php echo FSText::_("Sự kiện") ?> > </a>
        <a href="<?php echo FSRoute::_("index.php?module=event&view=cat&ccode=" . $sukienchitiet->category_alias . "&id=" . $sukienchitiet->category_id); ?>"> <?php echo $sukienchitiet->category_name; ?>
            > </a>
        <a href="#"> <?php echo $sukienchitiet->title; ?> </a>

    </div>
    <div class="section-two">

        <div class="section2_left1">
            <h2 class="title">
                <?php echo $sukienchitiet->title ?>
            </h2>
            <div class="box-time-place">
                <div class="box-time-item">
                    <p class="time1"><?php echo date('d', strtotime($sukienchitiet->time_event)); ?></p>
                    <p class="time2"><?php echo date('m/Y', strtotime($sukienchitiet->time_event)); ?></p>
                </div>
                <div class="box-chitiet-place">
                    <div class="box-tieude">
                        <p><?= FSText::_('Chủ đề') ?></p>
                        <span class="chude"><?= $sukienchitiet->title ?></span>
                    </div>
                    <div class="box-time-start">
                        <p><?= FSText::_('Thời gian bắt đầu') ?></p>
                        <span><?= $sukienchitiet->specific_time ?></span>
                    </div>
                    <div class="box-place">
                        <p><?= FSText::_('Địa điểm') ?></p>
                        <span><?= $sukienchitiet->place ?></span>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php echo $sukienchitiet->content ?>
            </div>
            <div class="box-dangky">
                <a href="<?= $sukienchitiet -> link_dangky?>" class="dang-ky text-uppercase"><?= FSText::_('Đăng ký ngay') ?></a>
            </div>
            <div class="tag">
                <?php include 'default_tags.php'; ?>
            </div>

            <div class="box-share">
                <span class="grey--text"><?php echo FSText::_("Chia sẻ :") ?></span>
                <div>
                    <a onclick="share_click(600, 600, 'fb')" class="ml-3 mr-3">
                        <svg width="25" height="25" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.8125 2.625C14.5234 2.625 15.125 3.22656 15.125 3.9375V13.5625C15.125 14.3008 14.5234 14.875 13.8125 14.875H10.0391V10.7188H11.625L11.9258 8.75H10.0391V7.49219C10.0391 6.94531 10.3125 6.42578 11.1602 6.42578H12.0078V4.75781C12.0078 4.75781 11.2422 4.62109 10.4766 4.62109C8.94531 4.62109 7.93359 5.57812 7.93359 7.27344V8.75H6.21094V10.7188H7.93359V14.875H4.1875C3.44922 14.875 2.875 14.3008 2.875 13.5625V3.9375C2.875 3.22656 3.44922 2.625 4.1875 2.625H13.8125Z" fill="#1890FF" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="event_related">
                <?php
                $total_content_relate = count($event_related);
                if ($total_content_relate) { ?>
                    <h4 class="title text-uppercase"><?php echo FSText::_('Sự kiện liên quan') ?></h4>
                    <div class="box-event-related">
                        <div class="box-related">
                            <?php
                            foreach ($event_related as $item) {
                                $link = FSRoute::_('index.php?module=event&view=event&code=' . $item->alias . '&id=' . $item->id);
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
                                        <div class="box-time">
                                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.5 20C1.1 20 0.75 19.85 0.45 19.55C0.15 19.25 0 18.9 0 18.5V3C0 2.6 0.15 2.25 0.45 1.95C0.75 1.65 1.1 1.5 1.5 1.5H3.125V0H4.75V1.5H13.25V0H14.875V1.5H16.5C16.9 1.5 17.25 1.65 17.55 1.95C17.85 2.25 18 2.6 18 3V18.5C18 18.9 17.85 19.25 17.55 19.55C17.25 19.85 16.9 20 16.5 20H1.5ZM1.5 18.5H16.5V7.75H1.5V18.5ZM1.5 6.25H16.5V3H1.5V6.25ZM9 12C8.71667 12 8.47917 11.9042 8.2875 11.7125C8.09583 11.5208 8 11.2833 8 11C8 10.7167 8.09583 10.4792 8.2875 10.2875C8.47917 10.0958 8.71667 10 9 10C9.28333 10 9.52083 10.0958 9.7125 10.2875C9.90417 10.4792 10 10.7167 10 11C10 11.2833 9.90417 11.5208 9.7125 11.7125C9.52083 11.9042 9.28333 12 9 12ZM5 12C4.71667 12 4.47917 11.9042 4.2875 11.7125C4.09583 11.5208 4 11.2833 4 11C4 10.7167 4.09583 10.4792 4.2875 10.2875C4.47917 10.0958 4.71667 10 5 10C5.28333 10 5.52083 10.0958 5.7125 10.2875C5.90417 10.4792 6 10.7167 6 11C6 11.2833 5.90417 11.5208 5.7125 11.7125C5.52083 11.9042 5.28333 12 5 12ZM13 12C12.7167 12 12.4792 11.9042 12.2875 11.7125C12.0958 11.5208 12 11.2833 12 11C12 10.7167 12.0958 10.4792 12.2875 10.2875C12.4792 10.0958 12.7167 10 13 10C13.2833 10 13.5208 10.0958 13.7125 10.2875C13.9042 10.4792 14 10.7167 14 11C14 11.2833 13.9042 11.5208 13.7125 11.7125C13.5208 11.9042 13.2833 12 13 12ZM9 16C8.71667 16 8.47917 15.9042 8.2875 15.7125C8.09583 15.5208 8 15.2833 8 15C8 14.7167 8.09583 14.4792 8.2875 14.2875C8.47917 14.0958 8.71667 14 9 14C9.28333 14 9.52083 14.0958 9.7125 14.2875C9.90417 14.4792 10 14.7167 10 15C10 15.2833 9.90417 15.5208 9.7125 15.7125C9.52083 15.9042 9.28333 16 9 16ZM5 16C4.71667 16 4.47917 15.9042 4.2875 15.7125C4.09583 15.5208 4 15.2833 4 15C4 14.7167 4.09583 14.4792 4.2875 14.2875C4.47917 14.0958 4.71667 14 5 14C5.28333 14 5.52083 14.0958 5.7125 14.2875C5.90417 14.4792 6 14.7167 6 15C6 15.2833 5.90417 15.5208 5.7125 15.7125C5.52083 15.9042 5.28333 16 5 16ZM13 16C12.7167 16 12.4792 15.9042 12.2875 15.7125C12.0958 15.5208 12 15.2833 12 15C12 14.7167 12.0958 14.4792 12.2875 14.2875C12.4792 14.0958 12.7167 14 13 14C13.2833 14 13.5208 14.0958 13.7125 14.2875C13.9042 14.4792 14 14.7167 14 15C14 15.2833 13.9042 15.5208 13.7125 15.7125C13.5208 15.9042 13.2833 16 13 16Z" fill="#3E3F3F" />
                                            </svg>
                                            <p>
                                            <p class="time"><?php echo date('d/m/Y H:i', strtotime($item->time_event)); ?></p>
                                        </div>
                                        <div class="box-place ">
                                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8 10C8.55 10 9.02083 9.80417 9.4125 9.4125C9.80417 9.02083 10 8.55 10 8C10 7.45 9.80417 6.97917 9.4125 6.5875C9.02083 6.19583 8.55 6 8 6C7.45 6 6.97917 6.19583 6.5875 6.5875C6.19583 6.97917 6 7.45 6 8C6 8.55 6.19583 9.02083 6.5875 9.4125C6.97917 9.80417 7.45 10 8 10ZM8 17.35C10.0333 15.4833 11.5417 13.7875 12.525 12.2625C13.5083 10.7375 14 9.38333 14 8.2C14 6.38333 13.4208 4.89583 12.2625 3.7375C11.1042 2.57917 9.68333 2 8 2C6.31667 2 4.89583 2.57917 3.7375 3.7375C2.57917 4.89583 2 6.38333 2 8.2C2 9.38333 2.49167 10.7375 3.475 12.2625C4.45833 13.7875 5.96667 15.4833 8 17.35ZM8 20C5.31667 17.7167 3.3125 15.5958 1.9875 13.6375C0.6625 11.6792 0 9.86667 0 8.2C0 5.7 0.804167 3.70833 2.4125 2.225C4.02083 0.741667 5.88333 0 8 0C10.1167 0 11.9792 0.741667 13.5875 2.225C15.1958 3.70833 16 5.7 16 8.2C16 9.86667 15.3375 11.6792 14.0125 13.6375C12.6875 15.5958 10.6833 17.7167 8 20Z" fill="#555555" />
                                            </svg>
                                            <p><?php echo $item->place ?></p>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="section2_right1">
            <div class="event-hot">
                <div class="box-ev-top">
                    <h2 class="is_hot text-uppercase"><?php echo FSText::_('Sự kiện nổi bật') ?></h2>
                </div>
                <div class="content-hot">
                    <div class="box-img">
                        <?php
                        $image_noibat = URL_ROOT . str_replace('/original/', '/small/', $sukiennoibat->image);
                        ?>
                        <img src="<?= $image_noibat ?>" alt="">
                    </div>
                    <div class="content-main">
                        <a href="<?= FSRoute::_('index.php?module=event&view=event&code=' . $sukiennoibat->alias . '&id=' . $sukiennoibat->id) ?>"><?= $sukiennoibat->title ?></a>
                        <div class="box-time">
                            <svg width="18" height="20" viewBox="0 0 18 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5 20C1.1 20 0.75 19.85 0.45 19.55C0.15 19.25 0 18.9 0 18.5V3C0 2.6 0.15 2.25 0.45 1.95C0.75 1.65 1.1 1.5 1.5 1.5H3.125V0H4.75V1.5H13.25V0H14.875V1.5H16.5C16.9 1.5 17.25 1.65 17.55 1.95C17.85 2.25 18 2.6 18 3V18.5C18 18.9 17.85 19.25 17.55 19.55C17.25 19.85 16.9 20 16.5 20H1.5ZM1.5 18.5H16.5V7.75H1.5V18.5ZM1.5 6.25H16.5V3H1.5V6.25ZM9 12C8.71667 12 8.47917 11.9042 8.2875 11.7125C8.09583 11.5208 8 11.2833 8 11C8 10.7167 8.09583 10.4792 8.2875 10.2875C8.47917 10.0958 8.71667 10 9 10C9.28333 10 9.52083 10.0958 9.7125 10.2875C9.90417 10.4792 10 10.7167 10 11C10 11.2833 9.90417 11.5208 9.7125 11.7125C9.52083 11.9042 9.28333 12 9 12ZM5 12C4.71667 12 4.47917 11.9042 4.2875 11.7125C4.09583 11.5208 4 11.2833 4 11C4 10.7167 4.09583 10.4792 4.2875 10.2875C4.47917 10.0958 4.71667 10 5 10C5.28333 10 5.52083 10.0958 5.7125 10.2875C5.90417 10.4792 6 10.7167 6 11C6 11.2833 5.90417 11.5208 5.7125 11.7125C5.52083 11.9042 5.28333 12 5 12ZM13 12C12.7167 12 12.4792 11.9042 12.2875 11.7125C12.0958 11.5208 12 11.2833 12 11C12 10.7167 12.0958 10.4792 12.2875 10.2875C12.4792 10.0958 12.7167 10 13 10C13.2833 10 13.5208 10.0958 13.7125 10.2875C13.9042 10.4792 14 10.7167 14 11C14 11.2833 13.9042 11.5208 13.7125 11.7125C13.5208 11.9042 13.2833 12 13 12ZM9 16C8.71667 16 8.47917 15.9042 8.2875 15.7125C8.09583 15.5208 8 15.2833 8 15C8 14.7167 8.09583 14.4792 8.2875 14.2875C8.47917 14.0958 8.71667 14 9 14C9.28333 14 9.52083 14.0958 9.7125 14.2875C9.90417 14.4792 10 14.7167 10 15C10 15.2833 9.90417 15.5208 9.7125 15.7125C9.52083 15.9042 9.28333 16 9 16ZM5 16C4.71667 16 4.47917 15.9042 4.2875 15.7125C4.09583 15.5208 4 15.2833 4 15C4 14.7167 4.09583 14.4792 4.2875 14.2875C4.47917 14.0958 4.71667 14 5 14C5.28333 14 5.52083 14.0958 5.7125 14.2875C5.90417 14.4792 6 14.7167 6 15C6 15.2833 5.90417 15.5208 5.7125 15.7125C5.52083 15.9042 5.28333 16 5 16ZM13 16C12.7167 16 12.4792 15.9042 12.2875 15.7125C12.0958 15.5208 12 15.2833 12 15C12 14.7167 12.0958 14.4792 12.2875 14.2875C12.4792 14.0958 12.7167 14 13 14C13.2833 14 13.5208 14.0958 13.7125 14.2875C13.9042 14.4792 14 14.7167 14 15C14 15.2833 13.9042 15.5208 13.7125 15.7125C13.5208 15.9042 13.2833 16 13 16Z" fill="#3E3F3F" />
                            </svg>
                            <p>
                            <p class="time"><?php echo date('d/m/Y H:i', strtotime($sukiennoibat->time_event)); ?></p>
                        </div>
                        <div class="box-place">
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 10C8.55 10 9.02083 9.80417 9.4125 9.4125C9.80417 9.02083 10 8.55 10 8C10 7.45 9.80417 6.97917 9.4125 6.5875C9.02083 6.19583 8.55 6 8 6C7.45 6 6.97917 6.19583 6.5875 6.5875C6.19583 6.97917 6 7.45 6 8C6 8.55 6.19583 9.02083 6.5875 9.4125C6.97917 9.80417 7.45 10 8 10ZM8 17.35C10.0333 15.4833 11.5417 13.7875 12.525 12.2625C13.5083 10.7375 14 9.38333 14 8.2C14 6.38333 13.4208 4.89583 12.2625 3.7375C11.1042 2.57917 9.68333 2 8 2C6.31667 2 4.89583 2.57917 3.7375 3.7375C2.57917 4.89583 2 6.38333 2 8.2C2 9.38333 2.49167 10.7375 3.475 12.2625C4.45833 13.7875 5.96667 15.4833 8 17.35ZM8 20C5.31667 17.7167 3.3125 15.5958 1.9875 13.6375C0.6625 11.6792 0 9.86667 0 8.2C0 5.7 0.804167 3.70833 2.4125 2.225C4.02083 0.741667 5.88333 0 8 0C10.1167 0 11.9792 0.741667 13.5875 2.225C15.1958 3.70833 16 5.7 16 8.2C16 9.86667 15.3375 11.6792 14.0125 13.6375C12.6875 15.5958 10.6833 17.7167 8 20Z" fill="#555555" />
                            </svg>
                            <p><?php echo $sukiennoibat->place ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-related">
                <?php include 'default_related_products.php';  ?>
            </div>
        </div>
        <div class="news-related">
            <?php include 'default_related_news.php';  ?>
        </div>
    </div>
</div>



<script>
    function share_click(width, height, type) {
        var leftPosition, topPosition;
        //Allow for borders.
        leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
        //Allow for title and status bars.
        topPosition = (window.screen.height / 2) - ((height / 2) + 50);
        var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
        u = location.href;
        t = document.title;
        if (type === 'fb') {
            window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', windowFeatures);
        }
      
        return false;
    }
</script>