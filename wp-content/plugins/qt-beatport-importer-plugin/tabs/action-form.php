<?php





/* = Main function that creates the options page
==========================================================================*/

function qtbeatimp_action_page() {

    ?>
    <h1>Import</h1>
    <div class="wrap">
<?php


    if (isset($_COOKIE['access_token']) && isset($_COOKIE['access_token_secret'])) {

            //echo 'asdasd';



            /*
            =======================================================================
                                
                                WE ALREADY HAVE AN API KEY and we are also LOGGED

            =======================================================================
            */

           
    ?>                    
                   
                    <div style="border-top:1px solid #dfdfdf; padding-top:30px;">
                        <div id="qtbeatimporter">
                            <input type="text" name="btimporter_url" id="BPIurl" />
                            <div id="artistchoice">
                                <h4>Is this an artist link?</h4>
                                <p><label><input type="checkbox" name="onlyartist" id="onlyartistpage" > Create only the artist page</label></p>
                            </div>
                            <a href="#" class="button button-primary" id="BPIsubmit">Start</a>
                        </div>
                        <div id="finalresult">
                        </div>
                        <div id="response">
                        </div>
                        <div class="actions-box">
                            <p>
                                <hr /><br />                       
                                <a href="#" class="button button-red" id="togglePerfAct">Stop Process</a>
                                <a href="#" class="button button-grey" id="resetAction">Reset and abort</a>
                            </p>
                        </div> 
                        
                    </div>
                    <br>
                 

                    <h1>Instructions</h1>
                    <p>Simply paste a beatport url from a release, artist or label, like:</p>
                    <pre>http://pro.beatport.com/artist/aaron-mills/297667</pre>
                    <p>You will see any retrived release before starting the import action.<br>
                    <strong>You can also choose which releases you want to import</strong> or import all of them in one click</p>
                    <p>By using this plugin, you must respect all the laws about the copyright, and avoid importing material that you don't legally own.<br>
                        This is just a software. You are the only one responsible of how you use it. Do not attempt to hack or reverse engineer any software by 3rd party.<br>
                        Do not make any illegal use of the imported material, that can only be intended to <strong>increase your Beatport tracks sales</strong> by promoting your music in a good genuine way.
                    </p>
    <?php 
    }else{
            
            if(get_option('beatport_api_key')!='' || get_option('beatport_api_secret')!='' ){
               // echo get_option('beatport_api_key').get_option('beatport_api_secret');
                /*
                =======================================================================
                                    
                                    WE ALREADY HAVE AN API KEY

                =======================================================================
                */

                ?>
                    <h3>You need to login on Beatport</h3>
                    
                    <?php 
                        // Basic oauth key request and login button
                        echo BPACCESSSTATUS;
                      
                    ?>
                    
                    
                <?php
            }
    }
    
    ?>
    <p><strong>Detected time: <?php echo date("Y/m/d H:i:s"); ?></strong></p>
    </div> <!-- wrap close -->
    <?php

} 



