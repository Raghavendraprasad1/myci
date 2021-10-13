<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dynamic_form_jquery extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data = array();
        $this->load->view('dynamic_form_jquery', $data);
    }

    function save()
    {
         //pr($this->input->post()); //this will show you raw post data
        $user = array();

        // here we will convert into multidimensional array
        for ($i = 1; $i < $_POST['total_count']; $i++) {
           
            // here condition to check the coming post data is in continous manner or not 
            if (isset($_POST['vName_' . $i]) && !empty($_POST['vName_' . $i])) {
                // echo $i;
                $user[$i]['vName'] = $_POST['vName_' . $i];
                $user[$i]['vEmail'] = $_POST['vEmail_' . $i];
                $user[$i]['vCity'] = $_POST['vCity_' . $i];
            } else {
                // if not then increase total count value by 1 so that we can check for next post values
                $_POST['total_count']++;
                continue;
            }
        }

       // pr($user);   // first array key starting from 1

       // here we are converting array keys to start from 0
        $user = array_values($user);

       //  pr($user,1);  // array with key starting from zero

        // echo "<pre>";
        // print_r($user);
        // die;
        // echo "</pre>";

        $result = $this->db->insert_batch('user', $user);

        if($result)
        {
            redirect('admin/dynamic_form_jquery');
        }
    }
}
