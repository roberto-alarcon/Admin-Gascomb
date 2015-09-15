<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign extends CI_Controller {

	function __contruct(){
		parent::__contruct();
		
	}


	public function index(){
		
		// Helpers
		$this->load->helper('form');
		// Vista
		$array['mensaje'] = "Registro de usuario";
		$this->load->view('Sign/login' , $array);
	}

	public function login(){
		
		// Helpers
		$this->load->helper('form');
		// Vista
		$array['mensaje'] = "Registro de usuario";
		$this->load->view('Sign/login' , $array);
	}

	public function register(){

		$this->load->model('users_2');
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
		$bd 		= $this->input->post('sistema');


		$result = $this->users_2->login($username, $password , $bd );	

		if($result)
	   {
	     $sess_array = array();
	     foreach($result as $row)
	     {
	       $sess_array = array(
	         'id' => $row->user_id,
	         'username' => $row->email,
	         'employee_id' => $row->employee_id,
	         'name' => ucwords( strtolower($row->name.' '.$row->last_name) ),
	         'profile' => $row->profile,
	         'login' => true,
	         'bd'=> $this->input->post('sistema')
	       );
	       $this->session->set_userdata('logged_in', $sess_array);
	     }


	     // Usuario correcto 
	     	redirect('dashboard', 'refresh');

	   }
	   else
	   {
	     
	     redirect('sign', 'refresh');
	     
	   }

		//$this->load->view('Sign/register' , $data);
	}


	public function logout(){
		
		$this->load->view('Sign/logout');
	}



}
