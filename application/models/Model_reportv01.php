<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_report extends CI_Model
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

    function Helpdesk_list($bulan,$tahun,$id)
            {
                $this->db->select("A.*,B.username as name_pic,B1.username as name_pic1,B2.username as name_pic_complete,D.desc_status,E.username as ucreate,H.username as uhuni,C.nama_lokasi,F.blok,F.no_unit,G.type as type_incident");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic','LEFT');
                $this->db->join('user as B1', 'B1.user_id = A.pic1','LEFT');
                $this->db->join('user as B2', 'B2.user_id = A.pic_complete','LEFT');
                $this->db->join('lokasi_kerja as C', 'C.id = A.id_area','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->join('user as E', 'E.user_id = A.user_create','LEFT');
                $this->db->join('unit as F', 'F.id = A.id_unit','LEFT');
                $this->db->join('type_incident as G', 'A.type_problem = G.id','LEFT');
                $this->db->join('user as H', 'H.user_id = F.penghuni','LEFT');
               // $this->db->where('A.divisi_id',$divisi);
                   if ($id != null || $id !='')
                 {
                     $this->db->where('A.id_area', $id);
                 }
                $this->db->where('year(A.create_date)',$tahun);
                $this->db->where('month(A.create_date)',$bulan);
                $data = $this->db->get();
                return $data->result();
            }

   
}