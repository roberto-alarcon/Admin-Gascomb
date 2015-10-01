<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){


		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_dashboard');
		$this->load->view('Layout/footer');

	}

}
?>