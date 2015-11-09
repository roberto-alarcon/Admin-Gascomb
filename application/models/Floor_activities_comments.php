<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities_comments extends CI_Model{

  var $folio_id;

  function __contruct(){
    parent::__contruct();
  }

  public function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }


  public function get_all_comments_by_folio(){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    
    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('floor_activities_comments');
    $this->db->where('folio_id', $this->folio_id );
    $this->db->order_by("date", "desc");
    $query = $this->db->get();

    return $query;

  }

  public function insert_comment( $comment ){

    $session      = $this->session->userdata('logged_in');
    $bd           = $session['bd'];
    $employee_id  = $session['employee_id'];
    $this->load->database( $bd , TRUE);

    if( !empty($comment) ){

      $data = array(
         'folio_id'       => $this->folio_id ,
         'date'           => time() ,
         'employee_id'    => $employee_id,
         'comments'       => $comment
      );

      $this->db->insert('floor_activities_comments', $data);
    }


  }




 
 
    
 }

?>