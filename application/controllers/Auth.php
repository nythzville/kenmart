<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


	public function __construct(){
		 // constructor
         parent::__construct();
         //$this->load->libray('session');
         $this->load->library('form_validation');
         $this->load->model('customers_model');

    }

	public function index(){
		
		// If post to login 
		if(isset($_POST)){
			// load the library for validation
			$this->load->library('form_validation');
			 
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database');

			if($this->form_validation->run() == FALSE){
			    //Field validation failed.  User redirected to login page
			    $this->load->view('view_login');
			}else{
			    //Go to private area
			    $role = $this->session->userdata['logged_in']['role'];
			    //var_dump($this->session->userdata());
			    if($role=='Admin'){

			    	redirect('admin/dashboard', 'refresh');
			    }elseif($role=='Customer'){

			    	redirect('customers/profile/', 'refresh');
			    }else{
			    	
			    	redirect('home', 'refresh');
			    }

			}
			 
		}

	}
	
	function check_database($password){
	   	//Field validation succeeded.  Validate against database
	   	$username = $this->input->post('username');
	 
	   	//query the database
	   	$this->load->model('customers_model');
	   	$result = $this->customers_model->login($username, $password);
	 
	   	if($result){
	     	$sess_array = array();
	     	foreach($result as $row){
	       		$sess_array = array(
	         		'id' 		=> $row->user_id,
	         		'username' 	=> $row->username,
	         		'role' 		=> $row->role
	       			);
	       		$this->session->set_userdata('logged_in', $sess_array);
	     	}
	    	return TRUE;
	   	}else{
	     	
	     	$this->form_validation->set_message('check_database', 'Invalid username or password');
	     	return false;
	   	}
 	}


	function login(){
		// Load the view for login display
		$this->load->view('view_login');
	}

	function logout(){
		// function for logging out
		// Destroy data on session
	   	$this->session->unset_userdata('logged_in');
	   	session_destroy();

	   	// redirect to login form
	   	redirect('auth/login', 'refresh');
 	}

 	public function register(){
		//if pos data has submitted
		if(isset($_POST)){

			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]'); // checks the email if unique to the users table

			// if validation is passed
			if ($this->form_validation->run() == FALSE){
                
                //$this->load->view('myform');
            
            }else{
               	$last_id = $this->customers_model->get_last_id();

				$customer_data = array(
					'user_id'		=> $last_id + 1,
					'email' 		=> $_POST['email'],
					'username' 		=> $_POST['username'],
					'password'		=> $_POST['password'],
					'role'			=> 'Customer',
					);
	            // add customer
	            $this->customers_model->store($customer_data);

	       		$sess_array = array(
	         		'id' 			=> $last_id + 1,
	         		'email' 		=> $_POST['email'],
					'username' 		=> $_POST['username'],
					'role'			=> 'Customer'
	       			);

	       		$this->session->set_userdata('logged_in', $sess_array);

	       		redirect('customers/profile/', 'refresh');

            }

		}	
	}
 
}