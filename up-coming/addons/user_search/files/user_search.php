<?php if(boomAllow($addons['addons_access'])){ ?>
<script data-cfasync="false">

var ev_delay = (function() {
  var timer = 0;
  return function(callback, ms) {
    clearTimeout(timer);
    timer = setTimeout(callback, ms);
  };
})();
getSearchUser = function() {
  closeLeft();
  panelIt(400, 1);
  $.post('addons/user_search/system/user_search_template.php', {
    token: utk,
	}, function(response) {
		chatRightIt(response);
		selectIt();
  });
}
evSearchUser = function(){
	$("#ev_user_results").fadeIn().html('<div class="centered_element vpad15"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>');
	ev_delay(function() {
		$.post('addons/user_search/system/action.php', {
			query: $('#ev_search_users').val(),
			search_type: $('#ev_search_type').val(),
			search_order: $('#ev_search_order').val(),
			token: utk,
			}, function(response) {
				$('#ev_user_results').fadeIn();
				$("#ev_user_results").html(response);
		});
	}, 2000);
}

$(document).ready(function() {
	appPanelMenu('search', 'بحث الاعضاء', 'getSearchUser();');
	appLeftMenu('search', 'بحث الاعضاء', 'getSearchUser();');
	$(document).on('change', '#ev_search_type, #ev_search_order', function() {
		var evSearchVal = $(this).val();
		evSearchUser();
	});
	$(document).on('keyup', '#ev_search_users', function() {
		evSearchUser();
	});
});

</script>
<?php } ?>