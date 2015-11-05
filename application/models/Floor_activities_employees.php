<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities_employees extends CI_Model{

  var $folio_id;

  function __contruct(){
    parent::__contruct();
  }

  public function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }


  public function check_if_employee_exists( $employee_id ){

    $session      = $this->session->userdata('logged_in');
    $bd           = $session['bd'];
    $this->load->database( $bd , TRUE);

    $this->db->where('folio_id', $this->folio_id );
    $this->db->where('employee_id', $employee_id );
    $this->db->from('floor_activities_employees');
    $total  = $this->db->count_all_results();
    return $total;

  }  


  public function add_employee( $employee_id ){

    $row_results  = $this->check_if_employee_exists( $employee_id );
    
    if( $row_results == 0 ){

      $session      = $this->session->userdata('logged_in');
      $bd           = $session['bd'];
      $this->load->database( $bd , TRUE);

      $data = array(
         'folio_id'       => $this->folio_id ,
         'employee_id'    => $employee_id,
         'status'       => 1
      );

      $this->db->insert('floor_activities_employees', $data);

    }

  } 
    
 }

?>