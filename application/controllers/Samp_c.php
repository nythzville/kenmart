<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Samp_c extends CI_Controller {

	public function __construct(){
        // Call the constructor
        parent::__construct();

       
    }
    
    public function index(){

    	$this->load->model('samp_m');

    	$data['products'] = $this->samp_m->get_all_products();
    	
    	$this->load->view('view_sample',$data);
    	
    }

    public function add($num=null){
    	echo $num;
    }

}