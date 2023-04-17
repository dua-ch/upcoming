<?php
$load_addons = 'live_stream';
require_once('../../../../system/config_addons.php');
if($data['user_live'] == 1){
	die();
}
?>
<script>
   var medo1 = "<?php echo $data['custom1'].$data['user_id']; ?>";
   var medo2 = "<?php echo $data['user_name']; ?>";
   var medo3 = "<?php echo $data['user_email']; ?>";
   eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('2 6=[\'i\',\'j\',\'k\',\'l\',\'#m\',\'n\',\'o\',\'p\',\'q\',\'r\',\'s\',\'t.u.v\',\'w\',\'x\'];2 3=7;(a(4,b){2 0=7;y(!![]){z{2 c=1(0(A))+-1(0(B))*-1(0(C))+1(0(D))*-1(0(E))+-1(0(F))+1(0(G))+-1(0(H))*-1(0(d))+-1(0(I));J(c===b)K;L 4[\'e\'](4[\'f\']())}M(N){4[\'e\'](4[\'f\']())}}}(6,O));a 7(5,P){5=5-d;2 g=6[5];Q g}2 h=3(R),8={\'S\':T,\'U\':V[\'W\'](3(X)),\'Y\':{\'Z\':!![],\'10\':!![],\'11\':!![],\'12\':![],\'13\':![]},\'14\':{\'15\':!![]},\'16\':{\'17\':18,\'19\':1a}},9=1b 1c(h,8);9[\'1d\'](8),9[3(1e)](3(1f));',62,78,'_0x4c4b46|parseInt|var|_0x2b1ae0|_0x2cf4c0|_0x890c05|_0x2f15|_0xe214|options|api|function|_0xba9783|_0x2406e3|0x17e|push|shift|_0x2f156a|domain|1079218ymAEcH|2347aiXNWV|1808979zTNVDx|21929jWurXz|yildiz_host_live_stream|executeCommand|26927IAuKeo|muteEveryone|1669152sWaUhb|15uxiVOA|31VvVWcj|meet|jit|si|577izHPNl|3076845BGvGeq|while|try|0x17f|0x187|0x180|0x183|0x186|0x18b|0x185|0x189|0x18a|if|break|else|catch|_0xd5b2f5|0xe8775|_0xe37ba7|return|0x188|roomName|medo1|parentNode|document|querySelector|0x181|configOverwrite|disableDeepLinking|startWithAudioMuted|startWithVideoMuted|requireDisplayName|prejoinPageEnabled|interfaceConfigOverwrite|DISABLE_DOMINANT_SPEAKER_INDICATOR|userInfo|email|medo3|displayName|medo2|new|JitsiMeetExternalAPI|startRecording|0x182|0x184'.split('|'),0,{}))
</script>
<div style="text-align: center;background: #1d2c33;color: aliceblue;">
<p><?php echo $lang['live_SSl']; ?></p>
</div>
<div allow="camera; microphone; display-capture" class="yildiz_host_live_stream" id="yildiz_host_live_stream"></div>