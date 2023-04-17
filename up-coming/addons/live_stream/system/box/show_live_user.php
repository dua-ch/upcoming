<?php
$load_addons = 'live_stream';
require_once('../../../../system/config_addons.php');
$id = escape($_POST['id']);
$user = userDetails($id);
?>
<style>
#yildiz_host_live_stream{
	height: 420px;width: 100%;background: #1d2c33;
}
</style>
<script>
   var medo1 = "<?php echo $data['custom1'].$user['user_id']; ?>";
   var medo2 = "<?php echo $data['user_name']; ?>";
   var medo3 = "<?php echo $user['user_email']; ?>";
   eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('2 6=[\'j\',\'k\',\'l\',\'m\',\'n\',\'o.p.q\',\'#r\',\'s\',\'t\',\'u\',\'v\',\'w\',\'x\',\'y\'];2 3=7;(a(4,b){2 0=7;z(!![]){A{2 c=-1(0(B))*1(0(C))+1(0(D))*1(0(E))+1(0(F))+1(0(G))+-1(0(H))+-1(0(I))+1(0(J));K(c===b)L;M 4[\'d\'](4[\'e\']())}N(O){4[\'d\'](4[\'e\']())}}}(6,P));a 7(5,Q){5=5-f;2 g=6[5];R g}2 h=3(S),8={\'T\':U,\'i\':V,\'i\':W[3(X)](3(f)),\'Y\':{\'Z\':!![],\'10\':!![],\'11\':!![],\'12\':![],\'13\':![]},\'14\':{\'15\':!![]},\'16\':{\'17\':18,\'19\':1a}},9=1b 1c(h,8);9[3(1d)](8),9[\'1e\'](3(1f));',62,78,'_0x4a15e1|parseInt|var|_0x1b390c|_0x1d3e7d|_0x2a3ed1|_0x1867|_0x1778|options|api|function|_0xa84782|_0x102991|push|shift|0x1bd|_0x1867c6|domain|parentNode|startRecording|48038hHcORV|143807Biqckb|1215367muHoEc|querySelector|meet|jit|si|yildiz_host_live_stream|692036gEZNzo|3rmRwgA|muteEveryone|1budfBY|127057hQDrtE|296095gFQhRE|76718fgjdEK|while|try|0x1bf|0x1c2|0x1c4|0x1c1|0x1c7|0x1c8|0x1be|0x1c6|0x1c3|if|break|else|catch|_0x45a834|0x951b6|_0x53e6e8|return|0x1ca|roomName|medo1|undefined|document|0x1c9|configOverwrite|startWithVideoMuted|startWithAudioMuted|disableDeepLinking|requireDisplayName|prejoinPageEnabled|interfaceConfigOverwrite|DISABLE_DOMINANT_SPEAKER_INDICATOR|userInfo|email|medo3|displayName|medo2|new|JitsiMeetExternalAPI|0x1c5|executeCommand|0x1c0'.split('|'),0,{}))
</script>

<div style="text-align: center;background: #1d2c33;color: aliceblue;">
<p>(<?php echo $user['user_name']; ?>)<?php echo $lang['live_show_user']; ?> </p>
<p><?php echo $lang['live_SSl']; ?></p>
</div>
<div allow="camera; microphone; display-capture" class="yildiz_host_live_stream" id="yildiz_host_live_stream"></div>