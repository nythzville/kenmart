<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

	public function __construct(){
        // Call the constructor
        parent::__construct();

       
    }

	public function index(){
		// calls product model 
		$this->load->model('products_model');

		//
		$data['userdata'] = $this->session->userdata();

		//

		// $data[1];
		// $data[2];
		
		$data['product_categories'] = $this->products_model->get_all_category();

		

		if(isset($_SESSION['logged_in'])&&($_SESSION['logged_in']['role']=='Admin')){
			redirect('admin');
			
		}

		$this->load->view('view_home',$data);
	}
}
