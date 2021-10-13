<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Multiselect extends MY_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('profile_model');
    }

    function index()
    {
        $data=array();
        $data['cities']=$this->profile_model->getCity();
        $data['cityvalue']=$this->profile_model->getCityvalues();
        // print_r($result); die;
        $this->adminviews('multiselect',$data);
    }

    function saveCity()
    {
        $data=array();
        $data['iCityid']=$this->input->post('iCityid');
        // print_r($data); die;
        $city=implode(",",$data['iCityid']);
        // echo $city;
        $cityval['iCityid']=$city;
        $this->db->where('vName',"raghav");
       $result=$this->db->update("student",$cityval);
       if($result)
       {
        $this->adminviews('multiselect',$data);
       }
       else{
           echo "bhad m jao";
       }


    }

    
}