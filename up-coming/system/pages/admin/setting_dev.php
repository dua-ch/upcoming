<?php
require_once('../../config_session.php');
?>
<div class="page_indata">
    <div id="page_wrapper">
        <div class="page_full">
            <div class="page_element item_page_title">
                <p><i class="fa fa-star"></i> اعدادات المطور</p>
            </div>
        </div>
        <div class="page_full">
            <div class="page_element">
                <div class="boom_form">
                    <div class="setting_element">
                        <p class="label">تشغيل او ايقاف نظام الـ seen للخاص</p>
                        <select onchange="savePrivateSeen();" id="set_private_seen">
                            <option <?php echo selCurrent($data['private_seen'], 0); ?> value="0">ايقاف</option>
                            <option <?php echo selCurrent($data['private_seen'], 1); ?> value="1">تشغيل</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>