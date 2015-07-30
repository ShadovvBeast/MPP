<?php  

$n=1;

$posts_query = new WP_Query('posts_per_page=5');   

while ($posts_query->have_posts()) : $posts_query->the_post();



if($n%2==0){

	$link_class	= 'l1';

}else{$link_class	= 'l2';}



?>



<li class="widget_list">



    <!-- <div class="big_number cufon"><?php echo $n; ?></div> -->

    <a href="<?php the_permalink() ?>"  title="<?php the_title(); ?>" class="post_title <?php echo $link_class; ?>"><?php the_title(); ?></a>

    <div class="canc">&nbsp;</div>

    

</li>



<?php $n++; endwhile; wp_reset_query(); ?>