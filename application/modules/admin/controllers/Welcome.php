<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller {

    public function __construct()
    {
        parent::__construct();    
    }
	public function index()
	{
        echo "test";die;
		//$this->load->view('welcome_message');
    }
    
    
}
