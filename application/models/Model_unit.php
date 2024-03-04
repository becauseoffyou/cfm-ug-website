<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_unit extends CI_Model
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


    



  function List_lokasi()
            {
               $this->db->select("A.*");
               $this->db->from('lokasi_kerja as A');
                 $this->db->where_not_in('A.id', '1');
                   $this->db->where('A.status',1);
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
               $this->db->select("A.kode,A.nama");
               $this->db->from('penghuni as A');
               $this->db->where('A.status',0);
                 $data = $this->db->get();
                return $data->result();
            }


      function Document_unit($dec)
            {
               $this->db->select("A.*");
               $this->db->from('unit_file as A');
               $this->db->where('A.unit_id',$dec);
               //$this->db->where('A.status',1);
                 $data = $this->db->get();
                return $data->result();
            }



function Add_log($log){
     $this->db->insert('unit_log', $log);
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
                $this->db->select("A.*,B.nama as nama_penghuni, C.nama_lokasi,D.status_detail");
                $this->db->from('unit as A');
                $this->db->join('penghuni as B', 'B.kode = A.penghuni ','LEFT');
                $this->db->join('lokasi_kerja as C', 'C.id = A.id_lok ','LEFT');
                 $this->db->join('status as D', 'D.id = A.status ','LEFT');
                $this->db->where('A.id',$dec);
                $this->db->limit(1);
                $data = $this->db->get();
                return $data->result();
            }

                   function Aset($dec)
            {
                $this->db->select("A.*");
                $this->db->from('aset as A');
                $this->db->where('A.id_unit',$dec);
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

     function Fasilitas($dec)
            {
                $this->db->select("A.*,B.nama as nama_fasilitas");
                $this->db->from('unit_fasilitas as A');
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
        $this->db->delete('unit_fasilitas');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }   
}



       	function Delete_file($id){
        $this->db->where('id', $id);
        $this->db->delete('unit_file');
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
        $this->db->select("A.*,B.nama as nama_penghuni,C.status_detail,D.nama_lokasi,D.kode as kode_area");
                $this->db->from('unit as A');
                  $this->db->join('penghuni as B', 'B.kode = A.penghuni ','LEFT');
                $this->db->join('status as C', 'C.id = A.status ','LEFT');
                      $this->db->join('lokasi_kerja as D', 'D.id = A.id_lok ','LEFT');
                 $this->db->order_by('A.blok','asc');
                $data = $this->db->get();
                return $data->result();

    }


      function List_unit_short($id,$area_data)
    {
       $this->db->select("A.*,B.nama as nama_penghuni,C.status_detail,D.nama_lokasi,D.kode as kode_area");
                $this->db->from('unit as A');
                  $this->db->join('penghuni as B', 'B.kode = A.penghuni ','LEFT');
                   $this->db->join('lokasi_kerja as D', 'D.id = A.id_lok ','LEFT');
                $this->db->join('status as C', 'C.id = A.status ','LEFT');
                   if ($area_data != null || $area_data !='')
                 {
                     $this->db->where('A.id_lok', $area_data);
                 } 
                  if ($id != null || $id !='')
                 {
                     $this->db->where('A.status', $id);
                 }

                
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




        function  Edit_unit($id,$nama,$lokasi_unit,$blok,$no_unit,$status_unit,$penghuni,$no_sprd,$tgl_sprd,$no_bast,$tgl_bast,$catatan,$alamat_lengkap,$status_aktif,
        $wilayah,$kondisi,$masuk,$keluar,$tgl_perbaikan,$nominal_rab,$nominal_spk,$kontraktor,$id_listrik,$id_pam,$id_telp,$internet_1,$internet_2,$internet_3,$internet_4,$daya_listrik,$hak_menempati,$klasifikasi,$type_unit) {
                $this->db->set('id_lok',$lokasi_unit);
                 $this->db->set('nama_unit',$nama);
                $this->db->set('blok',$blok);
                $this->db->set('no_unit',$no_unit);
                $this->db->set('status',$status_unit);
                $this->db->set('penghuni',$penghuni);
                $this->db->set('dok',$no_sprd);
                $this->db->set('tgl_dok',$tgl_sprd);
                $this->db->set('no_bast',$no_bast);
                $this->db->set('tgl_bast',$tgl_bast);
                $this->db->set('keterangan',$catatan);
                $this->db->set('alamat_lengkap',$alamat_lengkap);
                $this->db->set('status_unit',$status_aktif);
                $this->db->set('wilayah',$wilayah);
                $this->db->set('kondisi',$kondisi);
                $this->db->set('masuk',$masuk);
                $this->db->set('keluar',$keluar);
                $this->db->set('tgl_perbaikan',$tgl_perbaikan);
                $this->db->set('nominal_rab',$nominal_rab);
                $this->db->set('nominal_spk',$nominal_spk);
                $this->db->set('kontraktor',$kontraktor);
                $this->db->set('id_listrik',$id_listrik);
                $this->db->set('id_pam',$id_pam);
                $this->db->set('id_telp',$id_telp);
                $this->db->set('id_internet1',$internet_1);
                $this->db->set('id_internet2',$internet_2);
                $this->db->set('id_internet3',$internet_3);
                $this->db->set('id_internet4',$internet_4);
                $this->db->set('daya_listrik',$daya_listrik);
                $this->db->set('hak_menempati',$hak_menempati);
                $this->db->set('klasifikasi',$klasifikasi);
                $this->db->set('type',$type_unit);







                $this->db->where('id',$id);
                $this->db->update('unit');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }



            }
  function Wilayah()
            {
               $this->db->select("A.*");
               $this->db->from('wilayah as A');
                 $data = $this->db->get();
                return $data->result();
            }


             function Kondisi()
            {
               $this->db->select("A.*");
               $this->db->from('kondisi_rumdin as A');
                 $data = $this->db->get();
                return $data->result();
            }


            
             function Klasifikasi()
            {
               $this->db->select("A.*");
               $this->db->from('klasifikasi as A');
                 $data = $this->db->get();
                return $data->result();
            }




















