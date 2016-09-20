<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Reports extends CI_Controller {

	public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();

       $this->load->model('products_model');
       $this->load->model('orders_model');
       $this->load->model('reports_model');
    }

	public function index(){
		//var_dump($this->session->userdata());
		$this->load->view('view_reports');
	}
	public function products(){
		$thedata = $this->products_model->get_all_products();
		//var_dump($data);

		$data['products'] = $this->reports_model->sort_percentage($thedata);
		$this->load->view('admin/view_product_report',$data);
	}

	
}
