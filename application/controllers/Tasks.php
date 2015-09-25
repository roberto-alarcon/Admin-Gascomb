<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		$this->load->library('employees');
	}

	public function index(){

		$grid_array		= array();
		$folio_id 		= $this->session->userdata('folio_id');
		
		$this->load->model('floor_activities');
		$this->floor_activities->load_folio( $folio_id );
		$result = $this->floor_activities->load_activities_by_folio();

		
		$this->load->model('employees');


		foreach ($result->result() as $row)
        {

        	$grid_array[] =  array(
        						'floor_activity_id' => $row->floor_activity_id,
        						'description'		=> $row->description,
        						'employees' 		=> $this->employees->get_name_by_id( $row->employee_id ),
        						'status'			=> $row->status

        						 );
        }


        
		
		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('Tasks/index' , array('grid' => $grid_array ));
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

	public function add(){
		
		$query 		= $this->input->post('query');
		$result		= array();

		if( !empty($query) ){

			$this->load->model('support_activities');
			$result 	= $this->support_activities->get_activities_by_keyword( $query );
			
		}

		// Helpers
		$this->load->helper('form');

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('Tasks/add' , array('result' => $result ));
		$this->load->view('Layout/footer');
	}

	public function add_activity(){

		$query 					= $this->input->post('activity');
		$support_activity_id	= '';


		$this->load->model('support_activities');
		$support_activities_result = $this->support_activities->search_support_activity_by_description( $query );

		foreach ($support_activities_result->result() as $row)
	      {
	          
	          $support_activity_id = $row->support_activity_id;     
	         
	      }

		if ( !empty($support_activity_id) ){

			$this->load->model('floor_activities');
			$this->floor_activities->add_new_activity( $support_activity_id , $query);
		}


		redirect('tasks/update', 'refresh');
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


	public function mechanic(){

		$folio_id 		= $this->session->userdata('folio_id');
		
		$this->load->model('floor_activities');
		$this->floor_activities->load_folio( $folio_id );
		$result = $this->floor_activities->load_activities_by_folio();

		// Employees
		$this->load->model('employees');
		$list_employees = $this->employees->getAllEmployees();
		
		// Helpers
		$this->load->helper('form');

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('Tasks/mechanic', array('result' => $result , 'list_employees' => $list_employees));
		$this->load->view('Layout/footer');

	}

	public function mechanic_add(){

		$this->load->model('floor_activities');
		$this->floor_activities->add_mechanics( $_POST );
		redirect('tasks/', 'refresh');

	}


}
?>