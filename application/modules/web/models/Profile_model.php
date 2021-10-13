<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Profile_model extends CI_Model
{
    function save_admin($arr)
    {
        $result=$this->db->insert("teacher",$arr);
        if($result)
        {
            return true;
        }
        else{
            return false;
        }
    }
}