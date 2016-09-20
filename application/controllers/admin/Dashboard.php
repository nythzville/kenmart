<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Dashboard extends CI_Controller {

	public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('reports_model');
        $this->load->model('orders_model');
        $this->load->model('products_model');
       
    }

	public function index(){
		$data['total_customers'] = $this->reports_model->get_num_customers();
		$data['total_products'] = $this->reports_model->get_num_products();
		$data['total_pending_orders'] = $this->reports_model->get_num_pending_orders();
		$data['total_delivered_orders'] = $this->reports_model->get_num_delivered_orders();
		$data['total_ondelivery_orders'] = $this->reports_model->get_num_ondelivery_orders();
		$data['total_ordered_items'] = $this->reports_model->get_num_ordered_items();
		$data['product_quantities'] = $this->reports_model->sort_percentage($this->reports_model->get_product_quantities());


		$this->load->view('admin/view_home',$data);
	}


	public function get_product_stocks($product_id){

	}
	public function get_top_products(){

	}
	

}
