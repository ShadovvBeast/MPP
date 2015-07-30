<div class="row-fluid" >
	<div class="span8" >
		<h1 class="qw-archive-title">
		<?php 
		if(is_search()){
		 echo single_term_title(); 
		} else
		if(is_post_type_archive( 'artist' )){
		 echo esc_attr__('Artists','labelpro');
		}else{
		 echo 'Recent posts: ';
		 if(single_cat_title()){
			 echo ucfirst(single_cat_title());
		 }else{
		  	if(isset($author)){
				$curauth = get_user_by('id', $author);
				if(is_object($curauth)){
					echo $curauth->nickname;
				}
			}else 	if(isset($_GET['author_name'])){
				$curauth = get_user_by('slug', $_GET['author_name']);
				echo $curauth->nickname;
			}			  
		 }	  
		}
		?>
		</h1>

	   <div class="qw-listed-elements qw-posts">
			<?php
	   			get_template_part( 'part', 'archive' ); 
			?>
	    </div>
	    <p>
	    <?php
		global $wp_query;
		$big = 999999999; // need an unlikely integer
		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages
		) );
		?>
		</p>
	</div>
    <div class="span4">
     	<div class="qw-innerbox">
            <div class="qw-inside-innerbox">
            	<?php  display_sidebar("Archive sidebar right"); ?>
            </div>
     	</div>
    </div>
</div></div>
