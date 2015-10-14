<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechanic_main extends CI_Controller {
    
	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){
		$this->load->model('mechanic_activities');

		$foliosMechanic = $this->mechanic_activities->findFoliosMechanic(); 
        $foliosValidos = array();
        $c = 0;
        
        foreach ($foliosMechanic->result() as $k => $row){
            $folioValido = $this->mechanic_activities->findFechasFolio($row->folio_id);
            if ($folioValido){
                $foliosValidos[$c]['folio'] = $row->folio_id;
                
                $ActividadesMechanic = $this->mechanic_activities->findActividadesFolio($row->folio_id); 
                $foliosValidos[$c]['actividades'] = $ActividadesMechanic->result();

                $DatasFolio = $this->mechanic_activities->findDataFolio($row->folio_id);
                $foliosValidos[$c]['datos_folio'] = $DatasFolio->result();

                $LeaderId = $this->mechanic_activities->findLeaderEmployee($row->folio_id);
                if ($LeaderId){
                    foreach ($LeaderId->result() as $k1 => $row){
                       $LeaderName = $this->mechanic_activities->findNameEmployee($row->leader_employee_id);
                       $foliosValidos[$c]['leadername'] = $LeaderName;
                    }
                    
                }
 
                $c++;
            }
        }

        $foliosValidos = json_encode($foliosValidos);
		$this->load->view('Mechanic/header');
		$this->load->view('Mechanic/main',array('resultado' => $foliosValidos));
        $this->load->view('Mechanic/footer');
	}

}
?> 