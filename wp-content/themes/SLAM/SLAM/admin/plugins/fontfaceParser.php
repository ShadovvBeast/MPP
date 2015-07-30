<?php
/*
Author: Igor Nardo
Function: parse and grab the font name from font face stylesheets downloaded from montsquirrel
License: Do what you want with this ;)
*/
if(!function_exists('fontfaceParser')){
	
	function fontfaceParser($source){

		if(isset($source)){
			if($source!=''){
			//	echo $source;
				$selectorsArray = explode('font-family:',$source);
				
				$familyarray = explode (';',$selectorsArray[1]);
				
				$toreplacearray = array('"',"'",',',';',);
				
				$name = str_replace($toreplacearray,'',$familyarray[0]);
				
				return trim($name);
			}
		}
		return '';
	}

}
