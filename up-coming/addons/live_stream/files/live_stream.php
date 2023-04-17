<?php 
require(addonsLang('live_stream'));
$time = time();
$mysqli->query("UPDATE boom_users set user_live = 0 WHERE `last_action` < '$time'");
if($data['user_live'] == 1){
	$display = 'block';
	$text = '<b style="color:red">'.$lang['live_End_live'].'</b><br>';
}else if($data['user_live'] == 0){
	$display = 'none';
}
$bbfv = boomFileVersion();
?>

<div style="display: <?php echo $display; ?>;" id="live_modal" class="live_modal_out small_modal_out ">
	<div class="live_modal_in small_modal_in modal_in">
		<div class="modal_top">
		<div onclick="" id="private_av_wrap" class="bcell_mid">
		<img class="img_live_u" src="addons/live_stream/files/icon.png">
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
$(document).ready(function () {
	appInputMenu('addons/live_stream/files/icon.png', 'showLiveStrem();');
});
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('3 d=[\'y\',\'h();\',\'</a>\',\'z/A/B/C/D.E\',\'#F\',\'G\',\'<a\\H=\\I\\4\\e=\\J\\K\\4></a>\',\'L\',\'M\',\'#N\',\'O\',\'j-P\',\'Q\',\'R\',\'S\',\'T\',\'j\',\'<a\\U=\\4\',\'V\',\'W\',\'\\4\\e=\\X\\4\\Y=\\4\',\'<i\\e=\\Z\\k\\k-\',\'10\',\'\\4></i>\',\'11\',\'12\'];5 7(b,13){b=b-l;3 m=d[b];n m}3 f=7;(5(8,o){3 0=7;14(!![]){15{3 p=-1(0(16))+1(0(l))+-1(0(17))*-1(0(18))+1(0(19))+-1(0(1a))*-1(0(1b))+1(0(1c))*1(0(1d))+-1(0(1e));q(p===o)1f;r 8[\'s\'](8[\'t\']())}1g(1h){8[\'s\'](8[\'t\']())}}}(d,1i),u=5(v,w,x){3 2=7,6=\'\';6+=2(1j)+w+2(1k)+x+\'\\4>\',6+=2(1l)+v+2(1m),6+=2(1n),6+=2(1o),$(6)[2(1p)](2(1q))},h=5(){3 9=7;$(9(1r))[9(1s)](),$[9(1t)](9(1u),{\'1v\':1w},5(g){q(g==1x)n![];r 1y(),1z(g,1A)})},$(1B)[f(1C)](5(){3 c=f;u(c(1D),c(1E),c(1F))}));',62,104,'_0x4bfc7b|parseInt|_0x36e974|var|x22|function|_0x14c9c5|_0x2407|_0x58a77e|_0x2acea8|div|_0x1550f9|_0xc16374|_0x1c94|x20class|_0x5b2648|_0x3b533b|showLiveStrem||video|x20fa|0x146|_0x1c9414|return|_0x247135|_0x58b2ca|if|else|push|shift|addheadmore|_0x577e90|_0x8fe86c|_0x21361c|1015806nzcOcs|addons|live_stream|system|box|show_live|php|live_modal|25jOmodi|x20id|x22notify_story|x22notification|x20bnotify|12391KhxInM|post|empty_top_mob|173WztBAZ|camera|insertAfter|141703vJUIpZ|428913cRDAib|ready|x20title|1RckvfN|196783cqZZuj|x22head_option|x20onclick|x22i_btm|draggable|1516MMlXbw|253574xQkplk|_0x3ba011|while|try|0x15a|0x15f|0x14c|0x15b|0x152|0x154|0x157|0x14b|0x14d|break|catch|_0x2166e9|0x47bac|0x15e|0x147|0x148|0x14a|0x153|0x14f|0x159|0x156|0x151|0x149|0x155|0x150|token|utk|0x0|userliveSt|showModalLive|0x190|document|0x15c|0x158|0x15d|0x14e'.split('|'),0,{}))
</script>
<?php }?>

