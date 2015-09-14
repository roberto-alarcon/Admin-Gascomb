<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class General extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		//$this->load->view('General/photos');
		$this->load->view('Layout/footer');

	}

	public function photos(){

		// OBTENEMOS EL PATH 
		$this->load->library( 'gascomb' );
		$path_image 	= $this->gascomb->get_image_path();
		$cdn_path		= $this->gascomb->get_cdn_path();
		$folio_id 		= $this->session->userdata('folio_id');

		$this->load->model('photos');
		$image_list = $this->photos->get_all_photos( $path_image , $cdn_path ,$folio_id);
	

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('General/photos' , array('list' => $image_list) );
		$this->load->view('Layout/footer');
	}

	public function pdf(){

		$this->load->library( 'gascomb' );
		$cdn_path		= $this->gascomb->get_cdn_path();
		$folio_id 		= $this->session->userdata('folio_id');
		$path_pdf 		= $cdn_path.$folio_id.'/pdf/'.$folio_id.'.pdf';

		$this->load->view('Layout/header');
		$this->load->view('Layout/menu_folio');
		$this->load->view('General/pdf' , array('pdf' => $path_pdf ) );
		$this->load->view('Layout/footer');
	}


}
?>