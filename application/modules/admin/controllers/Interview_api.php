<?php
defined('BASEPATH') or exit('No direct script access alowed');
class Interview_api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // create api to shorten url for free using curl 
    function index()
    {
        $total = array();
       $url_arr= array(
           0 => "https://mindzie.com/2021/08/16/key-performance-indicators-kpis/",
           1 => "https://mindzie.com/2021/06/30/identifying-process-risks-using-process-mining/",
           2 => "https://mindzie.com/2021/05/15/a-process-optimization-view-on-robotic-process-automation/",
           3 => "https://mindzie.com/2021/04/11/keys-to-making-your-process-improvement-project-a-success/",
           4 => "https://mindzie.com/2021/03/14/process-mining-vs-business-intelligence/"
       );

       for($i=0; $i<count($url_arr); $i++)
       {
          $total[] = $this->fetch_blogs_data($url_arr[$i]);

       }

       pr($total);
    }


    function fetch_blogs_data($url)
    {
                // Extract HTML using curl
                $ch = curl_init();
    
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                
                $data = curl_exec($ch);
                curl_close($ch);
                
                // Load HTML to DOM Object
                $dom = new DOMDocument();
                @$dom->loadHTML($data);
                
                // Parse DOM to get Title
                $nodes = $dom->getElementsByTagName('title');
                $title = $nodes->item(0)->nodeValue;
        
                // get blog contents ///////////////////////
                $blog_content = $dom->getElementsByTagName('p');
        
                $b_content="";
                for ($i = 0; $i < $blog_content->length; $i++) {
                    $b_content .= $blog_content->item($i)->nodeValue;
                }
                
                // // Parse DOM to get Meta Description
                // $metas = $dom->getElementsByTagName('meta');
                // // pr($metas[0],1);
                // $body = "";
                // for ($i = 0; $i < $metas->length; $i ++) {
                //     $meta = $metas->item($i);
                //     if ($meta->getAttribute('name') == 'description') {
                //         $body = $meta->getAttribute('content');
                //     }
                // }
                
                // Parse DOM to get Images
                $image_urls = array();
                $images = $dom->getElementsByTagName('img');
                 
                 for ($i = 0; $i < $images->length; $i ++) {
                     $image = $images->item($i);
                     $src = $image->getAttribute('src');
                     
                     if(filter_var($src, FILTER_VALIDATE_URL)) {
                         $image_src[] = $src;
                     }
                 }
                
                $output = array(
                    'title' => $title,
                    'image_src' => $image_src,
                    'body' => $b_content
                );
                return $output;
    }
}