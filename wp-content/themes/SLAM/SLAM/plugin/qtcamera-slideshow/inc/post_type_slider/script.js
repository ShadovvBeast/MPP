// JavaScript Document
/*
	this is the module switch.
	Changes the active form fields dependently on the selected value in the module name


*/
jQuery(document).ready(function($)  
{  
//composer_modulearchive
/*
(
						'sliders' => array ('label' => 'Slider','value' => 'sliders'),
						'sponsors' => array ('label' => 'Sponsors','value' => 'sponsors'),
						'posts' => array ('label' => 'Posts Archive','value' => 'posts'),
						'featuredpost' => array ('label' => 'Featured Post','value' => 'featuredpost'),
						'projects' => array ('label' => 'Projects Archive','value' => 'projects'),
						'project' => array ('label' => 'Single Project','value' => 'project'),
						'releases' => array ('label' => 'Releases','value' => 'releases'),
						'podcasts' => array ('label' => 'Podcasts','value' => 'podcasts')
*/

/*
	var elToHide = jQuery("#composer_modulearchive").closest('tr').siblings().not(':first');
	
	//elToHide.hide();
	
	jQuery("#composer_modulearchive").change(function(){
		
		var selector = jQuery(this);
		
		
		selector.closest('tr').siblings().not(':first').hide();
		
		
		var selectedValue = selector.find(":selected").val();
		
		switch (selectedValue) {
			case "sliders":
				
				jQuery('#composer_slider_images-repeatable').closest('tr').show();
			break;
			case "sponsors":
				jQuery('#composer_sponsors_images-repeatable').closest('tr').show();
			break;
			case "posts":
			case "projects":
			case "releases":
			case "podcasts":
				jQuery('#category').closest('tr').show();
			break;
			case "post":
				jQuery('label:contains("Post Select")').closest('tr').show();
			break;
			break;
			case "project":
				jQuery('label:contains("Project Select")').closest('tr').show();
			break;
			case "release":
				jQuery('label:contains("Release Select")').closest('tr').show();
			break;
			case "podcast":
				jQuery('label:contains("Podcast Select")').closest('tr').show();
			break;
			default:
		}
	});*/
	
});