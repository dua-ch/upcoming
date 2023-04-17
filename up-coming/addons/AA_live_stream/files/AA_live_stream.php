<?php 
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [LIVE_STREAM]           |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.6]          |
 |                                               |
 *===============================================*/
require(addonsLang('AA_live_stream'));
$time = time() - 35; 
$mysqli->query("UPDATE boom_users set user_live = 0 WHERE last_action < '$time'");
if($data['user_live'] == 1){
	$display = 'block';
	$text = '<b style="color:red">'.$lang['live_End_live'].'</b><br>';
}else if($data['user_live'] == 0){
	$display = 'none';
}
$bbfv = boomFileVersion();
?>

<div style="display: <?php echo $display; ?>;" id="live_modal" class="live_modal_out small_modal_out">
	<div class="live_modal_in small_modal_in modal_in">
		<div class="modal_top">
		<div onclick="" id="private_av_wrap" class="bcell_mid">
		<img class="img_live_u" src="addons/AA_live_stream/files/icon.png">
		</div>
		<div onclick="" id="private_name" class="bcell_mid bellips">Live Stream</div>
			<div class="modal_top_empty">
			</div>
			
			<div style="width: 80px;" class="modal_top_element">
			<i onclick="hidelive();" class='fa fa-minus'></i>
			<i style="padding-left: 14px;padding-right: 4px;" class="close_modal_live fa fa-times"></i>
			</div>
		</div>
		<div id="live_modal_content" class="modal_content live_modal_content">
		<?php echo $text; ?>
		</div>
	</div>
</div>
<?php if(boomAllow($addons['addons_access'])){ ?>
<script>
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('2 8=[\'t\\u\',\'e/f/v/w.x\',\'y\',\'z\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\',\'G\',\'H\',\'I\',\'J\',\'e/f/K/L/M.N\',\'g();\',\'O\'];3 4(h,i){9 4=3(7,P){7=7-j;2 k=8[7];9 k},4(h,i)}2 5=4;(3(6,l){2 0=4;Q(!![]){R{2 m=1(0(S))*1(0(T))+-1(0(U))+-1(0(V))+-1(0(W))*-1(0(X))+1(0(Y))+-1(0(Z))+-1(0(j))*-1(0(10));n(m===l)11;o 6[\'p\'](6[\'q\']())}12(13){6[\'p\'](6[\'q\']())}}}(8,14),g=3(){2 a=4;$[a(15)](a(16),{\'17\':18},3(b){n(b==19)9![];o 1a(),1b(b,1c)})},$(r)[5(s)](3(){2 c=5;1d(c(1e),c(1f))}),$(r)[5(s)](3(){2 d=5;1g(d(1h),d(1i),\'1j();\')}));',62,82,'_0x1b1595|parseInt|var|function|_0x2a07|_0x522b19|_0x46360e|_0x4ee459|_0x4ee4|return|_0x2ac42a|_0x3fe2ff|_0xbf1026|_0x439e38|addons|AA_live_stream|showLiveStrem|_0x2a7de7|_0x291c67|0x64|_0x1e486f|_0x5d21af|_0x189443|if|else|push|shift|document|0x67|List|x20Live|files|icon|png|ready|post|380118NGMShk|2855758EhoDiN|8bABsHD|1357532rDNcdu|804327DNtgcW|43lFSNsV|12542qpbNLY|tasks|1711112AUPLqN|15779YCqGaW|system|box|show_live|php|1cczvem|_0x2a07fb|while|try|0x6e|0x6f|0x6c|0x69|0x6b|0x72|0x6d|0x71|0x6a|break|catch|_0x30063b|0xd613d|0x68|0x73|token|utk|0x0|userliveSt|showModalLive|0x190|appInputMenu|0x66|0x74|appLeftMenu|0x70|0x65|showListLive'.split('|'),0,{}))
</script>
<?php } ?>

