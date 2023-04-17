<?php
require_once('../system/config.php');
require_once('Aconfig.php');
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<link rel="shortcut icon" type="image/png" href="../default_images/icon.png" />
<link rel="stylesheet" type="text/css" href="../css/selectboxit.css" />
<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css" />
<link rel="stylesheet" type="text/css" href="../css/themes/Dark/dark.css" />
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<link rel="stylesheet" type="text/css" href="../css/responsive.css" />
<link rel="stylesheet" type="text/css" href="../css/rtl.css" />
<link rel="stylesheet" type="text/css" href="../css/colors.css" />
<script src="../js/jquery-1.11.2.min.js"></script>
<script src="js/install.js"></script>
<script data-cfasync="false" src="../js/fancybox/jquery.fancybox.js"></script>
<script data-cfasync="false" src="../js/jqueryui/jquery-ui.min.js"></script>
<script src="../js/global.min.js"></script>
<div id="page_content">
	<div id="page_global">
		<div style="max-width: 1100px;margin: 0 auto;height: auto;padding: 20px 0px;width:100%;" class="page_indata">
			<div id="page_wrapper">
				<div class="page_full">
					<div class="page_element">
						<div class="page_top_elem">
							<div class="bold page_top_title">
								<i class="fa fa-file-text"></i> الشروط والقوانين</div>
						</div>
					</div>
				</div>
				<div class="page_full">
					<div class="page_element">
						<p class="bold">بعض الاشياء التي لا يُسمح لك بفعلها</p>
						<ul class="list lite">
							<li><i class="fa fa-times error"></i> لا يمكنك إعادة بيع هذه الاضافات لأي شخص</li>
							<li><i class="fa fa-times error"></i> لا يمكنك إضافة تعديلات في البرمجه الاساسيه للاضافة او استخدامها في اضافة أخرى</li>
							<li><i class="fa fa-times error"></i> لا يمكنك العبث بأي ملف من ملفات الاضافات</li>
							<li><i class="fa fa-times error"></i> في حالة تم أكتشاف أنك قمت بأعطاء اضافاتك لأي موقع آخر يحق لمطور الاضافات بإيقاف اضافاتك بدون الرجوع إليك</li>
							<li><i class="fa fa-times error"></i> في حالة إتلافك لإحدى الاضافات لا يحق لك طلب إصلاح الاخطاء من مطور الاضافات ( وذلك يرجع إلى رغبته في ذلك او لا ) ولكن لا يحق لك إجباره</li>
						</ul>
					</div>
					<div class="page_element">
						<span class="bold"><i class="fa fa-puzzle-piece"></i> قائمة الاضافات</span><br>
						<span id="result_prog"></span>
					</div>
				</div>
				<div class="page_full">
					<div class="page_element">
						<div id="addons_list">
							<?php echo addonsPs();  ?>
						</div>
					</div>
				</div>
				<div class="page_full">
					<div class="page_element">
						<p class="bold">© 2020 جميع الحقوق محفوظة للمطورين , <b style="color:red;">AmeeR PS</b> / <b style="color: yellow;">AhmedEx</b></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>