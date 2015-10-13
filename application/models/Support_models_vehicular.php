<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Support_models_vehicular extends CI_Model{

  
  function __contruct(){
    parent::__contruct();
  }

  
  public function get_model_by_id( $id ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    
    $this->load->database( $bd , TRUE);
    $this->db->select('model');
    $this->db->from('support_models_vehicular');
    $this->db->where('support_models_vehicular_id', $id );
    $query = $this->db->get();

    $model = "";

    foreach ($query->result() as $row)
    {
        $model = $row->model;
    }

    return $model;

  }
 
    
 }

?>