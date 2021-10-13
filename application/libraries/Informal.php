<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Informal
{

    function __construct()
       {
           $name="Raghavendra Prasad";
           $designation='Associate Web Developer';
       }
       
    public function ip_info($info_arr='')
    {
       
       return "you are living in ".$info_arr['city']." which is situated in ".$info_arr['state'];
    }

    public function get_sum($a='',$b='',$c='')
    {
        return $a+$b+$c;
    }
}