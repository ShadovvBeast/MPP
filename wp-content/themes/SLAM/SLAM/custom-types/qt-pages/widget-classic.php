<?php
/*
		This is the template that is automatically included by the widget

*/
?>
<ul>
<?php
if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
$postId = $query->post->ID;
$span = "span12 marginfix borderbottom";
?>		
	<li>			
		<a class="qw-blocklink" href="<?php the_permalink(); ?>">
			<?php
				if($instance['showthumbnail']=='true'){
	           		if(has_post_thumbnail())  {
	           			the_post_thumbnail('thumbnail','class=qw-widget-thumbnail');
                    }
				}
			?>
			<span class="qw-widg-singleline	<?php echo(($instance['shorten_titles']=='yes')? 'ellipsis':'');?>"></span>
				<a class="" href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</span>
		</a>
	</li>

<?php endwhile; endif; 

 if(isset($instance['archivelink']) && isset($instance['archivelink_text'])){
	if($instance['archivelink'] == 'show'){
		if($instance['archivelink_text']==''){$instance['archivelink_text'] = 'More'};
	 	echo ' <li class="text-right "><a href="'.get_post_type_archive_link('post').'"><i class="icon-chevron-right animated"></i> '.$instance['archivelink_text'].'</a></li>';
 	} 
 }
?>
</ul>
<?php 