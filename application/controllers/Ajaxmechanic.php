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
		$activity_desc = $this->input->post('actdes');
		$company = $this->input->post('comp');
        $action = $this->input->post('act');
        $comentario = $this->input->post('comentario');
        $folio = $this->input->post('fo');

        $this->load->model('mechanic_activities');
        $this->load->model('floor_activities_details_control');
        $time = time();
        if($action != "tostop"){
			$update = $this->mechanic_activities->update_activity($activity_id, $company, $action, $time);
			$details = $this->floor_activities_details_control->updateDetailsActivities($folio, $activity_id, $company, $action, $time);
			if ($update == 1 && $details == 1){
				echo 1;
			} else {
				echo 0;
			}
		} else {
			$idComment = $this->mechanic_activities->update_activity_tostop($activity_id, $company, $action, $comentario, $folio, $time, $activity_desc);
			$this->floor_activities_details_control->updateDetailsActivitiesStop($folio, $activity_id, $company, $action, $time, $idComment);
			sleep(2);
			redirect('mechanic_main', 'refresh');
		}
 
		

	}

	public function add_extensions(){

        $folio_ext = $this->input->post('fol_ext');
        $comment_ext = $this->input->post('comment_ext');
        $comp_ext = $this->input->post('comp_ext');
        $lead_ext = $this->input->post('lead_ext');

        $this->load->model('floor_activities_extensions');
        $myextension = $this->floor_activities_extensions->add_extensions_folio($folio_ext,$comment_ext,$comp_ext,$lead_ext);
        if ($myextension > 0){
        	sleep(2);
        	redirect('mechanic_main', 'refresh');
        } 
		

	}




}
?>