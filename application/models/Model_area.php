<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_area extends CI_Model
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
    
    function List_area()
    {
        $this->db->select("A.*,coalesce(D.total,0) as total ");
        $this->db->from('lokasi_kerja as A');
        $this->db->join("(select id_lok,count(COALESCE(id,0)) as total from unit where status_unit=1 group by id_lok) as D ", "D.id_lok = A.id","LEFT");
        $this->db->where('A.status',1);
        $data = $this->db->get();        
        return $data->result();
    }
        
    function Edit_area($user_id,$id,$nama_lokasi,$status_aktif,$catatan,$alamat,$latitude,$longitude){
                $this->db->set('nama_lokasi',$nama_lokasi);
                $this->db->set('keterangan',$catatan);
                $this->db->set('alamat_lengkap',$alamat);
                $this->db->set('status',$status_aktif);
                $this->db->set('lat',$latitude);
                $this->db->set('long',$longitude);
                $this->db->set('user_change',$user_id);
                $this->db->set('change_date',date("Y-m-d H:i:s"));
                $this->db->where('id',$id);
                $this->db->update('lokasi_kerja');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
}

function Add_log($log){
     $this->db->insert('area_log', $log);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }


}
  
      function Document_area($dec)
            {
               $this->db->select("A.*");
               $this->db->from('area_file as A');
               $this->db->where('A.unit_id',$dec);
             $this->db->where('A.type',2);
                 $data = $this->db->get();
                return $data->result();
            }






       	function Delete_file($id){
        $this->db->where('id', $id);
        $this->db->delete('area_file');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }


  function Fasilitas($dec)
            {
                $this->db->select("A.*,B.nama as nama_fasilitas");
                $this->db->from('area_fasilitas as A');
                $this->db->join('fasilitas as B', 'B.id = A.fasilitas ','LEFT');
                $this->db->where('A.unit_id',$dec);
                $data = $this->db->get();
                return $data->result();
            }

            
                function Data_fasilitas()
            {
                $this->db->select("A.*");
                $this->db->from('fasilitas as A');
                $this->db->order_by('A.nama','asc');
                $data = $this->db->get();
                return $data->result();
            }

function Delete_data_fasilitas($id){
 
        $this->db->where('id', $id);
        $this->db->delete('area_fasilitas');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }   
}



  function Detail($dec)
            {
                $this->db->select("A.*");
                $this->db->from('lokasi_kerja as A');
                $this->db->where('A.id',$dec);
                $this->db->limit(1);
                $data = $this->db->get();
                return $data->result();
            }



 function Unit($dec)
    {
       $this->db->select("A.*,B.username as nama_penghuni,C.status_detail");
                $this->db->from('unit as A');
                  $this->db->join('user as B', 'B.user_id = A.penghuni ','LEFT');
                $this->db->join('status as C', 'C.id = A.status ','LEFT');
                
                 $this->db->where('A.id_lok',$dec);
                 $this->db->order_by('A.blok','asc');
                $data = $this->db->get();
                return $data->result();

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



  function Status_unit()
            {
               $this->db->select("A.*");
               $this->db->from('status as A');
                 $data = $this->db->get();
                return $data->result();
            }

             function penghuni()
            {
               $this->db->select("A.*");
               $this->db->from('user as A');
               $this->db->where('A.user_type',5);
               $this->db->where('A.status',1);
                 $data = $this->db->get();
                return $data->result();
            }







  

                function Aset($dec)
            {
                $this->db->select("A.*");
                $this->db->from('aset as A');
                $this->db->where('A.id_area',$dec);
                 $this->db->where('A.type','area');
                $data = $this->db->get();
                return $data->result();
            }

            
                function Data_aset()
            {
                $this->db->select("A.*");
                $this->db->from('aset as A');
                $this->db->order_by('A.nama','asc');
                $data = $this->db->get();
                return $data->result();
            }

function Delete_data_aset($id){
 
        $this->db->where('id', $id);
        $this->db->delete('unit_aset');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }   
}

   































  function List_unit()
    {
       $this->db->select("A.*,B.username as nama_penghuni,C.status_detail");
                $this->db->from('unit as A');
                  $this->db->join('user as B', 'B.user_id = A.penghuni ','LEFT');
                $this->db->join('status as C', 'C.id = A.status ','LEFT');
                 $this->db->order_by('A.blok','asc');
                $data = $this->db->get();
                return $data->result();

    }


      function List_unit_short($id)
    {
       $this->db->select("A.*,B.username as nama_penghuni,C.status_detail");
                $this->db->from('unit as A');
                  $this->db->join('user as B', 'B.user_id = A.penghuni ','LEFT');
                $this->db->join('status as C', 'C.id = A.status ','LEFT');
                 $this->db->where('A.status',$id);
                 $this->db->order_by('A.blok','asc');
                $data = $this->db->get();
                return $data->result();

    }







 function Aktifitas_unit($dec)
    {
       $this->db->select("A.*");
                $this->db->from('schedule_job as A');
                $this->db->where('A.id_unit',$dec);
                 $this->db->order_by('A.id','desc');
                $data = $this->db->get();
                return $data->result();

    }




     




















   
}