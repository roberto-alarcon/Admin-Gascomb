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

	public function update(){

		$folio_id 		= $this->session->userdata('folio_id');
		
		$this->load->model('floor_activities');
		$this->floor_activities->load_folio( $folio_id );
		$result = $this->floor_activities->load_activities_by_folio();

		
		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('Tasks/update' , array('result' => $result ));
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

		$folio_id 		= $this->session->userdata('folio_id');
		$activity_id	= $this->input->get('id_activity', TRUE);;

		$this->load->model('floor_activities');
		$this->floor_activities->load_folio( $folio_id );
		$this->floor_activities->delete_activity( $activity_id );

		redirect('tasks/update', 'refresh');

	}


}
?>