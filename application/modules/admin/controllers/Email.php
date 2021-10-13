<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends MY_Controller{

    function __construct()
    {
        parent::__construct();
       
    }

    function index()
    {
        $this->adminviews("user_form");
    }

    function send_mail()
    {
        // pr(FCPATH,1);
        $request=$this->input->post();
        // pr($request,1);
        
        $this->load->library('phpmailer_lib');
        $mail=$this->phpmailer_lib->load();
        $mail->setFrom('raghavendra@prologictechnologies.in', 'The KnowLedge Mantra');
        // $mail->addReplyTo('info@example.com', 'CodexWorld');
        
        // Add a recipient
        // $mail->addAddress($this->input->post('to_mail'));
        $mail->addAddress("raghavendrakumar1520@gmail.com");

        
        // Add cc or bcc 
        // $mail->addCC($this->input->post('cc_mail'));
        // $mail->addBCC($this->input->post('bcc_mail'));
        
        // Email subject
        $mail->Subject = 'Get Your Dreamed Job';
        
        // Set email format to HTML
        $mail->isHTML(true);
        
        // Email body content
        $mailContent = "<h3>This mail able to help you to get your dreamed job</h3>
            <p>Please send your cv on the following mail id</p>
            <p>raghavendra@prologictechnologies.in</p>";

        $mail->Body = $mailContent;
        
        // Send email
        if(!$mail->send()){
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            echo 'Message has been sent';
        }
    }


}