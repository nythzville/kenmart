<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_model extends CI_Model {

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    public function get_num_customers(){
    	$this->db->where('role','Customer');
    	$query = $this->db->get('users');
    	return $query->num_rows();
    }

    public function get_num_products(){

    	$query = $this->db->get('products');
    	return $query->num_rows();
    }
    public function get_num_orders(){
    	$query = $this->db->get('orders');
    	return $query->num_rows();
    }
    public function get_num_pending_orders(){
    	$this->db->where('status','pending');
    	$query = $this->db->get('orders');
    	return $query->num_rows();
    }
    public function get_num_ondelivery_orders(){
        $this->db->where('status','ondelivery');
        $query = $this->db->get('orders');
        return $query->num_rows();
    }

    public function count_categories(){
        $sql = "SELECT cat_id FROM products" ;
        $query = $this->db->query($sql);

        return $query->result();
    }
    public function get_num_delivered_orders(){
    	$this->db->where('status','delivered');
    	$query = $this->db->get('orders');
    	return $query->num_rows();
    }

    public function get_product_quantity($product_id){
    	$this->db->select('product_name,quantity,min_quantity,max_quantity');
    	$query = $this->db->get('products');
    	return $query->result();
    }
    public function get_product_quantities(){
        $this->db->select('product_name,quantity,min_quantity,max_quantity');
        $query = $this->db->get('products');
        return $query->result();
    }

    public function get_num_ordered_items(){
    	$this->db->select('ordered_quantity');
    	$query = $this->db->get('ordered_items');

    	$count = 0;
    	$items = $query->result();

    	foreach ($items as $item) {
    		$count = $count + $item->ordered_quantity;
    	}
    	return $count;

    }
    public function sort_percentage($data){

        $count = count($data);
        for($x=0;$x<$count;$x++){

            $pct1 = sprintf('%0.2f',($data[$x]->quantity/$data[$x]->max_quantity));
            $q1 = $data[$x]->quantity;
            

            for($y=$x; $y<$count;$y++){

                
                if(floatval(sprintf('%0.2f',(($data[$y]->quantity)/($data[$y]->max_quantity)))) < floatval(sprintf('%0.2f',(($data[$x]->quantity)/($data[$x]->max_quantity))))){

                     $cont = $data[$x];
                     $data[$x] = $data[$y];
                     $data[$y] = $cont;

                }
            }

        }
        return $data;
        
    }

}