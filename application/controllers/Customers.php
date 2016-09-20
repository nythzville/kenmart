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
                $this->load->model('orders_model');
                $this->load->model('logs_model');
                $this->load->library('form_validation');
                $this->load->helper(array('form', 'url'));
                $this->load->helper('path');
        }

	public function index(){
		
		// Getting data of all customers
		$data['customers'] = $this->customers_model->get_All();
		$this->load->view('view_all_customers',$data); //pass the data into view
	}

 	function profile(){
		// Get the session data of Logged in user
		$userdata = $this->session->userdata();
		$user_id = $userdata['logged_in']['id'];

		// Get the profile data on the database
		$data['user'] = $this->customers_model->get_profile($user_id);
		$data['location'] = $this->customers_model->get_location($user_id);
		$data['product_categories'] = $this->products_model->get_all_category();
		$data['activity_logs'] = $this->customers_model->get_logs($user_id);
		$data['orders'] = $this->orders_model->get_orders_by_user($user_id);
		
		$this->load->view('view_customer_profile',$data);
	}
	public function save_profile(){
		if(isset($_POST['save-profile'])){
			$userdata = $this->session->userdata();
			$user_id = $userdata['logged_in']['id'];

			$metadata = $this->customers_model->get_meta($user_id);
	       	$data = json_decode($metadata->meta_data);
					$data->firstname		= $_POST['firstname'];
					$data->middlename		= $_POST['middlename'];
					$data->lastname			= $_POST['lastname'];
					$data->contact			= $_POST['contact'];
					
			$json_data = json_encode($data);

			if($this->customers_model->update_meta($user_id,$json_data)){

				$this->logs_model->log($user_id,'Update Profile','Updated own profile');

				redirect(base_url('customers/profile'));
			}
		}
	}

	public function create(){
		// Load the New Customer View
		$data['action'] = 'create';
		$this->load->view('view_add_customer',$data);

	}

	public function store(){
		

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required',
                array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');

        if ($this->form_validation->run() == FALSE){
                
            $this->load->view('view_new_customer');
        
        }else{
            
            $this->customers_model->save($data);
        
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

	public function destroy(){
		//  Deleting the user
		$this->customers_model->destroy($_POST['ID']);
	}

	public function do_upload(){

		if(isset($_REQUEST)){
			$date = date('YmdHis');
			$file = 'C:\xampp\htdocs\online-selling\uploads';//.$date.'.jpg';
			$newfile = set_realpath($file);

			$config['upload_path']          = $newfile;
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 5000;
	        $config['max_width']            = 1024;
	        $config['max_height']           = 768;
	        $config['file_name']			= $date;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('avatar_file'))
	        {
	          	
	          	$error = array('error' => $this->upload->display_errors());

	          	$this->session->set_flashdata('uploaded', false);
	          	$this->session->set_flashdata('err_mgs', $this->upload->display_errors());
				redirect(base_url('customers/profile'));

	        }else{

	            $data = array('upload_data' => $this->upload->data());

	            // Get user ID
	            $userdata = $this->session->userdata();
				$user_id = $userdata['logged_in']['id'];


				// Get the current meta data in database

	            $metadata = $this->customers_model->get_meta($user_id);
	            $meta_data = json_decode($metadata->meta_data);
	            $meta_data->avatar = $data["upload_data"]["file_name"];
	            
	            $newmeta = json_encode($meta_data);
	            $this->customers_model->update_meta($user_id,$newmeta);

	            $this->session->set_flashdata('uploaded', true);
				redirect(base_url('customers/profile'));
	     

	        }
		}
        
    }

}