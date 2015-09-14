<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loadfolio extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){

		
		$this->load->library('folio');
		$this->folio->folio_load( $this->input->post('folio_id') );
		
		if ( $this->folio->folio_exists() ){

			redirect('general/pdf', 'refresh');

		}else{

			echo "El folio no existe";
		}

		


	}

}
?>