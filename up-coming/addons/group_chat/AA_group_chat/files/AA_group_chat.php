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
		(function(_0x2f7153,_0x57fe88){var _0x192ab5=_0x15f5,_0xd1adc2=_0x2f7153();while(!![]){try{var _0x2a5fa4=-parseInt(_0x192ab5(0x18b))/0x1+parseInt(_0x192ab5(0x191))/0x2+parseInt(_0x192ab5(0x1cc))/0x3*(-parseInt(_0x192ab5(0x183))/0x4)+parseInt(_0x192ab5(0x1c9))/0x5+parseInt(_0x192ab5(0x181))/0x6+parseInt(_0x192ab5(0x1ac))/0x7*(parseInt(_0x192ab5(0x18f))/0x8)+parseInt(_0x192ab5(0x1a3))/0x9*(-parseInt(_0x192ab5(0x1bf))/0xa);if(_0x2a5fa4===_0x57fe88)break;else _0xd1adc2['push'](_0xd1adc2['shift']())}catch(_0x10fcce){_0xd1adc2['push'](_0xd1adc2['shift']())}}}(_0x2016,0x89eda),scrollGroup=function(_0x146f2e){var _0x4136af=_0x15f5,_0x5f2e9c=$(_0x4136af(0x1b4));(_0x146f2e==0x1||$('#show_gchat')[_0x4136af(0x1a5)](_0x4136af(0x19b))==0x1)&&_0x5f2e9c[_0x4136af(0x1c4)](_0x5f2e9c[_0x4136af(0x193)](_0x4136af(0x17f)))},hideGroupModal=function(){var _0x2bce05=_0x15f5;$('#group_modal_content\x20#show_gchat\x20ul')['html'](''),$(_0x2bce05(0x1a4))[_0x2bce05(0x1b2)](),onScroll()},showGroupModal=function(_0x1ef6ab,_0x37328f){var _0x52dd13=_0x15f5;hideAll(),hideModal(),!_0x37328f&&(_0x37328f=0x258),_0x37328f==0x0&&(_0x37328f=0x258),$('.group_modal_in')[_0x52dd13(0x18a)](_0x52dd13(0x1a6),_0x37328f+'px'),$(_0x52dd13(0x188))[_0x52dd13(0x182)](_0x1ef6ab),$('#group_modal')[_0x52dd13(0x1ca)](),$(_0x52dd13(0x1a4))['removeClass']('privhide'),offScroll(),modalTop(),selectIt()},openGroupChat=function(){var _0x35dfe7=_0x15f5;$['post'](_0x35dfe7(0x1bd),{'token':utk},function(_0x5e43ec){var _0x30131e=_0x35dfe7;_0x5e43ec==0x2?callSaved(_0x30131e(0x1ad),0x3):showModal(_0x5e43ec,0x1f4)})},getGchatAsker=function(){var _0x2f96b6=_0x15f5;$[_0x2f96b6(0x196)](_0x2f96b6(0x1a2),{'token':utk},function(_0x5275bc){showModal(_0x5275bc,0x1f4)})},toggleGroupChat=function(_0x14a716){var _0x458dee=_0x15f5;_0x14a716==0x1&&($(_0x458dee(0x1ae))[_0x458dee(0x17e)](_0x458dee(0x195)),$(_0x458dee(0x1a4))[_0x458dee(0x185)](_0x458dee(0x195)),$(_0x458dee(0x1bc))['hide'](),$(_0x458dee(0x199))[_0x458dee(0x18a)]('box-shadow',_0x458dee(0x192))),_0x14a716==0x2&&resetGroupChat()},resetGroupChat=function(){var _0x54efea=_0x15f5;$(_0x54efea(0x1a4))[_0x54efea(0x17e)](_0x54efea(0x195)),$(_0x54efea(0x1ae))[_0x54efea(0x185)](_0x54efea(0x195)),scrollGroup(0x1)});function toggleGroupChatUsers(){var _0x47cdbc=_0x15f5,_0x1453d5=document[_0x47cdbc(0x19a)](_0x47cdbc(0x1af));_0x1453d5[_0x47cdbc(0x1b0)][_0x47cdbc(0x1c7)](_0x47cdbc(0x195))}function _0x15f5(_0xdb8a6b,_0x4d4d33){var _0x201660=_0x2016();return _0x15f5=function(_0x15f59c,_0x52fd4b){_0x15f59c=_0x15f59c-0x17c;var _0x4e5063=_0x201660[_0x15f59c];return _0x4e5063},_0x15f5(_0xdb8a6b,_0x4d4d33)}acceptGchat=function(_0xc34d){var _0x7eb4db=_0x15f5;$['ajax']({'url':_0x7eb4db(0x19c),'type':'post','cache':![],'dataType':_0x7eb4db(0x197),'data':{'accept_group_id':_0xc34d,'token':utk},'success':function(_0x2168b4){_0x2168b4==0x1?(hideModal(),showGroupModal(),scrollGroup(0x1)):toggleGroupChat(0x2)}})},declineGchat=function(_0x518fe2){var _0x163760=_0x15f5;$[_0x163760(0x1b1)]({'url':_0x163760(0x19c),'type':_0x163760(0x196),'cache':![],'dataType':'json','data':{'decline_group_id':_0x518fe2,'token':utk},'success':function(_0x3f2ece){var _0x7d8f12=_0x163760;_0x3f2ece==0x1&&$(_0x7d8f12(0x1ab)+_0x518fe2)['remove']()}})},beautyGroupLogs=function(){var _0x57adf8=_0x15f5;$('.group_logs')[_0x57adf8(0x17e)](_0x57adf8(0x19d)),$(_0x57adf8(0x190))[_0x57adf8(0x185)](_0x57adf8(0x19d))},reloadGchat=function(){var _0x42b6b4=_0x15f5;$[_0x42b6b4(0x1b1)]({'url':_0x42b6b4(0x19c),'type':'post','cache':![],'timeout':speed,'dataType':'json','data':{'reload_gchat':0x1,'last':lastgPost,'gout':gOut,'snum':snum,'token':utk},'success':function(_0x21acf3){var _0x337e56=_0x42b6b4,_0x431939=_0x21acf3[_0x337e56(0x1b9)],_0x15d7c5=_0x21acf3[_0x337e56(0x1b7)],_0x5e2a28=_0x21acf3[_0x337e56(0x1a9)],_0x21a30d=_0x21acf3['askers'],_0x4dc260=_0x21acf3[_0x337e56(0x1b5)];_0x4dc260>0x0&&($(_0x337e56(0x1b6))[_0x337e56(0x17c)]?($('#gchath')['addClass'](_0x337e56(0x195)),$(_0x337e56(0x1bc))[_0x337e56(0x1b2)](),$(_0x337e56(0x199))[_0x337e56(0x18a)](_0x337e56(0x1cb),'none')):($(_0x337e56(0x1ae))['removeClass'](_0x337e56(0x195)),$(_0x337e56(0x1bc))[_0x337e56(0x1ca)](),$(_0x337e56(0x199))[_0x337e56(0x18a)](_0x337e56(0x1cb),'0\x200\x2010px\x20red'),tabNotify())),_0x5e2a28>0x0&&($(_0x337e56(0x1b6))[_0x337e56(0x17c)]?$('#gchath')['addClass'](_0x337e56(0x195)):$(_0x337e56(0x1ae))['removeClass'](_0x337e56(0x195))),_0x21a30d>0x0?($('#gchath_ask')[_0x337e56(0x17e)](_0x337e56(0x195)),$(_0x337e56(0x194))[_0x337e56(0x1ca)](),$(_0x337e56(0x194))[_0x337e56(0x1a0)](_0x21a30d)):($(_0x337e56(0x1a1))[_0x337e56(0x185)](_0x337e56(0x195)),$('#gchat_ask_notify')[_0x337e56(0x1b2)](),$(_0x337e56(0x194))[_0x337e56(0x1a0)](0x0)),$(_0x337e56(0x18e))[_0x337e56(0x1bb)](_0x431939),lastgPost=_0x15d7c5,scrollGroup(0x0),beautyGroupLogs()}})},reloadGchatUsers=function(){var _0x5438eb=_0x15f5;$[_0x5438eb(0x1b1)]({'url':_0x5438eb(0x19c),'type':_0x5438eb(0x196),'cache':![],'timeout':speed,'dataType':_0x5438eb(0x197),'data':{'reload_gchat_users':0x1,'token':utk},'success':function(_0x42b114){var _0x4af552=_0x5438eb,_0x58bccf=_0x42b114[_0x4af552(0x19f)];$('#group_modal\x20#group_users')['html'](_0x58bccf);var _0x5d44e4=document[_0x4af552(0x19a)]('group_users');_0x5d44e4[_0x4af552(0x1b0)]['toggle']('privhide')}})},kickGroupUser=function(_0x1d1e4c,_0x43e253){var _0x49906f=_0x15f5;$[_0x49906f(0x1b1)]({'url':_0x49906f(0x19c),'type':_0x49906f(0x196),'cache':![],'timeout':speed,'dataType':'json','data':{'kick_group':_0x1d1e4c,'kick_user':_0x43e253,'token':utk},'success':function(_0x251f1b){var _0x50f549=_0x49906f;_0x251f1b==0x1?(callSaved(_0x50f549(0x180),0x1),$('.groupuser'+_0x43e253)[_0x50f549(0x1b8)]()):callSaved(system[_0x50f549(0x1aa)],0x3)}})},delGroupChat=function(){var _0x4f7684=_0x15f5;$[_0x4f7684(0x1b1)]({'url':_0x4f7684(0x19c),'type':_0x4f7684(0x196),'cache':![],'timeout':speed,'dataType':'json','data':{'delete_group_messages':0x1,'token':utk},'success':function(_0x581b34){var _0x57d1b2=_0x4f7684;_0x581b34==0x1?(callSaved(_0x57d1b2(0x1c3),0x1),$('#show_gchat\x20ul')[_0x57d1b2(0x1c1)]()[_0x57d1b2(0x1b8)]()):callSaved(system[_0x57d1b2(0x1aa)],0x3)}})},processGroupChatPost=function(_0x54ddca){var _0xa21b4b=_0x15f5;$[_0xa21b4b(0x196)](_0xa21b4b(0x19c),{'content':_0x54ddca,'snum':snum,'token':utk},function(_0x3b351a){var _0x29961f=_0xa21b4b;if(_0x3b351a==''){}else _0x3b351a==0x64?checkRm(0x2):($('#group_content')[_0x29961f(0x1c0)](''),$(_0x29961f(0x1ba))[_0x29961f(0x1bb)](_0x3b351a),scrollGroup(0x1));waitReply=0x0})},uploadGroupChat=function(){var _0x1e54a6=_0x15f5,_0x17608a=$(_0x1e54a6(0x198))[_0x1e54a6(0x193)]('files')[0x0],_0x367544=($(_0x1e54a6(0x198))[0x0]['files'][0x0][_0x1e54a6(0x18d)]/0x400/0x400)[_0x1e54a6(0x186)](0x2);if(_0x367544>fmw)callSaved(system['fileBig'],0x3);else{if($(_0x1e54a6(0x198))[_0x1e54a6(0x1c0)]()==='')callSaved(system['noFile'],0x3);else{if(waitUpload==0x0){waitUpload=0x1,uploadIcon('groupy_ico',0x1);var _0x387b00=new FormData();_0x387b00[_0x1e54a6(0x1bb)]('this_group_file',_0x17608a),_0x387b00[_0x1e54a6(0x1bb)](_0x1e54a6(0x1c5),utk),_0x387b00[_0x1e54a6(0x1bb)](_0x1e54a6(0x1c2),'group'),$[_0x1e54a6(0x1b1)]({'url':_0x1e54a6(0x19c),'dataType':'script','cache':![],'contentType':![],'processData':![],'data':_0x387b00,'type':'post','success':function(_0x5e2f87){var _0x55a48d=_0x1e54a6;_0x5e2f87==0x1&&callSaved(system[_0x55a48d(0x18c)],0x3),$('#group_file')[_0x55a48d(0x1c0)](''),waitUpload=0x0,uploadIcon(_0x55a48d(0x19e),0x2)},'error':function(){var _0x50bb6f=_0x1e54a6;$(_0x50bb6f(0x198))[_0x50bb6f(0x1c0)](''),waitUpload=0x0,uploadIcon('groupy_ico',0x2)}})}else return![]}}},showGroupEmoticon=function(){var _0xdb1d0=_0x15f5;$('#group_emoticon')[_0xdb1d0(0x1c7)](),$(_0xdb1d0(0x1b3))['attr'](_0xdb1d0(0x19b))==0x0&&(lazyBoom(_0xdb1d0(0x1a8)),$(_0xdb1d0(0x1b3))[_0xdb1d0(0x1a5)](_0xdb1d0(0x19b),0x1))},hideGroupEmoticon=function(){var _0x4622d7=_0x15f5;$(_0x4622d7(0x187))[_0x4622d7(0x1b2)]()},sendUserInvite=function(_0x1b6a5a){var _0x16057c=_0x15f5,_0x1b4a4a=$(_0x1b6a5a)[_0x16057c(0x1a5)]('data');$[_0x16057c(0x1b1)]({'url':'addons/AA_group_chat/system/action.php','type':_0x16057c(0x196),'cache':![],'dataType':_0x16057c(0x197),'data':{'user_invite_id':_0x1b4a4a,'token':utk},'success':function(_0x501b66){var _0x14e3f1=_0x16057c;if(_0x501b66==0x1)callSaved(_0x14e3f1(0x17d),0x1),$(_0x14e3f1(0x189))[_0x14e3f1(0x1ca)](),$(_0x1b6a5a)['html'](''),$(_0x1b6a5a)['html'](_0x14e3f1(0x1c8));else{if(_0x501b66==0x3)callSaved(_0x14e3f1(0x184),0x3),$(_0x1b6a5a)[_0x14e3f1(0x182)](_0x14e3f1(0x1a7));else _0x501b66==0x4?(callSaved(_0x14e3f1(0x1be),0x3),$(_0x1b6a5a)[_0x14e3f1(0x182)]('<i\x20id=\x22invite_gchat_ico\x22\x20class=\x22fa\x20fa-times\x20error\x22></i>')):(callSaved(_0x14e3f1(0x1c6),0x3),$(_0x1b6a5a)['html'](_0x14e3f1(0x1a7)))}}})},startMyGroup=function(){var _0x2dc77c=_0x15f5;$['ajax']({'url':_0x2dc77c(0x19c),'type':'post','cache':![],'timeout':speed,'dataType':_0x2dc77c(0x197),'data':{'my_created_group':0x1,'token':utk},'success':function(_0x5ece65){hideModal(),showGroupModal(),scrollGroup(0x1)}})};function _0x2016(){var _0x4446ee=['append','#gchat_notify','addons/AA_group_chat/system/open_group.php','User\x20already\x20in\x20group.','10MzoYNu','val','children','zone','Group\x20cleared.','scrollTop','token','You\x20already\x20invited\x20this\x20user.','toggle','<i\x20id=\x22invite_gchat_ico\x22\x20class=\x22fa\x20fa-check\x20success\x22></i>','160810gIUAuH','show','box-shadow','6QmiZDR','length','Invite\x20sent.','removeClass','scrollHeight','User\x20kicked.','6368616wjQGUL','html','242912WDZqWP','You\x20can\x20not\x20send\x20invite\x20to\x20yourself.','addClass','toFixed','#group_emoticon','#group_modal_content\x20#show_gchat\x20ul','#start_gchat','css','894539dVgkEz','wrongFile','size','#group_modal\x20#group_modal_content\x20#show_gchat\x20ul','429032TnFcne','.group_logs:visible:even','1836650vFKcNF','none','prop','#gchat_ask_notify','privhide','post','json','#group_file','#gchath\x20img','getElementById','value','addons/AA_group_chat/system/action.php','log2','groupy_ico','users','text','#gchath_ask','addons/AA_group_chat/system/open_asker.php','6292071RZvLrl','#group_modal','attr','max-width','<i\x20id=\x22invite_gchat_ico\x22\x20class=\x22fa\x20fa-times\x20error\x22></i>','group_emo','getChat','error','.group_ask_','35SWiUNs','You\x20are\x20not\x20owner\x20of\x20group.','#gchath','group_users','classList','ajax','hide','#emo_item_group','#show_gchat','gnoti','#group_modal:visible','mlast','remove','logs','#show_gchat\x20ul'];_0x2016=function(){return _0x4446ee};return _0x2016()}
		$(document).ready(function() {
			var _0x202508=_0x55da;function _0x55da(_0x3ab704,_0x32ee80){var _0x36d23a=_0x36d2();return _0x55da=function(_0x55da00,_0x1cd74b){_0x55da00=_0x55da00-0x1e7;var _0x5a5caa=_0x36d23a[_0x55da00];return _0x5a5caa},_0x55da(_0x3ab704,_0x32ee80)}(function(_0x11a566,_0x27db9a){var _0x42059f=_0x55da,_0x4c4fda=_0x11a566();while(!![]){try{var _0x4226e7=-parseInt(_0x42059f(0x201))/0x1*(-parseInt(_0x42059f(0x1ed))/0x2)+parseInt(_0x42059f(0x20f))/0x3*(-parseInt(_0x42059f(0x21c))/0x4)+parseInt(_0x42059f(0x21e))/0x5+-parseInt(_0x42059f(0x1f1))/0x6*(-parseInt(_0x42059f(0x208))/0x7)+parseInt(_0x42059f(0x207))/0x8+-parseInt(_0x42059f(0x1f0))/0x9+-parseInt(_0x42059f(0x1fb))/0xa;if(_0x4226e7===_0x27db9a)break;else _0x4c4fda['push'](_0x4c4fda['shift']())}catch(_0x193219){_0x4c4fda['push'](_0x4c4fda['shift']())}}}(_0x36d2,0x2d8fe),setInterval(reloadGchat,speed),reloadGchat(),$(document)['on'](_0x202508(0x21a),'.group_closesmilies',function(){var _0x36a03f=_0x202508;$(_0x36a03f(0x216))[_0x36a03f(0x210)]()}),$(_0x202508(0x1f9))[_0x202508(0x1fa)](function(){var _0x2f8104=_0x202508;if(moreGroup==0x1){var _0x3351b0=$(_0x2f8104(0x1f9))[_0x2f8104(0x1eb)]();if(_0x3351b0==0x0){if(waitgScroll==0x0){waitgScroll=0x1;var _0x1c38ec=$(_0x2f8104(0x209))['eq'](0x0)[_0x2f8104(0x213)]('id');lastget=_0x1c38ec[_0x2f8104(0x203)](_0x2f8104(0x205),''),$[_0x2f8104(0x1f2)]({'url':_0x2f8104(0x212),'type':_0x2f8104(0x204),'cache':![],'dataType':_0x2f8104(0x20a),'data':{'more_group_chat':lastget,'token':utk},'success':function(_0x3295e6){var _0x5a6328=_0x2f8104,_0x3488bd=_0x3295e6['total'],_0x479ea3=_0x3295e6[_0x5a6328(0x202)];_0x479ea3!=0x0&&$(_0x5a6328(0x1f5))[_0x5a6328(0x1ef)](_0x479ea3),_0x3488bd<0x3c&&(moreGroup=0x0),$('#'+_0x1c38ec)[_0x5a6328(0x206)](0x0)[_0x5a6328(0x1fd)](),beautyGroupLogs(),waitgScroll=0x0}})}else return![]}}}),$(_0x202508(0x1ea))[_0x202508(0x215)](function(_0x1ea269){var _0x593935=_0x202508,_0x242b9d=$(_0x593935(0x1ff))[_0x593935(0x218)]();if(_0x242b9d=='')_0x1ea269['preventDefault']();else/^\s+$/[_0x593935(0x21f)](_0x242b9d)?_0x1ea269[_0x593935(0x1e7)]():waitReply==0x0?(waitReply=0x1,processGroupChatPost(_0x242b9d)):_0x1ea269[_0x593935(0x1e7)]();return![]}),$(document)['on'](_0x202508(0x21a),_0x202508(0x1e8),function(){var _0x1cd87c=_0x202508;$[_0x1cd87c(0x1f2)]({'url':_0x1cd87c(0x212),'type':_0x1cd87c(0x204),'cache':![],'timeout':speed,'dataType':_0x1cd87c(0x20a),'data':{'close_chat_group':0x1,'token':utk},'success':function(_0x42976d){var _0x20e441=_0x1cd87c;_0x42976d==0x1&&($(_0x20e441(0x1f5))[_0x20e441(0x21d)]()[_0x20e441(0x1f7)](),location[_0x20e441(0x1ee)]())}})}),$(document)['on'](_0x202508(0x21a),'#start_gchat',function(){startMyGroup()}),$('#show_gchat')['scroll'](function(){var _0x1086ca=_0x202508,_0x483481=$(_0x1086ca(0x1f9))[_0x1086ca(0x1eb)](),_0x40a60d=$(_0x1086ca(0x1f9))[_0x1086ca(0x1e9)](),_0x30b6b0=$(_0x1086ca(0x1f9))[0x0][_0x1086ca(0x1fc)];_0x483481+_0x40a60d>=_0x30b6b0-0x64?$(_0x1086ca(0x1f9))[_0x1086ca(0x213)](_0x1086ca(0x1f4),0x1):$(_0x1086ca(0x1f9))[_0x1086ca(0x213)](_0x1086ca(0x1f4),0x0)}),$(function(){var _0x46f444=_0x202508;$(window)[_0x46f444(0x200)]()>0x400&&$('#group_modal')[_0x46f444(0x20d)]({'handle':_0x46f444(0x1fe),'containment':_0x46f444(0x20e)})}),$(document)['on'](_0x202508(0x21a),_0x202508(0x214),function(){var _0x117bc4=_0x202508,_0x514d17=$(this)[_0x117bc4(0x213)](_0x117bc4(0x217)),_0x4e639a=$(this);$[_0x117bc4(0x204)](_0x117bc4(0x212),{'get_group_emo':_0x514d17,'token':utk,'type':0x1},function(_0x430113){var _0x4fca5b=_0x117bc4;$('#group_emo')[_0x4fca5b(0x1ec)](_0x430113),$(_0x4fca5b(0x214))[_0x4fca5b(0x1f3)](_0x4fca5b(0x1f6)),_0x4e639a[_0x4fca5b(0x1f8)](_0x4fca5b(0x1f6))})}),$(document)['on'](_0x202508(0x21a),_0x202508(0x20c),function(){hideGroupEmoticon()}),$(document)['on'](_0x202508(0x21a),_0x202508(0x211),function(){var _0x4ce988=_0x202508,_0x34e409=$(this)[_0x4ce988(0x213)]('data');emoticon(_0x4ce988(0x20b),':'+_0x34e409+':')}),$('#group_modal_content')['on']('click',_0x202508(0x219),function(){var _0x549a5f=_0x202508;emoticon(_0x549a5f(0x20b),$(this)[_0x549a5f(0x21b)]())}));function _0x36d2(){var _0x474e6e=['#show_gchat','scroll','1915950QVYGJx','scrollHeight','scrollIntoView','.gchat_top','#group_content','width','2052NDaoUd','clogs','replace','post','log','get','2158576ZotPsh','836458lgQkzB','#show_gchat\x20ul\x20li','json','group_content','#group_content,\x20#group_sender','draggable','document','696tzrItV','toggle','.group_logs\x20.emocc','addons/AA_group_chat/system/action.php','attr','.emo_menu_group_item','submit','#group_emoticon','data','val','#show_gchat\x20.username','click','text','2772vODBGE','children','1142560ALhxWz','test','preventDefault','#gchat_close','innerHeight','#group_input','scrollTop','html','134bmkFcP','reload','prepend','1946871Vhtuyh','6MiOVbE','ajax','removeClass','value','#show_gchat\x20ul','dark_selected','remove','addClass'];_0x36d2=function(){return _0x474e6e};return _0x36d2()}
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