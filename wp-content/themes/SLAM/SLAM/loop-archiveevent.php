<div class="row-fluid" >
        <div class="span8" >
            <h1 class="qw-archive-title">
            <?php   
            $termname = '';
            if(isset($term)){
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                if(is_object($term)){
                   echo $term->name.' ';
                } 
            }
            echo esc_attr__('Events','labelpro');
            ?>
             </h1>
            <?php
            get_template_part( 'part', 'archiveevent' );
            ?>
        </div>
        <div class="span4">
            <div class="qw-innerbox">
                <div class="qw-inside-innerbox">
                    <?php display_sidebar("Archive sidebar right"); ?>
                </div>
            </div>
        </div>
</div>
</div>