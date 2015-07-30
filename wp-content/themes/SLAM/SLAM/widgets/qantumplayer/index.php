<?php
/*
Plugin name: Qantum Player Embedded / based on Soundmanager2
Plugin URI: 
Description: Add a mp3 player widget, embedded with theme
Version: 1.0
Author: Igor Nardo
*/

/** 
 * Register the Widget 
*/
add_action( 'widgets_init', 'QantumPlayerWidgetInit' );
function QantumPlayerWidgetInit() {
	wp_register_style( 'flashblock', get_template_directory_uri().'/widgets/qantumplayer/360-player/flashblock/flashblock.css');
	wp_enqueue_style( 'flashblock' );	
	wp_register_style( '360playercss', get_template_directory_uri().'/widgets/qantumplayer/360-player/360player.css');
	wp_enqueue_style( '360playercss' );
	function qantumplayerInitializeCus(){
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/widgets/qantumplayer/360-player/script/berniecode-animator.js'.'"></script>';	
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/widgets/qantumplayer/360-player/script/soundmanager2.js'.'"></script>';	
		
		if(preg_match('/MSIE 8/i',$_SERVER['HTTP_USER_AGENT']) || preg_match('/MSIE 7/i',$_SERVER['HTTP_USER_AGENT']) || preg_match('/MSIE 6/i',$_SERVER['HTTP_USER_AGENT'])) 

		{ 
			echo '<script type="text/javascript" src="'.get_template_directory_uri().'/widgets/qantumplayer/360-player/script/360player-custom-IE8.js'.'"></script>';	
			echo '<script type="text/javascript">
			soundManager.setup({
			  url: "'.get_template_directory_uri().'/widgets/qantumplayer/360-player/swf/",
			  useHighPerformance: false
			});
			</script>';	

		}else{

			echo '<script type="text/javascript" src="'.wp_make_link_relative(get_template_directory_uri().'/widgets/qantumplayer/360-player/script/360player-custom.js').'"></script>';	
			/*
      echo '<script type="text/javascript">
			soundManager.setup({
			  url: "'.get_template_directory_uri().'/widgets/qantumplayer/360-player/swf/",
			  useHighPerformance: true
			});
			threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
			threeSixtyPlayer.config.showHMSTime = false;
			threeSixtyPlayer.config.useWaveformData = true;
			threeSixtyPlayer.config.useEQData = true;
			threeSixtyPlayer.config.waveformDataColor = "#F0000";
			threeSixtyPlayer.config.playRingColor = "#ffffff";
			threeSixtyPlayer.config.loadRingColor = "#00000";
			if (threeSixtyPlayer.config.useWaveformData) { soundManager.flash9Options.useWaveformData = true;}	
			if (threeSixtyPlayer.config.useEQData) {soundManager.flash9Options.useEQData = true; }
			if (threeSixtyPlayer.config.usePeakData) {soundManager.flash9Options.usePeakData = true;}
			if (threeSixtyPlayer.config.useWaveformData || threeSixtyPlayer.flash9Options.useEQData || threeSixtyPlayer.flash9Options.usePeakData) { soundManager.preferFlash = true;}	
			</script>';	

       */

      echo '<script type="text/javascript">
      soundManager.setup({
        url: "'.wp_make_link_relative(get_template_directory_uri().'/widgets/qantumplayer/360-player/swf/').'",
        useHighPerformance: true
      });
      threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
      threeSixtyPlayer.config.showHMSTime = false;
      threeSixtyPlayer.config.useWaveformData = true;
      threeSixtyPlayer.config.useEQData = true;
      threeSixtyPlayer.config.waveformDataColor = "'.get_option(THEME_SHORTNAME.'_waveformDataColor').'";
      threeSixtyPlayer.config.playRingColor = "'.get_option(THEME_SHORTNAME.'_playRingColor').'";
      threeSixtyPlayer.config.loadRingColor = "'.get_option(THEME_SHORTNAME.'_loadRingColor').'";
      if (threeSixtyPlayer.config.useWaveformData) { soundManager.flash9Options.useWaveformData = true;}  
      if (threeSixtyPlayer.config.useEQData) {soundManager.flash9Options.useEQData = true; }
      if (threeSixtyPlayer.config.usePeakData) {soundManager.flash9Options.usePeakData = true;}
      if (threeSixtyPlayer.config.useWaveformData || threeSixtyPlayer.flash9Options.useEQData || threeSixtyPlayer.flash9Options.usePeakData) { soundManager.preferFlash = true;}  
      </script>'; 
     
		}
	}
	add_filter('wp_footer', 'qantumplayerInitializeCus');
   function IEpatchScript(){
   	 	echo '<!--[if IE]><script type="text/javascript" src="'.get_template_directory_uri().'/widgets/qantumplayer/360-player/script/excanvas.js"></script><![endif]-->';
	}
    add_filter('wp_head', 'IEpatchScript');
}


