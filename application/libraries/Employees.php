<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Employees {

    
    public function getname()
    {

    	 	$username 	= "strike.00mx@hotmail.com";
    	 	$password	= "P4dr1n0s";
    	 	$ci =& get_instance();
    	 	$ci -> db -> select('*');
		    $ci -> db -> from('users');
		    $ci -> db -> where('email', $username);
		    $ci -> db -> where('password', MD5($password));
		    $ci -> db -> limit(1);
		 
		    $query = $ci -> db -> get();
		 
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