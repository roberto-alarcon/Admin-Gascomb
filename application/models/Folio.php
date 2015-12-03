<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Folio extends CI_Model{

  var $folio_id;

  function __contruct(){
    parent::__contruct();
  }

  public function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }


  public function get_folio(){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    
    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('folios');
    $this->db->where('folio_id', $this->folio_id );
    $query = $this->db->get();

    return $query;

  }


  public function get_productivity(){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('folios');
    $this->db->where('support_status_id !=', 8);
    $this->db->where('support_status_id !=', 9);
    $query = $this->db->get();

    return $query;



  }
 
    
 }

?>