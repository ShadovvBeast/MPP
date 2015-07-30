<?php

if(isset($_POST['action']) && isset($_POST['option_page'])){
	if ( 
	    ! isset( $_POST['qtbeatimp_settings'] ) 
	    || ! wp_verify_nonce( $_POST['qtbeatimp_settings'], 'qtbeatimp_settings_update' ) 
	) {

	   print 'Sorry, your nonce did not verify.';
	   exit;

	} else {
		$fields = array("beatport_api_key",
		                "beatport_api_secret",
		                "qwim_importimage",
		                "qwim_importsample"
		                );

		foreach ( $fields as $a ) {
			if(isset($_POST[$a])){
				update_option($a, sanitize_text_field($_POST[$a]));
			}else{
				update_option($a, "");
			}
		}
	}
}
?>
<h1>QantumThemes Beat Importer Settings</h1>
<?php
 if(get_option("beatport_api_key") == '' || get_option("beatport_api_secret") == ''){
        ?>
        <div class="qw-alert">
        	Attention: you need a Beatport API key and secret to use this plugin.
        </div>

        <?php
    }
?>
<form method="post" action="tools.php?page=qtbeatimp_settings&tab=settings" novalidate="novalidate">


	<input type="hidden" name="option_page" value="QWIM_OPTION">
	<input type="hidden" name="action" value="update">
	<?php wp_referer_field() ?>
	<?php wp_nonce_field('qtbeatimp_settings_update','qtbeatimp_settings'); ?>

	<table class="form-table">
		<tbody>

			

			<tr>
				<th scope="row"><label for="beatport_api_key">Beatport Api Key</label></th>
				<td><input name="beatport_api_key" type="text" id="beatport_api_key" value="<?php echo esc_attr(get_option("beatport_api_key")); ?>" class="regular-text">
				<br><small>Stored value: <?php echo esc_attr(get_option("beatport_api_key")); ?></small></td>
			</tr>
			<tr>
				<th scope="row"><label for="beatport_api_secret">Beatport Api Secret</label></th>
				<td><input name="beatport_api_secret" type="text" id="beatport_api_secret" value="<?php echo esc_attr(get_option("beatport_api_secret")); ?>" class="regular-text"><br>
					<small>Stored Value: <?php echo esc_attr(get_option("beatport_api_secret")); ?></small></td>
			</tr>

			
			<!--
				To do: add check in the code
			<tr>
				<th scope="row"><label for="qwim_importsample">Import mp3 sample</label></th>
				<td><input name="qwim_importsample" type="checkbox" id="qwim_importsample" <?php echo ((get_option("qwim_importsample")=='on')? 'checked="checked"':''); ?> class="regular-checkbox">
				<small> (disable if you are getting problem importing. Player will link to the original mp3.)</small></td>
			</tr>

			<tr>
				<th scope="row"><label for="qwim_importimage">Import release cover</label></th>
				<td><input name="qwim_importimage" type="checkbox" id="qwim_importimage" <?php echo ((get_option("qwim_importimage")=='on')? 'checked="checked"':''); ?> class="regular-checkbox">
					<small> (disable if you are getting problem importing. You will need to upload featured image manually)</small></td>
			</tr>

			-->
			
		</tbody>
	</table>


	<p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
</form>

<h3>Getting your API key:</h3>
<p>Please visit: https://oauth-api.beatport.com/</p>
<p>Note: this software is intended to help musicians and label owners increasing their beatport sales by easily displaying the releases in their websites. Any other use is not legal</br>
	You are the only one responsible about the use that you are doing of this plugin. Use it only to import the releases that you want to sell</br>
	Every release must maintain its own link to the original Beatport page in order to help people buy your music from the marketplace.</p>