<div class="qw-index-header">
	
    <div class="row-fluid qw-logobar" >
        <div class="qw-logocontainer span<?php 
		if(function_exists('header_layout_balance')){
			echo header_layout_balance('logo');
		}else{
			echo '12';
		}
		?>">
             <?php
				display_logo(); // includes/frontend_functions.php
			?>
        </div>
        <div class="span<?php 
		if(function_exists('header_layout_balance')){
			echo header_layout_balance('social');
		}else{
			echo '12';
		}
		?>">
            <ul class="qw-social pull-right">
                <?php
					get_template_part( "part", 'social' );
				?>
            </ul>
        </div>
    </div>
</div>