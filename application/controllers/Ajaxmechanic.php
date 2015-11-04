<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxmechanic extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){


	}

	public function udpate_activitie(){

		$activity_id = $this->input->post('actv');
		$company = $this->input->post('comp');
        $action = $this->input->post('act');
        $comentario = $this->input->post('comentario');
        $folio = $this->input->post('fo');

        $this->load->model('mechanic_activities');
        if($action != "tostop"){
			$update = $this->mechanic_activities->update_activity($activity_id, $company, $action);
			echo $update;
		} else {
			$update = $this->mechanic_activities->update_activity_tostop($activity_id, $company, $action, $comentario, $folio);
			redirect('mechanic_main', 'refresh');
		}
        
		

	}



}
?>