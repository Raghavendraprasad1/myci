<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Profile_model extends CI_Model
{

    function getCityvalues()
    {
        return $this->db->get("student",array("vName" =>'raghav'))->row();
    }

    function getCity()
    {
       return $this->db->get("cities")->result();
    }
    function save_admin($arr)
    {
        $result=$this->db->insert("admin",$arr);
        if($result)
        {
            return true;
        }
        else{
            return false;
        }
    }

    function update_anonymous()
    {
        $id_arr=array("iId"=>10,"iId"=>11,"iId"=>12);

    $next_arr=array(
        array(
            "iId"=>10,
        ),
        array(
            "iId"=>11,
        ),
        array(
            "iId"=>12,
        )
    );

    $new_arr=array();
    $i=0;
    foreach($next_arr as $con)
    {
         $new_arr[$i++]=$con["iId"];    
    }

        $data=array(
            "fSalary" =>54777,
        );

        $this->db->where_in("iId",$new_arr);
        $result=$this->db->update("admin",$data);
        if($result)
        {
            echo "data updated";
        }
    }

   function get_edit_data($id)
   {
      return $this->db->get_where("user",array("iUserId"=>$id))->row(); 
   }

   function update_admin($arr,$iId)
   {
       $this->db->where("iId",$iId);
       return $this->db->update("admin",$arr);
   }
    
}