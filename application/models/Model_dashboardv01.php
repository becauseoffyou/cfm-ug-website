<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_dashboard extends CI_Model
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
   
         function Notif(){
               $this->db->select("A.*");
                $this->db->from('schedule_job as A');
                $this->db->where('A.ntf',0);
                $this->db->order_by('A.id','desc');
                $data = $this->db->get();
                return $data->result();

            }


 function Area()
            {
            $this->db->select("A.*");
            $this->db->from('lokasi_kerja as A');
            $this->db->where_not_in('A.id', '1');
            $this->db->where('A.status',1);
            $this->db->order_by('A.nama_lokasi', "asc");
                 $data = $this->db->get();
                return $data->result();
            }


           

              function List_helpdesk($id)
            {
        $data = $this->db->query("SELECT A.*,B.jml as jml,D.desc_status
        from( select * FROM schedule_job where ( '$id' IS NULL OR '$id' = '' OR id_area = '$id' )  group by status) A  
        left join
        (select count(id)as jml,status  from schedule_job where ( '$id' IS NULL OR '$id' = '' OR id_area = '$id' )  group by status)  B on B.status= A.status 
        left join
        status_progres as D on D.id=A.status
        
        ");
         return $data->result();
            }

            
 function Data_unit($id)
            {
        $data = $this->db->query("SELECT A.*,B.jml as jml,D.status_detail 
         from( select * FROM unit where type=0 and ('$id' IS NULL OR '$id' = '' OR id_lok = '$id' ) group by status) A  
         left join
        (select count(id)as jml,status  from unit where type=0 and ('$id' IS NULL OR '$id' = '' OR id_lok = '$id' ) group by status)  B on B.status= A.status 
        left join
        status as D on D.id=A.status
        
        ");
         return $data->result();
            }


  function List_unit($id)
            {
                $this->db->select("A.*,B.username as nama_penghuni, C.nama_lokasi,D.status_detail");
                $this->db->from('unit as A');
                $this->db->join('user as B', 'B.user_id = A.penghuni ','LEFT');
                $this->db->join('lokasi_kerja as C', 'C.id = A.id_lok ','LEFT');
                 $this->db->join('status as D', 'D.id = A.status ','LEFT');
                   $this->db->where('A.type', 0);
                 if ($id != null || $id !='')
                 {
                     $this->db->where('A.id_lok', $id);
                 }
/*               
                   if ($status_hunian != null || $status_hunian !='')
                 {
                     $this->db->where('A.status', $status_hunian);
                 } */
                $data = $this->db->get();
                return $data->result();
            }








/*
    function Task_list($divisi)
            {
               $this->db->select("A.*,B.username as name_pic, C.divisi,D.desc_status");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->where('A.divisi_id',$divisi);
                  $this->db->order_by('A.id', "desc");
                $data = $this->db->get();
                return $data->result();
            }

               function Task_dash($divisi)
    {
        $data = $this->db->query("SELECT B.id,B.desc_status,
        (SELECT coalesce(count(id),0)  as total FROM schedule_job WHERE  divisi_id='$divisi' and status = B.id )  as jumlah
        from
        (select id,desc_status from status_progres where id < 5 group by id) B
        ");
         return $data->result();
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

              function Tambah_comment($data_log){
        $this->db->insert('log_task', $data_log);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
            }


            function Notif($notif){
               $this->db->select("A.*");
                $this->db->from('schedule_job as A');
                $this->db->where('A.pic',$notif);
                $this->db->where('A.ntf',0);
                $this->db->order_by('A.id','desc');
                $data = $this->db->get();
                return $data->result();

            }

            */

   
}