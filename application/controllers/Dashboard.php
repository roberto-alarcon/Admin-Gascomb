<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){

		$this->load->model( 'folio' );
		$this->load->model( 'dependency' );
		$this->load->model( 'support_brand_vehicular' );
		$this->load->model( 'support_models_vehicular' );
		$this->load->model( 'floor_activities' );
		$this->load->model( 'employees' );
		$this->load->model( 'tracing' );



		$folio_result 	= $this->folio->get_productivity();
		$array_grid	 	= array();

		foreach ($folio_result->result() as $row)
		{
		    
		    // Load al activities by folio
		    $this->floor_activities->load_folio( $row->folio_id );
		    $activities = $this->floor_activities->load_activities_by_folio();

		    // Get Activities descripcion
		    $descripcion_activities = array();
		    $employees_id			= array();
		    foreach ($activities->result() as $row_activities)
			{
				//$descripcion_activities[] = $row_activities->description;
				$descripcion_activities[] 	= $row_activities->description;
				$employees_id[]				= $row_activities->employee_id;
			}

			$employees_id = array_unique($employees_id);
			$employees_names = array();
			foreach ($employees_id as $key => $id) {
				
				$employees_names[] = $this->employees->get_name_by_id( $id );
			}

			// Seguimiento:
			$this->tracing->load_folio( $row->folio_id );
			$tracing_results = $this->tracing->get_tracing_by_folio_id();
			$descripcion_tracing = array();
			foreach ($tracing_results->result() as $row_tracing)
			{
				$descripcion_tracing[] = $row_tracing->comments;

			}


		    $array_grid[] = array(
		    		'dependency' 				=>	$this->dependency->get_name_by_id( $row->dependency_id ),
		    		'folio_id' 					=> $row->folio_id,
		    		'support_brand_vehicular'	=>$this->support_brand_vehicular->get_brand_by_id( $row->support_brand_vehicular_id ),
		    		'support_models_vehicular'	=> $this->support_models_vehicular->get_model_by_id( $row->support_models_vehicular_id ),
		    		'registration_plate'		=> $row->registration_plate,
		    		'entry_date'				=> $row->entry_date." ".$row->entry_time,
		    		'reparaciones'				=> implode(",", $descripcion_activities),
		    		'mechanics'					=> implode(",", $employees_names),
		    		'seguimiento'				=> substr(implode("<br/>", $descripcion_tracing) , 0 , 100),
		    		'tower'						=> $row->tower

		    	);	

		    
		}


		//print_r( $array_grid );

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_dashboard');
		$this->load->view('Dashboard/productivity' , array( 'report' => $array_grid ));
		$this->load->view('Layout/footer');

	}

}
?>