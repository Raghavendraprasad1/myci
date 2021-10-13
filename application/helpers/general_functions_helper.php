<?php

function pr($arr, $die = false) {
    echo '<pre>';
    print_r($arr);
    if ($die)
        die;
    echo '</pre>';
}

function custom_error_log($msg,$file = null, $class = null, $function = null)
{
    // __FILE__, __CLASS__, __FUNCTION__
    $file_path=FCPATH."error/".date('m-d-Y').'error_log.log';

    $logMsg = date('m/d/Y')." ".$msg;
    

    if(!file_exists($file_path))
    {
        $error_file= fopen($file_path,'w');
    }
    else{
     $error_file= fopen($file_path,'a');
    }

         if ($file !== null) {
            //Add file where error was generated
            $logMsg .= " FILE : " . $file . "\n";
        }
        if ($class !== null) {
            //Add class where error was generated
            $logMsg .= " CLASS : " . $class . "\n";
        }
        if ($function !== null) {
            //Add Function where error was generated
            $logMsg .= " FUNCTION: " . $function . "\n";
        }

    // $msg="Raghav my name";
     $result=fwrite($error_file,$logMsg);
     fclose($error_file);
}


// function to generate success json response
function success_response($data, $status)
{
    $response = array();
    $response['meta']['success'] = true;
    $response['meta']['code'] = $status;
    $response['data'] = $data;
    return $response;
}

// function to generate error json response
function error_response($error, $status)
{
    $response = array();
    $response['meta']['success'] = false;
    $response['meta']['code'] = $status;
    $response['data']['errors'] = $error;

    return $response;
}



/**
 * Sends json response back
 * @param string
 * @param array
 */
function json_response ($status, $data, $exit = FALSE) {

	$CI =& get_instance();
	$CI->output->set_content_type('application/json');
	$CI->output->set_status_header($status);
	$CI->output->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
	if($exit){
		$CI->output->_display();
		exit;
	}

}

//check access token for apis
function accessTokenCheck($accessToken)
{
    $CI = &get_instance();

    $verified = $CI->db->get('user', ['vAccessToken' => $accessToken])->num_rows();
    if ($verified > 0) {
        return true;
    } else {
        return false;
    }
}