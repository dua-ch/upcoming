<?php
require_once('../config_session.php');
if (!boomAllow(100)) {
    die();
}
?>
<style>
    .trsetting {
        background: #1a1a1a;
        border-radius: 5px;
        padding: 0;
    }

    .trtext {
        color: #1a1a1a;
        background: #cbcbcb;
        padding: 10px 0;
    }

    .trlabel {
        padding: 3px 0 5px 0;
    }
</style>
<div style="background: black;" class="pad_box centered_element">
    <div class="setting_element trsetting">
        <p class="text_med bold trtext">ترافيك الرابط الرئيسي</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('direct'); ?> user/s</p>
    </div>
    <div class="setting_element trsetting">
        <p class="text_med bold trtext">ترافيك من الدعوات</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('referer'); ?> user/s</p>
    </div>
	<div class="setting_element trsetting">
        <p class="text_med bold trtext">ترافيك من الاعلانات</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('ads'); ?> user/s</p>
    </div>
    <div class="setting_element trsetting">
        <p class="text_med bold trtext">ترافيك جوجل</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('google'); ?> user/s</p>
    </div>
    <div class="setting_element trsetting">
        <p class="text_med bold trtext">ترافيك فيسبوك</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('facebook'); ?> user/s</p>
    </div>
    <div class="setting_element trsetting">
        <p class="text_med bold trtext">ترافيك انستقرام</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('insta'); ?> user/s</p>
    </div>
    <div class="setting_element trsetting">
        <p class="text_med bold trtext">ترافيك تويتر</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('twitter'); ?> user/s</p>
    </div>
    <div class="setting_element trsetting">
        <p class="text_med bold trtext">مجموع الترافيك الكامل للدردشة</p>
        <p class="label success trlabel">Traffic Count : <?php echo trafficCounter('others'); ?> user/s</p>
    </div>
</div>