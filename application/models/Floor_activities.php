<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities extends CI_Model{

  var $folio_id;

  function __contruct(){
    parent::__contruct();   
  }

  function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }


  function delete_activity( $activity_id ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    
    $this->load->database( $bd , TRUE);
    $this->db->delete('floor_activities', array('floor_activity_id' =>  $activity_id ));

  }

  function load_activities_by_folio(){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('floor_activities');
    $this->db->where('folio_id', $this->folio_id );
    $query = $this->db->get();
   
    return $query;


  }

  function add_new_activity( $support_activity_id , $description){

    $folio_id = $this->session->userdata('folio_id');
    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $data = array(
       'folio_id' => $folio_id ,
       'support_activity_id' => $support_activity_id ,
       'description' => $description,
       'employee_id' => 0,
       'comments' => '.'
    );

    $this->db->insert('floor_activities', $data); 


  }


}
?>