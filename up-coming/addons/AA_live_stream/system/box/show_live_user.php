<?php
/*===============================================*
 |                                               |
 |   Development      :  [AMEER_PS]              |
 |                                               |
 |   addon name       :  [STORE_CHAT]            |
 |                                               |
 |   Version          :  [1.0]                   |
 |                                               |
 |   Codychat version :  [CODYCHAT 3.5]          |
 |                                               |
 *===============================================*/
$load_addons = 'AA_live_stream';
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
   var ameerps1 = "<?php echo $data['custom1'].$user['user_id']; ?>";
   var ameerps2 = "<?php echo $data['user_name']; ?>";
   var ameerps3 = "<?php echo $user['user_email']; ?>";
   var domain = "meet.jit.si";
   eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('3 8=[\'#m\',\'n\',\'o\',\'p\',\'q\',\'r\',\'s\',\'t\',\'u\',\'v\',\'w\',\'x\',\'y\',\'z\',\'A\',\'B\',\'C\'];3 2=4;(9(5,b){3 0=4;D(!![]){E{3 c=1(0(F))*-1(0(G))+1(0(H))+1(0(I))+-1(0(J))+-1(0(K))*1(0(d))+1(0(L))+1(0(M))*-1(0(N));O(c===b)P;Q 5[\'e\'](5[\'f\']())}R(S){5[\'e\'](5[\'f\']())}}}(8,T));9 4(g,h){i 4=9(6,U){6=6-d;3 j=8[6];i j},4(g,h)}3 a={\'V\':W,\'k\':X,\'k\':Y[\'Z\'](2(10)),\'11\':{\'12\':!![],\'13\':!![],\'14\':!![],\'15\':![],\'16\':![]},\'17\':{\'18\':!![]},\'19\':{\'1a\':1b,\'1c\':1d}},7=1e 1f(1g,a);7[2(1h)](a),7[2(l)](2(1i)),7[2(l)](2(1j),{\'1k\':[2(1l),2(1m)]});',62,85,'_0x52a8c0|parseInt|_0x388906|var|_0x2996|_0x59b276|_0x442fcf|api|_0x442f|function|options|_0x45afba|_0x2e982b|0x15f|push|shift|_0x201337|_0x448263|return|_0x5999fd|parentNode|0x167|yildiz_host_live_stream|2IRdiEH|591764KaQNLG|804445bPRXKW|884592duTuZN|1mCgfOG|1EviliT|microphone|297826ALGOsh|executeCommand|startRecording|279249SpyoWM|muteEveryone|camera|581354lHxTft|902039sKGAAR|overwriteConfig|while|try|0x164|0x16c|0x162|0x16d|0x160|0x166|0x161|0x163|0x169|if|break|else|catch|_0xee08ee|0x84951|_0x29964d|roomName|ameerps1|undefined|document|querySelector|0x16f|configOverwrite|startWithVideoMuted|startWithAudioMuted|disableDeepLinking|requireDisplayName|prejoinPageEnabled|interfaceConfigOverwrite|DISABLE_DOMINANT_SPEAKER_INDICATOR|userInfo|email|ameerps3|displayName|ameerps2|new|JitsiMeetExternalAPI|domain|0x168|0x16a|0x16e|toolbarButtons|0x165|0x16b'.split('|'),0,{}))
</script>

<div style="text-align: center;background: #1d2c33;color: aliceblue;">
<p>(<?php echo $user['user_name']; ?>)<?php echo $lang['live_show_user']; ?> </p>
<p><?php echo $lang['live_SSl']; ?></p>
</div>
<div allow="camera; microphone; display-capture" class="yildiz_host_live_stream" id="yildiz_host_live_stream"></div>