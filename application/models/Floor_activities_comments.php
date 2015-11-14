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

    return $this->db->insert_id();


  }


  public function add_comment_folio($folio,$comment,$company){

      $afftectedRows = 0;
      $time = time();

      $ci =& get_instance();
      $session = $ci->session->userdata('logged_in');
      $id_empl = $session['employee_id']; 

      $data2 = array(
         'folio_id'       => $folio ,
         'date'           => $time,
         'employee_id'    => $id_empl,
         'comments'       => $comment
      );


      if ($company == "Gascomb"){
          $this->load->database( "default" , true);
          $this -> db -> insert('floor_activities_comments', $data2); 
          $afftectedRows = $this -> db -> affected_rows();
          
      } else if ($company == "Pts"){
          $this->dbPTS = $this->load->database( $bd , true);
          $this -> dbPTS -> insert('floor_activities_comments', $data2); 
          $afftectedRows = $this -> dbPTS -> affected_rows();

       
     }

      return $afftectedRows;

  }

 
 
    
 }

?>