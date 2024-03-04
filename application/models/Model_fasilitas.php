<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_fasilitas extends CI_Model
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
    
    function List_data()
            {
                $this->db->select("A.*");
                $this->db->from('fasilitas as A');
                 $data = $this->db->get();
                return $data->result();
            }
        

    function Edit($id,$nama)
            {
                
                $this->db->set('nama',$nama);
                $this->db->where('id',$id);
                $this->db->update('fasilitas');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }

    function Delete($id){
        $this->db->where('id', $id);
        $this->db->delete('fasilitas');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }

   
}