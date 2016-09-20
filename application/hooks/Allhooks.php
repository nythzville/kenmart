<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {
    var $CI; 
    function __construct() {
      $this->CI =& get_instance();
      //$this->CI->load->helper('url');
    	//$this->CI->load->library('session');
      $this->CI->load->model('locations_model');
   	}
      // check 
   	function login_check() {
        
      if(isset($_GET['cur_latlng'])){

        $lat = $_GET['lat'];
        $lng = $_GET['lng'];
        
        if($this->CI->locations_model->update_location($lat,$lng)){

        }

        echo 'ok';
        exit;
      }
      
      if(!isset($_SESSION['logged_in'])){
          // $this->CI->load->view('view_login');
          
          // redirect to login page
        redirect('auth/login','refresh');
      }else{
        // if($_SESSION['logged_in']['role']=='Admin'){
        //   redirect(base_url().'admin/dashboard','refresh');
        //   exit;
        // }
        
      }
    
    }

    function add_session_order(){
      // if(isset($_SESSION['order'])){
      //   $order_id = $_SESSION['order']['order_id'];
      //   $orders = $this->CI->orders_model->get_ordered_products($order_id);
      //   $_SESSION['order']['items'] = $orders;
      // }
      
    }

    function admin(){

      if(strripos(current_url(), 'admin')){
        $role = $_SESSION['logged_in']['role'];
        if($role !='Admin'){
          //echo "";
          //var_dump($this->CI->session->userdata);
          
          redirect(base_url(),'refresh');
        }else{


        }
      }else{

      }
    }
}