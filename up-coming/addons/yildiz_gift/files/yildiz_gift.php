<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [YILDIZ_GIFT]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
$bbfv = boomFileVersion();
?>
<audio class="hidden" id="gift_sound" src="addons/yildiz_gift/files/gifts.mp3<?php echo $bbfv; ?>"></audio>
<script>
var nullgifts = "يجب عليك اختيار هدية قبل الارسال";
var quizfals  = "لا تمتلك نقاط كافية للارسال";
var countfull = "لا يمكنك ارسال اكثر من 10 هدية بكل مرة او انك اخترت قيمة اقل من 1";
var infofull = "الاهداء فارغ الرجاء كتابة اهداء";
</script>
<?php if($addons['custom1'] == 1){ ?>
<script data-cfasync="false">
sendGiftPublic = function(){
	$.ajax({
		url: "addons/yildiz_gift/system/send_gift.php",
		type: "post",
		cache: false,
		dataType: 'json',
		data: { 
			token: utk
		},
		success: function(response){
		var pGifts = response.gifts;// وهون قيمة واحد انو اذا بيسمح ينعرض او لا 
		var PGift = response.PGift;// باخذ الرسالة بخزنها هون  
		var classrand = response.class;
		if ((pGifts) == 1){// وهون شرط العرض انو يكون مخزن واحد 
		mmnewuser(); // اول ما يعرض بنفذ هاض الفنقشن مشان يصفر القيمة واحد 
		//giftsPlay();
		overModal(PGift);
        var s = 15000; // هي الوقت 
        $(classrand).fadeIn(300).delay(s).fadeOut();
		}
		},
		error: function(){
			return false;
		}
	});
}
GiftPublic = setInterval(sendGiftPublic, 3000);
sendGiftPublic();

</script>
<?php } ?>
<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false">
giftsPlay = function(){
	if(boomSound(3)){
	document.getElementById('gift_sound').play();
	}
}
loadGiftPanel = function(item){
	var target = $(item).attr('data');
	$.post('addons/yildiz_gift/system/box/panel_gift.php', {
		target: target,
		token: utk,
		}, function(response) {
			showEmptyModal(response, 580);
			closeTrigger();
	});
}
mmnewuser = function(){
	$.post('addons/yildiz_gift/system/send_gift.php', {
		    mnewuser: 1,
			token: utk,
		}, function(response) {
	});
}

var waitGifts = 0;
sendGiftsPs = function(item) {
	if(waitGifts == 0){
		waitGifts = 1;
		var idGift = $(item).attr('data');
		var idUser = $(item).attr('data-user');
		$.post('addons/yildiz_gift/system/action.php', {
			saveGift: 1,
			count_gift: $('#count_gifts').val(),
			info_gift: $('#info_gift').val(),
			gift_id: idGift,
			target: idUser,
			token: utk,
		}, function(response) {
			if (response == 1) {
				callSaved(system.actionComplete, 1);
				hideModal();
				waitGifts = 0;
			} else if (response == 3) {
				callErrorgift((nullgifts));
				waitGifts = 0;
			}else if (response == 4) {
				callErrorgift((quizfals));
				waitGifts = 0;
			}else if (response == 5) {
				callErrorgift((countfull));
				waitGifts = 0;
			}
			else if (response == 6) {
				callErrorgift((infofull));
				waitGifts = 0;
			}
			else {
				callSaved(system.error, 3);
				waitGifts = 0;
			}
		});
	}
}
//______________________________//

callErrorgift = function(text){
$('.error_gift').text(text);
$('#error_show').show("500");
}

$(document).on('click', '.selected_gifts', function() {
$('#error_show').hide("500");
});

$(document).on('keypress keydown keyup', '#info_gift', function() {
if($.trim($(this).val()).length) {
		// main chat
        $('#error_show').hide("500");
    }else{
		$('#error_show').show("500");
	}
});

$(document).on('click', '.selected_gifts', function() {
	var id = $(this).attr('data-id');
    var price = $(this).attr('value');
    var name = $(this).attr('name');
    var imggift = $(this).attr('data-img');
	$('.new_style_gift').removeClass( 'new_style_gift_sel' );
    $(this).addClass('new_style_gift_sel');
	$('#gift_id').attr('data', id);
	$('#img_gif').attr('src', imggift);
	$('#img_gif').attr('href', imggift);
    $('.price_gifts').text(price);
    $('.name_gifts').text(name);
});
//______________________________//
</script>
<?php } ?>
<script data-cfasync="false">
boomAddCss('addons/yildiz_gift/files/style_gift.css');
colseGift = function(id){
$('#colse_gift'+id).hide("500");
}
boardFame = function(){
	$.post('addons/yildiz_gift/system/box/board_fame.php', { 
		token: utk,
		}, function(response) {
		showModal(response, 420);
	});
}
$(document).ready(function(){
appLeftMenu('gem error', 'ملوك الشهره', 'boardFame();');
});
</script>
<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false">
$(document).ready(function(){
	appAvMenu('other', 'gift gifts_icon', 'ارسال هدية', 'loadGiftPanel(this);');
	appAvMenu('staff', 'gift gifts_icon', 'ارسال هدية', 'loadGiftPanel(this);');
});
</script>
<?php } ?>