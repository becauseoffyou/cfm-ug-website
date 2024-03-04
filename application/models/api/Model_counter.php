<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_counter extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
        date_default_timezone_set("Asia/Bangkok");
       
    }
   




    function getcodecm()
    {
        date_default_timezone_set('Asia/Bangkok');
        $w=date('ym');
        $m=date('m');
        $y=date('y');
        $q = $this->db->query("SELECT * FROM counter  where counter.type='CM' AND counter.month='$m' AND counter.year='$y'");
        $kd1 = "";
    
        if($q->num_rows()>0){
            foreach($q->result_array() as $k){
                $id= $k['id'];
                $tmp = ((int)$k['val'])+1;
                $kd = sprintf("%04s", $tmp);
                $kd1= "CM$w$kd";
        $this->db->set('val',$tmp);
        $this->db->where('id',$id);
        $this->db->update('counter');
            }
        }else{
            $kd = "0001";
            $kd1= "CM$w$kd";
            $data = [
				'type' => "CM",
				'year' => date("y"),
				'month' => date("m"),
				'val' => "0001"
                ];  
                $this->db->insert('counter', $data);     
        }
        return $kd1;
    }    


    function getcodepm()
    {
        date_default_timezone_set('Asia/Bangkok');
        $w=date('ym');
        $m=date('m');
        $y=date('y');
        $q = $this->db->query("SELECT * FROM counter  where counter.type='PM'AND counter.month='$m' AND counter.year='$y'");
        $kd1 = "";
    
        if($q->num_rows()>0){
            foreach($q->result_array() as $k){
                $id= $k['id'];
                $tmp = ((int)$k['val'])+1;
                $kd = sprintf("%04s", $tmp);
                $kd1= "$w-PM$kd";
        $this->db->set('val',$tmp);
        $this->db->where('id',$id);
        $this->db->update('counter');
            }
        }else{
            $kd = "0001";
            $kd1= "$w-PM$kd";
            $data = [
				'type' => "PM",
				'year' => date("y"),
				'month' => date("m"),
				'val' => "0001"
                ];  
                $this->db->insert('counter', $data);     
        }
        return $kd1;
    }    




}