<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// require_once('Informal.php');
class Lib_extend extends Informal
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_sum($a='',$b='',$c='')
    {
        return $a*$b*$c;
    }
}