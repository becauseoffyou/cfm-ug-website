<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model
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
     function List_user()
            {
               $this->db->select("A.username,A.user_id,A.status,B.type as type_user , C.nama_lokasi as lok");
                $this->db->from('user as A');
                $this->db->join('user_type as B', 'A.user_type = B.ut_id ','LEFT');
                $this->db->join('lokasi_kerja as C', 'A.lokasi_kerja = C.id ','LEFT');
                $this->db->order_by('A.user_id', "desc");
                 $data = $this->db->get();
                return $data->result();
            }

              function List_divisi()
            {
               $this->db->select("A.*");
               $this->db->from('divisi as A');
               $this->db->order_by('A.id', "desc");
                 $data = $this->db->get();
                return $data->result();
            }

         function List_lokasi()
            {
               $this->db->select("A.*");
               $this->db->from('lokasi_kerja as A');
               $this->db->order_by('A.nama_lokasi', "asc");
                 $data = $this->db->get();
                return $data->result();
            }



               function List_regional_sub($id_divisi)
            {
               $this->db->select("A.*");
                $this->db->from('regional as A');
                 $this->db->where('A.divisi_id',$id_divisi);
                $this->db->order_by('A.regional', "asc");
                 $data = $this->db->get();
                return $data->result();
            }

                 function List_lini_bisnis_sub($id_divisi)
            {
               $this->db->select("A.*");
                $this->db->from('lini_bisnis as A');
                 $this->db->where('A.divisi',$id_divisi);
                $this->db->order_by('A.lini_bisnis', "asc");
                 $data = $this->db->get();
                return $data->result();
            }

               function List_user_type()
            {
               $this->db->select("A.*");
                $this->db->from('user_type as A');
                $this->db->where_not_in('A.ut_id', '4');
                $this->db->order_by('A.type', "asc");
                 $data = $this->db->get();
                return $data->result();
            }


               function Getkodeuser($id_lok)
    {
                $r= $id_lok;
                $this->db->select("COUNT(*) as num");
                $this->db->from('user');
                $dat = $this->db->get()->row_array();
    
        if($dat){
         
                $id= $dat['num'];
                $tmp = ((int)$id); //+1;
                $kd = sprintf("%04s", $tmp);
                $kd1= "$r$kd";
                
            
        }else{
            $kd = "0001";
            $kd1= "$r$kd";    
        }
        return $kd1;
    }  

      function Tambah_user($data){
        $this->db->insert('user', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
            }


    function Cek_user($user)
            {
              $this->db->select("A.*,B.regional, C.divisi,D.type,F.nama_lokasi,E.lini_bisnis as lini");
                $this->db->from('user as A');
                $this->db->join('regional as B', 'A.regional_id = B.id ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('user_type as D', 'A.user_type = D.ut_id ','LEFT');
                $this->db->join('lini_bisnis as E', 'A.lini_bisnis = E.id ','LEFT');
                $this->db->join('lokasi_kerja as F', 'A.lokasi_kerja = F.id ','LEFT');
                $this->db->where('A.user_id',$user);
                $data = $this->db->get();
                return $data->result();
            }


            function Edit_user($user,$username,$jabatan,$nip,$telp,$email,$user_type,$password,$status,$divisi,$regional,$lini_bisnis,$lokasi_kerja,$change_date,$user_change)
            {
                $this->db->set('username',$username);
                 $this->db->set('jabatan',$jabatan);
                $this->db->set('nip',$nip);
                $this->db->set('telp',$telp);
                $this->db->set('email',$email);
                $this->db->set('user_type',$user_type);
                $this->db->set('password',$password);
                $this->db->set('status',$status);
                $this->db->set('divisi_id',$divisi);
                $this->db->set('regional_id',$regional);
                $this->db->set('lini_bisnis',$lini_bisnis);
                $this->db->set('lokasi_kerja',$lokasi_kerja);
                $this->db->set('change_date',$change_date);
                $this->db->set('user_change',$user_change);
                $this->db->where('user_id',$user);
                $this->db->update('user');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }


            function Edit_profile($user,$telp,$email,$password)
            {
                $this->db->set('telp',$telp);
                $this->db->set('email',$email);
                $this->db->set('password',$password);
                $this->db->set('change_date',$change_date);
                $this->db->set('user_change',$user_change);
                $this->db->where('user_id',$user);
                $this->db->update('user');
        if($this->db->affected_rows() > 0){
        return true;
        }
        else
        {
            return false;
        }

            }
   
}