<script>
var liveRank = <?php echo $addons['custom3']; ?>;
var liveRankEnd = 8;
var lang1 = "<?php echo $lang['live_send_filter'] ;?>";
var lang2 = "<?php echo $lang['live_send_filter'] ;?>";
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('1 w=[\'1w\',\'.1x\',\'#x\',\'1y\',\'d/e/b/y.i\',\'#1z\',\'X\',\'d/e/b/z/1A.i\',\'1B\',\'1C-1D\',\'1E\',\'1F\',\'d/e/b/z/1G.i\',\'1H\',\'d/e/1I/1J.Y\',\'A\',\'Z\',\'1K\',\'d/e/b/1L.i\',\'1M\',\'1N-1O\',\'1P\',\'1Q\',\'d/e/b/z/1R.i\',\'.1S\',\'10\',\'1T\',\'.1U\',\'1V\',\'1W\',\'11\',\'Y\',\'1X\',\'1Y\'];0 f(12,13){2 f=0(o,1Z){o=o-14;1 15=w[o];2 15},f(12,13)}1 3=f;(0(l,16){1 5=f;20(!![]){21{1 17=-6(5(22))*6(5(23))+-6(5(24))+-6(5(25))+-6(5(26))*-6(5(27))+6(5(28))+-6(5(29))+6(5(2a))*6(5(2b));4(17===16)2c;7 l[\'18\'](l[\'19\']())}2d(2e){l[\'18\'](l[\'19\']())}}}(w,2f),1a=0(1b){1 B=f;$[B(g)](B(2g),{\'j\':1b,\'8\':9},0(C){4(C==c)2![];7 1c(C,m)})},1d=0(){1 D=f;$[D(g)](D(2h),{\'8\':9},0(E){4(E==c)2![];7 1c(E,m)})},F=0(){1 p=f;$[p(2i)]({\'2j\':p(2k),\'2l\':\'A\',\'2m\':![],\'2n\':\'2o\',\'2p\':{\'8\':9},\'2q\':0(q){1 1e=p,2r=q[1e(2s)],r=q[\'s\'],G=q[\'Z\'];4(G==c)1a(r);7 G==a&&(H(r),I(r))},\'11\':0(){2![]}})},2t=2u(F,2v),F(),2w(3(2x)),10=0(){1 n=3;$(n(2y))[n(2z)](n(2A)),$(2B)[\'X\'](n(2C))},1f=0(){1 J=3;$(\'#x\')[J(1g)](\'\'),$(J(1h))[\'1i\'](),2D()},$(2E)[\'2F\'](3(2G),3(14),0(){1f(),K()}),1j=0(1k,k){1 h=3;2H(),L(),!k&&(k=m),k==c&&(k=m),$(h(2I))[h(2J)](h(2K),k+\'2L\'),$(\'#x\')[h(1g)](1k),$(h(1h))[h(2M)](),$(h(2N))[\'1i\'](),2O(),2P(),2Q()},H=0(M){1 N=3;4(s==M)2![];$[N(g)](N(2R),{\'j\':M,\'8\':9},0(O){4(O==c)2![];7 1j(O,m)})},I=0(1l){1 1m=3;$[\'A\'](1m(t),{\'j\':1l,\'I\':a,\'8\':9},0(1n){4(1n==c)2![];7 L()})},1o=0(1p){1 P=3;$[P(g)](P(t),{\'j\':1p,\'1o\':a,\'8\':9},0(1q){4(1q==c)2![];7 L()})},1r=0(Q){1 R=3;4(s==Q)2![];4(!1s(2S))2![];7 $[R(g)](\'d/e/b/y.i\',{\'j\':Q,\'1r\':a,\'8\':9},0(S){1 T=R;4(S==c)2![];7 S==a?(u(b[T(2T)],a),1d()):u(b[T(2U)],1t)})},1u=0(v){1 U=3;4(s==v)2![];1s(2V)?H(v):$[U(g)](U(t),{\'j\':v,\'1u\':a,\'8\':9},0(V){4(V==c)2![];7 V==2W?u(2X,1t):u(2Y,a)})},2Z=0(){1 1v=3;$[1v(g)](\'d/e/b/y.i\',{\'30\':a,\'8\':9})},K=0(){1 W=3;$[W(g)](W(t),{\'K\':a,\'8\':9})});',62,187,'function|var|return|_0x1f2f1e|if|_0x5d8794|parseInt|else|token|utk|0x1|system|0x0|addons|AA_live_stream|_0x40af|0xa3|_0x157641|php|id|_0x3934c3|_0x9e6641|0x190|_0x3a6a5c|_0x361f4d|_0x1e8697|_0x1a2654|_0x4c6c5c|user_id|0x98|callSaved|_0x3382e4|_0x361f|live_modal_content|action|box|post|_0x5a0f8d|_0x6456ac|_0x2e1499|_0x370de2|showBoxAllow|_0x27a753|showLiveStremUser|delAllow|_0x6f5eb|endUserliveSt|hideModal|_0x239d3b|_0x237429|_0x8f60f6|_0x276181|_0x396132|_0x43438b|_0x477e59|_0x258e97|_0xea428b|_0x1b65ef|_0x698fa0|toggleClass|css|show|hidelive|error|_0x5f0f5f|_0x1cf63a|0x8d|_0x1d0703|_0x5f1db1|_0x3a9cfa|push|shift|showAllow|_0xc0a2ec|showModal|showListLive|_0x9fbf66|hideModalLive|0xa1|0x99|hide|showModalLive|_0x3d43bc|_0x37ac43|_0x36d099|_0x815cce|acAllow|_0x468757|_0x2a807d|EndUserLiveW|boomAllow|0x3|addAllow|_0x1e7b44|454078idcrli|hide_for_modal|655278xHSllJ|live_modal|show_live_user|710189rvARuN|max|width|252174WCDxjU|435836OwaLZQ|allow_user|html|files|style|7YIXIuN|user_find|3CDoFAR|fa|plus|saved|ajax|list_live|live_modal_in|419579biMguX|close_modal_live|click|1QZhWDS|my_id|45544arDjdG|_0x40af78|while|try|0x93|0xa5|0x94|0x9f|0x8f|0x9c|0x9e|0x97|0xa7|0xae|break|catch|_0x239d61|0x572ec|0xa0|0xab|0xaa|url|0xa6|type|cache|dataType|json|data|success|_0x537254|0x92|showBoxAllows|setInterval|0xbb8|boomAddCss|0xa2|0x96|0x9a|0xad|this|0xa8|onScroll|document|on|0x8e|hideAll|0xac|0x91|0x9d|px|0xa4|0x95|offScroll|modalTop|selectIt|0x9b|liveRankEnd|0xa9|0x90|liveRank|0x2|lang1|lang2|userliveSt|userlive'.split('|'),0,{}))
</script>
<script src="https://meet.jit.si/external_api.js<?php echo $bbfv; ?>"></script>