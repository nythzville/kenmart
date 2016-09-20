<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Locations extends CI_Controller {

	public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('orders_model');
        $this->load->model('products_model');
        $this->load->model('logs_model');

        $this->load->model('reports_model');
       
    }

    public function index(){
    	$data["locations"] = $this->orders_model->get_all_orders();
    	$this->load->view('admin/view_map',$data);
    }

    public function order($order_id=null){

    	$data["location"] = $this->orders_model->get_order($order_id);
    	//echo $data["order"]->full_address;
    	//var_dump($data);
    	$this->load->view('admin/view_map',$data);

    }

}