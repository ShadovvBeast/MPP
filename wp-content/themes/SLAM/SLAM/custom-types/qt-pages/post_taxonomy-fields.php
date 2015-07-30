<?php

/* = Custom taxonomy fields
======================================================*/


// Edit term page
if(!function_exists('category_taxonomy_edit_meta_field')){
function category_taxonomy_edit_meta_field($term) {
 
	// put the term ID into a variable
	$t_id = $term->term_id;
 
	// retrieve the existing value(s) for this meta field. This returns an array
	$term_meta = get_option( "taxonomy_$t_id" ); ?>
	<tr class="form-field">
	<th scope="row-fluid" valign="top"><label for="term_meta[custom_term_meta]"><?php _e( 'Category type layout', 'category' ); ?></label></th>
		<td>			
			<?php 

			 	if(isset($term_meta['colnumber'])){
				 	$colnumber = esc_attr( $term_meta['colnumber'] ) ? esc_attr( $term_meta['colnumber'] ) : ''; 
				}else{$colnumber = '';}

			 	if(isset($term_meta['sidebar'])){
				 	$sidebar = esc_attr( $term_meta['sidebar'] ) ? esc_attr( $term_meta['sidebar'] ) : ''; 
				}else{$sidebar = '';}

			 
			 	if(isset($term_meta['infscroll'])){
				 	$infscroll = esc_attr( $term_meta['infscroll'] ) ? esc_attr( $term_meta['infscroll'] ) : ''; 
				}else{$infscroll = '';}
			 ?>
			<h2>Columns:</h2>
			<p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="1" name="term_meta[colnumber]" id="term_meta[colnumber]" <?php if($colnumber=='1'){ echo 'checked="checked" ';} ?> >
				<span style="display:block; ">1 Column</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="2" name="term_meta[colnumber]" id="term_meta[colnumber]2" <?php if($colnumber=='2'){ echo 'checked="checked" ';} ?> >
				<span style="display:block; ">2 Columns</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="3" name="term_meta[colnumber]" id="term_meta[colnumber]3" <?php if($colnumber=='3'){ echo 'checked="checked" ';} ?> >			
				<span style="display:block; ">3 Columns</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="4" name="term_meta[colnumber]" id="term_meta[colnumber]4" <?php if($colnumber=='4'){ echo 'checked="checked" ';} ?> >			
				<span style="display:block; ">4 Columns</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="" name="term_meta[colnumber]"  <?php if($colnumber==''){ echo 'checked="checked" ';} ?> >			
				<span style="display:block; ">Default</span>
			</p>
			<span style="color:red">If you choose 4 columns the sidebar will be disabled anyway</span></p>

			<h2>Archive layout:</h2>
			<p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="fullwidth" name="term_meta[sidebar]" id="term_meta[sidebar]" <?php if($sidebar=='fullwidth'){ echo 'checked="checked" ';} ?> >
				<span style="display:block; ">Fullwidth page</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="sidebar" name="term_meta[sidebar]" id="term_meta[sidebar]2" <?php if($sidebar=='sidebar'){ echo 'checked="checked" ';} ?> >
				<span style="display:block; ">With Sidebar</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="" name="term_meta[sidebar]"  <?php if($sidebar==''){ echo 'checked="checked" ';} ?> >			
				<span style="display:block; ">Default</span>
			</p>
			

			<h2>Infinite scroll option:</h2>
			<p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="1" name="term_meta[infscroll]" id="term_meta[infscroll]" <?php if($infscroll=='1'){ echo 'checked="checked" ';} ?> >
				<span style="display:block; ">Enable</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="2" name="term_meta[infscroll]" id="term_meta[infscroll]2" <?php if($infscroll=='2'){ echo 'checked="checked" ';} ?> >
				<span style="display:block; ">Disable</span>
			</p><p>
				<input style="display:block; float:left; width:30px;" type ="radio" value="" name="term_meta[infscroll]"  <?php if($infscroll==''){ echo 'checked="checked" ';} ?> >			
				<span style="display:block; ">Default</span>
			</p>
			<p class="description"><?php _e( 'If not specified, will be taken the general value of the QantumPanel','_qt_' ); ?><br />

		</td>
	</tr>
<?php
}
add_action( 'category_edit_form_fields', 'category_taxonomy_edit_meta_field', 10, 2 );

}//function_exists





	// Save extra taxonomy fields callback function.
if(!function_exists('save_custom_term_meta_category')){
	function save_custom_term_meta_category( $term_id ) {
		if ( isset( $_POST['term_meta'] ) ) {
			$t_id = $term_id;
			$term_meta = get_option( "taxonomy_$t_id" );
			$cat_keys = array_keys( $_POST['term_meta'] );
			foreach ( $cat_keys as $key ) {
				if ( isset ( $_POST['term_meta'][$key] ) ) {
					$term_meta[$key] = $_POST['term_meta'][$key];
				}
			}
			// Save the option array.
			update_option( "taxonomy_$t_id", $term_meta );
		}
	}  
	add_action( 'edited_category', 'save_custom_term_meta_category', 10, 2 );  
	add_action( 'create_category', 'save_custom_term_meta_category', 10, 2 );
}


