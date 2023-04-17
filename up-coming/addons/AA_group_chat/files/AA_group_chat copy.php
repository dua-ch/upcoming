<?php if (boomAllow($addons['addons_access'])) {
	function emoGroupItem($type)
	{
		switch ($type) {
			case 1:
				$emoclass = 'emo_menu_group_item';
				break;
		}
		$emo = '';
		$dir = glob('emoticon/*', GLOB_ONLYDIR);
		foreach ($dir as $dirnew) {
			$emoitem = str_replace('emoticon/', '', $dirnew);
			$emo .= '<div data="' . $emoitem . '" class="emo_menu ' . $emoclass . '"><img class="emo_select" src="emoticon_icon/' . $emoitem . '.png"/></div>';
		}
		return $emo;
	}
	function listGroupSmilies($type)
	{
		$supported = smiliesType();
		switch ($type) {
			case 1:
				$emo_act = 'group_content';
				$closetype = 'group_closesmilies';
				break;
		}
		$files = scandir(BOOM_PATH . '/emoticon');
		foreach ($files as $file) {
			if ($file != "." && $file != "..") {
				$smile = preg_replace('/\.[^.]*$/', '', $file);
				foreach ($supported as $sup) {
					if (strpos($file, $sup)) {
						echo '<div  title=":' . $smile . ':" class="emoticon ' . $closetype . '"><img  class="lazyboom" data-img="emoticon/' . $smile . $sup . '" src="" onclick="emoticon(\'' . $emo_act . '\', \':' . $smile . ':\')"/></div>';;
					}
				}
			}
		}
	}
?>
	<script data-cfasync="false" type="text/javascript">
		var checkGchat = '<?php echo $data['user_group']; ?>';
		var waitReply = 0;
		var lastgPost = 0;
		var groupRe = 0;
		var waitUpload = 0;
		var moreGroup = 1;
		var waitgScroll = 0;
		var gOut = 0;
		scrollGroup = function(z) {
			var p = $('#show_gchat');
			if (z == 1 || $('#show_gchat').attr('value') == 1) {
				p.scrollTop(p.prop("scrollHeight"));
			}
		}
		hideGroupModal = function() {
			$('#group_modal_content #show_gchat ul').html('');
			$('#group_modal').hide();
			onScroll();
		}
		showGroupModal = function(r, s) {
			hideAll();
			hideModal();
			if (!s) {
				s = 600;
			}
			if (s == 0) {
				s = 600;
			}
			$('.group_modal_in').css('max-width', s + 'px');
			$('#group_modal_content #show_gchat ul').html(r);
			$('#group_modal').show();
			$('#group_modal').removeClass('privhide');
			offScroll();
			modalTop();
			selectIt();
		}
		openGroupChat = function() {
			$.post('addons/AA_group_chat/system/open_group.php', {
				token: utk
			}, function(response) {
				if (response == 2) {
					callSaved('You are not owner of group.', 3);
				} else {
					showModal(response, 500);
				}
			});
		}
		getGchatAsker = function() {
			$.post('addons/AA_group_chat/system/open_asker.php', {
				token: utk
			}, function(response) {
				showModal(response, 500);
			});
		}
		toggleGroupChat = function(type) {
			if (type == 1) {
				$('#gchath').removeClass('privhide');
				$('#group_modal').addClass('privhide');
				$('#gchat_notify').hide();
				$('#gchath img').css('box-shadow', 'none');
			}
			if (type == 2) {
				resetGroupChat();
			}
		}
		resetGroupChat = function() {
			$('#group_modal').removeClass('privhide');
			$('#gchath').addClass('privhide');
			scrollGroup(1);
		}

		function toggleGroupChatUsers() {
			var element = document.getElementById("group_users");
			element.classList.toggle("privhide");
		}
		acceptGchat = function(gid) {
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: {
					accept_group_id: gid,
					token: utk
				},
				success: function(response) {
					if (response == 1) {
						hideModal();
						showGroupModal();
						scrollGroup(1);
					} else {
						toggleGroupChat(2);
					}
				},
			});
		}
		declineGchat = function(gid) {
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: {
					decline_group_id: gid,
					token: utk
				},
				success: function(response) {
					if (response == 1) {
						$('.group_ask_' + gid).remove();
					}
				},
			});
		}
		beautyGroupLogs = function() {
			$(".group_logs").removeClass("log2");
			$(".group_logs:visible:even").addClass("log2");
		}
		reloadGchat = function() {
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				timeout: speed,
				dataType: 'json',
				data: {
					reload_gchat: 1,
					last: lastgPost,
					gout: gOut,
					snum: snum,
					token: utk
				},
				success: function(response) {
					var logs = response.logs;
					var mLast = response.mlast;
					var getChat = response.getChat;
					var askers = response.askers;
					var gnoti = response.gnoti;
					if (gnoti > 0) {
						if ($('#group_modal:visible').length) {
							$("#gchath").addClass('privhide');
							$("#gchat_notify").hide();
							$('#gchath img').css('box-shadow', 'none');
						} else {
							$("#gchath").removeClass('privhide');
							$("#gchat_notify").show();
							$('#gchath img').css('box-shadow', '0 0 10px red');
							tabNotify();
						}
					}
					if (getChat > 0) {
						if ($('#group_modal:visible').length) {
							$("#gchath").addClass('privhide');
						} else {
							$("#gchath").removeClass('privhide');
						}
					}
					if (askers > 0) {
						$("#gchath_ask").removeClass('privhide');
						$("#gchat_ask_notify").show();
						$("#gchat_ask_notify").text(askers);
					} else {
						$("#gchath_ask").addClass('privhide');
						$("#gchat_ask_notify").hide();
						$("#gchat_ask_notify").text(0);
					}
					$('#group_modal #group_modal_content #show_gchat ul').append(logs);
					lastgPost = mLast;
					scrollGroup(0);
					beautyGroupLogs();
				},
			});
		}
		reloadGchatUsers = function() {
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				timeout: speed,
				dataType: 'json',
				data: {
					reload_gchat_users: 1,
					token: utk
				},
				success: function(response) {
					var users = response.users;
					$('#group_modal #group_users').html(users);
					var element = document.getElementById("group_users");
					element.classList.toggle("privhide");
				},
			});
		}
		kickGroupUser = function(g, u) {
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				timeout: speed,
				dataType: 'json',
				data: {
					kick_group: g,
					kick_user: u,
					token: utk
				},
				success: function(response) {
					if (response == 1) {
						callSaved('User kicked.', 1);
						$('.groupuser' + u).remove();
					} else {
						callSaved(system.error, 3);
					}
				},
			});
		}
		delGroupChat = function() {
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				timeout: speed,
				dataType: 'json',
				data: {
					delete_group_messages: 1,
					token: utk
				},
				success: function(response) {
					if (response == 1) {
						callSaved('Group cleared.', 1);
						$('#show_gchat ul').children().remove();
					} else {
						callSaved(system.error, 3);
					}
				},
			});
		}
		processGroupChatPost = function(message) {
			$.post('addons/AA_group_chat/system/action.php', {
				content: message,
				snum: snum,
				token: utk,
			}, function(response) {
				if (response == '') {

				} else if (response == 100) {
					checkRm(2);
				} else {
					$('#group_content').val('');
					$("#show_gchat ul").append(response);
					scrollGroup(1);
				}
				waitReply = 0;
			});
		}
		uploadGroupChat = function() {
			var file_data = $("#group_file").prop("files")[0];
			var filez = ($("#group_file")[0].files[0].size / 1024 / 1024).toFixed(2);
			if (filez > fmw) {
				callSaved(system.fileBig, 3);
			} else if ($("#group_file").val() === "") {
				callSaved(system.noFile, 3);
			} else {
				if (waitUpload == 0) {
					waitUpload = 1;
					uploadIcon('groupy_ico', 1);
					var form_data = new FormData();
					form_data.append("this_group_file", file_data)
					form_data.append("token", utk)
					form_data.append("zone", 'group')
					$.ajax({
						url: "addons/AA_group_chat/system/action.php",
						dataType: 'script',
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,
						type: 'post',
						success: function(response) {
							if (response == 1) {
								callSaved(system.wrongFile, 3);
							}
							$("#group_file").val("");
							waitUpload = 0;
							uploadIcon('groupy_ico', 2);
						},
						error: function() {
							$("#group_file").val("");
							waitUpload = 0;
							uploadIcon('groupy_ico', 2);
						}
					})
				} else {
					return false;
				}
			}
		}
		showGroupEmoticon = function() {
			$('#group_emoticon').toggle();
			if ($('#emo_item_group').attr('value') == 0) {
				lazyBoom('group_emo');
				$('#emo_item_group').attr('value', 1);
			}
		}
		hideGroupEmoticon = function() {
			$('#group_emoticon').hide();
		}
		sendUserInvite = function(source) {
			var id = $(source).attr('data');
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: {
					user_invite_id: id,
					token: utk
				},
				success: function(response) {
					if (response == 1) {
						callSaved('Invite sent.', 1);
						$('#start_gchat').show();
						$(source).html('');
						$(source).html('<i id="invite_gchat_ico" class="fa fa-check success"></i>');
					} else if (response == 3) {
						callSaved('You can not send invite to yourself.', 3);
						$(source).html('<i id="invite_gchat_ico" class="fa fa-times error"></i>');
					} else if (response == 4) {
						callSaved('User already in group.', 3);
						$(source).html('<i id="invite_gchat_ico" class="fa fa-times error"></i>');
					} else {
						callSaved('You already invited this user.', 3);
						$(source).html('<i id="invite_gchat_ico" class="fa fa-times error"></i>');
					}
				},
			});
		}
		startMyGroup = function() {
			$.ajax({
				url: "addons/AA_group_chat/system/action.php",
				type: "post",
				cache: false,
				timeout: speed,
				dataType: 'json',
				data: {
					my_created_group: 1,
					token: utk
				},
				success: function(response) {
					hideModal();
					showGroupModal();
					scrollGroup(1);
				},
			});
		}
		$(document).ready(function() {
			setInterval(reloadGchat, speed);
			reloadGchat();
			$(document).on('click', '.group_closesmilies', function() {
				$('#group_emoticon').toggle();
			});
			$('#show_gchat').scroll(function() {
				if (moreGroup == 1) {
					var pos = $('#show_gchat').scrollTop();
					if (pos == 0) {
						if (waitgScroll == 0) {
							waitgScroll = 1;
							var lastlog = $('#show_gchat ul li').eq(0).attr('id');
							lastget = lastlog.replace('log', '');
							$.ajax({
								url: "addons/AA_group_chat/system/action.php",
								type: "post",
								cache: false,
								dataType: 'json',
								data: {
									more_group_chat: lastget,
									token: utk
								},
								success: function(response) {
									var ccount = response.total;
									var newLogs = response.clogs;

									if (newLogs != 0) {
										$("#show_gchat ul").prepend(newLogs);
									}
									if (ccount < 60) {
										moreGroup = 0;
									}
									$("#" + lastlog).get(0).scrollIntoView();
									beautyGroupLogs();
									waitgScroll = 0;
								},
							});
						} else {
							return false;
						}
					}
				}
			});
			$('#group_input').submit(function(event) {
				var message = $('#group_content').val();
				if (message == '') {
					event.preventDefault();
				} else if (/^\s+$/.test(message)) {
					event.preventDefault();
				} else {
					if (waitReply == 0) {
						waitReply = 1;
						processGroupChatPost(message);
					} else {
						event.preventDefault();
					}
				}
				return false;
			});
			$(document).on('click', '#gchat_close', function() {
				$.ajax({
					url: "addons/AA_group_chat/system/action.php",
					type: "post",
					cache: false,
					timeout: speed,
					dataType: 'json',
					data: {
						close_chat_group: 1,
						token: utk
					},
					success: function(response) {
						if (response == 1) {
							$('#show_gchat ul').children().remove();
							location.reload();
						}
					},
				});
			});
			$(document).on('click', '#start_gchat', function() {
				startMyGroup();
			});
			$('#show_gchat').scroll(function() {
				var s = $('#show_gchat').scrollTop();
				var c = $('#show_gchat').innerHeight();
				var d = $('#show_gchat')[0].scrollHeight;
				if (s + c >= d - 100) {
					$('#show_gchat').attr('value', 1);
				} else {
					$('#show_gchat').attr('value', 0);
				}

			});
			$(function() {
				if ($(window).width() > 1024) {
					$("#group_modal").draggable({
						handle: ".gchat_top",
						containment: "document",
					});
				}
			});
			$(document).on('click', '.emo_menu_group_item', function() {
				var thisEmo = $(this).attr('data');
				var emoSelect = $(this);
				$.post('addons/AA_group_chat/system/action.php', {
					get_group_emo: thisEmo,
					token: utk,
					type: 1,
				}, function(response) {
					$('#group_emo').html(response);
					$('.emo_menu_group_item').removeClass('dark_selected');
					emoSelect.addClass('dark_selected');
				});
			});
			$(document).on('click', '#group_content, #group_sender', function() {
				hideGroupEmoticon();
			});
			$(document).on('click', '.group_logs .emocc', function() {
				var copyEmo = $(this).attr('data');
				emoticon('group_content', ':' + copyEmo + ':');
			});
			$('.avstaff, .avroomstaff, .avother').append('<div data="" value="" data-av="" onclick="sendUserInvite(this);startMyGroup();" class="avset avitem"><i class="fa fa-share warn"></i> Invite Group Chat</div>');
			$('<div id="gchath" onclick="toggleGroupChat(2);" class="chat_footer_item privhide"><img id="group_ico" src="addons/AA_group_chat/files/gchat.png"><div style="height: 10px;width: 10px;border-radius: 25px;" id="gchat_notify" class="notification bnotify"></div></div>').insertAfter('#dpriv');
			$('<div id="gchath_ask" onclick="getGchatAsker();" class="chat_footer_item privhide"><img id="group_ico" src="addons/AA_group_chat/files/gchat.png"><div id="gchat_ask_notify" class="notification bnotify">0</div></div>').insertAfter('#dpriv');
			<?php if ($data['user_group'] == '') { ?>
				appLeftMenu('comments error', 'Group Chat', 'openGroupChat();');
			<?php } ?>
			boomAddCss('addons/AA_group_chat/files/gchat.css?v=<?php echo time(); ?>');
			<?php if ($data['user_language'] == 'Arabic') { ?>
				boomAddCss('addons/AA_group_chat/files/rtl_gchat.css?v=<?php echo time(); ?>');
			<?php } ?>
		});
	</script>
	<div id="group_modal" class="privelem privhide">
		<div class="gchat_top top_panel btable top_background">
			<div id="private_name" class="bcell_mid bellips">
				<i class="fa fa-comments"></i> Group Chat
			</div>
			<div onclick="toggleGroupChat(1);" class="group_opt">
				<i class="fa fa-minus"></i>
			</div>
			<div onclick="reloadGchatUsers();" class="group_opt">
				<i class="fa fa-users"></i>
			</div>
			<div id="group_main_menu" onclick="showMenu('group_menu');" class="menutrig group_opt">
				<i class="fa fa-cog menutrig"></i>
				<div id="group_menu" class="sysmenu add_shadow fmenu">
					<?php if ($data['group_owner'] == 1) { ?>
						<div class="fmenu_item" onclick="openGroupChat();">
							<div class="fmenu_icon menuo">
								<i class="fa fa-users"></i>
							</div>
							<div class="fmenu_text">
								Add Users
							</div>
						</div>
						<div class="fmenu_item" onclick="delGroupChat();">
							<div class="fmenu_icon menuo">
								<i class="fa fa-trash"></i>
							</div>
							<div class="fmenu_text">
								Clear
							</div>
						</div>
					<?php } ?>
					<div id="gchat_close" class="fmenu_item">
						<div class="fmenu_icon menuo">
							<i class="fa fa-sign-out"></i>
						</div>
						<div class="fmenu_text">
							Exit
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="group_users top_panel btable">
			<div class="privhide" id="group_users">
			</div>
		</div>
		<div id="group_modal_content">
			<div id="show_gchat" class="background_box" value="1">
				<ul>
				</ul>
			</div>
		</div>
		<div id="group_input" class="input_wrap">
			<form id="group_form" action="" method="post" name="group_form">
				<div class="input_table">
					<div value="0" id="emo_item_group" class="input_item main_item" onclick="showGroupEmoticon();">
						<i class="fa fa-smile-o"></i>
					</div>
					<div class="input_item main_item">
						<i id="groupy_ico" data="fa-paperclip" class="fa fa-paperclip"></i><input id="group_file" class="up_input" onchange="uploadGroupChat();" type="file">
					</div>
					<div id="group_input_box" class="td_input">
						<input spellcheck="false" id="group_content" placeholder="<?php echo $lang['type_something']; ?>" maxlength="<?php echo $data['max_private']; ?>" autocomplete="off" />
					</div>
					<div id="group_sender" class="main_item">
						<button class="default_btn csend" id="group_send"><i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
			</form>
			<div id="group_emoticon" class="background_box">
				<div class="emo_head private_emo_head">
					<div data="base_emo" class="dark_selected emo_menu emo_menu_group_item"><img class="emo_select" src="emoticon_icon/base_emo.png" /></div>
					<?php echo emoGroupItem(1); ?>
					<div class="empty_emo">
					</div>
					<div class="emo_menu" id="emo_close_priv" onclick="hideGroupEmoticon();">
						<i class="fa fa-times"></i>
					</div>
				</div>
				<div id="group_emo" class="emo_content_group">
					<?php listGroupSmilies(1); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>