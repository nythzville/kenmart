<?php

class Samp_m extends CI_Model {

        
    public function get_all_products(){


    	// SELECT * FROM products;
    	// $this->db->select('*');
    	// $this->db->from('products');

    	$query = $this->db->get('products');

    	$data = $query->result();

    	return $data;

    }
        
}