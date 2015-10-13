<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Support_brand_vehicular extends CI_Model{

  
  function __contruct(){
    parent::__contruct();
  }

  
  public function get_brand_by_id( $id ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    

    $this->load->database( $bd , TRUE);
    $this->db->select('brand');
    $this->db->from('support_brand_vehicular');
    $this->db->where('support_brand_vehicular_id', $id );
    $query = $this->db->get();

    $brand = "";

    foreach ($query->result() as $row)
    {
        $brand = $row->brand;
    }

    return $brand;

  }
 
    
 }

?>