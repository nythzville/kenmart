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

        $this->load->model('reports_model');
       
    }

	public function index(){
		$orders = $this->orders_model->get_all_orders();
		$count = 0;
		foreach ($orders as $order) {
			$orders[$count]->total_ordered_quantity = $this->orders_model->get_total_items_ordered($order->order_id);
			$count++;
		}

		//var_dump($orders);

		$data['orders'] = $orders; 

		//var_dump($data);
		$this->load->view('admin/view_all_orders',$data);
	}

	public function pending(){
		$data['total_customers'] = $this->reports_model->get_num_customers();
		$data['total_products'] = $this->reports_model->get_num_products();
		$data['total_pending_orders'] = $this->reports_model->get_num_pending_orders();
		$data['pending_orders'] = $this->orders_model->get_all_pending(null);

		$this->load->view('admin/view_all_pending_orders',$data);
	}

	public function ondelivery(){
		$orders = $this->orders_model->get_all_ondelivery();
		$count = 0;
		foreach ($orders as $order) {
			$orders[$count]->total_ordered_quantity = $this->orders_model->get_total_items_ordered($order->order_id);
			$count++;
		}

		//var_dump($orders);

		$data['orders'] = $orders; 

		//$data['orders'] = $this->orders_model->get_all_ondelivery();
		//var_dump($data);
		$this->load->view('admin/view_all_orders',$data);
		//var_dump($data);
	}

	public function delivered(){
		$data['orders'] = $this->orders_model->get_all_delivered();
		//var_dump($data);
		$this->load->view('admin/view_all_orders',$data);
	}

	public function ordered(){
		if(isset($_REQUEST['order_id'])){
			$order_id = $_REQUEST['order_id'];
			$orders = $this->orders_model->get_ordered_products($order_id);
			var_dump($orders);
			// foreach ($orders as $order) {
			// 	echo '<tr>';
			// 	echo '<td>'.$order->sku.'</td>';
			// 	echo '<td>'.$order->product_name.'</td>';
			// 	echo '<td>'.$order->ordered_quantity.'</td>';
			// 	echo '</tr>';
			// }
		
		}
		exit;

	}

	public function cart(){
		$order_id = $_SESSION['order']['order_id'];
		$data['products'] = $this->orders_model->get_ordered_products($order_id);
		$this->load->view('view_cart',$data);
	}
	public function create(){

		$data['action'] = 'create';
		
		$this->load->view('admin/view_add_order',$data);
		// var_dump($data);
	}

	public function store(){
		$order_id = $this->orders_model->get_last_id();
		$order_id = $order_id + 1;

		$userdata = $this->session->userdata('logged_in');
		$user_id =  $userdata['id'];
		$datetime  = date("Y-m-d H:i:s");

		$code = 'xyz'; // hash code
		// order data to add
		$data = array(
			'order_id' => $order_id,
			'code' => $code,
			'user_id' => $user_id,
			'date_ordered' => $datetime,
			'status' => 'pending'
			);

		if($this->orders_model->insert_order($data)){

			$this->session->set_userdata('order',array('order_id'=>$order_id)) ;
			$order = $this->session->userdata('order');
		
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


	public function add_product(){

		$order_id = 0;
		// if already have order
		if(isset($_SESSION['order'])){
			// get order id
			$order_id = $_SESSION['order']['order_id'];
			//var_dump($order_id);
		}
		else{

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

			$total_orders = 0;
			foreach ($orderered_items as $item){
				$total_orders +=intval($item->ordered_quantity);
			}


			$meta = json_decode($order_info->meta_data);
            $order_html ="";
            if(isset($meta->firstname)&isset($meta->lastname)){
            	$order_html = "<h3>".$meta->firstname." ".$meta->lastname."</h3>";
            }else{
            	$order_html = "<h3>".$order_info->username."</h3>";
            }

            $order_html .='<ul class="list-unstyled user_data">
                <li>
                    <i class="fa fa-qrcode user-profile-icon"></i> '.$order_info->code.'
                </li>
                <li>
                    <i class="fa fa-calendar user-profile-icon"></i> '.date("F j, Y",strtotime($order_info->date_ordered)).'
                </li>

                <li><i class="fa fa-map-marker user-profile-icon"></i> '.$order_info->full_address.'<br/>'.$order_info->distance.'
                </li>
                <li>
                Total Items: '.$total_orders.'
                </li>
               

                <li class="m-top-xs">
                    <i class="fa fa-envelope user-profile-icon"></i> '.$order_info->email.'
                </li>
            </ul>';
            if($order_info->status=='pending'){
            $order_html .='<a href="'.base_url('admin/orders/todelivery/'.$order_id).'" class="btn btn-success"><i class="fa fa-truck m-right-xs"></i> Approved</a>';
        	}

        	if($order_info->status=='ondelivery'){
            $order_html .='<a href="'.base_url('admin/orders/todelivered/'.$order_id).'" class="btn btn-success"><i class="fa fa-truck m-right-xs"></i> Delivered</a>';
        	}

            $order_html .='<a href="'.base_url('admin/locations/order/'.$order_id).'" class="btn btn-success"><i class="fa fa-search m-right-xs"></i> View Location</a>
            ';
            $order_html .='<a target="_blank" href="'.base_url('orders/print_delivery/'.$order_id).'" class="btn btn-success"><i class="fa fa-print m-right-xs"></i> Print Form</a>';




			$ordered_html = "";
			foreach ($orderered_items as $item) {
				if($item->ordered_quantity>$item->quantity){
					$ordered_html .= '<tr style="background:rgba(255,0,0,0.3);">';
				}else{
					$ordered_html .= "<tr>";
				}

				$ordered_html .= '<td>'.$item->sku.'</td><td>'.$item->product_name.'</td>';
				if($item->ordered_quantity>$item->quantity){
					$ordered_html .= '<td style="color:red;">'.$item->ordered_quantity.'</td>';
				}else{
					$ordered_html .= '<td>'.$item->ordered_quantity.'</td>';
				}
				
				$ordered_html .= "</tr>";
			}

			$ordered_html .="<tr><td colspan='2'><strong>Total Quantity</strong></td><td>".$total_orders."</td></tr>";
			
			$data["order_html"] = $order_html;
			
			$data["ordered_html"] = $ordered_html;
			echo $jsondata = json_encode($data);

		}
		
		

		
		exit;
	}


	// to delivery


	public function todelivery($order_id=null){

		if($order_id!=null){
			$all_available = true;
			$products = $this->orders_model->get_ordered_products($order_id);
				
			foreach ($products as $product) {
				$product_id = $product->product_id;
				if($this->products_model->quantity_availability($product_id,$product->ordered_quantity)){

				}else{
					$all_available = false;
					break;
				}
			}

			if($all_available==true){
				if($this->orders_model->set_to_delivery($order_id)){
					
					foreach ($products as $product) {
						$new_q = (($product->quantity)-($product->ordered_quantity));
						$product_id = $product->product_id;

						if($this->products_model->update_quantity($product_id,$new_q)){

						}
							
					}

				}else{

				}
				$this->session->set_flashdata('set_to_delivery', true);
				redirect(base_url('admin/orders/ondelivery'));
			}else{
				$this->session->set_flashdata('not_enough_stock', true);
				redirect(base_url('admin/orders/pending'));

			}
		
		}

	}
	public function todelivered($order_id=null){
		
		if($order_id!=null){
			
			if($this->orders_model->set_to_delivered($order_id)){
				$this->session->set_flashdata('set_to_delivered', true);
				redirect(base_url('admin/orders/'));

			}else{
				$this->session->set_flashdata('failed_to_deliver', true);
				redirect(base_url('admin/orders'));
			}
		}

	}
}
