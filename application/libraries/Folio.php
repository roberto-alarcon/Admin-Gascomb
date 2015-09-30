<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Folio {

	var $folio_id;
	var $system;

	function __contruct(){
		
		

	}

	public function folio_load( $folio_id ){

		$this->folio_id = $folio_id;

	}

	public function folio_exists(){

		
		$ci =& get_instance();
		$session = $ci->session->userdata('logged_in');
		$bd = $session['bd'];

		// Conexion BD
		$ci->load->database( $bd , TRUE);
	    $ci -> db -> select('folio_id');
	    $ci -> db -> from('folios');
	    $ci -> db -> where('folio_id', $this->folio_id);
	    $ci -> db -> limit(1);
	 
	    $query = $ci -> db -> get();
	 
	    if($query -> num_rows() == 1){
	       $this->folio_in_session();
	       return TRUE;
	    
	    }else{
	       $this->folio_out_session();
	       return false;
	    }


	}


	public function folio_in_session(){

		$ci =& get_instance();
		$ci->session->set_userdata('folio_id', $this->folio_id);
	}


	public function folio_out_session(){

		$ci =& get_instance();
		$ci->session->set_userdata('folio_id', '' );

	}




}