<?php
Class Users extends CI_Model{

  function __contruct(){
    parent::__contruct();
  }
 
  function login($username, $password , $bd){
    
    $this->load->database( $bd , TRUE);
    $this -> db -> select('*');
    $this -> db -> from('users');
    $this -> db -> where('email', $username);
    $this -> db -> where('password', MD5($password));
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