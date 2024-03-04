<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_aset extends CI_Model
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
    
               function List_data($unit,$area)
            {
                $this->db->select("A.*,B.nama_lokasi,C.blok,C.no_unit,C.nama_unit");
                $this->db->from('aset as A');
                $this->db->join('lokasi_kerja as B', 'B.id = A.id_area ','LEFT');
                 $this->db->join('unit as C', 'C.id = A.id_unit ','LEFT');
                        if(!empty($area))
        {
                   $this->db->where('A.id_area',$area);
        }
         
                     if(!empty($unit))
        {
                  $this->db->where('A.id_unit',$unit);
        }
             $data = $this->db->get();
                return $data->result();
            }
        

            function Edit($id,$nama)
            {
                
                $this->db->set('nama',$nama);
                $this->db->where('id',$id);
                $this->db->update('aset');
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
        $this->db->delete('aset');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }


      function List_lokasi()
            {
               $this->db->select("A.*");
               $this->db->from('lokasi_kerja as A');
                 $this->db->where_not_in('A.id', '1');
               $this->db->order_by('A.nama_lokasi', "asc");
                 $data = $this->db->get();
                return $data->result();
            }


               function Unit_data($type)
            {
               $this->db->select("A.id,A.blok,A.no_unit,A.nama_unit");
               $this->db->from('unit as A');
               $this->db->where('id_lok', $type);
               $this->db->order_by('A.blok', "asc");
               $data = $this->db->get();
               return $data->result();
            }

   
}