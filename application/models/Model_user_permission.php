<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user_permission extends CI_Model
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
    /*
               function List_error_versi_php_rendah()
            {
               $this->db->select("A.*,C.description as permission,B.type as type_user");
                $this->db->from('user_permission as A');
                 $this->db->join('user_type as B', 'B.ut_id = A.user_type','LEFT');
                 $this->db->join('permission as C', 'C.permission_id = A.permission_id','LEFT');
                 $data = $this->db->get();
                return $data->result();
            }
            */

             function List_data()
            {
                $data = $this->db->query("SELECT A.*,C.description as permission,B.type as type_user
				
				from user_permission as A
				left join user_type B on B.ut_id = A.user_type
                left join permission C on C.permission_id = A.permission_id
				");
                return $data->result();
            }


                function Type()
            {
               $this->db->select("A.*");
                $this->db->from('user_type as A');
               
                 $data = $this->db->get();
                return $data->result();
            }

                 function Permission()
            {
               $this->db->select("A.*");
                $this->db->from('permission as A');
               
                 $data = $this->db->get();
                return $data->result();
            }
        
/*
            function Edit($id,$nama)
            {
                
                $this->db->set('nama',$nama);
                $this->db->where('id',$id);
                $this->db->update('type_mesin');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }

            */

            	function Delete($id){
        $this->db->where('up_id', $id);
        $this->db->delete('user_permission');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }

   
}