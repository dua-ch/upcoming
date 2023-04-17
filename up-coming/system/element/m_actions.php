<div class="centered_element">
<?php if (boomRole(4) || boomAllow(95)) { ?>
				<input type="checkbox" id="remove_msgs" name="remove_msgs">
  				<label for="remove_msgs">حذف جميع رسائل العضو من الغرفة</label><br><br>
			<?php } ?>

<?php if($boom['is_muted'] == 0 && boomRole(4) || $boom['is_muted'] == 0 && boomAllow(100)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_mute');" class="reg_button theme_btn bmargin5"> كتم غرفة</button>
<?php } ?>
<?php if($boom['is_muted'] > 0 && boomRole(4) || $boom['is_muted'] > 0 &&  boomAllow(100)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_unmute');" class="reg_button warn_btn bmargin5">فك كتم الغرفة</button>
<?php } ?>
<?php if($boom['is_blocked'] == 0 && boomRole(5) ||  $boom['is_blocked'] == 0 && boomAllow(100)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_block');" class="reg_button theme_btn bmargin5"> طرد الغرفة</button>
<?php } ?>
<?php if($boom['is_blocked'] > 0 && boomRole(6) || $boom['is_blocked'] > 0 && boomAllow(100)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'room_unblock');" class="reg_button warn_btn"> فك طرد الغرفة</button>
<?php } ?>
<?php if($boom['user_rank'] < 95 && $boom['user_role'] < 4 && boomRole(4) || $boom['user_rank'] < 95 && $boom['user_role'] < 4 && boomAllow(95)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'warn');" class="reg_button theme_btn bmargin5">تحذير العضو</button>
<?php } ?>
<?php if(!isMuted($boom) && !isRegmute($boom) && canMuteUser($boom)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'more_mute');" class="reg_button theme_btn bmargin5">كتم</button>
<?php } ?>
<?php if((isMuted($boom) || isRegmute($boom)) && canMuteUser($boom)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'unmute');" class="reg_button warn_btn bmargin5"> فك الكتم</button>
<?php } ?>
<?php if(isKicked($boom) && canKickUser($boom)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'unkick');" class="reg_button warn_btn bmargin5"> فك الطرد</button>
<?php } ?>
<?php if(!isKicked($boom) && canKickUser($boom)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'more_kick');" class="reg_button theme_btn bmargin5">طرد</button>
<?php } ?>
<?php if(isBanned($boom) && canBanUser($boom)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'unban');" class="reg_button warn_btn bmargin5">فك الحظر</button>
<?php } ?>
<?php if(!isBanned($boom) && canBanUser($boom)){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'more_ban');" class="reg_button theme_btn bmargin5">حظر</button>
<?php } ?>
<?php if(boomAllow(100) && $boom['no_perm'] == 1 && !isBot($boom) && isStaff($boom['user_rank']) || boomAllow(100) && $boom['no_perm'] == 1 && !isBot($boom) && $boom['user_role'] >= 4){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'take_all_perm');" class="reg_button theme_btn bmargin5">سحب الصلاحيات</button>
<?php } ?>
<?php if(boomAllow(100)  && $boom['no_perm'] == 0 && !isBot($boom) && isStaff($boom['user_rank']) || boomAllow(100) && $boom['no_perm'] == 0 && !isBot($boom) && $boom['user_role'] >= 4){ ?>
<button onclick="listAction(<?php echo $boom['user_id']; ?>, 'give_all_perm');" class="reg_button warn_btn bmargin5">منح الصلاحيات</button>	
<?php } ?>
</div>