<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Json_function extends MY_Controller
{
   public function __construct()
    {
        parent::__construct();
    }

  function index()
  {
    $iUserId='';
    $actionLinks="<span class='hidden-all' >Deleted</span>"."<a href='".base_url('admin/patients/delete_user?iUserId=').base64_encode($iUserId)."' class='btn btn-sm btn-flat btn-danger ' title='Delete'><i class='fa fa-trash' aria-hidden='true'></i></a>";
    $data=array("link" => $actionLinks);
    $this->adminviews("js_table",$data);
  }

}