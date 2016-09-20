<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Locations_model extends CI_Model {

        public $name;
        

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
           
    }

    public function update_location($lat,$lng){

    	$this->db->set('lat',$lat);
    	$this->db->set('lng',$lng);
        $this->db->where('user_id',1);
        if($this->db->update('location')){
            return true;
        }else{
            return false;
        }

    }

}