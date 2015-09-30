<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class Support_activities extends CI_Model{

  function __contruct(){
    parent::__contruct();
  }

  function get_activities_by_keyword( $where ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];

    $this->load->database( $bd , TRUE);
    /*
    $this->db->select('*');
    $this->db->distinct();
    $this->db->from('support_activities');
    $this->db->like('description', $where);
    $this->db->order_by("description", "asc");
    */
    //$this->db->select('SELECT distinct(description) FROM sistema_gascomb.support_activities where description like "%muelles%";');
 
    $query = $this->db->query('SELECT distinct(description) FROM support_activities where description like "%'.$where.'%";');
   
    return $query;

  }

  function search_support_activity_by_description( $description ){

    $session  = $this->session->userdata('logged_in');
    $bd       = $session['bd'];
    $this->load->database( $bd , TRUE);
    
    $this->db->select('support_activity_id');
    $this->db->from('support_activities');
    $this->db->where('description', $description);
    $this->db->limit(1);
    return $this->db->get();
    

  }
 
  
}
?>