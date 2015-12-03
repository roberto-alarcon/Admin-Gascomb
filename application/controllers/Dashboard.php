<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		$this->load->library('excel');
		
	}

	public function index(){
		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_dashboard');
		$this->load->view('Layout/footer');

	}


	public function reporte(){

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
		    		'dependency' 				=> $this->dependency->get_name_by_id( $row->dependency_id ),
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


	public function export_report(){

		// Libreria Excel
		$this->load->library('excel');

		// Modelos
		$this->load->model( 'folio' );
		$this->load->model( 'dependency' );
		$this->load->model( 'support_brand_vehicular' );
		$this->load->model( 'support_models_vehicular' );
		$this->load->model( 'floor_activities' );
		$this->load->model( 'employees' );
		$this->load->model( 'tracing' );

		$folio_result 	= $this->folio->get_productivity();
		$array_grid	 	= array();


		$headee = array(
		    'font' => array(
		        'name' => 'Helvetica',
		        'size' => 9,
		        'bold' => true,
		        'color' => array(
		            'rgb' => '000000'
		        ),
		    ),
		    'borders' => array(
		        'bottom' => array(
		            'style' => PHPExcel_Style_Border::BORDER_THIN,
		            'color' => array(
		                'rgb' => '000000'
		            )
		        )
		    ),
		    'fill' => array(
		        'type' => PHPExcel_Style_Fill::FILL_SOLID,
		        'startcolor' => array(
		            'rgb' => 'D1E5FE',
		        ),
		    ),
		);

		$stylecells = array(
		    'font' => array(
		        'name' => 'Helvetica',
		        'size' => 9,
		        'bold' => false,
		        'color' => array(
		            'rgb' => '000000'
		        ),
		    ),
		    'borders' => array(
		             'outline' => array(
		                    'style' => PHPExcel_Style_Border::BORDER_THIN,
		                    'color' => array('rgb' => 'A4BED4'),
		             ),
		    )
		    
		);


		$F=$this->excel->getActiveSheet();
		$Line=2;
		//Estilos
		$F->getStyle('A1:J1')->applyFromArray($headee);
		//Centrado
		$F->getStyle('A1:J1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//Ancho de columna
		$F->getColumnDimension('A')->setWidth(30);
		$F->getColumnDimension('B')->setWidth(20);
		$F->getColumnDimension('C')->setWidth(10);
		$F->getColumnDimension('D')->setWidth(20);
		$F->getColumnDimension('E')->setWidth(20);
		$F->getColumnDimension('F')->setWidth(20);
		$F->getColumnDimension('G')->setWidth(40);
		$F->getColumnDimension('H')->setWidth(20);
		$F->getColumnDimension('I')->setWidth(40);
		$F->getColumnDimension('J')->setWidth(10);
		
		//Titulos
		$F->setCellValue('A1', "Dependencia")
		                    ->setCellValue('B1', "Folio")
		                    ->setCellValue('C1', "Marca")
		                    ->setCellValue('D1', "Tipo")
		                    ->setCellValue('E1', "Placas")
		                    ->setCellValue('F1', "Entrada")
		                    ->setCellValue('G1', "Reparación")
		                    ->setCellValue('H1', "Mecanico")
		                    ->setCellValue('I1', "Seguimiento")
		                    ->setCellValue('J1', "Torre");


		// For consulta
		foreach ($folio_result->result() as $row)
		{

			
			// Load al activities by folio
		    $this->floor_activities->load_folio( $row->folio_id );
		    $activities = $this->floor_activities->load_activities_by_folio();

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



			$F->getStyle('A'.$Line.':J'.$Line)->applyFromArray($stylecells);
            $F->getRowDimension(1)->setRowHeight(-1);


            //$F->setCellValue('A'.$Line,$valor["folio_id"])
           	$F->setCellValue('A'.$Line, utf8_encode( $this->dependency->get_name_by_id( $row->dependency_id ) ))
              ->setCellValue('B'.$Line, utf8_encode( $row->folio_id ))
              ->setCellValue('C'.$Line, utf8_encode( $this->support_brand_vehicular->get_brand_by_id( $row->support_brand_vehicular_id ) ))
              ->setCellValue('D'.$Line, utf8_encode( $this->support_models_vehicular->get_model_by_id( $row->support_models_vehicular_id )))
              ->setCellValue('E'.$Line, utf8_encode( $row->registration_plate ))
              ->setCellValue('F'.$Line, utf8_encode( $row->entry_date." ".$row->entry_time ))
              ->setCellValue('G'.$Line, utf8_encode( implode(",", $descripcion_activities) ))
              ->setCellValue('H'.$Line, utf8_encode( implode(",", $employees_names) ))
              ->setCellValue('I'.$Line, utf8_encode( implode(",", $descripcion_tracing) ))
              ->setCellValue('J'.$Line, utf8_encode( $row->tower ));
              
                 
              ++$Line;

		}

		

		$filename = "reporte_de_productividad_".date('d_m_Y', time() ).".xls";
	  
	  	// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
		$objWriter->save('php://output');

		//exit;
    

	}

}
?>