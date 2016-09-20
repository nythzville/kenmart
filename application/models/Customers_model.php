<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers_model extends CI_Model {

    public $ID;
    public $username;

    public function __construct(){
            // Call the CI_Model constructor
            parent::__construct();
    }

    public function get_All()
    {
        // get all Customer in the database
        $this->db->select('*');
        $this->db->from('users');
        $this->db->join('location','location.user_id = users.user_id');
        $this->db->where('role =','Customer');
        $query = $this->db->get();

        if($query->num_rows() >= 1){
             return $query->result();
        }else{
             return false;
        }
    }

    function login($username, $password){

            // check the user table on database if username and password exist
            $this->db->select('user_id, username, password, role');
            $this->db->from('users');
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $this->db->limit(1);
             
            $query = $this->db->get();
             
            if($query->num_rows() == 1){
                 return $query->result();
            }else{
                 return false;
            }
    }
    public function get_profile($id){

        // check the user table on database if username and password exist
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('user_id', $id);
        $this->db->limit(1);
         
        $query = $this->db->get();
         
        if($query->num_rows() == 1){
             return $query->row();
        }else{
             return false;
        }
    }
    public function get_meta($id){
        $this->db->select('meta_data');
        $this->db->from('users');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }

    }

    public function update_meta($id,$data){

        $this->db->set('meta_data', $data);
        $this->db->where('user_id', $id);
        if($this->db->update('users')){
            return true;
        }else{
            return false;
        }
    }

    public function get_logs($id){
        $this->db->select('*');
        $this->db->from('activity_log');
        $this->db->where('user_id',$id);
        $this->db->order_by('date_time', 'DESC');
         $query = $this->db->get();
        
        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return false;
        }
    }

    public function get_location($id){
        // check the user table on database if username and password exist
        $this->db->select('*');
        $this->db->from('location');
        $this->db->where('user_id', $id);
        $this->db->limit(1);
         
        $query = $this->db->get();
         
        if($query->num_rows() == 1){
             return $query->row();
        }else{
             return false;
        }
    }

    public function save_location($data){
        $user_id = $data['user_id'];

        // check location already exist
        if($this->get_location($user_id)){
            //if user location already on database just update the location

            $this->db->where('user_id', $user_id);
            $this->db->update('location', $data);

            return true;
        }else{

            // if no location for the user then add location
            if($this->db->insert('location',$data)){
                return true;
            }else{
                return false;
            }

        }        
    }

    public function destroy($id){
        
        //$this->ID = $id;
        //$this->db->where('user_id',$id);
        $this->db->delete('users', array('user_id' => $id));
    }

    // adding new customer to user table
    public function store($data){
        $this->db->insert('users',$data);
    }

    public function get_last_id(){
        $this->db->select_max('user_id');
        $query = $this->db->get('users'); 
        if($user = $query->row()){
           
            return $user->user_id;

        }else{
            return false;
        }
    }
       
}
?>