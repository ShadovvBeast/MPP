<?php
	$fontlist = url_get_contents(THEMEURL . '/font/googlefonts.txt');
	//echo $fontlist;
	$json_a=json_decode($fontlist, true);
	$items = $json_a['items'];
	foreach($items as $i){
		if($i['kind']=='webfonts#webfont'){
			$v = str_replace(' ','+',$i['family']);
			echo '<option value="'.$v.'" ';
			if (get_option( $value['id'] ) == $v) { 
			echo ' selected="selected" '; 
			} 
			echo ' >'.$i['family'].' </option>';
		}
	}
?>