<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mechanic_main extends CI_Controller {
    
	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){
		$this->load->model('mechanic_activities');

		$foliosMechanic = $this->mechanic_activities->findFoliosMechanic(); 
        $foliosMechanicPts = $this->mechanic_activities->findFoliosMechanicPts(); 
        $this->load->library('utilsm');
        $path_qr_gascomb = $this->utilsm->get_cdn_path("gascomb");
        $path_qr_pts = $this->utilsm->get_cdn_path("pts");
        $foliosValidos = array();
        $foliosValidosP = array();
        $c = 0;
        $p = 0;
        $bd = "default";
        $bd2 = "pts";
        
        foreach ($foliosMechanic->result() as $k => $row){
            $folioValido = $this->mechanic_activities->findFechasFolio($row->folio_id,$bd);
            if ($folioValido){
                $foliosValidos[$c]['company'] = "Gascomb";
                $foliosValidos[$c]['folio'] = $row->folio_id;
                $foliosValidos[$c]['qrcode'] = $path_qr_gascomb.$row->folio_id."/_qrcode/qrcode.png";
                $foliosValidos[$c]['pdf'] = $path_qr_gascomb.$row->folio_id."/pdf/".$row->folio_id.".pdf";
                
                $ActividadesMechanic = $this->mechanic_activities->findActividadesFolio($row->folio_id,$bd); 
                $foliosValidos[$c]['actividades'] = $ActividadesMechanic->result();

                $DatasFolio = $this->mechanic_activities->findDataFolio($row->folio_id,$bd);
                $foliosValidos[$c]['datos_folio'] = $DatasFolio->result();

                $Comments = $this->mechanic_activities->findCommentsFolio($row->folio_id,$bd);
                $foliosValidos[$c]['comments'] = $Comments->result();

                $LeaderId = $this->mechanic_activities->findLeaderEmployee($row->folio_id,$bd);
                if ($LeaderId <> ""){
                    foreach ($LeaderId->result() as $k1 => $row){
                       $LeaderName = $this->mechanic_activities->findNameEmployee($row->leader_employee_id,$bd);
                       $foliosValidos[$c]['leadername'] = $LeaderName;
                       $foliosValidos[$c]['priority'] = $row->priority;
                    }
                    
                }

                $c++;
            }
        }

        foreach ($foliosMechanicPts->result() as $k3 => $row3){
            $folioValidoP = $this->mechanic_activities->findFechasFolio($row3->folio_id,$bd2);
            if ($folioValidoP){
                $foliosValidosP[$p]['company'] = "Pts Service";
                $foliosValidosP[$p]['folio'] = $row3->folio_id;
                $foliosValidosP[$p]['qrcode'] = $path_qr_pts.$row3->folio_id."/_qrcode/qrcode.png";
                $foliosValidosP[$p]['pdf'] = $path_qr_pts.$row3->folio_id."/pdf/".$row3->folio_id.".pdf";
                
                $ActividadesMechanicP = $this->mechanic_activities->findActividadesFolio($row3->folio_id,$bd2); 
                $foliosValidosP[$p]['actividades'] = $ActividadesMechanicP->result();

                $DatasFolioP = $this->mechanic_activities->findDataFolio($row3->folio_id,$bd2);
                $foliosValidosP[$p]['datos_folio'] = $DatasFolioP->result();

                $CommentsP = $this->mechanic_activities->findCommentsFolio($row3->folio_id,$bd2);
                $foliosValidosP[$p]['comments'] = $Comments->result();

                $LeaderIdP = $this->mechanic_activities->findLeaderEmployee($row3->folio_id,$bd2);
                if ($LeaderIdP <> ""){
                    foreach ($LeaderIdP->result() as $k4 => $row4){
                       $LeaderNameP = $this->mechanic_activities->findNameEmployee($row4->leader_employee_id,$bd2);
                       $foliosValidosP[$p]['leadername'] = $LeaderNameP;
                       $foliosValidosP[$p]['priority'] = $row4->priority;
                    }
                    
                }

                $p++;
            }
        }
        

        #$foliosValidosT = array_merge($foliosValidos,$foliosValidosP);   
        $foliosValidosT = json_encode($foliosValidos);
		$this->load->view('Mechanic/header');
		$this->load->view('Mechanic/main',array('resultado' => $foliosValidosT));
        $this->load->view('Mechanic/footer');
	}

}

?> 