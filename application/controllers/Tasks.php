<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		$this->load->library('employees');
	}

	public function index(){

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('Tasks/index');
		$this->load->view('Layout/footer');


	}

	public function gantt(){

		$employees = $this->load->library('employees');
		var_dump($employees);
		echo $employees->getname();

		echo "Vista Gantt";
	}


	public function edit(){

		$id = $this->input->get('id', TRUE);
		echo $id;
		echo "Edicion de tarea";
	}

	public function delete(){

		echo "borramos actividad";

	}


}
?>