<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  Class Mechanic_activities extends CI_Model{

    var $id_employee;
    var $hoy;
    var $leader_employee;

    function __contruct(){
        parent::__contruct();   
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

    function findFoliosMechanic(){
      
        $ci =& get_instance();
        $session = $ci->session->userdata('logged_in');
        $this->id_employee = $session['employee_id'];      

        $this->load->database( "default" , TRUE);
        $this -> db -> distinct();
        $this -> db -> select('folio_id');
        $this -> db -> from('floor_activities');
        $this -> db -> where('employee_id', $this->id_employee);
        #$this -> db -> where('status =', '1');
        $this -> db -> limit(100);
        return $this -> db-> get();

        #return $query->result();
      
    }

    function findFechasFolio($folio){
        $this->hoy = time();
        $this->load->database( "default" , TRUE);
        $this -> db -> select('time_start,leader_employee_id,priority');
        $this -> db -> from('floor_activities_folio');
        $this -> db -> where('folio_id', $folio);
        $this -> db -> limit(100);

        $query = $this -> db -> get();

        foreach ($query->result() as $row)
        {
            $time_start = date('d/m/Y',$row->time_start);
            if( $time_start  <= date('d/m/Y', $this->hoy) ){
               return true;
            } else {
               return false;
            }
        }
  
    }

    function findActividadesFolio($folio){

        $this->load->database( "default" , TRUE);
        $this -> db -> select('floor_activity_id,description,status');
        $this -> db -> from('floor_activities');
        $this -> db -> where('folio_id', $folio);
        $this -> db -> where('employee_id', $this->id_employee);
        $this -> db -> where('status <>', '0');
        $this -> db -> limit(100);
        
        return $this -> db-> get();
      
    }

    function findDataFolio($folio){

        $this->load->database( "default" , TRUE);
        $this -> db -> select('dependency_id,received_by,entry_date,tower,parking_space,type_service');
        $this -> db -> from('folios');
        $this -> db -> where('folio_id', $folio);
        $this -> db -> limit(100);
        
        return $this -> db-> get();
      
    }

    /*function get_departments(){
        $sql = $this->db->query('SELECT departmentName FROM department ORDER BY departmentName ASC');
        return $sql->result();
        /* you simply return the results as an object
         * also note you can use the ActiveRecord class for this...might make it easier
         
    }*/

  }
?>