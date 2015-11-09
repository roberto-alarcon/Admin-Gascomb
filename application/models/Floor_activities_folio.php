<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities_folio extends CI_Model{

  
  /*
  var $status   =  array('pendiente-mecanicos' => 0,
                      'pendiente' => 1,
                      'proceso' => 2,
                      'detenido' => 3,
                      'vobo' => 4,
                      'terminado' => 5
                     );*/
  
  var $status   =  array('cerrado' => 0,
                      'abierto' => 1
                     );

  var $priority  = array(
                      'urgente' => 0,
                      'medio'   => 1,
                      'bajo'    => 2
                    );

  function __contruct(){
    parent::__contruct();
  }

  
  public function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }

  public function add_folio( $folio_id ){

    $session      = $this->session->userdata('logged_in');
    $bd           = $session['bd'];
    $employee_id  = $session['employee_id'];
    $this->load->database( $bd , TRUE);

    $data = array(
       'folio_id'           => $folio_id ,
       'leader_employee_id' => $employee_id ,
       'status'             => $this->status['abierto'],
       'priority'           => $this->priority['medio'],
       'time_start'         => time(),
       'time_end'           => time() + 24*60*60,


    );

    $this->db->insert('floor_activities_folio', $data);

  }

  public function delete_folio( $folio_id ){
    $session      = $this->session->userdata('logged_in');
    $bd           = $session['bd'];
    $this->load->database( $bd , TRUE);
    $this->db->delete('floor_activities_folio', array('folio_id' => $folio_id)); 

  }

  public function get_all_info_by_folio( ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('floor_activities_folio');
    $this->db->where('folio_id', $this->folio_id );
    $query = $this->db->get();
    return $query;

  }


  public function get_all_folios_by_employee( ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    $employee_id  = $session['employee_id'];
    
    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('floor_activities_folio');
    $this->db->where('leader_employee_id', $employee_id );
    $this->db->where('status', 1 );
    $this->db->order_by("folio_id", "desc");
    $query = $this->db->get();
    return $query;

  }

  public function update_config_by_folio( $priority , $time_start , $time_end , $status ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $data = array(
               'priority' => $priority,
               'time_start' => $time_start,
               'time_end' => $time_end,
               'status' => $status
            );

    $this->load->database( $bd , TRUE);
    $this->db->where('folio_id', $this->folio_id);
    $this->db->update('floor_activities_folio', $data);

  }

  public function on_activity(){  
    $this->switch_activity( 1 );

  }

  public function off_activity(){
    $this->switch_activity( 0 );

  }

  private function switch_activity( $actiivity ){
    
    $data = array(
               'status' => $actiivity
            );

    $this->db->where('folio_id', $$this->folio_id);
    $this->db->update('floor_activities_folio', $data);

  }
 
    
 }

?>