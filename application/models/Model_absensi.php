<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_absensi extends CI_Model
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
     function List_absensi($tanggal)
            { $div =$this->session->userdata('divisi_id');
               
                 $data = $this->db->query("SELECT A.username,B.id,B.tanggal,B.in_absen,B.out_absen,B.stat_in,B.stat_out
                 from user A
                 left join (SELECT * from absensi_ where tanggal = '$tanggal')B ON A.user_id=B.user_id
                 Where A.divisi_id = '$div'  and A.status=1 order by A.username asc");
                return $data->result();
            }
              function Bar1($tanggal)
            {  $div =$this->session->userdata('divisi_id');
                 $data = $this->db->query("SELECT COALESCE(count(A.user_id),0)  as bar
                 from user A
                 left join (SELECT id,user_id from absensi_ where tanggal = '$tanggal')B ON A.user_id=B.user_id
                 Where A.divisi_id = '$div' and A.status=1  and B.id is null order by A.username desc")->row_array();

                 
    
                return $data['bar'];
            }

             function Bar2($tanggal)
            {
                $this->db->select("COALESCE(count(A.id),0)  as bar");
                $this->db->from('absensi_ as A');
                $this->db->where('A.divisi',$this->session->userdata('divisi_id'));
                $this->db->where('A.stat_in',1);
                $this->db->where('A.tanggal',$tanggal);
                 $data = $this->db->get()->row_array();
                return $data['bar'];
            }

              function Bar3($tanggal)
            {
                $this->db->select("COALESCE(count(A.id),0)  as bar");
                $this->db->from('absensi_ as A');
                $this->db->where('A.divisi',$this->session->userdata('divisi_id'));
                $this->db->where('A.stat_in',2);
                $this->db->where('A.tanggal',$tanggal);
                $data = $this->db->get()->row_array();
                return $data['bar'];
            }


             function Bar4($tanggal)
            {
                $this->db->select("COALESCE(count(A.id),0)  as bar");
                $this->db->from('absensi_ as A');
                $this->db->where('A.divisi',$this->session->userdata('divisi_id'));
                $this->db->where('A.stat_out',1);
                $this->db->where('A.tanggal',$tanggal);
                  $data = $this->db->get()->row_array();
                return $data['bar'];
            }

              function Bar5($tanggal)
            {
                $this->db->select("COALESCE(count(A.id),0)  as bar");
                $this->db->from('absensi_ as A');
                $this->db->where('A.divisi',$this->session->userdata('divisi_id'));
                $this->db->where('A.stat_out',2);
                $this->db->where('A.tanggal',$tanggal);
                $data = $this->db->get()->row_array();
                return $data['bar'];
            }

                function Detail($id)
            {
                $this->db->select("A.*,B.username as nama");
                $this->db->from('absensi_ as A');
                 $this->db->join('user as B', 'A.user_id = B.user_id ','LEFT');
                $this->db->where('A.id',$id);
                 $data = $this->db->get();
                 return $data->result();
            }


              function Update_note($id,$jam_in,$jam_out,$ket_in,$ket_out)
            {
                $this->db->set('in_absen',$jam_in);
                $this->db->set('out_absen',$jam_out);
                $this->db->set('ket_in',$ket_in);
                $this->db->set('ket_out',$ket_out);
                $this->db->where('id',$id);
                $this->db->update('absensi_');
                if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }

            }
   
}