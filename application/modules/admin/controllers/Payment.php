<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// rzp_live_ILgsfZCZoFIKMb
// rzp_test_5eJu4eP0EYBioU
// 4prBsUVFmWx5VpG1mZRCyZJj
// require_once(APPPATH."libraries/razorpay/razorpay-php/Razorpay.php");
// use Razorpay\Api\Api;

class Payment extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $this->adminviews("product_list");
        // $this->adminviews("register");

    }

    // public function pay()
    // {
    //   $api = new Api(RAZOR_KEY_ID, RAZOR_KEY_SECRET);
    //   /**
    //    * You can calculate payment amount as per your logic
    //    * Always set the amount from backend for security reasons
    //    */
    //   $_SESSION['payable_amount'] = 10;
    //   $razorpayOrder = $api->order->create(array(
    //     'receipt'         => rand(),
    //     'amount'          => $_SESSION['payable_amount'] * 100, // 2000 rupees in paise
    //     'currency'        => 'INR',
    //     'payment_capture' => 1 // auto capture
    //   ));
    //   $amount = $razorpayOrder['amount'];
    //   $razorpayOrderId = $razorpayOrder['id'];
    //   $_SESSION['razorpay_order_id'] = $razorpayOrderId;
    //   $data = $this->prepareData($amount,$razorpayOrderId);
    //   $this->load->view('rezorpay',array('data' => $data));
  

    public function razor_payment_success()
    { 
        // echo "raghav"; die;
     $data = [
               'user_id' => '1',
               'product_id' => $this->input->post('product_id'),
               'payment_id' => $this->input->post('razorpay_payment_id'),
               'amount' => $this->input->post('totalAmount')
            ];
     $insert = $this->db->insert('payments', $data);
     $arr = array('msg' => 'Payment successfully credited', 'status' => true);  
    }
    public function razor_payment_thankyou()
    {
        $this->adminviews("razor_thankyou");
    }


}