<?php
defined('BASEPATH') or exit('No direct script access allowed');
// use admin\url_shorten;
class Error_log extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function default_calculate()
    {

      echo date("m/d/Y h:iA");
      echo date_default_timezone_get();

        // phpinfo();
        // try{

        //     $num = $this->input->get('num');

        //     IF($num == 0)
        //     {
        //         throw new Exception();
        //     }
        //     else{
        //         // show_error("this is a valid number");
        //         show_404("the page you are looking for not found",404);
        //     }

        //     echo 20/$num;
        // }
        // catch(Exception $e)
        // {
        //     // custom_error_log("zero is not allowed",__FILE__,__CLASS__,__FUNCTION__);
        //     log_message("error","zero is not allowed");
        // }

    }

    function custom_calculate()
    {
        try{
            $num = $this->input->get('num');
            if($num == 0)
            {
                throw new Exception();
            }

            echo 20/$num;
        }
        catch(Exception $e)
        {
            custom_error_log("zero is not allowed",__FILE__,__CLASS__,__FUNCTION__);
        }

    }

    function get_another()
    {
        $obj= new Url_shorten();
    }

    
    


}