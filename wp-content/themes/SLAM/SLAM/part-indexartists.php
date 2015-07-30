<?php
/*
	Extract contents put as The Home and put them in the homepage
	// this comes from qantum panel options
*/
?>
	   <div class="qw-indexmodule">  
        	<div class="qw-innerbox">
        		<div class="qw-inside-innerbox">
	        		<h1 class="qw-archive-title"><?php the_title(); ?></h1>
	            	<div class="qw-inside-innerbox maincontent">
						<?php the_content(); ?>
	                </div>
                </div>
            </div>
	    </div>
	 
