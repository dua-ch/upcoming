<?php
   $load_addons = 'AA_gifts';
   require_once('../../../system/config_addons.php'); 
 ?>
<?php echo elementTitle($data['addons'], 'loadLob(\'admin/setting_addons.php\');'); ?>
<div class="page_full">
   <div>
      <div class="tab_menu">
         <ul>
            <li class="tab_menu_item tab_selected" data="korsy" data-z="korsy_setting"><i class="fa fa-cogs"></i> <?php echo $lang['settings']; ?></li>
         </ul>
      </div>
   </div>
   <div class="page_element">
      <div id="korsy" class="tpad15">
         <div id="korsy_setting" class="tab_zone">
            <div class="setting_element ">
               <p class="label"><?php echo $lang['limit_feature']; ?></p>
               <select id="set_addon_access">
               <?php echo listRank($data['addons_access'], 1); ?>
               </select>
            </div>
			<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
            <div class="page_full">
				<div class="page_element">
					<div class="page_top_elem">
						<div class="bold page_top_title" style="font-size: 20px;">
							<i class="fa fa-gift"></i> Your gifts details
						</div>
					</div>
					<div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
				    <div class="setting_element ">
                        <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name1" value="<?php echo chooseGiftName(1); ?>">
                    </div>
                    <div class="setting_element ">
                       <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins1" value="<?php echo chooseGiftCoins(1); ?>">
                    </div>
                    <div class="setting_element ">
                       <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 1);" class="full_input" id="set_gift_photo1" type="file">
                        <div class="post_file_data" class="pad10 main_post_data hidden" data-key="">
					    </div>
					    <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(1); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(2); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(2); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 2);" class="full_input" id="set_gift_photo2" type="file" value="<?php echo chooseGiftPhoto(2); ?>">
                        <div class="post_file_data" class="pad10 main_post_data hidden" data-key="">
					    </div>
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(2); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(3); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(3); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 3);" class="full_input" id="set_gift_photo3" type="file" value="<?php echo chooseGiftPhoto(3); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(3); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(4); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(4); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 4);" class="full_input" id="set_gift_photo4" type="file" value="<?php echo chooseGiftPhoto(4); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(4); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(5); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(5); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 5);" class="full_input" id="set_gift_photo5" type="file" value="<?php echo chooseGiftPhoto(5); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(5); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(6); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(6); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 6);" class="full_input" id="set_gift_photo6" type="file" value="<?php echo chooseGiftPhoto(6); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(6); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(7); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(7); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 7);" class="full_input" id="set_gift_photo7" type="file" value="<?php echo chooseGiftPhoto(7); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(7); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(8); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(8); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 8);" class="full_input" id="set_gift_photo8" type="file" value="<?php echo chooseGiftPhoto(8); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(8); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(9); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(9); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 9);" class="full_input" id="set_gift_photo9" type="file" value="<?php echo chooseGiftPhoto(9); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(9); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(10); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(10); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 10);" class="full_input" id="set_gift_photo10" type="file" value="<?php echo chooseGiftPhoto(10); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(10); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(11); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(11); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 11);" class="full_input" id="set_gift_photo11" type="file" value="<?php echo chooseGiftPhoto(11); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(11); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    <div style="background: #EDEDEF;padding: 10px;border-radius: 5px;">
                    <div class="setting_element ">
                    <p class="label">Gift name</p>
                        <input class="full_input" type="text" id="set_gift_name2" value="<?php echo chooseGiftName(12); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift points</p>
                       <input class="full_input" type="text" id="set_gift_coins2" value="<?php echo chooseGiftCoins(12); ?>">
                    </div>
                    <div class="setting_element ">
                    <p class="label">Gift image</p>
                       <input onchange="updateGift1(this, 12);" class="full_input" id="set_gift_photo12" type="file" value="<?php echo chooseGiftPhoto(12); ?>">
                       <img style="height: 70px;margin-top: 13px;" src="addons/AA_gifts/files/icons/<?php echo chooseGiftPhoto(12); ?>">
                    </div>
					<button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
                    </div>
                    <br><br>
                    
                </div>
			</div>
            <button onclick="saveSettings();" type="button" class="clear_top reg_button theme_btn"><i class="fa fa-floppy-o"></i> <?php echo $lang['save']; ?></button>
         </div>
      </div>
      <div class="config_section">
         <script data-cfasync="false" type="text/javascript">
            saveSettings = function () {
            	$.post('addons/AA_gifts/system/action.php', {
            	    set_addon_access: $('#set_addon_access').val(),
            		set_gift_name1: $('#set_gift_name1').val(),
					set_gift_coins1: $('#set_gift_coins1').val(),
					set_gift_name2: $('#set_gift_name2').val(),
					set_gift_coins2: $('#set_gift_coins2').val(),
					set_gift_name3: $('#set_gift_name3').val(),
					set_gift_coins3: $('#set_gift_coins3').val(),
					set_gift_name4: $('#set_gift_name4').val(),
					set_gift_coins4: $('#set_gift_coins4').val(),
					set_gift_name5: $('#set_gift_name5').val(),
					set_gift_coins5: $('#set_gift_coins5').val(),
					set_gift_name6: $('#set_gift_name6').val(),
					set_gift_coins6: $('#set_gift_coins6').val(),
					set_gift_name7: $('#set_gift_name7').val(),
					set_gift_coins7: $('#set_gift_coins7').val(),
					set_gift_name8: $('#set_gift_name8').val(),
					set_gift_coins8: $('#set_gift_coins8').val(),
					set_gift_name9: $('#set_gift_name9').val(),
					set_gift_coins9: $('#set_gift_coins9').val(),
					set_gift_name10: $('#set_gift_name10').val(),
					set_gift_coins10: $('#set_gift_coins10').val(),
					set_gift_name11: $('#set_gift_name11').val(),
					set_gift_coins11: $('#set_gift_coins11').val(),
					set_gift_name12: $('#set_gift_name12').val(),
					set_gift_coins12: $('#set_gift_coins12').val(),
            		token: utk,
            	}, function (response) {
            		if (response == 1) {
            			callSaved(system.saved, 1);
            		} else {
            			callSaved(system.error, 3);
            		}
            	});
            }
            loadLob = function(p){
            	hideAll();
            	$.post('addons/AA_gifts/system/'+p, { 
            		token: utk,
            		}, function(response) {
            			$('#page_wrapper').html(response);
            			selectIt();
            			pageTop();
            	});
            }
            removeFile = function(target){
            	postIcon(2);
            	$.post('system/encoded/action_files.php', {
            		remove_uploaded_file: target,
            		token: utk,
            		}, function(response) {
            	});
            }
            var waitGift1 = 0;
            updateGift1 = function(source ,target){
            	var file_data = $(source).prop("files")[0];
            	var filez = ($(source)[0].files[0].size / 1024 / 1024).toFixed(2);
            	if( filez > fmw ){
            		callSaved(system.fileBig, 3);
            	}
            	else if($(source).val() === ""){
            		callSaved(system.noFile, 3);
            	}
            	else {
            		if(waitGift1 == 0){
            			waitGift1 = 1;
            			var form_data = new FormData();
            			form_data.append("file", file_data)
            			form_data.append("target", target)
            			form_data.append("token", utk)
            			$.ajax({
            				url: "addons/AA_gifts/system/action_photo.php",
            				dataType: 'json',
            				cache: false,
            				contentType: false,
            				processData: false,
            				data: form_data,
            				type: 'post', 
            				success: function(response){
            					if(response.code > 0){
            						if(response.code == 1){
            							callSaved(system.wrongFile, 3);
            						}
            					}
            					else {
                              callSaved('Upload done', 1);
            						loadLob('config.php');
            					}
            					waitGift1 = 0;
            				}
            			})
            		}
            		else {
            			return false;
            		}
            	}
            }
            
         </script>
      </div>
   </div>
</div>