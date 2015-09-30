<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Employees extends CI_Model{

  function __contruct(){
    parent::__contruct();
  }
 
  public function get_name_by_id( $employee_id ){

    $name     = "";
    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    

    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('employees');
    $this->db->where('employee_id', $employee_id );
    $query = $this->db->get();

    foreach ($query->result() as $row)
        {

          $name = $row->name." ".$row->last_name; 
        }

    return $name;
    

  }

  public function getAllEmployees(){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    $this->db->select('*');
    $this->db->from('employees');
    $this->db->where('status', '1' );
    $this->db->order_by("name", "asc");
    $query = $this->db->get();

    return $query;


  }


    
 }

?>