<?php

function url_get_contents ($Url) {
	if (function_exists('wp_remote_get')){ 
		$response = wp_remote_get( $Url );
		if( is_wp_error( $response ) ) {
		   $error_message = $response->get_error_message();
		   echo('Adminindex.php says: Wrong resource url');
		   return "";
		} else {
			return $response ['body'];
		}
	}
}
define('ADMINCURRENTTAB','0');
$themename = "Qantum Panel";
$shortname = THEME_SHORTNAME;
define('SPECIAL_ADMIN_PANEL','adminindex.php');
define ('CACHEPATH',get_template_directory().'/admin/actions/cache/');
$categories = get_categories('hide_empty=0&orderby=name');
$wp_cats = array();
foreach ($categories as $category_list ) {
       $wp_cats[$category_list->cat_ID] = $category_list->cat_name;   
}
array_unshift($wp_cats, "Choose a category"); 
if(is_admin()){
	include_once ('actions/_common.php');
	require_once ('actions/config.php');
}
function mytheme_add_admin() {
	$cookie = '0';
	global $themename, $shortname, $options;
	add_theme_page($themename, $themename, 'manage_options', SPECIAL_ADMIN_PANEL, 'mytheme_admin');
	add_menu_page($themename, $themename, 'manage_options', SPECIAL_ADMIN_PANEL, 'mytheme_admin',get_template_directory_uri().'/admin/immagini/panelicon.png');
	

	//add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position ); 
	
	if ( isset( $_GET['page'] ) ){
		if ( $_GET['page'] == basename(__FILE__) ) {
					if ( isset( $_POST['action'] )){
						if ( 'save' == $_POST['action'] && 'reset' != $_REQUEST['action']) {

									
												$includeAction = '';
												$debugger='';
												/* = Options saving
												==========================================================================*/
												foreach ($options as $value) {
													//**********************************************************************************
													if(isset($value['id'])){
														//====== SETTINGS OR VALUE IDS =====================================
														if(isset($_POST[ $value['id'] ]) || isset ($_FILES[$value['id']])){
															//============ MAIN UPDATING REQUEST MANAGEMENT ================
															if($value['type']=='file'){
																if(!isset($_REQUEST['delete-'.$value['id'] ] )){
																	$newinput = array();
																	if (isset($_FILES[$value['id']]) && $_FILES[$value['id']]!='') {
																		$overrides = array('test_form' => false); 
																		$file = wp_handle_upload($_FILES[$value['id']], $overrides);
																		$newinput['file'] = $file;
																		if(isset($file['url'])){
																			$var_value = $file['url'];
																			if($var_value != ''){
																				update_option( $value['id'],  $var_value ); 
																			}
																		}
																	}
																}else if(isset($_REQUEST['delete-'.$value['id'] ] ) ){ //
																	if($_REQUEST['delete-'.$value['id']] == 'delete'){
																		update_option( $value['id'],  '' ); 
																	}
																}
															}else if($value['type']!='file'){
																if(isset($_REQUEST[ $value['id'] ])){
																	$var_value = $_REQUEST[ $value['id'] ] ;
																	update_option( $value['id'],  wp_htmledit_pre($var_value) ); 
																}
															}
															//========= END OF MAIN UPDATING REQUEST MANAGEMENT =============
														}//if(isset($_POST[ $value['id'] ]) || isset ($_FILES[$value['id']])){
													}//if(isset($value['id'])){ 

													//=========================== dynamic action =======================================
													if(isset($value['dyn_action'])){
														if($value['dyn_action'] != ''){
															if(isset($_POST[$value['dyn_action']])){
																update_option('perform_dyn_action','yes');
																$action_todo 	= trim($value['dyn_action']);
																$arg_todo 		= trim($_POST[$value['dyn_action']]);
																$includeAction .= "&".$action_todo.'='.$arg_todo;	
															}
														}	
													}	
													//=========================== end of dynamic action ================================
												}// end foreach ($options as $value) {

													/* = start function to activate fontface
												==========================================================================*/
												$fontfaceDebug = '';
												if ( get_option( THEME_SHORTNAME . '_fontface_enable' ) == 'true' && get_option( THEME_SHORTNAME . '_fontface_font' )!='') {
													include('plugins/fontfaceParser.php');
													
													$style_to_get_font = THEMEURL . "/font/" . get_option( THEME_SHORTNAME . '_fontface_font' ) . '/stylesheet.css';
													if(function_exists('url_get_contents')){
															$file = url_get_contents($style_to_get_font);
															if ($file != false){
																$font_name = fontfaceParser($file);
																update_option(THEME_SHORTNAME.'_additionalCssFontFace',$font_name);	
															}else{
																$fontfaceDebug = 'Impossible to read the font css file. The server cannot access this file: '.$style_to_get_font;
															}
													}else{
														$fontfaceDebug = 'Missing function url_get_contents';
													}
												}
	
												
												
												// ========================================================================================
						header("Location: admin.php?page=".SPECIAL_ADMIN_PANEL."&saved=true&".$includeAction);
						die;
						} //if ( 'save' == $_POST['action'] ) {
					}
				}// if ( isset( $_POST['action'] )){
		} //if ( $_GET['page'] == basename(__FILE__) ) {
	}// if ( isset( $_GET['page'] ) ){


	function mytheme_admin() {
		$cookie = '1';
		global $themename, $shortname, $options;
		$i=0;
		 if ( isset( $_REQUEST['saved'] )){
					if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
		 }
		 if ( isset( $_REQUEST['reset'] )){			
			if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
		 }

		?>
        <div class="containeradmin">
            <div class="hwrapper">&nbsp;</div>
            <div class="section vertical fleft">
            	<div class="sidebar_left">
                    <div class="logo_holder">
                    <img src="<?php echo get_template_directory_uri(); ?>/admin/immagini/logo.png"  alt="qantum pro" />
                    </div>

               		<ul class="tabs">
                   	<?php
                   	if(isset($_COOKIE['curtabz'])){
				   		$cookie = $_COOKIE['curtabz'];
				   	}else{
				   		$cookie = 'no';
				   	}
				   	$n=0;
					$first = 0;
				   	foreach ($options as $value) {
						if($value['type']=='section' ){
							$n++;
						echo   '<li'; 
						if(isset($cookie)){
							if ($n==$cookie || $first == 0){
								echo ' class="current" ';
							}
						}
						echo '><span id="icon'.$n.'" ';
						echo '>'.$value['name'].'</span></li>';
						}
						$first++;
					}
					/**/
					
				   ?> 
                </ul>
            </div>
			
            <div class="contents">
                        <form method="post" enctype="multipart/form-data" action="admin.php?page=<?php echo SPECIAL_ADMIN_PANEL; ?>" >
                        <?php

                        /* Fields case
                        =================================================*/
									function QTprintDesc($v,$id){
										if($v!=''){
											echo '<p class="QTdescription" id="descfor'.$id.'">'.$v.'</p>';
										}
									}
									function QTinfos($v,$id){
										if($v!=''){
											echo ' <a href="#" class="infoSign" data-relto="'.$id.'"><i class="icon-info-sign" ></i></a>';
										}
									}
									$boxnumber = 1;
									$currentclass = '';
									foreach ($options as $value) {
										if($value['type']=='section' ){
											$boxnumber ++;
										}
										if(isset($_COOKIE['curtabz'])){
											if($boxnumber == $_COOKIE['curtabz']) {
												$currentclass = ' visible';}else{$currentclass = '';
											}
										}
										if(!isset($value['desc'])){$value['desc']='';}

										switch ( $value['type'] ) {
											//___________________________________open
											case "open":
												?><div class="box <?php echo $currentclass.' '. $_COOKIE['curtabz']. '-'.$boxnumber; ?>">
												
												<?php
											break;
											//___________________________________number
											case 'number':
											?>
													<div class="element">
														<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?></label>
														<input class="" name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))  ); } else { if(isset($value['std'])) { echo $value['std']; } } ?>" />
														<small><?php if(isset($value['desc'])) { echo $value['desc'];} ?></small>
													</div>
													<div class="canc"></div>
											<?php
											break;
											//___________________________________close
											case "close":
											?>
												<div class="element" style="text-align:right;">
												<input name="save<?php echo $i; ?>" class="button button-primary" type="submit" value="Save changes"  />
												</div>
											   </div>
											<?php
											break;
											//___________________________________title
											case "title":
											?>
												<!-- <h1>To easily use the <?php echo $themename;?> theme, you can use the menu below.</h1> -->
											<?php 
											break;
											//___________________________________title
											case "contents":
											?>
												<?php echo $value['desc']; ?>
											<?php 
											break;
											//___________________________________ temporary_text
											case 'temporary_text':
											?>
													<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?></label>
														<!--<input class="textinput" name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>" type="text" 
														value=" " />-->
														<small><?php if(isset($value['desc'])) { echo $value['desc'];} ?></small>
													</div>
													<div class="canc"></div>
											<?php
											break;
											//___________________________________text
											case 'pageselect':
											?>
													<div class="element">
														<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
														<?php QTprintDesc($value['desc'],$value['id']); ?>
														<?php			
															$post_type = 'page';
															if(isset($value['post_type'])){
																$post_type = $value['post_type'];
																if ( !post_type_exists( $post_type ) ) {
																	echo 'Error: this post type doesn\'t exists';
																}
															}
															$args = array(
																//'depth'            	=> 0,
																//'child_of'         	=> 0,
																//'selected'         	=> 0,
																'echo'             	=> 1,
																'post_type' 		=> $post_type,
																'name'             	=> $value['id'],
																'show_option_none' 	=> '---- SELECT ----'
															);
															if(get_option( $value['id']) != ''){
																$args['selected'] = get_option($value['id']);
															}
															wp_dropdown_pages($args);
														?>
													</div>
													<div class="canc"></div>
											<?php
											break;
											//___________________________________text
											case 'text':
											?>
													<div class="element">
														<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo ucfirst($value['name']); ?><?php QTinfos($value['desc'],$value['id']); ?></label>
														<input class="textinput" name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))  ); } else { if(isset($value['std'])) { echo $value['std']; } } ?>" />
														<?php QTprintDesc($value['desc'],$value['id']); ?>
													</div>
													<div class="canc"></div>
											<?php
											break;
											//___________________________________text
											case 'color':
											?>
													<div class="element">
														<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
														<input class="color {required:false}" name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>" type="<?php /*echo $value['type'];*/ ?>text" value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { if(isset($value['std'])) { echo $value['std']; } } ?>" />
									                    <a href="#"  class="nounderline" onclick="if(jQuery('#<?php echo $value['id'];?>').attr('value','').css({'background-color':'#FFF'})){}"><i class="icon-undo"></i> Reset</a>
														<?php QTprintDesc($value['desc'],$value['id']); ?>
													</div>
													<div class="canc"></div>
											<?php
											break;
											//___________________________________text
											case 'temporary_text':
											?>
													<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
														<input class="textinput" name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>" type="text" 
														value=" " />
														<?php QTprintDesc($value['desc'],$value['id']); ?>
													</div>
													<div class="canc"></div>
											<?php
											break;
											//___________________________________ image file upload __________________________________________________________________________
											case 'file':
											?>
												<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
													<?php QTprintDesc($value['desc'],$value['id']); ?>
													<?php 
													$myfile = stripslashes(get_option( $value['id'] ));
													if ( $myfile != "" && preg_match( "/\.(png|jpg|gif|ico)/i", $myfile )) 
													{ 
														$maxw = '100px';
														if(isset($value['previewwidth'])){
															$maxw = $value['previewwidth'];
														}
														echo '<img width="'.$maxw.'" class="adminimage" src="'.$myfile.'" style="width:'.$maxw.'" />';
													} 
													 echo '<input type="'.$value['type'].'" name="'.$value['id'].'" size="40" />';
													if(get_option( $value['id'] )!='') {
														 echo '<br />Delete image? <input type="checkbox" value="delete" name="delete-'.$value['id'].'"  /> Yes';
													}
												
													?>
									                 <div class="canc"></div>
												 </div>   
											<?php
											break;
											//___________________________________textarea
											case 'textarea':
											?>
												<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
													<?php QTprintDesc($value['desc'],$value['id']); ?>
													<textarea name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(esc_attr(get_option( $value['id']))); } else { if(isset($value['std'])) { echo $value['std']; } } ?></textarea>

												</div>
											<?php
											break;
											//___________________________________ select
											case 'select':
											?>
												<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
													<?php QTprintDesc($value['desc'],$value['id']); ?>
													<select name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>">
														<?php foreach ($value['options'] as $option) { ?>
															<option value="<?php echo $option; ?>" <?php if (get_option( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
														<?php } ?>
													</select>
												</div>
											<?php
											break;
											//___________________________________ file select
											case 'file_select':
											// make  the path relative wo wp-admin
											$path = $value['folder'];
											$pathar = explode('/wp-content',$path);
											$path = '../wp-content'.$pathar[1];
											$dir_handle = @opendir($path) or die("No folder found for this select options.");
											?>
												<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
													<?php QTprintDesc($value['desc'],$value['id']); ?>
													<select name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>">
													<?php
													$files = array();
													while ($files[] = readdir($dir_handle));
													sort($files);
													
													foreach ($files as $file) 
													{				
													if($file!="." && $file!=".." && $file!="")	
															echo '<option value="'.$file.'" ';
															if (get_option( $value['id'] ) == $file) { 
															echo ' selected="selected" '; 
															} 
															echo ' >'.$file.' </option>';
													}
													closedir($dir_handle);
													?>
													</select>
												</div>
											<?php
											break;
											//___________________________________ image image_file_select
											case 'image_file_select':
											// make  the path relative wo wp-admin
											$path = $value['folder'];
											$pathar = explode('/wp-content',$path);
											$path = '../wp-content'.$pathar[1];
											$dir_handle = @opendir($path) or die("No folder found for this select options.");
											?>
												<div class="element">
													
													<small><?php if(isset($value['desc'])) { echo $value['desc']; } ?></small>
													<?php
													
													$files = array();
													while ($files[] = readdir($dir_handle));
													sort($files);
													$torep = array('-','_');
													$images = '';
													
													echo '<H2>Actually selected: '.get_option( $value['id'] ).'</H3><HR /><br /><br />';
													
													$n = 1;
													foreach ($files as $file) 
													{	
														if($file!="." && $file!=".." && $file!="" && !preg_match("/_preview/",$file)):
																
																
																$previewfile = $path .'/_preview/'.$file.'.png';
																if(is_file($previewfile)){
																	
																	$checked = '';
																	$class = '';
																	if (get_option( $value['id'] ) == $file) { 
																		$checked = ' checked="checked" '; 
																		$class = ' selected ';
																	} 
																			
																	
																	$images .= '
																	
																	<label class="image_selector">
																	<input type="radio" value="'.$file.'" name="'.$value['id'].'" '.$checked .'>
																	'.$n.' - '.str_replace($torep,' ',$file).'<br /><img class="fileselector '.$class.'"   src="'.$previewfile.'" />
																	</label>';
																	$n++;
																}
																
														endif;
													}
													closedir($dir_handle);
													echo $images;
													?>
									                <div class="canc"></div>
												</div>
											<?php
											break;
											//___________________________________ action_field
											case 'action_field':
											?>
													<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?></label>
														<input class="textinput" name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>" type="text" 
														value=" " />
														<small><?php if(isset($value['desc'])) { echo $value['desc'];} ?></small>
													</div>
													<div class="canc"></div>
											<?php
											break;
											//___________________________________ googlefont
											case 'googlefont':
											?>
                                            
												<?php
                                                $oldOption ='Abel';
                                                if(get_option( $value['id'] )== ''){
                                                    $oldOption =  $value['std'];
                                                }else{
                                                    $oldOption =  get_option( $value['id'] );
                                                }
                                                ?>
                                                        
                                                        
												<div class="element">
													<label>Font family:</label>
														
														<select name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" class="googlefont-switch" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>">
															<?php
																$fontlist = url_get_contents(THEMEURL . '/font/googlefonts.txt');
																$json_a=json_decode($fontlist, true);
																$items = $json_a['items'];
																$n=1;
																
																
																foreach($items as $i){
																	if($i['kind']=='webfonts#webfont'){
																		$v = $i['family'];
																		echo '<option value="'.$v.'" ';
																		if ($oldOption == $v) { 
																			echo ' selected="selected" '; 
																		} 
																		echo ' >'.$i['family'].' </option>';
																		$n++;
																	}
																}
															?>
														</select>
														<div class="googlefontTestarea" id="font-testarea<?php if(isset($value['id'])) { echo $value['id']; } ?>" <?php if (get_option( $value['id'] ) != '') { echo ' data-visible="true" '; } ?>>					
															<h1>Grumpy wizards make toxic brew for the evil Queen and Jack.</h1>
															<h2>Grumpy wizards make toxic brew for the evil Queen and Jack.</h2>
															<h3>Grumpy wizards make toxic brew for the evil Queen and Jack.</h3>
															<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam commodo tortor sit amet libero dignissim porta. Curabitur condimentum ullamcorper tellus hendrerit molestie. Cras condimentum, nisl vitae posuere dictum, quam dui pulvinar lacus, et ullamcorper tellus libero non justo. Donec adipiscing volutpat tortor, vel adipiscing arcu tempor id. Quisque lobortis, enim eu malesuada luctus, turpis justo ornare magna, vitae iaculis ligula felis et urna. Nullam id odio consectetur, accumsan ante nec, congue mi. Integer at bibendum turpis. Proin in nisi augue. Donec facilisis mi at erat egestas pretium.</p>
									                	</div>

									                <div class="canc"></div>
												</div>
											<?php
											break;
											//___________________________________ checkbox
											case "checkbox":
											?>
												<div class="element">
													<label for="<?php if(isset($value['id'])) { echo $value['id']; } ?>"><?php echo $value['name']; ?><?php QTinfos($value['desc'],$value['id']); ?></label>
													<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
													<input type="checkbox" name="<?php if(isset($value['id'])) { echo $value['id']; } ?>" id="<?php if(isset($value['id'])) { echo $value['id']; } ?>" value="true" <?php echo $checked; ?> />
													<?php QTprintDesc($value['desc'],$value['id']); ?>
												</div>
											<?php 
											break; 
											//___________________________________ section
											case "section":
											$i++;
											?> <div class="element" style="text-align:right;">
												
												</div>
												<h1>
												<?php echo $value['name']; ?>
                                                <input name="save<?php echo $i; ?>" class="button button-primary pull-right" type="submit" value="Save changes"  />
                                                </h1>
                                                
									           
											<?php 
											break;
											//___________________________________ section
											case "subtitle":
											$i++;
											?>
												<h2><?php echo $value['name']; ?></h2>
											<?php 
												break;
											//___________________________________ hidden
											case "hidden":
												$i++;
												echo $value['name']; ?>: <?php get_option( $value['id'] ); 
												break;
											//___________________________________ DYNAMIC ACTION
											case 'dynamicaction':
											case 'dynamicaction':
												if(isset($_GET['saved']) && isset($value['qwaction']) && isset($_GET[$value['qwaction']])){
													if(get_option('perform_dyn_action')=='yes'){
															$action_argument = $_GET[$value['qwaction']];
															if($_GET[$value['qwaction']]!=''){
																//echo 'actions/'.$value['qwaction'].'.php';
																if(BEATPORTACTIONS == 'enabled'){
																	require_once ('actions/'.$value['qwaction'].'.php');
																	
																	update_option('perform_dyn_action','');
																}else{
																	echo '<br /><br /><font color="red">This function is disabled.</font> Please read the manual to know how to activate this function.<br /><br />
																			You basically need to download, unzip and upload to your server the free class needed to perform this action. This because is not a function available for commercial purposes, so it must be available for free and I can\'t include it as part of this product. Sorry.<br />
																			but don\'t worry is a really simple thing to do!!
																			';	
																}
															}
													}else{

														echo '<font color="green"><em>Action already performed. Do not use refresh to perform again, is useless.</em></font>';	
													}
												}
											break;
											break;
											//___________________________________ACTION BUTTON
											case 'actionbutton':
											break;
											//___________________________________ section
											case "reference":
											$i++;
											?>
												<h2><?php echo $value['name']; ?></h2>
													<?php
													foreach ($options as $value) {

														switch($value['type']){

															case 'section':
																echo '<h4 class="ref_section">'.$value['name'].'</h4>';
															break;
															case 'subtitle':
																echo '<br /><strong style="padding-top:8px;">'.$value['name'].'</strong><br />';
															break;
															case 'open':
															case 'close':
															break;
															default:
																if(isset($value['id'])){
																	echo $value['id'].': <strong>'.stripslashes(esc_attr(get_option( $value['id']))).'</strong><br />';
																}

														}


													}
											break;
									}
									}

									/* End of the fields case
									====================================================================*/
								?> 
                	<input id="curtabz" type="hidden" name="curtabz" value="x" />
                	<input type="hidden" name="action" value="save" />
                </form>
                <!-- <div class="box">
                    <form method="post">
                        <p class="submit">
                        <input name="reset" type="submit" value="Reset" />
                        <input type="hidden" name="action" value="reset" />
                        </p>
                    </form>
                </div>-->
            </div>
            <div class="canc">&nbsp;</div>
        </div><!-- .section -->
	</div>
   <a href="http://qantumthemes.com/manuals/slam/" target="_blank"><strong>Open Online Manual</strong></a>
    <?php

}

