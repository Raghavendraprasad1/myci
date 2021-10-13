<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        // $this->load->library('MY_Core_lib_extend');
        // $this->load->library('MY_form_validation');
        $this->load->model("profile_model");
        $this->load->library(array('MY_Form_validation'));
        // $this->load->library(array('form_validation'));
		
    }

    public function index()
    {
        $pagedata = array();
        // $this->output->cache(300);
        $this->adminviews("login_page");
    //    pr($this->load->view("login_page", $pagedata, true),1);
    }

    function verify_email()
    {
        $vEmail = $this->input->post('vEmail');
        $vPassword = $this->input->post('vPassword');
        $condition = array(
            "vEmail" => $vEmail,
            "vPassword" => $vPassword,
        );
        $row = $this->db->select("*")->from("teacher")->where($condition)->get();
        if($row->num_rows() > 0)
        {
            // $this->adminviews("enter_mobileno");
            $row_data=$row->row();
            $user_data=array(
                 "name" => $row_data->name,
                 "email" => $row_data->vEmail
            );
            $this->session->set_userdata("is_admin", $user_data);
            $this->adminviews('product_list');
        }
        else{
            $this->session->set_flashdata("error", "Please Enter valid Email and Password");
            $this->adminviews("login_page");
        }
        
    }

    function logout()
    {
        $this->session->unset_userdata("is_admin");
        redirect('admin/home');
    }


    function sent_otp()
    {
        $sms_reciever = $this->input->post('mobileno');
        $sms_sender = "12058283497";
        $condition = array(
            "mobileno" => $sms_reciever,
        );
        $row = $this->db->select("*")->from("teacher")->where($condition)->get()->num_rows();
        // $sms_reciever="918394003975";
        $this->load->library('twilio');
        $otp = rand(1001, 9999);
        $sms_message = trim($this->input->post('sms_message'));
        $sms_message = "hii Mr. Raghav </br> Your One Time Password For Login is: " . $otp . " ";
        $from = '+' . $sms_sender; //trial account twilio number
        $to = '+91' . $sms_reciever; //sms recipient number
        if ($row > 0) {

            $response = $this->twilio->sms($from, $to, $sms_message);

            $data = array("vOtp" => $otp);
            $this->db->where("id", 1);
            $result = $this->db->update("teacher", $data);

            if ($result && !$response->IsError) {
                $this->adminviews("otp_login");
            } else {
                $this->session->set_flashdata("error", "Please Enter a valid Number");
                $this->adminviews("enter_mobileno");
            }
        } else {

            $this->session->set_flashdata("error", "Please Enter a valid Number");
            $this->adminviews("enter_mobileno");
        }


        // if($response->IsError){
        // echo 'Sms Has been Not sent';
        // }
        // else{
        // echo 'Sms Has been sent';
        // }
    }

    // function otp_page()
    // {


    // }

    function product_page()
    {
        $this->adminviews('product_list');
    }

    function verify_otp()
    {
        $vOtp = $this->input->post('vOtp');
        $condition = array(
            "vOtp" => $vOtp,
        );
        $row = $this->db->select("*")->from("teacher")->where($condition)->get()->num_rows();

        if ($row > 0) {
            $this->adminviews('product_list');
        } else {
            $this->session->set_flashdata("error", "Please Enter a valid Otp");
            $this->adminviews("otp_login");
        }
    }

    function save()
    {
        $request = $this->input->post();
        $request = $this->security->xss_clean($request);

        if (empty($request['iId'])) {
            // print_r($request); die;
            // new code
            // unset($request['iId']);
            //   print_r($request); die;
            $arr = array(
                // "vUserName" =>  $request['vUserName'],
                // "vEmail" =>  $request['vEmail'],
                // "vPassword" =>  $request['vPassword'],
            );
            if (!empty($_FILES['vProfilePicture']['name'])) {
                pr($_FILES['vProfilePicture']['name'],1);
                $type = explode("/", $_FILES['vProfilePicture']['type']);
                $_FILES['vProfilePicture']['name'] = "profile_picture_" . time() . "." . $type[1];
                echo $_FILES['vProfilePicture']['name'];
                die;

                $_FILES['vProfilePicture']['name'] = "profile_picture_" . time() . "." . $type[1];

                echo $_FILES['vProfilePicture']['name'];
                die;

                $config = [
                    'upload_path'     => FCPATH . 'assets/images/admin_image/',
                    'allowed_types'   => 'jpg|png|jpeg',
                    'max_size'        => 10000
                ];

                $this->load->library('upload');
                $this->upload->initialize($config);

                $this->upload->do_upload("vProfilePicture");
                $data_img = $this->upload->data();

                // create thumbnail of image
                // $config2 = array(
                //     'image_library' => 'gd2', //get original image
                //     'source_image' => FCPATH . 'assets/images/admin_image/' . $data_img['file_name'], //save as new image //need to create thumbs first
                //     'maintain_ratio' => TRUE,
                //     'width' => 300,
                //     'height' => 400,
                //     'new_image' => FCPATH . 'assets/images/thumbnail_image/' . 'thumb' . $data_img['file_name'],
                // );

                // $this->load->library('image_lib'); //load library
                // $this->image_lib->initialize($config2);
                // $this->image_lib->resize();
                // $this->image_lib->clear();

                $image_info = $data_img['raw_name'] . $data_img['file_ext'];
                $arr["vProfilePicture"] = $image_info;
            }
            $result = $this->profile_model->save_admin($arr);
            if ($result) {
                $this->adminviews("signup");
            } else {
                echo "<script>confirm('found some error in insertion')</script>";
            }
        } else {
            $iId = $request['iId'];

            $arr = array(
                "vUserName" =>  $request['vUserName'],
                "vEmail" =>  $request['vEmail'],
                "vPassword" =>  $request['vPassword'],
            );
            // new code
            if (!empty($_FILES['vProfilePicture']['name'])) {
                $type = explode("/", $_FILES['vProfilePicture']['type']);
                $_FILES['vProfilePicture']['name'] = "profile_picture_" . time() . "." . $type[1];

                $config = [
                    'upload_path'     => FCPATH . 'assets/images/admin_image/',
                    'allowed_types'   => 'jpg|png|jpeg',
                    'max_size'        => 10000
                ];
                $this->load->library('upload');
                $this->upload->initialize($config);

                $this->upload->do_upload("vProfilePicture");
                $data_img = $this->upload->data();

                $arr["vProfilePicture"] = $data_img['file_name'];
                $user_arr = $this->db->get_where("admin", array("iId" => $iId))->row_array();
                $Old_image = $user_arr['vProfilePicture'];
                // echo $Old_image; 
                if (!empty($Old_image)) {
                    unlink(FCPATH . 'assets/images/admin_image/' . $Old_image);
                }
            }

            $result = $this->profile_model->update_admin($arr, $iId);
            if ($result) {
                $this->adminviews("signup");
            }
        }


        // end of code

        // check for unique email.
        // $vEmail = $request["vEmail"];
        // $this->db->select("*");
        // $this->db->from("admin");
        // $this->db->where("vEmail", $vEmail);
        // $row_data = $this->db->get()->num_rows();
        // if ($row_data > 0) {
        //     $is_unique =  '|is_unique[admin.vEmail]';
        // } else {
        //     $is_unique =  '';
        // }


        // $validate = array(
        //     array(
        //         'field' => 'vEmail',
        //         'label' => 'Email',
        //         'rules' => 'trim|required|valid_email' . $is_unique,
        //     ),
        // );

        // $arr = array(
        //     "vUserName" =>  $request['vUserName'],
        //     "vEmail" =>  $request['vEmail'],
        //     "vPassword" =>  $request['vPassword'],
        // );

        // if (isset($image_info) && !empty($image_info)) {
        //     $arr["vProfilePicture"] = $image_info;
        // }

        // $this->my_core_lib_extend->set_rules($validate);
        // if ($this->my_core_lib_extend->run() == FALSE) {
        //     $this->adminviews("signup");
        // } else {
        //     $result = $this->profile_model->save_admin($arr);

        //     $arr["iId"] = $this->db->insert_id();
        //     $this->session->set_userdata($arr);
        //     if (!empty($this->input->post("remember"))) {
        //         // echo "raghav inside checkbox"; die;
        //         set_cookie("username", $request['uname'], '3600');
        //         set_cookie("email", $request['email'], '3600');
        //         set_cookie("password", $request['pwd'], '3600');
        //     }
        //     $this->adminviews("login_page");
        // }
    }

    function edit_userdata()
    {
        $result = $this->profile_model->get_edit_data(18);
        // print_r($result); die;

        $data = array(
            "userdata" => $result
        );
        $this->adminviews("signup", $data);
    }

    function login_page()
    {
        $this->adminviews("login_page");
    }

    function login_verify()
    {
        $vEmail = $this->input->post("vEmail");
        $vPassword = $this->input->post("vPassword");
        // $iId=$this->session->userdata("iId");

        $this->db->select("*");
        $this->db->from("admin");
        $this->db->where("vEmail", $vEmail);
        $this->db->where("vPassword", $vPassword);
        $row_data = $this->db->get()->num_rows();

        if ($row_data > 0) {
            $this->adminviews("welcome_page");
            
        } else {
            redirect("admin/home");
        }
    }

    function delete_user($name, $id)
    {
        // $id=base64_decode($this->uri->segment(4));
        echo $name . "   " . $id;
        echo $this->input->ip_address();
        if (is_really_writable(FCPATH . 'assets/images')) {
            echo "file is writable";
        } else {
            echo "file is not writable";
        }

        if (is_https()) {
            echo "<br>secure communication";
        } else {
            echo "<br>Insecure communication";
        }
        return;
    }


    function update_anonymous()
    {
        $this->profile_model->update_anonymous();
    }

    function get_data()
    {
        $request = $this->input->post();
        // print_r($request); die;
        $response = json_encode($request);
        echo "<script>
        var re=json.parse($response);
        document.write(re.vEmail) </script>";
        die;

        $vEmail = $this->input->post('vEmail');
        $vPassword = $this->input->post('vPassword');
        $sql = "select * from admin where vEmail='$vEmail' AND vPassword='$vPassword' ";
        $result = $this->db->query($sql)->result();
        //    $result=$this->db->get_where("admin",array("vEmail" =>$vEmail, "vPassword" => $vPassword))->result();

        echo $this->db->last_query();
        echo "<pre>";
        print_r($result);
        die;
    }

    function load_testing_view()
    {
        $this->adminviews('testing_view');
    }  

    function file_upload()
    {
        $this->adminviews('file_upload_form');
    }

    public function oldpassCheck($str)
    {
        // echo "raghav 374"; die;
            if ($str == 'test')
            {
                // echo "first"; die;
                $this->form_validation->set_message('oldpassCheck', 'The old password is incorrect');
                    return FALSE;
            }
            else
            {
                // echo "second"; die;
                $this->form_validation->set_message('oldpassCheck', 'The old password is incorrect');
                    return TRUE;
            }
    }

    function save_file()
    {
        // pr($this->input->post(),1);

        // $validate=array(
        //     'field' => 'vEmail',
        //     'label' => 'Email',
        //     'rule' => 'required|callback_checkEmail'
        // );
        $this->load->library('form_validation');

        $this->form_validation->set_rules('vEmail', 'Email', 'trim|required|xss_clean|callback_oldpassCheck');


        // $this->form_validation->set_rules($validate);

        $data=$this->security->xss_clean($this->input->post());

        if($this->form_validation->run($this) == FALSE)
        {
            pr($this->form_validation->error_array(),1);
        }
        if (!empty($_FILES['vProfilePicture']['name'])) {
            // pr($_FILES['vProfilePicture'],1);
            $type = explode("/", $_FILES['vProfilePicture']['type']);
            $_FILES['vProfilePicture']['name'] = "profile_picture_" . time() . "." . $type[1];

            $config = [
                'upload_path'     => FCPATH . 'assets/images/admin_image/',
                'allowed_types'   => 'gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp',
                // 'allowed_types'   => '*',

                'max_size'        => 10000
            ];
           
            $this->load->library('upload');
            $this->upload->initialize($config);

            

            $arr["vProfilePicture"]='';
            if($this->upload->do_upload("vProfilePicture"))
            {
            $file_data = $this->upload->data();
            $arr["vProfilePicture"] = $file_data['file_name'];
            }

            // $user_arr = $this->db->get_where("admin", array("iId" => $iId))->row_array();
            // $Old_image = $user_arr['vProfilePicture'];
            // // echo $Old_image; 
            // if (!empty($Old_image)) {
            //     unlink(FCPATH . 'assets/images/admin_image/' . $Old_image);
            // }
        }

        $result = $this->db->insert("user",$arr);

        if ($result) {
            // $this->adminviews("file_upload_form");
            // redirect('admin/home/file_upload');
        }

    }

    public function file_system()
    {
        // echo FCPATH;
        // $file_path= "/var/www/html/log_folder/error_log.txt";

        // echo $file_exists($file_path);
        $file_path= "/var/www/html/log_folder/error_log.txt";

        //  echo file_exists($file_path);
        // die("87");
        if(file_exists($file_path))
        {
            // die("first");
           $log_file =fopen($file_path,'a');
        }
        else{
            // die("second");
           $log_file =fopen($file_path,'w');
        }
        // die("outside");

        fwrite($log_file, "Hi raghav");
        fclose($log_file);
    }
  
    

}
