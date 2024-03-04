<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_Mdl extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
        if(empty($this->session->userdata('user_id')))
        {
            $this->session->sess_destroy();
            redirect('Auth');
        }
    }
            function Edit_Profile($kode,$nama,$tlp,$pass,$email,$change,$user_change){
                $this->db->set('nama',$nama);
                $this->db->set('username',$nama);
                $this->db->set('telp',$tlp);
                $this->db->set('password',$pass);
                $this->db->set('email',$email);
                $this->db->set('change_date',$change);
                $this->db->set('user_change',$user_change);
                $this->db->where('user_id',$kode);
                $this->db->update('user');
                    return TRUE;
                }
           
}