function mytheme_add_init() {
	if(is_admin()){
		$screen = get_current_screen();
		if($screen->base === 'appearance_page_adminindex' || $screen->base === 'toplevel_page_adminindex'){
			$file_dir=get_template_directory_uri();
		//	wp_enqueue_style( 'QTfont-awesome-style', $file_dir.'/css/font-awesome/css/font-awesome.min.css' );
			wp_enqueue_style("QTfunctions", $file_dir."/admin/style.css", false, "1.0", "all");
			wp_enqueue_script('jquery');
			wp_enqueue_script("QTgeneralscript", $file_dir."/admin/js/generalScript.js", 'jquery');
			wp_enqueue_style("QTfontstyle", $file_dir."/admin/font/stylesheet.css", false, "1.0", "all");
			wp_enqueue_script("QTadmintabs", $file_dir."/admin/js/tabs.js",'jquery');
			wp_enqueue_script("QTqtimageselect", $file_dir."/admin/js/imageselect.js", 'jquery');	
			wp_enqueue_script("QTjquerycookies", $file_dir."/admin/js/jquerycookie.js", 'jquery');
			wp_enqueue_script("QTjscolor", $file_dir."/admin/js/jscolor/jscolor.js", 'jquery');
		}		
	}
}
add_action('admin_enqueue_scripts', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin',99999999999);