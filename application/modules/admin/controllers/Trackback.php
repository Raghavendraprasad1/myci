<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Trackback extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('trackback');
    }

    function send_trackback()
    {
        // echo "this is send trackback"; die;
        $tb_data = array(
            'ping_url'  => base_url('admin/trackback/receive_trackback/123'),
            'url'       => base_url('admin/trackback/send_trackback'),
            'title'     => 'Chase Tomorrows',
            'excerpt'   => 'Good Book to Help Others',
            'blog_name' => 'My First Blog',
            'ip_address'   => '192.168.1.102'
        );

        if (!$this->trackback->send($tb_data)) {
            echo $this->trackback->display_errors();
        } else {
            echo '<script> alert("Trackback was sent!") </script>';
        }
    }

    function receive_trackback()
    {
        if ($this->uri->segment(4) == FALSE) {
            $this->trackback->send_error('Unable to determine the entry ID');
        }

        if (!$this->trackback->receive()) {
            $this->trackback->send_error('The Trackback did not contain valid data');
        }

        $data = array(
            // 'tb_id'      => '',
            'entry_id'   => $this->uri->segment(4),
            'url'        => $this->trackback->data('url'),
            'title'      => $this->trackback->data('title'),
            'excerpt'    => $this->trackback->data('excerpt'),
            'blog_name'  => $this->trackback->data('blog_name'),
            'tb_date'    => date('Y-m-d h:i:s'),
            'ip_address' => $this->input->ip_address()
        );
       $result=$this->db->insert('trackbacks', $data);
       
       $this->trackback->send_success();
    }
}
