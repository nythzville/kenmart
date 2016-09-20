<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class Inventory extends CI_Controller {

	public function __construct(){
        // Call the constructor
        parent::__construct();

       
    }

	public function index(){
		// calls product model

		$this->load->view('view_inventory');

	}
}