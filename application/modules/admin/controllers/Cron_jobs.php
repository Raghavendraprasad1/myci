<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron_jobs extends MY_Controller{

    function __construct()
    {
        parent::__construct();
       
    }

    function index()
    {
        $data_arr=array(
            "vResult" => "fail",
        );
        // $this->db->where("iUserId",2);
        $this->db->update("user", $data_arr);
    }


}