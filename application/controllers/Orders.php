<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Orders extends CI_Controller {
	
	public function __construct(){
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->model('orders_model');
        $this->load->model('products_model');
        $this->load->model('logs_model');
        $this->load->model('customers_model');
       
    }

	public function index(){
		$user_id = isset($_SESSION['logged_in']['id'])? $_SESSION['logged_in']['id'] : 0;
		$data['user'] = $this->customers_model->get_profile($user_id);
		$data['orders'] = $this->orders_model->get_orders_by_user($user_id);
		$this->load->view('view_all_orders',$data);
	}	

	public function cart(){

		$user_id = isset($_SESSION['logged_in']['id'])? $_SESSION['logged_in']['id'] : 0;
		$data['products'] = $this->orders_model->get_ongoing_order($user_id);
		$data['user'] = $this->customers_model->get_profile($user_id);
		$this->load->view('view_cart',$data);

	}

	public function create(){

		$data['action'] = 'create';
		
		$this->load->view('view_add_order',$data);
		// var_dump($data);
	}

	public function store(){
		$order_id = $this->orders_model->get_last_id();
		$order_id = $order_id + 1;

		$userdata = $this->session->userdata('logged_in');
		$user_id =  $userdata['id'];
		$datetime  = date("Y-m-d H:i:s");

		$code = substr(md5(rand()),0,10); // hash code
		// order data to add
		$data = array(
			'order_id' => $order_id,
			'code' => $code,
			'user_id' => $user_id,
			'date_ordered' => $datetime,
			'status' => 'ongoing'
			);

		if($this->orders_model->insert_order($data)){

			$this->session->set_userdata('order',array('order_id'=>$order_id)) ;
			$order = $this->session->userdata('order');
			$this->logs_model->log($user_id,'Ordered ','Ordered with code '.$code);
			return $order_id;
		}else{
			return false;
			
		}

	}

	public function edit(){

	}

	public function update(){


	}

	public function destroy(){

	}

	public function update_quantity(){
		if(isset($_REQUEST['quantity_change'])){
			$cmd = $_REQUEST['quantity_change'];
			$item_id = $_REQUEST['item_id'];
			if (isset($_REQUEST['realquantity'])) {

				$realquantity = $_REQUEST['realquantity'];
				if($realquantity==true){
					if($this->orders_model->change_item_quantity($item_id,$_REQUEST['quantity_change'])){

						echo $quantity = $this->orders_model->get_item_quantity($item_id);
					
					}else{
						echo 0;
					}
				}
			}

			if($cmd=="add"){
				if($this->orders_model->add_item_quantity($item_id)){
					echo $quantity = $this->orders_model->get_item_quantity($item_id);
				}else{
					echo 0;
				}
			}
			
			if($cmd=="sub"){
				if($this->orders_model->sub_item_quantity($item_id)){

					$quantity = $this->orders_model->get_item_quantity($item_id);
					if($quantity==0){
						// Delete the item if quantity is zero
						if($this->orders_model->destroy_item($item_id)){
							echo 'destroyed';
						}

					}else{
						echo $quantity;
					}
				}else{
					echo 0;
				}
			}

			if($cmd=="del"){
				
				// Delete the item 
				if($this->orders_model->destroy_item($item_id)){
					echo 'destroyed';
				}
			}
			
			
		}

		exit;
	}

	public function add_product(){

		$user_id = $_SESSION['logged_in']['id'];
		$order_id = 0;
		// if already have order
		if(!$order_id = $this->orders_model->get_ongoing_order_id($user_id)){
			// get order id
			$order_id = $this->store();
		}

		// if product id is in the request
		if(isset($_REQUEST['product_id'])){
			$product_id = $_REQUEST['product_id'];
			$data = array(
				'product_id' 	=> $product_id,
				'order_id' 		=> $order_id,
				'ordered_quantity' 		=> 1,
				'price'			=> 0,
				 );


			if(!$this->orders_model->item_exists($order_id,$product_id)){
				$this->orders_model->insert_product_to_order($data);

				
				//$this->logs_model->log($_SESSION['logged_in']['id'],'Add Order Item',$data);
				echo 1;
			}
		// 	var_dump($data);
		}	
	}

	public function ajax_orderdata(){

		if(isset($_REQUEST['order_id'])){
			$order_id = $_REQUEST['order_id'];
			//$order_id =18;

		 	$order_info = $this->orders_model->get_order($order_id);
			$orderered_items = $this->orders_model->get_ordered_products($order_id);


			$meta = json_decode($order_info->meta_data);
            $order_html ="";
            if(isset($meta->firstname)&isset($meta->lastname)){
            	$order_html = "<h3>".$meta->firstname." ".$meta->lastname."</h3>";
            }else{
            	$order_html = "<h3>".$order_info->username."</h3>";
            }


			$ordered_html = "";
			$totalprice = 0;
			foreach ($orderered_items as $item) {
				$totalprice += $item->price;
				$ordered_html .= "<tr>";
				$ordered_html .= '<td>'.$item->sku.'</td><td>'.$item->product_name.'</td><td>'.$item->ordered_quantity.'</td><td>'.sprintf("%0.2f",$item->price).'</td>';
				$ordered_html .= "</tr>";
			}
			$ordered_html .= "<tr><td></td><td></td><td><strong>Total Price</strong> </td><td>".sprintf("%0.2f",$totalprice)."</td></tr>";

			$ordered_html .= "<tr><td>";
			$ordered_html .='<a target="_blank" href="'.base_url('orders/print_delivery/'.$order_id).'" class="btn btn-success"><i class="fa fa-print m-right-xs"></i> Print Form</a>';

            $ordered_html .="</td></tr>";

			$data["order_html"] = $order_html;
			
			$data["ordered_html"] = $ordered_html;
			echo $jsondata = json_encode($data);

		}

		exit;
	}

	public function to_pending(){
		if(isset($_POST['checkout'])){
			$order_id = $_POST['order_id'];

			if ($this->orders_model->set_to_pending($order_id)) {
				
				$this->session->set_flashdata('order_chechedout', true);
				redirect(base_url('orders'));
			}else{
				redirect(base_url('orders'));
			}
		}
	}

	public function quantity_availability($id, $quantity){

	}

	public function print_delivery($order_id=null){

		if($order_id!=null){
			$data['order'] = $this->orders_model->get_order($order_id);
			$data['products'] = $this->orders_model->get_ordered_products($order_id);
			

	        //load the view and saved it into $html variable
	        $this->load->view('view_delivery_form',$data);

    	}else{

    		redirect(base_url());

    	}
	}
	
}
