<?php

class Products_model extends CI_Model {

        public $name;

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

        public function get_all_products()
        {
                $this->db->select('*');
                $this->db->from('products');
                $this->db->join('product_category', 'products.cat_id = product_category.cat_id','left');
                $query = $this->db->get();
                return $query->result();
        }
        

        public function create_product($data){

                $this->db->insert('products', $data);
                return true;

        }

        public function find($id){
            $this->db->where('product_id',$id);
            $query = $this->db->get('products');
            if($query->num_rows() >= 1){
                return $query->row();
            }else{
                return false;
            }

        }


        public function udpate_product($data,$id){
            if($this->db->update('products', $data, array('product_id' => $id))){
                return true;

            }else{
                return false;
            }
        }


        public function destroy($id){
            if($this->db->delete('products', array('product_id' => $id))){
                return true;
            }else{
                return false;
            }
        }


        public function get_all_category()
        {
            //"Select * from product_category;"
            
            $query = $this->db->get('product_category');
            
            $data  = $query->result();

            return $data;

        }
        public function create_category($data){

            if($this->db->insert('product_category', $data)){

                return true; 
            }else{
                return false;
            }
        }
        
        public function destroy_category($id){
            if($this->db->delete('product_category', array('cat_id' => $id))){
                return true;
            }else{
                return false;
            }
        }

        public function get_products_by_category($cat_id){

                $this->db->select('*');
                $this->db->from('products');
                 $this->db->join('product_category', 'product_category.ID = products.cat_id');
                $this->db->where('cat_id',$cat_id);
                $query = $this->db->get();
                 
                if($query->num_rows() >= 1){
                     return $query->result();
                }else{
                     return false;
                }
        }

        public function update_quantity($product_id,$quantity){

            $this->db->set('quantity',$quantity);
            $this->db->where('product_id', $product_id);
            if($this->db->update('products')){

                return true;
            }else{
                return false;
            }
        }

        public function quantity_availability($id, $quantity){

            $this->db->select('quantity');
            $this->db->where('product_id', $id);
            $this->db->from('products');
            $query = $this->db->get();

            if($query->num_rows() == 1){
                $product = $query->row();
                $cur_quantity = $product->quantity;
                if($quantity>$cur_quantity){
                    return false;
                }else{
                    return true;
                }

            }else{
                return false;
            }

        
        }

}
?>