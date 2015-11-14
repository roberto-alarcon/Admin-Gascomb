<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities_details_control extends CI_Model{

  protected $dbPTS;
  
  function __contruct(){
    parent::__contruct();
  }

  public function updateDetailsActivities($folio, $activity_id, $company, $action, $time){

      $ci =& get_instance();
      $session = $ci->session->userdata('logged_in');
      $id_empl = $session['employee_id']; 

      switch ($action) {
          case "tostart":
              $status = '2';
              break;

          case "tofinalize":
              $status = '4';
              break;

          case "restart":
              $status = '2';
              break;
      }

      $data = array(
       'folio_id' => $folio,
       'floor_activity_id' => $activity_id,
       'employee_id' => $id_empl,
       'status' => $status,
       'time_start' => $time,
       'comments_id' => null
      );


      if ($company == "Gascomb"){
          $this->load->database( "default" , true);
          $this -> db -> insert('floor_activities_details_control', $data); 
          $afftectedRows = $this -> db -> affected_rows();
          
      } else if ($company == "Pts"){
          $this -> dbPTS = $this->load->database( $bd , true);
          $this -> dbPTS -> insert('floor_activities_details_control', $data); 
          $afftectedRows = $this -> dbPTS -> affected_rows();
       
      }

      return $afftectedRows;

  }
                                              
  public function updateDetailsActivitiesStop($folio, $activity_id, $company, $action, $time, $idcomment){

      $ci = & get_instance();
      $session = $ci->session->userdata('logged_in');
      $id_empl = $session['employee_id']; 


      $data = array(
       'folio_id' => $folio,
       'floor_activity_id' => $activity_id,
       'employee_id' => $id_empl,
       'status' => '3',
       'time_start' => $time,
       'comments_id' => $idcomment
      );


      if ($company == "Gascomb"){
          $this->load->database( "default" , true);
          $this -> db -> insert('floor_activities_details_control', $data); 
          $afftectedRows = $this -> db -> affected_rows();
          
      } else if ($company == "Pts"){
          $this -> dbPTS = $this->load->database( $bd , true);
          $this -> dbPTS -> insert('floor_activities_details_control', $data); 
          $afftectedRows = $this -> dbPTS -> affected_rows();
       
      }

      return $afftectedRows;

  }

  public function updateDetailsActivitiesReOpen($folio, $activity_id, $company, $time, $idcomment){

      $ci = & get_instance();
      $session = $ci->session->userdata('logged_in');
      $id_empl = $session['employee_id']; 


      $data = array(
       'folio_id' => $folio,
       'floor_activity_id' => $activity_id,
       'employee_id' => $id_empl,
       'status' => '2',
       'time_start' => $time,
       'comments_id' => $idcomment
      );


      if ($company == "Gascomb"){
          $this->load->database( "default" , true);
          $this -> db -> insert('floor_activities_details_control', $data); 
          $afftectedRows = $this -> db -> affected_rows();
          
      } else if ($company == "Pts"){
          $this -> dbPTS = $this->load->database( $bd , true);
          $this -> dbPTS -> insert('floor_activities_details_control', $data); 
          $afftectedRows = $this -> dbPTS -> affected_rows();
       
      }

      return $afftectedRows;

  }
    
}
?>