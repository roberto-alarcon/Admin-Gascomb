<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Utilsm {

	// *** Configuracion Clase
	var $enviroment 		= 'develop';
	var $host;

	// *** Configuracion Gascomb
	var $image_path = "/home/gascomb/secure_html/multimedia";
	var $cdn_path = "http://i2.gascomb.com/";

	// *** Configuracion PTS
	var $pts_image_path = "/home/gascomb/pts_secure_html/multimedia";
	var $pts_cdn_path = "http://cdn-p.gascomb.com/";

	// *** Configuracion Desarrollo
	var $dev_image_path = "/Users/ralarcon/Sites/Gascomb_html/multimedia";
	var $dev_cdn_path = "http://cdn-d.gascomb.com/";


	function __construct(){

	}



	public function get_cdn_path($company){

		if($company == "gascomb"){

			return $this->cdn_path;
 
		} else if ($company == "pts"){

			return $this->pts_cdn_path;

		}

		
	}


}
?>