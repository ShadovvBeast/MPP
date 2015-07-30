<div class="qw-innerbox qw-single-element qw-standard-content">
    <div class="qw-inside-innerbox">
    	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        	<header class="entry-header">
            	<h1 class="qw-artist-title"><?php the_title(); ?></h1>
            </header>
            
            <?php
            if(get_option(THEME_SHORTNAME.'_like_on_singles')=='enabled'){
            echo  addLikeButton (get_permalink());
            }
            if(get_option(THEME_SHORTNAME.'_tweet_on_singles')=='enabled'){
            echo  addTweetButton (get_permalink());
            }
            if(get_option(THEME_SHORTNAME.'_gplus_on_singles')=='enabled'){
            echo  addGplusButton (get_permalink());
            }
            ?>
            
            <?php
            $size = '580';
            if($thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( $size,$size ) )){
            $url = $thumb['0'];
            if( $url != ''){
            $big = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),array('950','950' )  );
            $big = $big[0];
            ?>
            <img src="<?php echo $url; ?>" class="qw-image-100 qw-autoheight qw-zerospacers" alt="<?php echo the_title(); ?>" >
            <?php
            }
            };
            ?>
            <div class="spacer"></div>
            <div class="qw-standard-content maincontent">
                <?php the_content(); ?>   
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'labelpro' ), 'after' => '</div>' ) ); ?>
            </div>
            <p class="qw-taxonomy-box">
                <i class="icon-time icon-white"></i><?php the_time('j F Y') ?>
                <i class="icon-user icon-white"></i><?php the_author_posts_link(); ?>
                <i class="icon-book icon-white"></i><?php the_category(' '); ?>
                <i class="icon-tags icon-white"></i><?php the_tags(' '); ?>
            </p>
            <?php
			/*
				note: a rel="category tag" html error may occur. Please not that this is not a theme error but a wordpress error, ar reported here:<br />
				http://wordpress.org/support/topic/wordpress-abuses-rel-tag
			*/
			?>
			<?php edit_post_link( __( 'Edit this post','labelpro' ), '<span class="edit-link">', '</span>' ); ?>
           
            <div class="spacer"></div>
            <div class="hidden-phone">
            <?php comments_template( ); ?>
             </div>
             
         </article>
    </div>
</div><!--  end single element elements -->

