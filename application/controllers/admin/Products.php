<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Product controller for Admin

class Products extends CI_Controller {

	public function __construct(){
        // Call the constructor
        parent::__construct();
        $this->load->model('reports_model');
       	$this->load->model('orders_model');
       	$this->load->model('products_model');
    }

	public function index()
	{
		
		$data['products'] = $this->products_model->get_all_products();
		$this->load->view('admin/view_all_products',$data);
	}


	public function add(){
		$data['action'] = 'add';
		$data['categories'] = $this->products_model->get_all_category();

		$this->load->view('admin/view_add_product',$data);
	}
	
	public function edit($product_id){

		$data['product'] = $this->products_model->find($product_id);
		$data['categories'] = $this->products_model->get_all_category();
		$data['action'] = 'edit';
		$this->load->view('admin/view_add_product',$data);
	}

	public function update(){
		if(isset($_POST['product_id'])){
			$data = array(
				'sku'			=>	$_POST['product_sku'],
				'product_name'	=>	$_POST['product_name'],
				'cat_id'		=>	$_POST['product_category'],
				'price'			=>	$_POST['product_price'],
				'quantity'		=>	$_POST['product_quantity'],
				'min_quantity'	=>	$_POST['min_quantity'],
				'max_quantity'	=>	$_POST['max_quantity'],
				'updated_on'	=>	date("Y-m-d H:i:s"),
				'description'	=>	$_POST['product_description'],
				);

			//var_dump($data);
			
			if($this->products_model->udpate_product($data,$_POST['product_id'])){
				$this->session->set_flashdata('item_updated', true);
				redirect(base_url('admin/products'));
			}else{
				$this->session->set_flashdata('item_updated', false);
				redirect(base_url('admin/products'));
			}

		}
	}

	public function delete(){
		if(isset($_POST['product_id'])){
			$product_id = $_POST['product_id'];
			if($this->products_model->destroy($product_id)){
				$this->session->set_flashdata('item_deleted', true);
				redirect(base_url('admin/products'));
			}else{
				$this->session->set_flashdata('item_deleted', false);
				redirect(base_url('admin/products'));
			}
		}

	}

	public function category(){

		$data['categories'] = $this->products_model->get_all_category();

		$this->load->view('admin/view_all_product_category',$data);

	}
	
	
	public function create_category(){
		if(isset($_POST['add_category'])){
			$cat_name = $_POST['cat_name'];
			$data = array('cat_name' => $cat_name);
			
			if($this->products_model->create_category($data)){
				$this->session->set_flashdata('category_added', true);
				redirect(base_url('admin/products/category'));
			}else{
				$this->session->set_flashdata('category_added', false);
				redirect(base_url('admin/products/category'));
			}
		}
	}	

	public function delete_category($cat_id=null){
		if($cat_id!=null){
			if($this->products_model->destroy_category($cat_id)){
				$this->session->set_flashdata('category_deleted', true);
				redirect(base_url('admin/products/category'));
			}else{
				$this->session->set_flashdata('category_deleted', false);
				redirect(base_url('admin/products/category'));
			}

		}else{
			$this->session->set_flashdata('category_deleted', false);
			redirect(base_url('admin/products/category'));
		}
	}

	public function products_by_category($cat_id=null){

		$data['products'] = $this->products_model->get_products_by_category($cat_id);
		$data['product_categories'] = $this->products_model->get_all_category();

		$this->load->view('admin/view_all_products',$data);
	}

	public function create(){

		if(isset($_POST['product_sku'])){
			$data = array(
				'sku'			=>	$_POST['product_sku'],
				'product_name'	=>	$_POST['product_name'],
				'cat_id'		=>	$_POST['product_category'],
				'price'			=>	$_POST['product_price'],
				'quantity'		=>	$_POST['product_quantity'],
				'min_quantity'	=>	$_POST['min_quantity'],
				'max_quantity'	=>	$_POST['max_quantity'],
				'added_on'		=>	date("Y-m-d H:i:s"),
				'updated_on'	=>	date("Y-m-d H:i:s"),
				'due_on'		=>	date("Y-m-d H:i:s"),
				'description'	=>	$_POST['product_description'],
				);

			$this->load->model('products_model');

			if($this->products_model->create_product($data)){
				$this->session->set_flashdata('item_added', true);
				redirect(base_url('admin/products'));
			}else{
				
			}
			
		
		}else{
			$this->index();
		}
		

	}

	public function update_quantity(){

		if(isset($_REQUEST['quantity_change'])){

			$product_id = $_REQUEST['product_id'];
			$quantity = $_REQUEST['quantity_change'];

			if($this->products_model->update_quantity($product_id,$quantity)){

				echo $_REQUEST['quantity_change'];
			}else{

				echo 'failed';
			}

		}

	}

	
}
