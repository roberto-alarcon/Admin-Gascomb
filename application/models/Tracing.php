<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Tracing extends CI_Model{

  function __contruct(){
    parent::__contruct();
  }

  public function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }
 
  public function get_tracing_by_folio_id( ){

    $name     = "";
    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    

    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('tracing');
    $this->db->where('folio_id', $this->folio_id );
    $query = $this->db->get();
    
    return $query;
    

  }

    
 }

?>