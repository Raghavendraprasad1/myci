<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export_excel extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('profile_model');
    }


    function get_export_excel()
    {
        $result=$this->db->get('admin')->result_array();

        $timestamp = time();
        $filename = 'Export_excel_' . $timestamp . '.xls';
        
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $isPrintHeader = false;
        foreach ($result as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
        exit();
    }

    function get_export_csv()
    {
        $result=$this->db->get('admin')->result_array();

        $timestamp = time();  
        $filename ='Export_csv' . $timestamp . '.csv';
        $fp = fopen('php://output', 'w');
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename='.$filename);
        fputcsv($fp, array_keys(reset($result)));
        
        foreach ($result as $row) {
            fputcsv($fp, $row);
        }
        exit;
    }


    function array2csv($array)
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

    function download_send_headers($filename) {
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


    function get_export_csv2()
    {
        $result=$this->db->get('admin')->result_array();
        $this->download_send_headers("data_export_" . date("Y-m-d") . ".csv");
        echo $this->array2csv($result);
        die();
    }


    


}