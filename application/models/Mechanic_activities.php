<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Mechanic_activities extends CI_Model{

  var $folio_id;

  function __contruct(){
    parent::__contruct();   
  }

  function dame_nombre(){

    return "Roberto Alarcon";
  }

  function login($nip, $bd){
    
    $this->load->database( $bd , TRUE);
    $this -> db -> select('*');
    $this -> db -> from('employees');
    $this -> db -> where('employee_id', $nip);
    $this -> db -> limit(1);
 
    $query = $this -> db -> get();
 
    if($query -> num_rows() == 1)
    {
       return $query->result();
    }
    else
    {
       return false;
    }
  }

}
?>