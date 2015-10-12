<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechanic extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){

		
		#$this->load->model('mechanic_activities');
		#$val = $this->mechanic_activities->dame_nombre();
		#$parametro = "Herminio";
		$this->load->helper('form');
		$this->load->view('Mechanic/login');
		#$this->load->view('Mechanic/login' , array( 'nombre' => $parametro , 'val' => $val));

	}

	public function activities(){

		echo "Aqui va mi vista actividades";

	}


    public function logeame(){

		$this->load->model('mechanic_activities');
		$nip 	= $this->input->post('nip');
		$bd = "default";
		$bd2 = "default";

		$result = $this->mechanic_activities->login($nip , $bd );	

		if($result)
	   {
		     $sess_array = array();
		     foreach($result as $row){
		        $sess_array = array(
		         #'username' => $row->email,
		          'employee_id' => $row->employee_id,
		          'name' => ucwords( strtolower($row->name.' '.$row->last_name) ),
		          'login' => true,
		          'bd'=> $bd,
		          'bd2'=> $bd2
		        );
		        $this->session->set_userdata('logged_in', $sess_array);
		     }


	     // Usuario correcto 
	     		redirect('mechanic_main', 'refresh');

	    } else {
	     
	        	redirect('mechanic', 'refresh');
	     
	    }
		
    }


}
?>