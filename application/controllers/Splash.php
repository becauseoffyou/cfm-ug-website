<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Splash extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->library('session');
        $this->load->model('auth/Auth_Mdl');
    }

    public function index()
    {

        $username = $this->session->userdata('user_id');
        $type = $this->session->userdata('user_type');
        $ip = strtotime("now");
        $time = date("Y-m-d H:i:s");

        $this->db->set('ist', $ip);

        // waktu, varchar(15)
        $this->db->set('tps', $time);

        $this->db->where('user_id', $username);
        $result = $this->db->update('user');

        $permission = "SELECT B.description from user_permission A LEFT JOIN permission B ON A.permission_id = B.permission_id WHERE A.user_type = '$type'";
        $data_permission = $this->db->query($permission)->result_array();

        $data = [
            'ip' => $ip,
            'per' => $data_permission
        ];

        $this->session->set_userdata($data);

        redirect('Home');
    }
}
