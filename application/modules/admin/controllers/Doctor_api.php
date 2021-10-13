<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doctor_api extends MY_Controller
{
   private $data_array = array();
    function __construct()
    {
        parent::__construct();
    }

    /**
     *Function to get pharmacy details of patient
     *@param  vAccessToken
     * @return doctor info
     */
    public function get_doctor_detail()
    {
        try {
            $this->vAccessToken = $this->input->get_request_header('Access-Token', true);
            if (!$this->vAccessToken) {
                // if you are not sending access token
                $this->data_array['message'] = UNAUTHORIZED_ACCESSTOKEN;
                $this->data_array['errorCode'] = API_ERROR_CODE;
                $response = error_response($this->data_array, 401);
                json_response(401, $response, true);
            } else {
                // if access exist 
                if (!accessTokenCheck($this->vAccessToken)) {
                    $this->data_array['message'] = "Invalid request";
                    $this->data_array['errorCode'] = API_ERROR_CODE;
                    $response = error_response($this->data_array, 401);
                    json_response(401, $response, true);
                }

                $request = $this->input->raw_input_stream;
                $request = $this->security->xss_clean($request);
                $request = json_decode($request); // decode data from json format
                $request = (array) $request;

                if(!empty($request))
                {
                    $this->db->select("*");
                    $this->db->from("doctor");
                    $this->db->where("city", $request['city']);
                    $UserData = $this->db->get();

                    if ($UserData->num_rows() > 0) {
                        $this->data_array['message'] = "success";
                        $this->data_array['data'] = $UserData->result_array();
                        $response = success_response($this->data_array, 200);
                        json_response(200, $response, true);
                    } else {
                        $this->data_array['message'] = "success";
                        $this->data_array['data'] = $UserData->result_array();
                        $response = success_response($this->data_array, 200);
                        json_response(200, $response, true);
                    }
                }
                else{
                    // if we didn't send the city name into request body
                    $this->data_array['message'] = "city is required";
                    $this->data_array['errorCode'] = 400;
                    $response = error_response($this->data_array, 400);
                    json_response(400, $response, true);
                }
            }
        } catch (Exception $e) {
            custom_error_log('UTC', 'ERROR WHILE GETTING DOCTOR DETAILS FOR USER HAVING ' . ' ERROR :' . $e->getMessage() . ' \n', __FILE__, __CLASS__, __FUNCTION__);
        }
    }

}