/*
* Adds QantumPlayerWidget widget.
*/

class QantumPlayerWidgetClass extends WP_Widget {
	function QantumPlayerWidget() {
		parent::WP_Widget( false, $region = 'Quantum Player Widget' );
	}
	/*
	* Register widget with WordPress.
	*/
    public function __construct() {
      parent::__construct(
        'QantumPlayerWidgetClass', 
        array( 'description' => __( 'Quantum Player Widget', 'labelpro' ), ) // Args
      );
    } 

  function widget( $args, $instance ) {
    extract( $args );    
    $title = apply_filters( 'widget_title', $instance['title'] );
	$defaultmp3 = trim(apply_filters( 'widget_defaultmp3', $instance['defaultmp3'] ));
	$skin = apply_filters( 'widget_skin', $instance['skin'] ); 
    echo $before_widget;
	?>

    <div id="mainplayer">
        <div class="ui360 ui360-vis"><a id="playerlink" href="<?php echo $defaultmp3; ?>" class="qw-hideme"><?php echo $defaultmp3; ?></a>
        </div>
        <div class="playerinfodata">
        <div class="player-tracktitle"></div>
        <div class="player-trackauthor"></div>
        <div class="player-buylink"></div>
        </div>
    </div>
    <?php
     echo $after_widget;
  }
  /**
   * Sanitize widget form values as they are saved.
   * @see WP_Widget::update()
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   * @return array Updated safe values to be saved.
   */
  function update( $new_instance, $old_instance ) {
    $instance = array();
	$instance['title'] = strip_tags( $new_instance['title'] );
	$instance['defaultmp3'] = strip_tags( $new_instance['defaultmp3'] );
	$instance['skin'] = strip_tags( $new_instance['skin'] );
    return $instance;    
  }

  /**
   * Back-end widget form.
   * @see WP_Widget::form()
   * @param array $instance Previously saved values from database.
   */
  function form( $instance ) {
    $title = esc_attr( $instance['title'] );
    $defaultmp3 = esc_attr( $instance['defaultmp3'] );
    $skin = esc_attr( $instance['skin'] );
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php __( 'Title:','labelpro'  ); ?>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'defaultmp3' ); ?>"><?php __( 'Default traCK:','labelpro' ); ?>
      <input class="widefat" id="<?php echo $this->get_field_id( 'defaultmp3' ); ?>" name="<?php echo $this->get_field_name( 'defaultmp3' ); ?>" type="text" value="<?php echo $defaultmp3; ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'skin' ); ?>"><?php __( 'Select Skin:','labelpro'  ); ?>
      <select class="widefat" name="<?php echo $this->get_field_name( 'skin' ); ?>">
        <option value="360player" <?php $skin == '360player' ? ' selected="selected"' : ''; ?> >360player</option>
        <option value="Cassette" <?php $skin == 'Cassette' ? ' selected="selected" ' : ''; ?> >Cassette</option>
      </select>  
      </label>
    </p>
    <?php
  }
} // class QantumPlayerWidget
?>