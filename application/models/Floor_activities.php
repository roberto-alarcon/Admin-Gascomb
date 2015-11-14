<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities extends CI_Model{

  var $folio_id;
  var $floor_activity_id;

  var $status   =  array('pendiente-mecanicos' => 0,
                      'pendiente' => 1,
                      'proceso' => 2,
                      'detenido' => 3,
                      'vobo' =>4,
                      'terminado' => 5
                     );

  function __contruct(){
    parent::__contruct();   
  }

  function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }

  function load_floor_activity_id( $floor_activity_id ){
    $this->floor_activity_id = $floor_activity_id;

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

  public function get_employee_id_by_floor_activity_id( $floor_activity_id ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    $this->db->select("employee_id");
    $this->db->from('floor_activities');
    $this->db->where('floor_activity_id', $floor_activity_id);
    $query = $this->db->get();

    $employee_id = 0;

    foreach ($query->result() as $row)
    {
        $employee_id =  $row->employee_id;
    }

    return $employee_id;

  }




  public function add_mechanics( $arrayMechanics ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];  


    foreach ($arrayMechanics as $key => $value){
        
        
        $floor_activity_id  = $key;
        $employees_id       = $value;

        $_bd_employee_id    = $this->get_employee_id_by_floor_activity_id( $floor_activity_id );
        
        if ( $_bd_employee_id !=  $employees_id){

          $data = array(
                 'employee_id' => $employees_id,
                 'status' => $this->status['pendiente']
              );

          $this->db->where('floor_activity_id', $floor_activity_id);
          $this->db->update('floor_activities', $data);

        }

    }

  }

  public function check_all_in_vobo(){
    $folio_id = $this->session->userdata('folio_id');
    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    $this->db->select('status');
    $this->db->from('floor_activities');
    $this->db->where('folio_id', $folio_id );
    $query = $this->db->get();


    $array_result = array();
    foreach ($query->result() as $row)
    {
      $array_result[] =  $row->status;
    }

    $resultado = array_unique( $array_result );

    if( isset( $resultado[0] ) ){
      if ( count($resultado) == 1 && $resultado[0] == 4 ){
        return "1";

      }else{
        return "0";

      }
    }else{

      return "0";
    }

  }


  public function get_activity_descripction_by_id( $id ){

    $folio_id = $this->session->userdata('folio_id');
    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    $this->db->select('description');
    $this->db->from('floor_activities');
    $this->db->where('floor_activity_id', $id  );
    $query = $this->db->get();

    $array_result = array();
    foreach ($query->result() as $row)
    {
      $array_result[] =  $row->description;
    }

    return $array_result;


  }


  public function close_all_activities_by_folio_id(){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $data = array(
               'status' => $this->status['terminado']
            );

    $this->db->where('folio_id', $this->folio_id);
    $this->db->update('floor_activities', $data);


  }



  private function change_status( $status ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    $folio_id = $this->session->userdata('folio_id');

    $data = array(
               'status' => $status
            );

    $this->db->where('floor_activity_id', $this->floor_activity_id);
    $this->db->update('floor_activities', $data);

  }


  public function status_pendiente( ){

    $this->change_status( $this->status['pendiente'] );

  }





}
?>