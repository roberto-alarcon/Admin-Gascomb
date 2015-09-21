<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechanic extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){

		
		$this->load->model('mechanic_activities');
		$val = $this->mechanic_activities->dame_nombre();
		echo $val;

		$parametro = "Herminio";
		$this->load->view('Mechanic/login' , array( 'nombre' => $parametro , 'val' => $val));

	}

	public function activities(){

		echo "Aqui va mi vista actividades";

	}

}
?>