<div class="qw-archive-release" >
        	
             <div class="qw-innerbox">
            	 <div class="qw-inside-innerbox">
            		<?php
            		
            		if(isset($term)){
                        $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                        if(is_object($term)){
                            $events =  get_event_list($term->slug);
                        } 
                    }else{
                        $events = get_event_list();   
                    }


                    if(count($events) > 0){ ?>
                         <table class="table eventtable eventarchive" cellpadding:"0" cellspacing="0" >
                            <tbody>
                                <?php
                                foreach($events as $e){
                                    $d = explode('-',$e['date']);
                                    $time = mktime(0, 0, 0, $d[1]);
                                    setlocale(LC_TIME, get_bloginfo('language'));
                                    $mname = strftime("%b", $d[1]);
                                    switch ($d[1]){
                                        case "1":$mname = __("jan","_qt");break;
                                        case "2":$mname = __("feb","_qt");break;
                                        case "3":$mname = __("mar","_qt");break;
                                        case "4":$mname = __("apr","_qt");break;
                                        case "5":$mname = __("may","_qt");break;
                                        case "6":$mname = __("jun","_qt");break;
                                        case "7":$mname = __("jul","_qt");break;
                                        case "8":$mname = __("aug","_qt");break;
                                        case "9":$mname = __("sep","_qt");break;
                                        case "10":$mname = __("oct","_qt");break;
                                        case "11":$mname = __("nov","_qt");break;
                                        case "12":$mname = __("dec","_qt");break;
                                    }
                                    echo '<tr>
                                    <td class="datebox"><span class="day">'.$d[2].'</span><span class="month fontface">'.$mname.'</span><span class="year fontface">'.$d[0].'</span></td>
                                    <td class="image">'.(($e['thumb']!='')? '<a class="qw-ethumbnail" href="'.$e['permalink'].'"><img src="'.$e['thumb'].'" /></a>':'').'</td>
                                    <td class="qt-eventlist-title"><a href="'.$e['permalink'].'" class="fontface">'.$e['title'].'</a><span class="qt-eventlist-details">'.$e['location'].' / '.$e['city'].' / '.$e['street'].'</span></td>
                                    </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    }else{
                        ?>No events planned.<?php
                    }
                    ?>

            	</div><!-- qw-inside-innerbox -->
            </div><!-- qw-innerbox -->


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



</div><!-- qw-archive-release -->



        
  