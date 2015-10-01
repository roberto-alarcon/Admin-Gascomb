<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities_folio extends CI_Model{

  
  var $status   =  array('pendiente-mecanicos' => 0,
                      'pendiente' => 1,
                      'proceso' => 2,
                      'detenido' => 3,
                      'vobo' => 4,
                      'terminado' => 5
                     );

  var $priority  = array(
                      'urgente' => 0,
                      'medio'   => 1,
                      'bajo'    => 2
                    );

  function __contruct(){
    parent::__contruct();
  }

  
  public function add_folio( $folio_id ){

    $session      = $this->session->userdata('logged_in');
    $bd           = $session['bd'];
    $employee_id  = $session['employee_id'];
    $this->load->database( $bd , TRUE);

    $data = array(
       'folio_id'           => $folio_id ,
       'leader_employee_id' => $employee_id ,
       'status'             => $this->status['pendiente-mecanicos'],
       'priority'           => $this->priority['medio'],
       'time_start'         => time(),
       'time_end'           => time() + 24*60*60,


    );

    $this->db->insert('floor_activities_folio', $data);

  }


  public function get_all_folios_by_employee( ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    $employee_id  = $session['employee_id'];
    
    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('floor_activities_folio');
    $this->db->where('leader_employee_id', $employee_id );
    $this->db->order_by("time_start", "desc");
    $query = $this->db->get();
    return $query;

  }
 
    
 }

?>