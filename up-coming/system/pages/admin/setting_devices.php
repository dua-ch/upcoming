<?php
require_once('../../config_session.php');
?>
<div class="page_indata">
    <div id="page_wrapper">
        <div class="page_full">
            <div class="page_element item_page_title">
                <p><i class="fa fa-desktop"></i> حجب الاجهزة</p>
            </div>
        </div>
        <div class="page_full">
            <div class="page_element" id="seo_page_list">
                <?php echo getBannedDevices(); ?>
            </div>
        </div>
    </div>
</div>