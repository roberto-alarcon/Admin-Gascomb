<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folios extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){

		$this->load->helper('form');

		$this->load->model( 'floor_activities_folio' );
		$folios = $this->floor_activities_folio->get_all_folios_by_employee( );

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_dashboard');
		$this->load->view('Folios/index' , array('gridFolio' => $folios));
		$this->load->view('Layout/footer');


	}

	public function add(){

		$folio_id 	= $this->input->post('addFolio');
		$this->load->model( 'floor_activities_folio' );
		$this->floor_activities_folio->add_folio( $folio_id );

		// Agregamos la marca de tiempo
		$this->load->model( 'floor_activities_timecontrol' );
		$this->floor_activities_timecontrol->load_folio( $folio_id	 );
		$this->floor_activities_timecontrol->set_asignacion_folio();


		redirect('folios/', 'refresh');
	}

	public function delete(){

		$folio_id = $this->input->get('folio_id', TRUE);
		$this->load->model( 'floor_activities_folio' );
		$this->floor_activities_folio->delete_folio( $folio_id );
		redirect('folios/', 'refresh');

	}

	public function search_folio(){

		$folio_id 	= $this->input->post('folio_id');

		$this->load->model( 'folio' );
		$this->folio->load_folio( $folio_id );
		$result	= $this->folio->get_folio();

		// Instanciamos dependencias
		$this->load->model( 'dependency' );
		$this->load->model( 'support_brand_vehicular' );
		$this->load->model( 'support_models_vehicular' );


		
		$table = "
		<form method='post' action='./add'>
		<table class='table table-hover'>";
		$table .= "<tr>
		<td></td>
		<td></td>
		<td><button type='submit' class='btn btn-primary'>[+] Agregar</button></td>
		</tr>";
		foreach ($result->result() as $row)
        {

        	$folio_id = $row->folio_id;
        	$table .= "<tr>";
        	$table .= "<td>Folio:</td><td>".$row->folio_id."</td>";
        	$table .= "</tr>";
        	$table .= "<tr>";
        	$table .= "<td>Dependencia:</td><td>".$this->dependency->get_name_by_id( $row->dependency_id )."</td>";
        	$table .= "</tr>";
        	$table .= "<tr>";
        	$table .= "<td>Marca:</td><td>".$this->support_brand_vehicular->get_brand_by_id( $row->support_brand_vehicular_id )."</td>";
        	$table .= "</tr>";
        	$table .= "<tr>";
        	$table .= "<td>Modelo:</td><td>".$this->support_models_vehicular->get_model_by_id( $row->support_models_vehicular_id )."</td>";
        	$table .= "</tr>";
        	$table .= "<tr>";
        	$table .= "<td>Placa:</td><td>".$row->registration_plate."</td>";
        	$table .= "</tr>";
        	$table .= "<tr>";
        	$table .= "<td>Torre:</td><td>".$row->tower."</td>";
        	$table .= "</tr>";
        	$table .= "<tr>";
        	$table .= "<td>Zona:</td><td>".$row->parking_space."</td>";
        	$table .= "</tr>";


        	
        }

        $table .= "<input type='hidden' id='addFolio' name='addFolio' value='".$folio_id."'>";
        $table .= "</table></form>";

		echo $table;
		
	}

}
?>