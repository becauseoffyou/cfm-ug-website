<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_penghuni extends CI_Model
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


    
  function List_penghuni()
    {
       $this->db->select("A.*,B.nama_unit,B.blok,B.no_unit,C.nama_lokasi as area");
                $this->db->from('penghuni as A');
                $this->db->join('unit as B', 'B.penghuni = A.kode ','LEFT');
                $this->db->join('lokasi_kerja as C', 'C.id = B.id_lok ','LEFT');
                $this->db->order_by('A.nama','asc');
                $data = $this->db->get();
                return $data->result();

    }


      function List_kerabat()
    {
       $this->db->select("A.*,B.nama as penghuni");
                $this->db->from('penghuni_kerabat as A');
                $this->db->join('penghuni as B', 'B.kode = A.id_penghuni ','LEFT');
                $this->db->order_by('A.nama','asc');
                $data = $this->db->get();
                return $data->result();

    }


          function List_art()
    {
       $this->db->select("A.*,B.nama as penghuni");
                $this->db->from('penghuni_art as A');
                $this->db->join('penghuni as B', 'B.kode = A.id_penghuni ','LEFT');
                $this->db->order_by('A.nama','asc');
                $data = $this->db->get();
                return $data->result();

    }


          function List_kendaraan()
    {
       $this->db->select("A.*,B.nama as penghuni");
                $this->db->from('penghuni_kendaraan as A');
                $this->db->join('penghuni as B', 'B.kode = A.id_penghuni ','LEFT');
                $this->db->order_by('A.nopol','asc');
                $data = $this->db->get();
                return $data->result();

    }


       function Detail($dec)
            {
                $this->db->select("A.*");
                 $this->db->from('penghuni as A');
                $this->db->where('A.kode',$dec);
                $this->db->limit(1);
                $data = $this->db->get();
                return $data->result();
            }

             function Kerabat($dec)
            {
                $this->db->select("A.*");
                 $this->db->from('penghuni_kerabat as A');
                $this->db->where('A.id_penghuni',$dec);
                $data = $this->db->get();
                return $data->result();
            }

                   function Kendaraan($dec)
            {
                $this->db->select("A.*");
                 $this->db->from('penghuni_kendaraan as A');
                $this->db->where('A.id_penghuni',$dec);
                $data = $this->db->get();
                return $data->result();
            }

                   function Art($dec)
            {
                $this->db->select("A.*");
                 $this->db->from('penghuni_art as A');
                $this->db->where('A.id_penghuni',$dec);
                $data = $this->db->get();
                return $data->result();
            }




















   
}