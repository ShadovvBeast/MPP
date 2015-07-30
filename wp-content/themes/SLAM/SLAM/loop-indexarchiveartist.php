<h1 class="qw-archive-title">
<?php 	
$termname = '';
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
if(is_object($term)){
    echo $term->name;
} 
 echo esc_attr__('Artists','labelpro');
?>
 </h1>
    	<div class=" qw-archive-release" >
			<div class="row-fluid">
            	<?php get_template_part( 'part', 'archiveartist' ); ?>
            </div>
      
        </div>
    <div class="canc"></div>    
</div>