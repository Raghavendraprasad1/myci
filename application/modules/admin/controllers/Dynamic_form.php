<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dynamic_form extends MY_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('profile_model');
    }

    function index()
    {
        $data=array();
        // $data['cities']=$this->profile_model->getCity();
        // $data['cityvalue']=$this->profile_model->getCityvalues();
        // print_r($result); die;
        $this->adminviews('dynamic_form',$data);
    }

    
}