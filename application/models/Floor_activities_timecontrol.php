<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Floor_activities_timecontrol extends CI_Model{

  var $folio_id;

  var $code         = array(
                        'asignacion-folio'      =>  1,
                        'asignacion-mecanicos'  =>  2,
                        'cambio-mecanicos'      =>  3,
                        'cerrar-folio'          =>  4
    );

  function __contruct(){
    parent::__contruct();
  }

  public function load_folio( $folio_id ){

    $this->folio_id = $folio_id;
  }

  private function change_status( $status ){

    $session      = $this->session->userdata('logged_in');
    $bd           = $session['bd'];
    $folio_id     = $this->session->userdata('folio_id');
    $employee_id  = $session['employee_id'];

    $data = array(
       'folio_id' => $this->folio_id ,
       'employee_id' => $employee_id ,
       'time' => time(),
       'code' => $status,
       
    );

    $this->db->insert('floor_activities_timecontrol', $data); 

  }


  public function set_asignacion_folio(){

    $this->change_status( $this->code['asignacion-folio'] );

  }

  public function set_asignacion_mecanicos(){
    $this->change_status( $this->code['asignacion-mecanicos'] );

  }

  public function set_cerrar_folio(){
    $this->change_status( $this->code['cerrar-folio'] );

  }

    
 }

?>