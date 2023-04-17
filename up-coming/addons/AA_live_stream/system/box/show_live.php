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
$load_addons = 'AA_live_stream';
require_once('../../../../system/config_addons.php');
if($data['user_live'] == 1){
	die();
}
?>
<script>
   var ameerps1 = "<?php echo $data['custom1'].$data['user_id']; ?>";
   var ameerps2 = "<?php echo $data['user_name']; ?>";
   var ameerps3 = "<?php echo $data['user_email']; ?>";
   var domain = "meet.jit.si";
   eval(function(p,a,c,k,e,r){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--)r[e(c)]=k[c]||e(c);k=[function(e){return r[e]}];e=function(){return'\\w+'};c=1};while(c--)if(k[c])p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c]);return p}('3 8=[\'l\',\'m\',\'n\',\'o\',\'p\',\'q\',\'r\',\'s\',\'t\',\'u\',\'v\',\'w\',\'x\',\'y\',\'z\',\'A\',\'B\',\'C\',\'D\',\'E\',\'F\',\'G\'];3 2=4;(9(5,b){3 0=4;H(!![]){I{3 c=-1(0(J))*1(0(K))+1(0(L))*1(0(M))+1(0(N))*-1(0(O))+-1(0(P))+-1(0(Q))*1(0(R))+-1(0(S))*-1(0(T))+1(0(U))*1(0(V));W(c===b)X;Y 5[\'d\'](5[\'e\']())}Z(10){5[\'d\'](5[\'e\']())}}}(8,11));3 a={\'12\':13,\'14\':15[2(16)](\'#17\'),\'18\':{\'19\':![],\'1a\':!![],\'1b\':!![],\'1c\':!![],\'1d\':![],\'1e\':![]},\'1f\':{\'1g\':!![]},\'1h\':{\'1i\':1j,\'1k\':1l}},6=1m 1n(1o,a);9 4(f,g){h 4=9(7,1p){7=7-i;3 j=8[7];h j},4(f,g)}6[2(1q)](a),6[2(k)](2(1r)),6[2(k)](2(1s),{\'1t\':[2(i),2(1u),2(1v),2(1w)]});',62,95,'_0x308f3e|parseInt|_0x4d3d00|var|_0x42e5|_0x481e2f|api|_0x1ba526|_0x1ba5|function|options|_0x22c5f2|_0x4ae058|push|shift|_0xae1fa6|_0x4ace8a|return|0xe8|_0x52bab9|0xf2|82763alGYJU|13Cvikbt|120383oxCrpI|148003TbPisD|296081mlLIJh|executeCommand|15781gkYQyB|1BiNRys|2mVqeOu|overwriteConfig|381015AmLYtF|camera|1wFQMvU|1Bbitie|invite|security|muteEveryone|microphone|28291uFSltK|1vtQrrq|startRecording|querySelector|while|try|0xea|0xe9|0xf0|0xf4|0xf3|0xee|0xf1|0xed|0xf9|0xf5|0xef|0xf7|0xfa|if|break|else|catch|_0x37cce0|0x26738|roomName|ameerps1|parentNode|document|0xec|yildiz_host_live_stream|configOverwrite|SHOW_JITSI_WATERMARK|disableDeepLinking|startWithAudioMuted|startWithVideoMuted|requireDisplayName|prejoinPageEnabled|interfaceConfigOverwrite|DISABLE_DOMINANT_SPEAKER_INDICATOR|userInfo|email|ameerps3|displayName|ameerps2|new|JitsiMeetExternalAPI|domain|_0x42e58d|0xeb|0xfd|0xf6|toolbarButtons|0xf8|0xfc|0xfb'.split('|'),0,{}))
</script>
<div style="text-align: center;background: #1d2c33;color: aliceblue;">
<p><?php echo $lang['live_SSl']; ?></p>
</div>
<div allow="camera; microphone; display-capture" class="yildiz_host_live_stream" id="yildiz_host_live_stream"></div>