<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders_model extends CI_Model {

        public $name;
        

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
           
    }

    public function insert_order($data){

        if($this->db->insert('orders', $data)){
            return true;
        }else{
            return false;
        }
    }

    public function get_order($id){
        $this->db->select('*');
        $this->db->from('orders');
       
        $this->db->join('users','users.user_id = orders.user_id');
        $this->db->join('location','users.user_id = location.user_id');
        $this->db->where('order_id',$id);
       
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            
            return $query->row();

        }else{
            return false;
        }
    }

    public function get_ongoing_order($user_id){

        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status','ongoing');
        $this->db->where('user_id',$user_id);
        $this->db->join('ordered_items','ordered_items.order_id = orders.order_id');
        $this->db->join('products','products.product_id = ordered_items.product_id');

       
        $query = $this->db->get();

        if($query->num_rows() >= 1){
            
            return $query->result();

        }else{
            return false;
        }

    }

    public function get_ongoing_order_id($user_id){

        $this->db->select('order_id');
        $this->db->from('orders');
        $this->db->where('user_id',$user_id);
        $this->db->where('status','ongoing');
        $query = $this->db->get();
        if($query->num_rows() >= 1){
            
            $order = $query->row();
            return $order->order_id;

        }else{
            return false;
        }

    }

    public function get_orders_by_user($id){
            $this->db->select('*');
            
            $this->db->from('orders');
            $this->db->where('user_id', $id);
            $this->db->order_by('date_ordered', 'DESC');

            $query = $this->db->get();
            
            if($query->num_rows() >= 1){
                return $query->result();
            }else{
                return false;
            }
    }

    public function get_all_orders(){
        
            $this->db->select('*');
            $this->db->from('orders');
            $this->db->join('users', 'users.user_id = orders.user_id');
            $this->db->join('location', 'users.user_id = location.user_id');
            $this->db->where('status !=','ongoing');
            $this->db->order_by('date_ordered', 'ASC');

            $query = $this->db->get();
            
            if($query->num_rows() >= 1){
                return $query->result();
            }else{
                return false;
            }
    }

    public function get_total_items_ordered($order_id){

            $this->db->select('ordered_quantity');
            $this->db->where('order_id',$order_id);
            $this->db->from('ordered_items');
            $this->db->join('products', 'products.product_id = ordered_items.product_id');
            $query = $this->db->get();
            
            if($query->num_rows() >= 1){
                $items = $query->result();
                $total_quantity = 0;
                foreach ($items as $item) {
                    $total_quantity += intval($item->ordered_quantity);
                }
                return $total_quantity;
            }else{
                return false;
            }
    }

    public function get_all_pending(){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status','pending');
        $this->db->join('users', 'users.user_id = orders.user_id');
        $this->db->join('location', 'users.user_id = location.user_id');

        $query = $this->db->get();
        
        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    }

    public function get_all_delivered(){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status','delivered');
        $this->db->join('users', 'users.user_id = orders.user_id');
        $this->db->join('location', 'users.user_id = location.user_id');

        $query = $this->db->get();
        
        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    }

    public function get_all_ondelivery(){
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status','ondelivery');
        $this->db->join('users', 'users.user_id = orders.user_id');
        $this->db->join('location', 'users.user_id = location.user_id');
        $this->db->join('ordered_items', 'orders.order_id = ordered_items.order_id');

        $query = $this->db->get();
        
        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    }
  
    public function set_to_pending($id){
        $this->db->set('status','pending');
        $this->db->where('order_id', $id);
        if($this->db->update('orders')){
            return true;
        }else{
            return false;
        }

    }

    public function set_to_delivery($id){
        $this->db->set('status','ondelivery');
        $this->db->where('order_id', $id);
        if($this->db->update('orders')){
            return true;
        }else{
            return false;
        }
    }
    public function set_to_delivered($id){
        $this->db->set('status','delivered');
        $this->db->where('order_id', $id);
        if($this->db->update('orders')){
            return true;
        }else{
            return false;
        }
    }

    public function insert_product_to_order($data){
        $this->db->insert('ordered_items', $data);


    }

    public function get_ordered_products($order_id){

        $this->db->select('*');
        $this->db->from('ordered_items');
        $this->db->join('products', 'products.product_id = ordered_items.product_id');
        $this->db->where('order_id', $order_id);
         
        $query = $this->db->get();
        if($query->num_rows() >= 1){
                
            return $query->result();
            
        }else{
                
            return false;
        }

    }

    public function get_last_id(){
        $this->db->select_max('order_id');
        $query = $this->db->get('orders'); 
        if($order = $query->row()){
           
            return $order->order_id;

        }else{
            return false;
        }
    }

    public function item_exists($order_id, $product_id){
        // check the user table on database if username and password exist
        $this->db->select('ID');
        $this->db->from('ordered_items');
        $this->db->where('order_id', $order_id);
        $this->db->where('product_id', $product_id);
        $this->db->limit(1);
         
        $query = $this->db->get();
         
        if($query->num_rows() == 1){
             return true;
        }else{
             return false;
        }
    }

    public function get_product_quantity($id){
        $this->db->select('quantity');
        $this->db->from('products');
        $this->db->where('product_id', $id);
        $this->db->limit(1);
         
        $query = $this->db->get();
         
        if($query->num_rows() == 1){
            
            $data = $query->row();

            return $data->quantity;
            
        }else{

            return false;
        }
    }

    public function change_item_quantity($id,$quantity){

        $this->db->set('ordered_quantity',$quantity);
        $this->db->where('ID', $id);
        if($this->db->update('ordered_items')){

            return true;
        }else{
            return false;
        }
    }

    public function add_item_quantity($id){

        $cur_q = $this->get_item_quantity($id);
        $cur_q++;

        $this->db->set('ordered_quantity',$cur_q);
        $this->db->where('ID', $id);
        if($this->db->update('ordered_items')){

            return true;
        }else{
            return false;
        }

    }
    public function sub_item_quantity($id){

        $cur_q = $this->get_item_quantity($id);
        $cur_q--;

        $this->db->set('ordered_quantity',$cur_q);
        $this->db->where('ID', $id);
        if($this->db->update('ordered_items')){

            return true;
        }else{
            return false;
        }

    }
    public function destroy_item($id){
        if($this->db->delete('ordered_items', array('ID' => $id))){
            return true;
        }else{
            return false;
        }
    }

    public function get_item_quantity($id){

        $this->db->select('ordered_quantity');
        $this->db->from('ordered_items');
        $this->db->where('ID', $id);
        $this->db->limit(1);
         
        $query = $this->db->get();
         
        if($query->num_rows() == 1){
             $item = $query->row();
            
             return $item->ordered_quantity;
        }else{
             return false;
        }   
    }
}