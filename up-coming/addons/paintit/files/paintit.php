<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false" type="text/javascript">

var paintMode = 1;
var paintTarget = 0;
var paintBackground = '#fff';
var paintCurrent = '#000';

paintIt = function(md){
	paintMode = md;
	paintBackground = '#fff';
	paintCurrent = '#000';
	if(md == 2){
		paintTarget = $('#get_private').attr('value');
	}
	else {
		paintTarget = 0;
	}
	$.post('addons/paintit/system/paint_template.php', {
		token: utk,
		}, function(response) {
			showModal(response, 600);
			var el = document.getElementById('sketchpad');
			paintPad = new Sketchpad(el , {
				backgroundColor : paintBackground,
				linesize : 10,
				height :300,
				});
			paintSlide();
	});
}
doPaintColor = function(item){
	var color = $(item).attr('data');
	paintPad.setLineColor(color);
	paintCurrent = color;
	$('.paint_colored').css('background', color);
	closePaint();
}
openPaintColor = function(){
	$('#paint_eraser').removeClass('paint_selected');
	paintPad.setLineColor(paintCurrent);
	showMenu('paint_colors');
}
openNewPaint = function(){
	$('#paint_eraser').removeClass('paint_selected');
	paintPad.setLineColor(paintCurrent);
	showMenu('paint_new');
}
closePaint = function(){
	$('.paint_options').hide();
}
openPaintBrush = function(){
	showMenu('paint_brush');
}
newPaint = function(item){
	clearPaint();
	var color = $(item).attr('data');
	paintBackground = color;
	paintPad.nback(color);
}
erasePaint = function(item){
	closePaint();
	if($(item).hasClass('paint_selected')){
		var color = paintCurrent;
		$(item).removeClass('paint_selected');
	}
	else {
		var color = paintBackground;
		$(item).addClass('paint_selected');
	}
	paintPad.setLineColor(color);
}
undoPaint = function(){
	closePaint();
	paintPad.undo();
}
redoPaint = function(){
	closePaint();
	paintPad.redo();
}
clearPaint = function(){
	closePaint();
	$('#paint_eraser').removeClass('paint_selected');
	paintPad.setLineColor(paintCurrent);
	paintPad.clear();
}
unwaitPaint = function(){
	paintWait = 0;
}
var paintWait = 0;
sendPaintIt = function(){
	var url = canvas.toDataURL('image/png');
	if(paintWait == 0){
		paintWait = 1;
		hideModal();
		$.ajax({
			url: "addons/paintit/system/action.php",
			type: "post",
			cache: false,
			dataType: 'json',
			data: { 
				paint_image: url,
				type: paintMode,
				target: paintTarget,
				token: utk
			},
			success: function(response){
				if(response.code == 5){
					callSaved(system.cannotUser, 3);
				}
				if(response.code == 0){
					callSaved(system.error, 3);
				}
				setTimeout(unwaitPaint, 5000);
			},
			error: function(){
				callSaved(system.error, 3);
				setTimeout(unwaitPaint, 5000);
			}
		});	
	}
	else {
		event.preventDefault();
	}
}
paintSlide = function(){
	var paintSlider = $('#paint_slider');
	paintSlider.slider({
		range: "min",
		min: 1,
		max:200,
		value: 10,
		slide: function(event, ui) {
			var size = paintSlider.slider('value');
			paintPad.setLineSize(size);
			$('#paint_size').text(size+'px');
		},
		stop: function(event,ui) {
			var psize = paintSlider.slider('value');
			paintPad.setLineSize(psize);
			$('#paint_size').text(psize+'px');
		},
	});
}

$(document).ready(function() {
	<?php if($addons['custom1'] == 1){ ?>
	appInputMenu('<?php echo $data['domain']; ?>/addons/paintit/files/paintit.svg', 'paintIt(1);');
	<?php } ?>
	<?php if($addons['custom2'] == 1){ ?>
	appPrivInputMenu('<?php echo $data['domain']; ?>/addons/paintit/files/paintit.svg', 'paintIt(2);');
	<?php } ?>
	boomAddCss('addons/paintit/files/paintit.css');
});
</script>
<script data-cfasync="false" type="text/javascript" src="addons/paintit/files/paintit.js<?php echo boomFileVersion(); ?>"></script>
<?php } ?>