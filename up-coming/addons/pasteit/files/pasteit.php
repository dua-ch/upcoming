<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false">

getClipboardImage = function(pasteEvent, callback){
	if(pasteEvent.clipboardData == false){
		if(typeof(callback) == "function"){
			callback(undefined);
		}
	};
	var items = pasteEvent.clipboardData.items;
	if(items == undefined){
		if(typeof(callback) == "function"){
			callback(undefined);
		}
	};
	for (var i = 0; i < items.length; i++) {
		if (items[i].type.indexOf("image") == -1) continue;
		var blob = items[i].getAsFile();
		if(typeof(callback) == "function"){
			callback(blob);
		}
	}
}
pasteitFocus = function(){
	if ($('#content').is(":focus")) {
		return 1;
	}
	else if ($('#message_content').is(":focus")) {
		return 2;
	}
	else {
		return 0;
	}
}
unwaitPaste = function(){
	waitPaste = 0;
}
var waitPaste = 0;

$(document).ready(function(){
	
	window.addEventListener("paste", function(e){
		getClipboardImage(e, function(imageBlob){
			if(imageBlob){
				var file = imageBlob;
				var filename = file.name;
				var pasteSize = (file.size / 1024 / 1024).toFixed(2);
				if( pasteSize < fmw ){
					var ext = filename.split('.').reverse()[0].toLowerCase();
					var toPasteit = pasteitFocus();
					if(toPasteit == 1 || toPasteit == 2){
						var toFile = 'file_chat.php';
						var toZone = 'chat';
						if(toPasteit == 2){
							toFile = 'file_private.php';
							toZone = 'private';
						}
						var data = new FormData();
						data.append('file', file);
						data.append("token", utk);
						data.append("zone", toZone);
						if(toPasteit == 2){
							data.append("target", $('#get_private').attr('value'));
						}
						if(waitPaste == 0){
							waitPaste = 1;
							$.ajax({
								url: 'system/'+toFile,
								data: data,
								type: 'POST',
								processData: false,
								contentType: false,
								success: function (response) {
									setTimeout(unwaitPaste, 5000);
								}
							});
						}
					}
				}
			}
		});
	}, false);

});

</script>
<?php } ?>