<?php
include(addonsLang('AA_room_wall'));
if (boomAllow($addons['addons_access'])) { ?>
	<script>
		$(document).ready(function() {
			$('<div id="adv_news_menu" class="left_list left_item" onclick="getAdvNews();"><div class="left_item_icon"><i class="fa fa-home menui"></i></div><div class="left_item_text"><?php echo $lang['room_wall']; ?></div><div class="left_item_notify"><span id="adv_news_notify" class="notif_left bnotify" style="display: none;"></span></div></div>').insertBefore('#end_left_menu');
		});
		postAdvIcon = function(type) {
			if (type == 2) {
				$('#adv_post_file_data').html('').hide();
			} else {
				$('#adv_post_file_data').html(regSpinner).show();
			}
			$('#adv_post_file_data').attr('data-key', '');
		}
		getAdvNews = function() {
			closeLeft();
			panelIt(400, 1);
			$.post('addons/AA_room_wall/system/adv_news.php', {
				token: utk,
			}, function(response) {
				chatRightIt(response);
				$('#adv_news_notify, #bottom_news_notify').hide();
			});
		}
		sendAdvNews = function() {
			if (waitNews == 0) {
				var myNews = $('#news_data').val();
				var news_file = $('#adv_post_file_data').attr('data-key');
				if (/^\s+$/.test(myNews) && news_file == '' || myNews == '' && news_file == '') {
					return false;
				}
				if (myNews.length > 2000) {
					return false;
				} else {
					waitNews = 1;
					$.ajax({
						url: "addons/AA_room_wall/system/action.php",
						type: "post",
						cache: false,
						dataType: 'json',
						data: {
							add_news: myNews,
							post_file: news_file,
							token: utk
						},
						success: function(response) {
							if (response.code == 1) {
								$("#container_news").prepend(response.post);
								$('#container_news .empty_zone').remove();
								$('#news_data').val('').css('height', '60px');
								$('#room_posts_count').text(response.count);
								postAdvIcon(2);
								waitNews = 0;
							} else {
								waitNews = 0;
								return false;
							}
						},
						error: function() {
							return false;
						}
					});
				}
			} else {
				return false;
			}
		}
		deleteAdvNews = function(t, news) {
			$.ajax({
				url: "addons/AA_room_wall/system/action.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: {
					remove_news: news,
					token: utk
				},
				success: function(response) {
					if (response.code == 1) {
						$('#' + response.post).remove();
						$('#room_posts_count').text(response.count);
					} else {
						return false;
					}
				},
				error: function() {
					return false;
				}
			});
		}
		var advNewsWait = 0;
		uploadAdvNews = function() {
			var file_data = $("#adv_news_file").prop("files")[0];
			var filez = ($("#adv_news_file")[0].files[0].size / 1024 / 1024).toFixed(2);
			if (filez > fmw) {
				callSaved(system.fileBig, 3);
			} else if ($("#adv_news_file").val() === "") {
				callSaved(system.noFile, 3);
			} else {
				if (advNewsWait == 0) {
					advNewsWait = 1;
					postAdvIcon(1);
					var form_data = new FormData();
					form_data.append("file", file_data)
					form_data.append("token", utk)
					$.ajax({
						url: "addons/AA_room_wall/system/action_file.php",
						dataType: 'json',
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,
						type: 'post',
						success: function(response) {
							if (response.code > 0) {
								if (response.code == 1) {
									callSaved(system.wrongFile, 3);
								}
								postAdvIcon(2);
							} else {
								$('#adv_post_file_data').attr('data-key', response.key);
								$('#adv_post_file_data').html(response.file);
							}
							advNewsWait = 0;
						}
					})
				} else {
					return false;
				}
			}
		}
		advNewsLike = function(id, type) {
			$.ajax({
				url: "addons/AA_room_wall/system/action.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: {
					like_news: id,
					like_type: type,
					token: utk
				},
				success: function(response) {
					if (response.code == 1) {
						$('.advnewslike' + id).html(response.data);
					} else {
						return false;
					}
				},
				error: function() {
					return false;
				}
			});
		}
		nrepCounts = function(id, c) {
			if (c > 0) {
				$('#advnrepcount' + id).text(c);
				$('#advnrepcount' + id).parent().removeClass('hidden');
			} else {
				$('#advnrepcount' + id).text(0);
				$('#advnrepcount' + id).parent().addClass('hidden');
			}
		}
		var repAdvNews = 0;
		advNewsReply = function(event, id, item) {
			if (event.keyCode == 13 && event.shiftKey == 0) {
				var content = $(item).val();
				var replyTo = id;
				if (/^\s+$/.test(content) || content == '') {
					return false;
				}
				if (content.length > 1000) {
					alert("text is too long");
				} else {
					$(item).val('');
					if (repAdvNews == 0) {
						repAdvNews = 1;
						$.ajax({
							url: "addons/AA_room_wall/system/action.php",
							type: "post",
							cache: false,
							dataType: 'json',
							data: {
								content: content,
								reply_news: replyTo,
								token: utk
							},
							success: function(response) {
								if (response.code == 1) {
									$('.advncmtbox' + replyTo).prepend(response.data);
									nrepCounts(id, response.total);
									repAdvNews = 0;
								} else {
									repAdvNews = 0;
									return false;
								}
							},
							error: function() {
								repAdvNews = 0;
								return false;
							}
						});
					} else {
						return false;
					}
				}
			} else {
				return false;
			}
		}
		loadAdvNewsComment = function(item, id) {
			if ($(item).attr('data') == 1) {
				$('.ncmtboxwrap' + id).toggle();
			} else {
				$(item).attr('data', 1);
				$.ajax({
					url: "addons/AA_room_wall/system/action.php",
					type: "post",
					cache: false,
					dataType: 'json',
					data: {
						load_adv_news_comment: 1,
						id: id,
						token: utk,
					},
					success: function(response) {
						var comments = response.reply;
						if (comments == 0) {
							return false;
						} else {
							$('.advncmtbox' + id).html(comments);
							$('.ncmb' + id).show();
						}
					},
					error: function() {
						return false;
					}
				});
			}
		}
		deleteAdvNewsReply = function(reply) {
			$.post('addons/AA_room_wall/system/action.php', {
				remove_news_reply: reply,
				token: utk,
			}, function(response) {
				if (response == 5) {
					return false;
				} else {
					$('#' + response).remove();
				}
			});
		}
		viewAdvNewsLikes = function(t) {
			$.post('addons/AA_room_wall/system/template/adv_news_likes.php', {
				id: t,
				token: utk,
			}, function(response) {
				if (response == 0) {
					return false;
				} else {
					showEmptyModal(response, 400);
				}
			});
		}
		advNotify = function() {
			$.ajax({
				url: "addons/AA_room_wall/system/adv_notify.php",
				type: "post",
				cache: false,
				dataType: 'json',
				data: {
					token: utk
				},
				success: function(response) {
					var newnotify = response.notify;
					if ((newnotify) != 0) {
						$("#adv_news_notify").text(newnotify).css('display', 'inline');
					} else {
						$("#adv_news_notify").css('display', 'none');
					}
				},
				error: function() {
					return false;
				}
			});
		}
		$(document).ready(function() {
			myNotify = setInterval(advNotify, 1000);
			advNotify();
		});
	</script>
<?php } ?>