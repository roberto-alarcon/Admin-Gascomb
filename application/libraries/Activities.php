<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Activities {

	var $id_employee;
	var $bd = "pts";
	var $bd2 = "default";

	function __contruct(){
		
		

	}


	public function findActivities(){

		
		$ci =& get_instance();
		$session = $ci->session->userdata('logged_in');
		$this->id_employee = $session['employee_id'];

		// Conexion BD
		/*$ci->load->database( $bd , TRUE);
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
	    }*/
	    $myArray = array("herminio", "medina", "rojo");
	    return $myArray;


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