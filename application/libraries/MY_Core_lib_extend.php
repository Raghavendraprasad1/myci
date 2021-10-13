<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

 require_once(getcwd().'/system/libraries/Form_validation.php');
class MY_Core_lib_extend extends CI_Form_validation
{
     public function __construct()
     {
         parent::__construct();
     }
}