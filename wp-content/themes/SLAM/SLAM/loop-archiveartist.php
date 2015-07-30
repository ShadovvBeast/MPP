<h1 class="qw-archive-title">
<?php 	
$termname = '';
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
if(is_object($term)){
    echo $term->name.' ';
} 

echo esc_attr__('Artists','labelpro');
?>
 </h1>
    	<div class=" qw-archive-release" >
			<div class="row-fluid">
            	<?php get_template_part( 'part', 'archiveartist' ); ?>
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
    <div class="canc"></div>    
</div>