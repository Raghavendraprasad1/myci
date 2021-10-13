<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('lib_extend');
        $this->load->library('MY_Core_lib_extend');
        $this->load->model("profile_model");
    }

    public function index()
    {
        $this->adminviews("signup");
    }

    function save()
    {
        $request = $this->input->post();
        $request = $this->security->xss_clean($request);
         $result = $this->profile_model->save_admin($request);
         if($result){
            $this->adminviews("login_page");   
         }
         else{
            $this->adminviews("signup");   
         }
    }

    function login_page()
    {
        $this->adminviews("login_page");

    }

    function login_verify()
    {
        $vEmail=$this->input->post("vEmail");
        $vPassword=$this->input->post("vPassword");
        // $iId=$this->session->userdata("iId");

        $this->db->select("*");
        $this->db->from("admin");
        $this->db->where("vEmail",$vEmail);
        $this->db->where("vPassword",$vPassword);
        $row_data=$this->db->get()->num_rows();

        if($row_data>0)
        {
            $this->adminviews("welcome_page");

        }
        else{
            redirect("admin/home");
        }
    }

    function delete_user()
    {
        
          $id=base64_decode($this->uri->segment(4));
          echo $id;
          echo $this->input->ip_address(); 
        if(is_really_writable(FCPATH.'assets/images'))
        {
            echo "file is writable";
        }
        else{
            echo "file is not writable";
        }

        if(is_https())
        {
            echo "<br>secure communication";
        }
        else{
            echo "<br>Insecure communication";
        }
         return;
    }

    function get_ip()
    {
        $info=array(
            "city" => "Mohali",
            "state" => "Punjab",
        );
       echo $this->lib_extend->ip_info($info);
    }

    function get_sum()
    {
        echo $this->lib_extend->get_sum(3,4,5);
    }

    function get_armstrong()
    {
       echo $this->my_core_lib_extend->is_armstrong(153);
       echo getcwd();
    }

   
}
