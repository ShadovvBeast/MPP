<?php

	/* Here you can customize the way the address is shown */
	$allinfosContact = array(THEME_SHORTNAME.'_contact_name',THEME_SHORTNAME.'_contact_phone1',THEME_SHORTNAME.'_contact_phone2',THEME_SHORTNAME.'_contact_phone3',THEME_SHORTNAME.'_contact_phone4',
							 THEME_SHORTNAME.'_contact_email',THEME_SHORTNAME.'_contact_address1',THEME_SHORTNAME.'_contact_address2',THEME_SHORTNAME.'_contact_address3',THEME_SHORTNAME.'_contact_address4');
	$ControlContact = 0;
	foreach ($allinfosContact as $inf){
			if(get_option($inf)!=''){
				$ControlContact ++;
			}
	}
	if ($ControlContact > 0){
?>
<h2 class="sidebaritem-0-title qw-sidebartitle">Contact info</h2>
<ul class="qw-footer_address">
	<?php if(get_option(THEME_SHORTNAME.'_contact_name')!=''){ ?>
    	<li class="qw-contact_name"><strong><?php echo get_option(THEME_SHORTNAME.'_contact_name'); ?></strong></li>
    <?php } ?>
    <?php if(get_option(THEME_SHORTNAME.'_contact_email')!=''){ ?>
    	<li class="qw-contact_email"><i class="icon-envelope icon-white"></i><a href="mailto:<?php echo get_option(THEME_SHORTNAME.'_contact_email'); ?>"><?php echo get_option(THEME_SHORTNAME.'_contact_email'); ?></a></li>
    <?php } ?>
    <?php
        $phones = array(THEME_SHORTNAME.'_contact_phone1',THEME_SHORTNAME.'_contact_phone2',THEME_SHORTNAME.'_contact_phone3',THEME_SHORTNAME.'_contact_phone4');
        $n=0;
        foreach ($phones as $p){
            if(get_option($p)!=''){
               ?>
                    <li class="qw-contact_phone qw-phone<?php echo $n; ?>"><i class="icon-play-circle icon-white"></i><?php echo get_option($p); ?></li>
               <?php
				$n++;
            }
        }
    ?>
    <?php
        $address = array(THEME_SHORTNAME.'_contact_address1',THEME_SHORTNAME.'_contact_address2',THEME_SHORTNAME.'_contact_address3',THEME_SHORTNAME.'_contact_address4');
        $n=0;
        foreach ($address as $a){
            if(get_option($a)!=''){
                  ?>
                    <li class="qw-contact_address qw-address<?php echo $n; ?>"><?php echo ($a == THEME_SHORTNAME.'_contact_address1'? '<i class="icon-map-marker icon-white"></i>' :'<i class="icon-minus icon-white"></i>');  ?><?php echo get_option($a); ?></li>
                 <?php
				$n++;
            }
        }
    ?>
</ul>
<?php	}	?>