/*


    
    function Log_task($dec)
    {
       $this->db->select("A.*,B.username");
                $this->db->from('log_task as A');
                  $this->db->join('user as B', 'B.user_id = A.user_id ','LEFT');
                $this->db->where('A.id_task',$dec);
                 $this->db->order_by('A.id','desc');
                $data = $this->db->get();
                return $data->result();

    }
    function Document($dec,$divisi) {
             $this->db->select("A.*,B.username as name_pic");
                $this->db->from('document as A');
                $this->db->join('user as B', 'B.user_id = A.user_create ','LEFT');
                $this->db->where('A.divisi_id',$divisi);
                $this->db->where('A.document_id_task',$dec);
                $data = $this->db->get();
                return $data->result();

    }


   function Tambah_comment($data){
        $this->db->insert('log_task', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
            }

            
               function Take_job($dec){
                $this->db->set('status',2);
                   $this->db->set('value_progres',5);
                $this->db->where('id',$dec);
                $this->db->update('schedule_job');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }


               function Complete($dec,$res,$time){
                $this->db->set('status',3);
                $this->db->set('result',$res);
                $this->db->set('value_progres',100);
                $this->db->set('finish_date',$time);
                $this->db->where('id',$dec);
                $this->db->update('schedule_job');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }


               function Cancel($dec,$time){
                $this->db->set('status',4);
                $this->db->set('finish_date',$time);
                $this->db->where('id',$dec);
                $this->db->update('schedule_job');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }
            
        function  Edit($dec,$task_name_edit,$task_remarks_edit,$participan_edit,$pr_edit) {
                $this->db->set('job_detail',$task_name_edit);
                $this->db->set('note',$task_remarks_edit);
                $this->db->set('pic',$participan_edit);
                $this->db->set('type',$pr_edit);
                $this->db->where('id',$dec);
                $this->db->update('schedule_job');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }



            }



                    
        function Update($dec,$value_progres,$task_progres){
                $this->db->set('last_update',$task_progres);
                $this->db->set('value_progres',$value_progres);
                $this->db->where('id',$dec);
                $this->db->update('schedule_job');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }


                     function Pic($divisi)
            {
               $this->db->select("A.user_id,A.username");
                $this->db->from('user as A');
                $this->db->where('A.divisi_id',$divisi);
                   $this->db->where('A.status',1);
                $data = $this->db->get();
                return $data->result();
            }

*/

            



     

   
}