<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		$this->load->library('employees');
	}

	public function index(){

		$grid_array		= array();
		$grid_comments	= array();
		$folio_id 		= $this->session->userdata('folio_id');
		
		// Informacion de la configuracion
		$this->load->model('floor_activities_folio');
		$this->floor_activities_folio->load_folio( $folio_id );
		$config_result 	= $this->floor_activities_folio->get_all_info_by_folio();
		$config_array 	= array();
		foreach ($config_result->result() as $row) {
		
			$config_array[] = array(
						'status' => $row->status,
						'priority' => $row->priority,
						'time_start' => $row->time_start,
						'time_end'	=> $row->time_end
				);

		}
		// Listado de Mecánicos
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


        // Obtenemos los comentarios
        $this->load->model('Floor_activities_comments');
        $this->Floor_activities_comments->load_folio( $folio_id );
        $result_comments	= $this->Floor_activities_comments->get_all_comments_by_folio();

        foreach ($result_comments->result() as $row) {

        	$grid_comments[]  = array(

        						'floor_activities_comments_id' => $row->floor_activities_comments_id,
        						'folio_id' => $row->folio_id,
        						'date' => $row->date,
        						'employee_id' => $row->employee_id,
        						'employee_name' => $this->employees->get_name_by_id($row->employee_id),
        						'comments' => $row->comments

        		);
        }

        // Helpers
		$this->load->helper('form');

		
		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('Tasks/index' , array('grid' => $grid_array , 'comments' => $grid_comments , 'config' =>$config_array));
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
		$activity_id	= $this->input->get('id_activity', TRUE);

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

	public function add_comment(){

		$comment	= $this->input->post('hidden_comments', TRUE);
		$folio_id 	= $this->session->userdata('folio_id');


		$this->load->model('floor_activities_comments');
        $this->floor_activities_comments->load_folio( $folio_id );
        $this->floor_activities_comments->insert_comment( $comment );

        redirect('tasks/', 'refresh');

	}

	public function add_config(){

		$priority 	= $this->input->post('priority', TRUE);
		$time_start	= $this->input->post('time_start_input', TRUE);
		$time_end	= $this->input->post('time_end_input', TRUE);

		$unix_time_start 	= strtotime($time_start);
		$unix_time_end 		= strtotime($time_end);


		$folio_id 		= $this->session->userdata('folio_id');
		
		// Informacion de la configuracion
		$this->load->model('floor_activities_folio');
		$this->floor_activities_folio->load_folio( $folio_id );
		$this->floor_activities_folio->update_config_by_folio( $priority , $unix_time_start , $unix_time_end );
		
		redirect('tasks/', 'refresh');

	}


}
?>