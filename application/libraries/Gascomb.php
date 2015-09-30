<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Gascomb {

	// *** Configuracion Clase
	var $enviroment 		= 'develop';
	var $host;

	// *** Configuracion Gascomb
	var $image_path 		= '/home/gascomb/secure_html/multimedia';
	var $cdn_path			= 'http://i2.gascomb.com/';

	// *** Configuracion PTS
	var $pts_image_path 	= '/home/gascomb/pts_secure_html/multimedia';
	var $pts_cdn_path		= 'http://cdn-p.gascomb.com/';

	// *** Configuracion Desarrollo
	var $dev_image_path		= '/Users/ralarcon/Sites/Gascomb_html/multimedia';
	var $dev_cdn_path		= 'http://cdn-d.gascomb.com/';


	function __construct(){

		if ( $_SERVER['SERVER_NAME'] == 'admin.gascomb.dev' ){

			$this->enviroment = 'develop';

		}else{

			$this->enviroment = 'production';
		}
	}


	public function get_image_path(){

		if($this->enviroment == 'develop'){

			return $this->dev_image_path;
		}else{

			$ci =& get_instance();
			$session 	= $ci->session->userdata('logged_in');
			$bd 		= $session['bd'];


			if ( $bd == 'default' ){

				return $this->image_path;
			}else if ( $bd = 'pts' ) {
				
				return $this->pts_image_path;
			}

		}



	}


	public function get_cdn_path(){

		if($this->enviroment == 'develop'){

			return $this->dev_cdn_path;
		}else{

			$ci =& get_instance();
			$session 	= $ci->session->userdata('logged_in');
			$bd 		= $session['bd'];


			if ( $bd == 'default' ){

				return $this->cdn_path;
			}else if ( $bd = 'pts' ) {
				
				return $this->pts_cdn_path;
			}

		}

		
	}


}
?>