<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Location extends CI_Controller {

	public function __construct(){
        // Call the constructor
        parent::__construct();
        $this->load->model('customers_model');
        $this->load->model('orders_model');
        $this->load->model('logs_model');
       
    }

	public function index(){
		$userdata = $this->session->userdata();
		$user_id = $userdata['logged_in']['id'];
		$data['user_info'] = $this->customers_model->get_profile($user_id);
		$data['location'] = $this->customers_model->get_location($user_id);
		$data['user'] = $this->customers_model->get_profile($user_id);
		
		//var_dump($data);
		$this->load->view('view_map',$data);
	}

	public function store(){
		if(isset($_POST['save_location'])){
			$userdata = $this->session->userdata();
			$user_id = $userdata['logged_in']['id'];

			$data = array(
					'full_address' 	=> $_POST['full_address'],
					'lat'			=> $_POST['lat'],
					'lng'			=> $_POST['lng'],
					'distance'		=> $_POST['distance'],
					'user_id'		=> $user_id,
					);

			if($this->customers_model->save_location($data)){
				
				$this->logs_model->log($user_id,'Updated Location','Updated own Address to '.$_POST['full_address'].'.');

				$this->session->set_flashdata('location_saved', true);
				redirect(base_url('location'));
			}else{
				$this->session->set_flashdata('location_saved', false);
				redirect(base_url('location'));
			}
			//var_dump($data);

		}
	}
}