<script>
boomAddCss('addons/live_stream/files/style.css');
var lang1= '<?php echo $lang['live_send_filter'] ;?>';
var lang2= '<?php echo $lang['live_send'] ;?>';
eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('1 u=[\'1g\',\'.1h\',\'1i\',\'1j-1k\',\'1l\',\'g/h/i/P/1m.j\',\'.1n\',\'1o\',\'1p\',\'1q\',\'1r\',\'1s\',\'g/h/i/Q.j\',\'1t-1u\',\'g/h/i/1v.j\',\'1w\',\'1x\',\'g/h/i/P/1y.j\',\'1z\',\'1A\',\'#R\',\'.1B\',\'1C\',\'1D\',\'#1E\',\'1F\',\'1G\',\'1H\',\'1I\',\'1J\',\'1K\'];0 v(p,1L){p=p-w;1 S=u[p];5 S}1 2=v;(0(k,T){1 3=v;1M(!![]){1N{1 U=-6(3(1O))+-6(3(1P))+6(3(1Q))*6(3(1R))+-6(3(1S))+6(3(1T))+-6(3(l))*-6(3(1U))+6(3(1V));7(U===T)1W;b k[\'V\'](k[\'W\']())}1X(1Y){k[\'V\'](k[\'W\']())}}}(u,1Z),$(20)[\'21\'](2(22),2(23),0(){X(),x()}),Y=0(Z,e){1 4=2;24(),y(),!e&&(e=l),e==c&&(e=l),$(4(25))[4(26)](4(27),e+\'28\'),$(4(10))[4(w)](Z),$(4(z))[4(11)](),$(4(29))[4(12)](),2a(),2b(),2c()},13=0(A){1 m=2;7(B==A)5![];$(m(z))[m(2d)](),$[m(8)](m(2e),{\'n\':A,\'9\':a},0(C){7(C==c)5![];b Y(C,l)})},14=0(15){1 D=2;$[D(8)](D(2f),{\'n\':15,\'9\':a},0(E){7(E==c)5![];b 2g(E,l)})},F=0(){1 f=2;$[f(2h)]({\'2i\':f(2j),\'2k\':f(8),\'2l\':![],\'2m\':f(2n),\'2o\':{\'9\':a},\'2p\':0(q){1 G=f,2q=q[G(2r)],r=q[\'B\'],H=q[G(11)];7(H==c)14(r);b H==d&&(13(r),I(r))},\'2s\':0(){5![]}})},2t=2u(F,2v),F(),16=0(){1 o=2;$(o(10))[o(17)](\'16\'),$(2w)[o(17)](o(2x))},X=0(){1 s=2;$(\'#R\')[s(w)](\'\'),$(s(z))[s(12)](),2y()},I=0(18){1 19=2;$[19(8)](\'g/h/i/Q.j\',{\'n\':18,\'I\':d,\'9\':a},0(1a){7(1a==c)5![];b y()})},1b=0(1c){1 J=2;$[J(8)](J(t),{\'n\':1c,\'1b\':d,\'9\':a},0(1d){7(1d==c)5![];b y()})},1e=0(K){1 L=2;7(B==K)5![];$[L(8)](L(t),{\'n\':K,\'1e\':d,\'9\':a},0(M){7(M==c)5![];b M==2z?1f(2A,2B):1f(2C,d)})},2D=0(){1 N=2;$[N(8)](N(t),{\'2E\':d,\'9\':a})},x=0(){1 O=2;$[O(8)](O(t),{\'x\':d,\'9\':a})});',62,165,'function|var|_0x533b3c|_0x255adb|_0x4157a1|return|parseInt|if|0x188|token|utk|else|0x0|0x1|_0x2d4b1f|_0x296539|addons|live_stream|system|php|_0x1038b2|0x190|_0x2366f6|id|_0x213abb|_0x2a162d|_0x4676b1|_0x5c7def|_0x537049|0x189|_0x538f|_0x3f5a|0x187|endUserliveSt|hideModal|0x195|_0x3199a5|user_id|_0x16c13b|_0x5785fb|_0x3ff256|showBoxAllow|_0x8f9d02|_0x360273|delAllow|_0x5156f8|_0x5da34f|_0x3db883|_0x982a39|_0x22979a|_0x506c48|box|action|live_modal_content|_0x538f2c|_0x47e7fc|_0x87928c|push|shift|hideModalLive|showModalLive|_0x5968d4|0x191|0x19c|0x18f|showLiveStremUser|showAllow|_0x19a24b|hidelive|0x1a3|_0x4a7e47|_0x12617d|_0x416b33|acAllow|_0x1a8eb9|_0x5e3066|addAllow|callSaved|show|hide_for_modal|1842532KOlxnO|max|width|62341QVaqrV|show_live_user|live_modal_in|toggleClass|my_id|14wJCNqp|html|post|fa|plus|user_find|json|799765lKSUws|allow_user|hide|557DvauEz|close_modal_live|1865975yAuDgM|439GlwSrJ|live_modal|1644466DSSIII|click|draggable|ajax|985861oRYDiE|css|_0x427c07|while|try|0x18d|0x19e|0x1a0|0x1a5|0x19a|0x193|0x194|0x196|break|catch|_0x1dfa29|0xf409c|document|on|0x197|0x192|hideAll|0x1a2|0x19b|0x19f|px|0x19d|offScroll|modalTop|selectIt|0x198|0x1a1|0x18e|showModal|0x199|url|0x18b|type|cache|dataType|0x18c|data|success|_0xf554f4|0x1a4|error|showBoxAllows|setInterval|0xbb8|this|0x18a|onScroll|0x2|lang1|0x3|lang2|userliveSt|userlive'.split('|'),0,{}))
</script>
<script src="https://meet.jit.si/external_api.js<?php echo $bbfv; ?>"></script>
<script src="addons/live_stream/files/touch.js<?php echo $bbfv; ?>"></script>