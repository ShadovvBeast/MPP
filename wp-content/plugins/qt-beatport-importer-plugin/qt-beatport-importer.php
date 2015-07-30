<?php

/*
Plugin Name: QantumThemes Free Beatport Importer
*
*
*
*/


$resp_messages		= '';

if(!function_exists('qt_make_link_relative')){

function qt_make_link_relative( $link ) {
    $link = preg_replace( '|https?://[^/]+(/.*)|i', '$1', $link );
    return $link;
}}






/* = Definition Of The Ajax Service
==========================================================================*/

define('THISPLUGINURL',qt_make_link_relative(plugin_dir_url(__FILE__).'actions/beatimp.ajax.php')) ;
$toreplace = array(THISPLUGINURL,'wp-admin');
$incPath =   urlencode(str_replace($toreplace,"",getcwd()));


define ('LOADURL',THISPLUGINURL.'?secretpath='.$incPath);


function QTBPIscriptsServiceSetup(){
        echo '<script type="text/javascript">
                window.QTBPIserviceUrl   = "'.LOADURL.'"; 
               // console.log("LU ------> '.LOADURL.'");
            </script>';    
}
add_action('admin_enqueue_scripts','QTBPIscriptsServiceSetup',9900);



/* = Import required libraries
==========================================================================*/




if(!function_exists('qw_load_oauthSimple')){
function qw_load_oauthSimple(){
    //$secure = '';
    if (!class_exists('OAuthSimpleException')) {
        require 'actions/inc/oauth/OAuthSimple.php';
    }
    require ("actions/inc/oauth/oauth_config.php");

    if(get_option('beatport_api_key')!='' && get_option('beatport_api_secret')!='' ){
        if (isset($_COOKIE['access_token']) && isset($_COOKIE['access_token_secret'])) {
            if(!isset($secure)){$secure = false;}
            setcookie('BeatMeCookyep',
                      base64_encode($_COOKIE['access_token'].'[++]'.$_COOKIE['access_token_secret'].'[++]'.get_option('beatport_api_key').'[++]'.get_option('beatport_api_secret'))
                      , time() + YEAR_IN_SECONDS, SITECOOKIEPATH, null, $secure );
        }else{
            include 'actions/inc/oauth/oauth_access.php';
            $result = checkBPOauthAccess();
            define ('BPACCESSSTATUS',  $result);
        }
     }
}}
add_action("init", "qw_load_oauthSimple");



/* = import CSS and JS
==========================================================================*/

add_action( 'admin_enqueue_scripts', 'enqueue_qtbeatportimporter_scripts' );
function enqueue_qtbeatportimporter_scripts() {		
	wp_register_style( 'qtbtimpstyle', plugin_dir_url(__FILE__).'/lib/style.css', false, '1.0.0' );
	wp_enqueue_style( 'qtbtimpstyle' );
    wp_enqueue_script("jquerycookies", plugin_dir_url(__FILE__).'/lib/jquerycookie.js', 'jquery', '',true);
	wp_enqueue_script( 'qtbtimpscript', plugin_dir_url(__FILE__).'/lib/main.js','jquery' , '1.0.0',true);
    wp_localize_script( 'qtbtimpscript', 'Qtbtimpscript', array(
        'ajaxurl' => plugin_dir_url(__FILE__).'/lib/main.js',
        'nonce' => wp_create_nonce( 'qtbtimpscript-nonce' )
    ) );

}







/* = Create the admin page
==========================================================================*/

add_action('admin_menu', 'qtBPI_create_optionspage');
function qtBPI_create_optionspage() {
	add_management_page('QT Beat Importer', 'QT Beat Importer', 'manage_options', 'qtbeatimp_settings', 'qtbeatimp_options');
}




/* = Main function that creates the options page
==========================================================================*/
function qtbeatimp_options(){
    if(!isset($_GET['tab'])){
        $_GET['tab'] = 'import';
    }
    if(get_option("beatport_api_key") == '' || get_option("beatport_api_secret") == ''){
        $_GET['tab'] = 'settings';
    }

    qw_beatadmin_tabs($_GET['tab']);
    echo '<div class="qw_importer_container">';


    /*
    *   Verify Act K
    */
    $llllllll = false;
    if(!function_exists("qwGetEnvDataTheme")){
         $lllllllllll = 'working';
        echo '<br>Theme incompatible with this plugin.';
        return;
    } else {
        $lllllllllll = qwGetEnvDataTheme(SERVICE);
    }
    $llllllllll = '';

    if($lllllllllll != 'working'){
         $llllllll = true;
          $llllllllll = 'Remote check bypassed';
    }else{
        if(!function_exists("qt_get_procedure_settings")){
            echo '<br>Theme incompatible with this plugin.';
            return ;
        }else{

           $lllllll = qt_get_procedure_settings(); 
          
           if($lllllll == get_option('qt_activation_key') || $lllllll == 'discard' || $lllllll == 'local'){
                $llllllll = true;
                $llllllllll = $lllllll;
               // echo $lllllll. ' - ------ '.get_option('qt_activation_key');
           }else{
                if( $lllllll != 'local'){
                    echo '<h4>Activation key missing</h4>
                    <p>1. Get the activation key <a href="http://www.qantumthemes.com/activation/" target="_blank">here</a></p>
                    <p>2. Set the activation key <a href="admin.php?page=adminindex.php">here</a></p>
                    <p>To use in localhost, only the purchase code is needed</p>';
                    return;
                }
           }
        }
    }
    

    if($llllllll == true){
        switch ($_GET['tab']){
            case "settings" :
               include ('tabs/settings-form.php');
            break;
            case "import" :
            default:
             include ('tabs/action-form.php');
             qtbeatimp_action_page();
             ?>
             <h2>After the submission of the url you can choose what to import:</h2>
            <img src="<?php echo  plugin_dir_url(__FILE__).'lib/tutorial.gif'; ?>" />
            <?php     
        }
    }
   
    echo '</div> <a href="http://www.qantumthemes.com/" target="_blank" class="qw_logo"><img src="'.plugins_url( 'qantum-logo-web.png', __FILE__ ).'" /></a>';
    echo '<p>Status: '.$llllllllll.'</p>';
}

/* = Create the admin tabs
==========================================================================*/
function qw_beatadmin_tabs( $current) {
    $tabs = array( 'import' => 'Import', 
                  'settings' => 'Settings');

    echo '<div id="icon-themes" class="icon32"><br></div>';
    echo '<h2 class="nav-tab-wrapper">';
    foreach( $tabs as $tab => $name ){
        $class = ( $tab == $current ) ? ' nav-tab-active' : '';
        echo "<a class='nav-tab$class' href='?page=qtbeatimp_settings&tab=$tab'>$name</a>";

    }
    echo '</h2>';
}
