<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {


	public function __construct()
        {
                // constructor
                parent::__construct();
                // Load the customer_model
                $this->load->model('customers_model');
                $this->load->model('products_model');
                $this->load->library('form_validation');
                $this->load->model('orders_model');
                $this->load->model('reports_model');
        }

	public function index(){
		
		// Getting data of all customers
		$data['customers'] = $this->customers_model->get_All();
		$this->load->view('admin/view_all_customers',$data); //pass the data into view
	}

	public function profile(){
		// Get the session data of Logged in user
		$userdata = $this->session->userdata();
		$user_id = $userdata['logged_in']['id'];

		// Get the profile data on the database
		$data['user'] = $this->customers_model->get_profile($user_id);
		$data['product_categories'] = $this->products_model->get_all_category();
		$this->load->view('admin/view_customer_profile',$data);
	}
	
	public function create(){
		// Load the New Customer View
		$data['action'] = 'create';
		$this->load->view('admin/view_add_customer',$data);

	}

	public function store(){
		

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required',
                array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|is_unique[users.email]');

        if ($this->form_validation->run() == FALSE){
                
            $this->load->view('admin/view_add_customer');
        
        }else{
            $meta = array(
            	'lastname'	=> $_POST['lastname'],
            	'firstname'	=> $_POST['firstname'],
            	'middlename'=> $_POST['middlename'],
            	'address'	=> $_POST['address']

            	);

            $meta_json = json_encode($meta);
            $data = array(
            	'email'		=>	$_POST['email'],
            	'username'	=>	$_POST['username'],
            	'password'	=>	$_POST['password'],
            	'role'		=>	'Customer',
            	'meta_data'	=>	$meta_json,
            	);

            if($this->customers_model->store($data)){
            	$this->session->set_flashdata('customer_added', true);
				redirect(base_url('admin/customers'));
            }else{
            	$this->session->set_flashdata('customer_added', false);
				redirect(base_url('admin/customers'));
            }
        
        }
	}

	public function edit($id){
		// Get the profile data on the database
		$data['user'] = $this->customers_model->get_profile($user_id);
		$data['action'] = 'edit';
		$this->load->view('view_new_customer',$data);
	}
	public function update(){
		//
	}

	public function delete(){
		//  Deleting the user
		if(isset($_POST['user_id'])){
			$this->customers_model->destroy($_POST['user_id']);
			
			$this->session->set_flashdata('customer_deleted', true);
			redirect(base_url('admin/customers'));
		}
	}

}