<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_todolist extends CI_Model
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

    function Detail($dec,$divisi)
            {
                $this->db->select("A.*,B.username as name_pic, C.divisi,D.desc_status,E.username as name_author");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->join('user as E', 'E.user_id = A.user_create ','LEFT');
                $this->db->where('A.divisi_id',$divisi);
                $this->db->where('A.id',$dec);
                $this->db->limit(1);
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


            	function Delete_file($id){
        $this->db->where('id', $id);
        $this->db->delete('document');
		if($this->db->affected_rows() > 0){
            return true;
        }
        else
        {
            return false;
        }
    }

   
}