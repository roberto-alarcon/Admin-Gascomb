<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Dependency extends CI_Model{

  
  function __contruct(){
    parent::__contruct();
  }

  
  public function get_name_by_id( $id ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    

    $this->load->database( $bd , TRUE);
    $this->db->select('name');
    $this->db->from('dependency');
    $this->db->where('dependency_id', $id );
    $query = $this->db->get();

    $name = "";

    foreach ($query->result() as $row)
    {
        $name = $row->name;
    }

    return $name;

  }
 
    
 }

?>