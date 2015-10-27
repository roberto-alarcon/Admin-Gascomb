<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  Class Mechanic_activities extends CI_Model{

    var $id_employee;
    var $hoy;
    var $leader_employee;
    protected $dbPTS;

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

    function findFoliosMechanicPts(){
      
        $ci =& get_instance();
        $session = $ci->session->userdata('logged_in');
        $this->id_employee = $session['employee_id'];      

        $this -> dbPTS = $this->load->database( "pts" , TRUE);
        $this -> dbPTS -> distinct();
        $this -> dbPTS -> select('folio_id');
        $this -> dbPTS -> from('floor_activities');
        $this -> dbPTS -> where('employee_id', $this->id_employee);
        #$this -> db -> where('status =', '1');
        $this -> dbPTS -> limit(100);

        return $this -> dbPTS -> get();

        #return $query->result();
      
    }

    function findFechasFolio($folio,$bd){
        $this->hoy = time();
        if ($bd == "default"){
            $this->load->database( $bd , TRUE);
            $this -> db -> select('time_start,leader_employee_id,priority');
            $this -> db -> from('floor_activities_folio');
            $this -> db -> where('folio_id', $folio);
            $this -> db -> limit(100);
            $query2 = $this -> db -> get();
        } elseif ($bd == "pts"){
            $this -> dbPTS = $this->load->database( $bd , TRUE);
            $this -> dbPTS -> select('time_start,leader_employee_id,priority');
            $this -> dbPTS -> from('floor_activities_folio');
            $this -> dbPTS -> where('folio_id', $folio);
            $this -> dbPTS -> limit(100);
            $query2 = $this -> dbPTS -> get();  
        }

        if($query2 -> num_rows() > 0){
            foreach ($query2->result() as $row2)
            {
                $time_start_p = date('d/m/Y',$row2->time_start);
                if( $time_start_p  <= date('d/m/Y', $this->hoy) ){
                   return true;
                } else {
                   return false;
                }
            }

        } else {
            return false;
        }

  
    }

    function findActividadesFolio($folio,$bd){
        if ($bd == "default"){
            $this->load->database( $bd , TRUE);
            $this -> db -> select('floor_activity_id,description,status');
            $this -> db -> from('floor_activities');
            $this -> db -> where('folio_id', $folio);
            $this -> db -> where('employee_id', $this->id_employee);
            $this -> db -> where('status <>', '0');
            $this -> db -> limit(100);
            return $this -> db -> get();           
        } else if($bd == "pts"){
            $this -> dbPTS = $this->load->database( $bd , TRUE);
            $this -> dbPTS -> select('floor_activity_id,description,status');
            $this -> dbPTS -> from('floor_activities');
            $this -> dbPTS -> where('folio_id', $folio);
            $this -> dbPTS -> where('employee_id', $this->id_employee);
            $this -> dbPTS -> where('status <>', '0');
            $this -> dbPTS -> limit(100);
            return $this -> dbPTS -> get();  
        }

      
    }

    function findDataFolio($folio,$bd){
       if ($bd == "default"){
            $this->load->database( $bd , TRUE);
            /*$this -> db -> select('dependency_id,received_by,entry_date,tower,parking_space,type_service');
            $this -> db -> from('folios');
            $this -> db -> where('folio_id', $folio);
            $this -> db -> limit(100);*/
            $this -> db-> select('f.dependency_id,f.received_by,f.entry_date,f.tower,f.parking_space,f.type_service,e.name,e.last_name,sa.name as service_description');
            $this -> db -> from('folios as f');
            $this -> db -> join('employees as e','e.employee_id = f.received_by','INNER');
            $this -> db -> join('support_type_activities as sa','sa.support_type_activities_id = f.type_service','INNER');
            $this -> db -> where('folio_id', $folio);
            $this -> db -> limit(100);
            return $this -> db-> get();
       } else if($bd == "pts"){
            $this -> dbPTS = $this->load->database( $bd , TRUE);
            $this -> dbPTS -> select('f.dependency_id,f.received_by,f.entry_date,f.tower,f.parking_space,f.type_service,e.name,e.last_name,sa.name as service_description');
            $this -> dbPTS -> from('folios as f');
            $this -> dbPTS -> join('employees as e','e.employee_id = f.received_by','INNER');
            $this -> dbPTS -> join('support_type_activities as sa','sa.support_type_activities_id = f.type_service','INNER');
            $this -> dbPTS -> where('folio_id', $folio);
            $this -> dbPTS -> limit(100);
            return $this -> dbPTS -> get();
       }

        
        return $this -> db-> get();
      
    }

    function findLeaderEmployee($folio,$bd){
         if ($bd == "default"){
            $this->load->database( $bd , TRUE);
            $this -> db -> distinct();
            $this -> db -> select('leader_employee_id,priority');
            $this -> db -> from('floor_activities_folio');
            $this -> db -> where('folio_id', $folio);
            $this -> db -> limit(1);
            return $this -> db -> get();
         } else if ($bd == "pts"){
            $this -> dbPTS = $this->load->database( $bd , TRUE);
            $this -> dbPTS -> distinct();
            $this -> dbPTS -> select('leader_employee_id,priority');
            $this -> dbPTS -> from('floor_activities_folio');
            $this -> dbPTS -> where('folio_id', $folio);
            $this -> dbPTS -> limit(1);
            return $this -> dbPTS -> get();
         }
  
    }

    function findNameEmployee($id,$bd){
        $name = "";
        if ($bd == "default"){
            $this->load->database( $bd , TRUE);
            $this -> db -> select('name,last_name');
            $this -> db -> from('employees');
            $this -> db -> where('employee_id', $id);
            $this -> db -> limit(1);
            $query = $this -> db-> get();
        } else if ($bd == "pts"){
            $this -> dbPTS = $this->load->database( $bd , TRUE);
            $this -> dbPTS -> select('name,last_name');
            $this -> dbPTS -> from('employees');
            $this -> dbPTS -> where('employee_id', $id);
            $this -> dbPTS -> limit(1);
            $query = $this -> dbPTS -> get();           
        }
        

        foreach ($query->result() as $row)
        {
            $name = $row->name.' '.$row->last_name;
        }

        return $name;      
      
    }

    function findCommentsFolio($folio,$bd){
        if ($bd == "default"){
            $this->load->database( $bd , TRUE);
            /*$this -> db -> select('date,employee_id,comments');
            $this -> db -> from('floor_activities_comments');
            $this -> db -> where('folio_id', $folio);
            $this -> db -> limit(100);*/
            $this -> db -> select('fa.date,fa.employee_id,fa.comments,e.name,e.last_name');
            $this -> db -> from('floor_activities_comments as fa');
            $this -> db -> join('employees as e','e.employee_id = fa.employee_id','INNER');
            $this -> db -> where('folio_id', $folio);
            $this -> db -> limit(100);
            return $this -> db -> get();
        } else if($bd == "pts"){
            $this -> dbPTS = $this->load->database( $bd , TRUE);
            $this -> dbPTS -> select('fa.date,fa.employee_id,fa.comments,e.name,e.last_name');
            $this -> dbPTS -> from('floor_activities_comments as fa');
            $this -> dbPTS -> join('employees as e','e.employee_id = fa.employee_id','INNER');
            $this -> dbPTS -> where('folio_id', $folio);
            $this -> dbPTS -> limit(100);
            return $this -> dbPTS -> get();
        }
  
    }

    /*function get_departments(){
        $sql = $this->db->query('SELECT departmentName FROM department ORDER BY departmentName ASC');
        return $sql->result();
        /* you simply return the results as an object
         * also note you can use the ActiveRecord class for this...might make it easier
         free_result();
    }*/

  }
?>