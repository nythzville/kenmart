<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends CI_Model {
    

    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    // adding logs to database
    public function log($user_id,$activity,$description){

        $data = array(
            'user_id'   =>$user_id,
            'date_time'  =>date("Y-m-d H:i:s"),
            'activity'=>$activity,
            'description' => $description
            );

    	if($this->db->insert('activity_log',$data)){
            return true;
        }
    }
}
?>