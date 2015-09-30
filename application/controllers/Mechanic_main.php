<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechanic_main extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){
		
		$this->load->view('Mechanic/header');
		$this->load->view('Mechanic/main');
        $this->load->view('Mechanic/footer');
	}

}
?>