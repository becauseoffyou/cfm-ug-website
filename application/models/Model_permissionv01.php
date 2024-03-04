<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_permission extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
        $us = $this->session->userdata('user_id');
        if(empty($us))
        {
            $this->session->sess_destroy();
            redirect('Auth');
        }
        
    }
    function getUserPermission($id_user)
    {
        $ip = $this->session->userdata('ip');
        $cek = $this->db->query("SELECT ist from user where user_id='$id_user'");
        if($cek->num_rows()>0){
            foreach($cek->result_array() as $k){
                $id= $k['ist'];
            }
        }
        if ($ip!=$id)
                {
                    redirect('Auth/Logout');
                }
        return  $this->session->userdata('per');
        
    }  
}