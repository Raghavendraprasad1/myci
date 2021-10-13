<?php
defined('BASEPATH') or exit('No direct script access alowed');

class Url_shorten extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // create api to shorten url for free using curl 
    function index()
    {
        // echo "<pre>";
        // var_dump($this);
        // die;
        $url = "https://www.w3schools.com/php/php_if_else.asp";
        $ch = curl_init(); 
        $timeout = 5; // default built-in connection timeout - 300 seconds
        curl_setopt($ch, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url=' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        echo $data;
    }

    // CURLOPT_CONNECTTIMEOUT -> is the maximum amount of time in seconds that is allowed to make the connection to the server  
    // https://tinyurl.com/yjtta8941 ->false value

    // If you set CURLOPT_RETURNTRANSFER to true or 1 then the return value from curl_exec will be the actual result from the successful operation otherwise it will return false value

    // 7f94e0ed00d5456cad0beedfa9045d15
    // how to set header and body in curl and make request
    function curl_use()
    {

        $url_d = "https://www.w3schools.com/bootstrap4/tryit.asp?filename=trybs_form_custom_switch&stacked=h"; // url to be shorten
        $url = 'https://api.rebrandly.com/v1/links'; // third party url
        $data = array();

        // set body 
        $data['domain']['fullName'] = "rebrand.ly";
        $data['destination']           = $url_d;
        $postdata = json_encode($data);

        // initialize curl
        $ch = curl_init($url);

        // set parameters
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata); // set body
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array('Content-Type: application/json', 'apikey: c2df8dc383f541088ea9c668fe6dd0ba')
        ); // set header
        $result = curl_exec($ch); // curl execution
        curl_close($ch);
        $data = json_decode($result, true);
        echo ($data['shortUrl']);
    }

    function export_to_excel()
    {
        $filename = "Webinfopen.xls"; // File Name
        // Download file
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");
        // $user_query = mysql_query('select name,work from info');
        $sql = "select * from student";
        $result = $this->db->query($sql);
        $rows = $result->result_array();
        // Write data to file
        $flag = false;
        foreach ($rows as $row) {
            if (!$flag) {
                // display field/column names as first row
                echo implode("\t", array_keys($row)) . "\r\n";
                $flag = true;
            }
            echo implode("\t", array_values($row)) . "\r\n";
        }
    }

    function array2csv(array &$array)
    {
        if (count($array) == 0) {
            return null;
        }
        ob_start();
        $df = fopen("php://output", 'w');
        fputcsv($df, array_keys(reset($array)));
        foreach ($array as $row) {
            fputcsv($df, $row);
        }
        fclose($df);
        return ob_get_clean();
    }

    function download_send_headers($filename)
    {
        // disable caching
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");

        // force download  
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");

        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
    }

    function export_to_csv()
    {
        $sql = "select * from student";
        $result = $this->db->query($sql);
        $rows = $result->result_array();

        $this->download_send_headers("data_export_" . date("Y-m-d") . ".csv");
        echo $this->array2csv($rows);
        die();
    }


    function get_zipcode_details()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $data = [
            "code" => "10005",
            "compare" => "10006,10007",
            "country" => "us",
        ];

        curl_setopt($ch, CURLOPT_URL, "https://app.zipcodebase.com/api/v1/distance?" . http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "apikey: YOUR-APIKEY",
        ));

        $response = curl_exec($ch);
        curl_close($ch);

        $json = json_decode($response);

        var_dump($json);
    }


    function check_sql()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "college";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM student";
        $result = $conn->query($sql);

        pr($result->fetch_assoc());
        die;


        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<br> id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
    }
}
