<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Product Controller for Customer

class Products extends CI_Controller {

	public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('orders_model');
        $this->load->model('products_model');
        $this->load->model('logs_model');
        $this->load->model('customers_model');
       
    }
    
	public function index(){

		//
		$user_id = $_SESSION['logged_in']['id'] ;

		$this->load->model('products_model');
		$data['products'] = $this->products_model->get_all_products();
		$data['user'] = $this->customers_model->get_profile($user_id);
		$this->load->view('view_all_products',$data);
	}

	public function category()
	{

		$this->load->model('products_model');
		$data['products'] = $this->products_model->get_all_category();
		$data['user'] = $this->customers_model->get_profile($user_id);

		$this->load->view('view_all_product_category',$data);

	}
	
	public function products_by_category($cat_id=null){
		
		$this->load->model('products_model');
		$data['products'] = $this->products_model->get_products_by_category($cat_id);
		$data['product_categories'] = $this->products_model->get_all_category();
		$data['user'] = $this->customers_model->get_profile($user_id);

		$this->load->view('view_all_products',$data);

	}

	
}
