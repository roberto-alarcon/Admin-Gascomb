<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities_extensions extends CI_Model{


  function __contruct(){
    parent::__contruct();
  }

  public function add_extensions_folio($folio,$comment,$company,$leader){

      $afftectedRows = 0;
      $time = time();

      $ci =& get_instance();
      $session = $ci->session->userdata('logged_in');
      $id_empl = $session['employee_id']; 

      $data2 = array(
         'folio_id'       => $folio ,
         'extensions_comments' => $comment,
         'status'         => '0',
         'date_request'   => $time,
         'approval_date'  => NULL,
         'applicant_employee' => $id_empl,
         'employee_responsible' => $leader,
         'responsible_agency'    => ''
         
      );


      if ($company == "Gascomb"){
          $this->load->database( "default" , true);
          $this -> db -> insert('floor_activities_extensions', $data2); 
          $afftectedRows = $this -> db -> affected_rows();
          
      } else if ($company == "Pts"){
          $this->dbPTS = $this->load->database( $bd , true);
          $this -> dbPTS -> insert('floor_activities_extensions', $data2); 
          $afftectedRows = $this -> dbPTS -> affected_rows();
       
      }

      return $afftectedRows;

  }

    
 }

?>