<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<?php include ('include/data.php'); ?>
<form action="admin.php?page=<?php echo $pluginname;?>" method="post">
	<div class="wowcolom">
		<div id="wow-leftcol">
			
			<input placeholder="Name is used only for admin purposes" type='text' name='title' value="<?php echo $title; ?>" class="wow-title"/>
			
			<div class="tab-box wow-admin">
				<ul class="tab-nav">
					<li><a href="#t1"><i class="fa fa-css3" aria-hidden="true"></i> Style</a></li>
					<li><a href="#t2"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a></li>					
				</ul>
				<div class="tab-panels">
					<div id="t1">
						<div class="itembox">
							<div class="item-title">
								<h3>Menu</h3>									
							</div>
							<div class="inside" style="display: block;">
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Position:<br/>									
										<select name="param[menu]">																	
											<option value="left" <?php if($param['menu']=='left') { echo 'selected="selected"'; } ?>>Left</option>
											<option value="right" <?php if($param['menu']=='right') { echo 'selected="selected"'; } ?>>Right</option>
										</select>								
									</div>
									<div class="wow-admin-col-4">
										Align <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>									
										<select disabled="disabled" >
											<option value="center">Center</option>									
										</select>	
										
									</div>
									<div class="wow-admin-col-4">
										Shape <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>									
										<select disabled="disabled" >																	
											<option value="square">Square</option>									
										</select>	
										
									</div>
								</div>
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Side Space:<br/>									
										<select name="param[sideSpace]">																	
											<option value="true" <?php if($param['sideSpace']=='true') { echo 'selected="selected"'; } ?>>Yes</option>
											<option value="false" <?php if($param['sideSpace']=='false') { echo 'selected="selected"'; } ?>>No</option>
										</select>								
									</div>
									<div class="wow-admin-col-4">
										Button Space:<br/>									
										<select name="param[buttonSpace]">																	
											<option value="true" <?php if($param['buttonSpace']=='true') { echo 'selected="selected"'; } ?>>Yes</option>
											<option value="false" <?php if($param['buttonSpace']=='false') { echo 'selected="selected"'; } ?>>No</option>
										</select>								
									</div>
									<div class="wow-admin-col-4">
										Label On:<br/>									
										<select name="param[labelsOn]">																	
											<option value="true" <?php if($param['labelsOn']=='true') { echo 'selected="selected"'; } ?>>Yes</option>
											<option value="false" <?php if($param['labelsOn']=='false') { echo 'selected="selected"'; } ?>>No</option>
										</select>								
									</div>
								</div>
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Label Space:<br/>									
										<select name="param[labelSpace]">																	
											<option value="true" <?php if($param['labelSpace']=='true') { echo 'selected="selected"'; } ?>>Yes</option>
											<option value="false" <?php if($param['labelSpace']=='false') { echo 'selected="selected"'; } ?>>No</option>
										</select>								
									</div>
									<div class="wow-admin-col-4">
										Label Connected:<br/>									
										<select name="param[labelConnected]">																	
											<option value="true" <?php if($param['labelConnected']=='true') { echo 'selected="selected"'; } ?>>Yes</option>
											<option value="false" <?php if($param['labelConnected']=='false') { echo 'selected="selected"'; } ?>>No</option>
										</select>								
									</div>
									<div class="wow-admin-col-4">
										Label Effect <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>									
										<select disabled="disabled">
											<option value="fade">Fade</option>
										</select>	
										
									</div>
								</div>
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Label Speed (ms) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>	
										<input type="text" value="400" disabled="disabled">
									</div>					
								</div>
							</div>
						</div>
						<div class="itembox">
							<div class="item-title">
								<h3>Sub Menu</h3>									
							</div>
							<div class="inside" style="display: block;">
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Sub Position <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>	
										<select disabled="disabled">																	
											<option>Only Pro version</option>									
										</select>			
										
									</div>
									<div class="wow-admin-col-4">
										Sub Space <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>	:<br/>									
										<select disabled="disabled">																	
											<option>Only Pro version</option>									
										</select>			
										
									</div>
									<div class="wow-admin-col-4">
										Sub Effect <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>									
										<select disabled="disabled">																	
											<option>Only Pro version</option>									
										</select>			
										
									</div>
								</div>
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Sub Speed (ms) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>	
										<input type="text" disabled="disabled" value="Only Pro version">																	
									</div>
								</div>
							</div>
						</div>
						<div class="itembox">
							<div class="item-title">
								<h3>Popup</h3>									
							</div>
							<div class="inside" style="display: block;">
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Horizontal position <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>	:<br/>									
										<select disabled="disabled">																	
											<option>Only Pro version</option>									
										</select>			
										
									</div>							
									<div class="wow-admin-col-4">
										Vertical position <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>									
										<select disabled="disabled">																	
											<option>Only Pro version</option>									
										</select>			
										
									</div>
									<div class="wow-admin-col-4">
										Corners <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>									
										<select disabled="disabled">																	
											<option>Only Pro version</option>									
										</select>			
										
									</div>
								</div>
								<div class="wow-admin-col">
									<div class="wow-admin-col-4">
										Color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>									
										<select disabled="disabled">																	
											<option>Only Pro version</option>									
										</select>			
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div id="t2">
						<div class="menu_1">
							<?php if ($count_i > 0){
								ksort($param['item_order']);
								foreach ($param['item_order'] as $key => $i) { ?>
								<div class="menu_1-items-<?php echo $i+1;?> itembox">
									<div class="item-title">
										<h3> Item <span class="menu_1-icount"><?php echo $key+1;?></span></h3>
										<input type="hidden" class="menu-order" name="param[item_order][]" value="<?php echo $i;?>">										
										<?php if ($key > 0) { ?> 
											<div class="handlediv" title="Delete"></div>
										<?php } ?>
										<div class="toggle togglehide" title="Hide" onclick="toogle(this);"></div>
									</div>
									<div class="inside" style="display: block;">
										<div class="wow-admin-col">
											<div class="wow-admin-col-4">
												Icon: custom <input disabled="disabled" type="checkbox" value="1" ><br/>
												<div id="iconstandart_<?php echo $i;?>">
													<span id="menu_1_icons_<?php echo $i;?>"></span>
												</div>
												<input type="hidden" value="<?php echo $param['menu_1']['item_icon'][$i]; ?>" id="menu_1_item_icon_<?php echo $i;?>">	
											</div>
											<div class="wow-admin-col-4">
												<?php esc_attr_e("Label", "wow-fmp-lang") ?>:<br/>
												<input type="text" name="param[menu_1][item_tooltip][<?php echo $i;?>]" value="<?php if(!empty($param['menu_1']['item_tooltip'][$i])) echo $param['menu_1']['item_tooltip'][$i]; ?>">			
											</div>
											<?php if ($i > 0){ ?>
												<div class="wow-admin-col-4">
													Sub item <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>	:<br/>
													<input type="checkbox" disabled="disabled" value="1" > 
												</div>
											<?php } ?>
										</div>
										<div class="wow-admin-col">
											<div class="wow-admin-col-4">	
												Item type <span class="dashicons dashicons-lock" style="color:#37c781;" title="Only Pro version"></span>:<br/>
												<select disabled="disabled">
													<option value="link">Link</option>				
												</select>
											</div>
											<div class="wow-admin-col-4 menu_1_item_link_<?php echo $i;?>">
												<span id="menu_1_item_link_<?php echo $i;?>">Link</span>: <span class="menu_1_item_link_<?php echo $i;?>"> open new window <input type="checkbox" name="param[menu_1][new_tab][<?php echo $i;?>]" value="1" <?php if(!empty($param['menu_1']['new_tab'][$i])) echo 'checked="checcked"'; ?>></span><br/>
												<input type="text" name="param[menu_1][item_link][<?php echo $i;?>]" value="<?php if(!empty($param['menu_1']['item_link'][$i])) echo $param['menu_1']['item_link'][$i]; ?>">
											</div>										
										</div>
										<div class="wow-admin-col">
											<div class="wow-admin-col-4">
												Сolor:<br/>
												<input type='text' placeholder="#ffffff" class="wp-color-picker-field" data-alpha="true" name='param[menu_1][color][<?php echo $i;?>]' value="<?php if(empty($param['menu_1']['color'][$i])){echo "#ffffff";}else{echo $param['menu_1']['color'][$i];}?>"/>
											</div>
											<div class="wow-admin-col-4">
												Background:<br/>
												<input type='text' placeholder="#ffffff" class="wp-color-picker-field" data-alpha="true" name='param[menu_1][bcolor][<?php echo $i;?>]' value="<?php if(empty($param['menu_1']['bcolor'][$i])){echo "#ffffff";}else{echo $param['menu_1']['bcolor'][$i];}?>"/>
											</div>
										</div>
									</div>
								</div>
								<?php	
								} 
							} 										
							?>
						</div>
						<div class="submit-bottom">
							<input type="button" value="Add item" class="formsub fully-rounded" onclick="itemadd(1)"> 							
						</div>
					</div>	
				</div>
			</div>
		</div>
		<div id="wow-rightcol">
			<div class="wowbox">
				<h3>Publish</h3>
				<div class="wow-admin" style="display: block;">
					<div class="wow-admin-col">
						<div class="wow-admin-col-6">
							<?php if ($id != ""){ echo '<p class="wowdel"><a href="admin.php?page='.$pluginname.'&info=del&did='.$id.'">Delete</a></p>';}; ?>
						</div>
						<div class="wow-admin-col-6 right">
							<p/>
							<input name="submit" id="submit" class="button button-primary" value="<?php echo $btn; ?>" type="submit">
						</div>
					</div>
				</div>
			</div>			
			<div class="wowbox">
				<h3>Display</h3>
				<div class="inside wow-admin" style="display: block;">
					<div class="wow-admin-col wow-wrap">
						<div class="wow-admin-col-12">
							Show for users: <br/>
							<input type="radio" checked="checked" > All users <br />
							<input type="radio" disabled="disabled"> If a user logged in <span class="dashicons dashicons-lock" style="color:#37c781;"></span><br />
							<input type="radio" disabled="disabled" > If user not logged <span class="dashicons dashicons-lock" style="color:#37c781;"></span>
						</div>
						<div class="wow-admin-col-12">
							<input name="param[include_mobile]" type="checkbox" value="1" <?php if(!empty($param['include_mobile'])) { echo 'checked="checked"'; }; ?> onclick="screen();"> Don’t show on screens less than (px)<br/>
							<div style="display:none;" id="screen">
								<input type="text" name="param[screen]" value="<?php if(!empty($param['screen'])) echo $param['screen']; ?>" /> 
							</div>
						</div>
						<div class="wow-admin-col-12">
							<input type="checkbox" disabled="disabled"> <?php esc_attr_e("Depending on the language", "wow-bmp-lang") ?> <span class="dashicons dashicons-lock" style="color:#37c781;"></span>
						</div>
						<div class="wow-admin-col-12">
							Show menu <span class="dashicons dashicons-lock" style="color:#37c781;"></span>:<br/>
							<select disabled="disabled">
								<option value="">Only Pro Version</option>									
							</select>
							
						</div>
						<div class="wow-admin-col-12" style="display:none;" id="shortcode" >
							<b>[Floating-Menu id=<?php echo $id; ?>]</b>
						</div>
					</div>
				</div>
			</div>
			<div class="wowbox">
				<center><img src="<?php echo plugin_dir_url( __FILE__ ); ?>thankyou.png" alt=""  /></center>
				<hr/>				
				<div class="wow-admin wow-plugins">
					<p>We will be very grateful if you <a href="https://wordpress.org/plugins/float-menu/" target="_blank"><b>leave a review about the plugin</b></a>.</p>
					<p>If you have suggestions on how to improve the plugin or create a new plugin, write to us via the <a href="admin.php?page=<?php echo $pluginname;?>&tool=support" target="_blank"><b>support form</b></a></p>					
					<p>We really appreciate your reviews and suggestions for improving the plugin.</p>
					<p>					
					<b><em>Thank you for choosing the plugin from Wow-Company! </em></b></p>
					<em><b>Best Regards</b>,<br/>						
						<a href="https://wow-estore.com/" target="_blank">Wow-Company Team</a><br/>
						Dmytro Lobov<br/>
						<a href="mailto:support@wow-company.com">support@wow-company.com</a>
					</em>
					
				</div>
			</div>			
		</div>
	</div>
	<input type="hidden" name="param[time]" value="<?php echo time(); ?>" />
	<input type="hidden" name="add" value="<?php echo $hidval; ?>" />    
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="data" value="<?php echo $data; ?>" />
	<input type="hidden" name="page" value="<?php echo $pluginname;?>" />	
	<input type="hidden" name="plugdir" value="<?php echo $pluginname;?>" />		
	<?php wp_nonce_field('wow_plugin_action','wow_plugin_nonce_field'); ?>
</form>	
<div style="display:none;">
	<select id="icons" class="icons">
		<?php
			include ('icon.php');										
		?> 
	</select>
</div>						