<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zip extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library("zip");   
    }

    function index()
    {
        $this->load->view("zip_view");
    }

    function createzip()
    {
        // $file=base_url('assets/images/admin_image/profile_picture_1601445973.jpeg');

        $filepath1 = FCPATH.'/assets/images/admin_image/profile_picture_1601445973.jpeg';
        $filepath2 = FCPATH.'/assets/optimization.ppt';

        $this->zip->add_data($filepath1);

        // Write the zip file to a folder on your server. Name it "my_backup.zip"
        $this->zip->archive(FCPATH.'/uploads/my_backup.zip');

        // Add file
        $this->zip->read_file($filepath1);
        $this->zip->read_file($filepath2);

        // Download
        $filename = "backup.zip";
        $this->zip->download($filename);

    }


}