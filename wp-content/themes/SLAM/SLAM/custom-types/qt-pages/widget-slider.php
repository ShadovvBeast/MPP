<?php

/*
		This is the template that is automatically included by the widget

*/
$wid = str_replace("-",'',$args['widget_id']);
?>
<div id="<?php echo $wid;?>" class="carousel slide postsSlide">

   <div class="carousel-inner">
   	<?php
   		$active = 'active';
		if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
		$postId = $query->post->ID;

			if(has_post_thumbnail())  { 

			?>		<div class="item <?php echo $active; ?>">
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $size = 'large', $attr = '' );?></a>
					</div>
			<?php
			$active = '';
			}
		endwhile; endif; 
	?>
	</div>
	 <a class="carousel-control animated left" href="#<?php echo $wid;?>" data-slide="prev"><i class="icon-chevron-left"></i></a>
  	<a class="carousel-control animated right" href="#<?php echo $wid;?>" data-slide="next"><i class="icon-chevron-right"></i></a>
</div>