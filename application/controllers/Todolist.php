<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Todolist extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_todolist');
	}
    public function index()
	{
           $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
       $data['pic'] =$this->Model_todolist->Pic($divisi);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Todolist/My_task',$data);	
        $this->load->view('templates/auth_footer');	
                 }
                    else{
         $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }
                    
    }

     public function Update()
	{

         $i=htmlspecialchars($this->input->get('id',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
             $divisi = $this->session->userdata('divisi_id');
        $user_id = $this->session->userdata('user_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['data'] = $this->Model_todolist->Detail($dec,$divisi);
         $data['doc'] = $this->Model_todolist->Document($dec,$divisi);
         $data['log'] = $this->Model_todolist->Log_task($dec);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Todolist/Update',$data);	
        $this->load->view('templates/auth_footer');	
                 }
                    else{
         $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }

                }
                    
    }



      public function New_task()
	{
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
					{ 

$task_name =ucfirst(trim(htmlspecialchars($this->input->post('task_name',true))));
$task_remarks =ucfirst(trim(htmlspecialchars($this->input->post('task_remarks',true))));
$task_pic =trim(htmlspecialchars($this->input->post('id',true)));
$task_pr =trim(htmlspecialchars($this->input->post('pr',true)));

          $data_task = array(
            'job_detail' => $task_name,
            'note' => $task_remarks,
            'status' => 1,
            'value_progres' => 0,
            'pic' => $task_pic,
            'user_create' => $this->session->userdata('user_id'),
            'create_date' =>date("Y-m-d H:i:s"),
            'divisi_id' => $divisi,
            'ntf' => 0,
            'type' => $task_pr
           
        );
                                 $add=$this->db->insert('schedule_job', $data_task); 
                                   $last_id = $this->db->insert_id();
                                 if($this->db->affected_rows($add) > 0){

                                $data = array(
                                'id_task' => $last_id,
                                'user_id' => $user_id,
                                'log_status' => 1,
                                'keterangan' => "Add task : $task_name",
                                'create_date' =>date("Y-m-d H:i:s")
                            );
                             $tambah = $this->Model_todolist->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                             redirect('Home');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Failed </div>');
                             redirect('Home');

                                }


                 }
                    else{
         $data['userPermission'] = $userPermission;
         var_dump($this->session->userdata('per'));
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }
                    
    }

    
     public function New_comment()
	{

         $i=htmlspecialchars($this->input->post('id_comment',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
             $divisi = $this->session->userdata('divisi_id');
        $user_id = $this->session->userdata('user_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
          $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                 'log_status' => 5,
                                'keterangan' => ucfirst(trim(htmlspecialchars($this->input->post('task_comment',true)))),
                                'create_date' =>date("Y-m-d H:i:s")
                            );
                                $tambah = $this->Model_todolist->Tambah_comment($data);
                                if ($tambah)
                                {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Todolist/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Todolist/Update?id= '.$i.'');

                                }
                 }
                    else{
         $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }

                }
                    
    }




    
     public function Take_job()
	{

        $i=htmlspecialchars($this->input->post('id_take_job',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
             $divisi = $this->session->userdata('divisi_id');
        $user_id = $this->session->userdata('user_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 2,
                                'keterangan' =>'Take Job',
                                'create_date' =>date("Y-m-d H:i:s")
                            );
                                $update = $this->Model_todolist->Take_job($dec);
                                if ($update)
                                {
                                $tambah = $this->Model_todolist->Tambah_comment($data);

                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Todolist/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Todolist/Update?id= '.$i.'');

                                }
                 }
                    else{
         $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }

                }
                    
    }


  public function Complete()
	{
    $res=ucfirst(trim(htmlspecialchars($this->input->post('task_result',true))));
        $i=htmlspecialchars($this->input->post('id_complete',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
             $divisi = $this->session->userdata('divisi_id');
        $user_id = $this->session->userdata('user_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                        $time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                 'log_status' => 3,
                                'keterangan' =>"Completed task : $res",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_todolist->Complete($dec,$res,$time);
                                if ($update)
                                {
                                      $tambah = $this->Model_todolist->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Todolist/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Todolist/Update?id= '.$i.'');

                                }
                 }
                    else{
         $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }

                }
                    
    }





  public function Cancel()
	{
    $res=ucfirst(trim(htmlspecialchars($this->input->post('task_cancel',true))));
        $i=htmlspecialchars($this->input->post('id_cancel',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
             $divisi = $this->session->userdata('divisi_id');
        $user_id = $this->session->userdata('user_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                        $time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                 'log_status' => 4,
                                'keterangan' =>"Cancel task : $res",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_todolist->Cancel($dec,$time);
                                if ($update)
                                {
                                      $tambah = $this->Model_todolist->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Home');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Home');

                                }
                 }
                    else{
         $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }

                }
                    
    }






      public function Edit()
	{
        $i =htmlspecialchars($this->input->post('id_edit',true));
             $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
					{ 

$task_name_edit =ucfirst(trim(htmlspecialchars($this->input->post('task_name_edit',true))));
$task_remarks_edit =ucfirst(trim(htmlspecialchars($this->input->post('task_remarks_edit',true))));
$participan_edit =trim(htmlspecialchars($this->input->post('participan_edit',true)));
$pr_edit =trim(htmlspecialchars($this->input->post('pr_edit',true)));
$time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                 'log_status' => 7,
                                'keterangan' =>"Edit task",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_todolist->Edit($dec,$task_name_edit,$task_remarks_edit,$participan_edit,$pr_edit);
                                if ($update)
                                {
                                      $tambah = $this->Model_todolist->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Home');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Home');

                                }

                 }
                    else{
         $data['userPermission'] = $userPermission;
         var_dump($this->session->userdata('per'));
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }
                }
                    
    }





      public function Progres()
	{
        $i=htmlspecialchars($this->input->post('id_update',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
					{ 

$value_progres =ucfirst(trim(htmlspecialchars($this->input->post('value_progres',true))));
$task_progres =ucfirst(trim(htmlspecialchars($this->input->post('task_progres',true))));
$time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                 'log_status' => 6,
                                'keterangan' =>"Update task : $task_progres",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_todolist->Update($dec,$value_progres,$task_progres);
                                if ($update)
                                {
                                      $tambah = $this->Model_todolist->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Todolist/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Todolist/Update?id= '.$i.'');

                                }

                 }
                    else{
         $data['userPermission'] = $userPermission;
         var_dump($this->session->userdata('per'));
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }
                }
                    
    }


     public function List_data()
    { 
        
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("dashboard");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
        
        
        
    
        $draw = intval($this->input->post("draw"));
        $start = intval($this->input->post("start"));
        $length = intval($this->input->post("length"));
        $order = $this->input->post("order");
        $search= $this->input->post("search");
        $search = $search['value'];
        $col = 0;
        $dir = "";
        if(!empty($order))
        {
            foreach($order as $o)
            {
                $col = $o['column'];
                $dir= $o['dir'];
            }
        }
        if($dir != "asc" && $dir != "desc")
        {
            $dir = "desc";
        }
        $valid_columns = array(
             0=>'A.create_date',
          1=>'A.job_detail',
           2=>'A.type',
            3=>'B.username',
             4=>'A.value_progres',   
            
        
           
           
       
        );
        if(!isset($valid_columns[$col]))
        {
            $order = null;
        }
        else
        {
            $order = $valid_columns[$col];
        }
        if($order !=null)
        {
            $this->db->order_by($order, $dir);
        }
        else
        {
                     $this->db->order_by("A.id","desc");
                      $this->db->where('A.divisi_id',$divisi);
                       $this->db->where('A.user_create',$user_id,'or','A.pic',$user_id);
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
                     $this->db->where('A.divisi_id',$divisi);
                      $this->db->where('A.user_create',$user_id,'or','A.pic',$user_id);
                  
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                     $this->db->where('A.divisi_id',$divisi);
                      $this->db->where('A.user_create',$user_id,'or','A.pic',$user_id);
                }
                $x++;
            }                 
        }
                $this->db->limit($length,$start);
             $this->db->select("A.*,B.username as name_pic, C.divisi,D.desc_status");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->where('A.divisi_id',$divisi);
               // $this->db->where('A.pic',$user_id);
                $this->db->where('A.user_create',$user_id,'or','A.pic',$user_id);
                $this->db->order_by("A.id","desc");
                $result_data = $this->db->get();
        $data = array();
        $no=1;
        foreach($result_data->result() as $rows)
        {
            $row= array();
         if ($rows->status==1){$label_status="label label-warning";}
           else if ($rows->status==2){$label_status="label label-info";}
           else if ($rows->status==3){$label_status="label label-success";}
           else if ($rows->status==4){$label_status="label label-danger";}
           else{$label_status="";}

        $status='<span class="'.$label_status.'">'.$rows->desc_status.'</span>';
        $task_name='<a href="#">'.$rows->job_detail.'</a><div class="small"><i class="fa fa-clock-o"></i> Created '.$rows->create_date.'</div>';
        
          if ($rows->type=='High'){$label_pr="label label-danger";}
           else if ($rows->type=='Medium'){$label_pr="label label-info";}
           else if ($rows->type=='Low'){$label_pr="label label-success";}
           else{$label_pr="";}
            $open = strtotime(date($rows->create_date)); 
                    if (empty($rows->finish_date) || $rows->finish_date==0) {
            $finish = strtotime(date("Y-m-d H:i:s")); 
            }
            else
            {
            $finish =strtotime(date($rows->finish_date)); 
            } 
            $diff = $finish - $open;
            $jam   = floor($diff / 3600);
            $menit = floor(($diff - ( $jam * 3600))/ 60  );
            $hari =  floor($jam / 24);
            $jam1 =  floor(($jam - ( $hari * 24)));
            $nilai = "$hari hari,$jam1 jam,$menit menit ";

             $value_progres='<div class="progress m-b-none full progress-small">
                            <div style="width: '.$rows->value_progres.'%" class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <small>'. $rows->value_progres.'% compleated:</small>';

              if ($this->session->userdata('user_id')== $rows->user_create &&  $rows->status!=3 &&  $rows->status!=4){
                $edit=' <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-toggle="modal" data-target="#cancel" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>

                          <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-job_detail ="'.$rows->job_detail.'"
                      data-note ="'.$rows->note.'"
                       data-name_pic ="'.$rows->name_pic.'"
                        data-pic ="'.$rows->pic.'"
                         data-type ="'.$rows->type.'"
                   
                     data-toggle="modal" data-target="#update" data-rel="tooltip" title="Edit" ><i class="fa fa-pencil" ></i></a>';
              }
              else {
             $edit='';
              }                          

           // $action=

            $row= array();
            //$row[]= $rows->id;
              $row[]= $status;
            $row[]= $task_name;
            $row[]= '<span class="'.$label_pr.'">'.$rows->type.'</span>';
            $row[]=$rows->name_pic;
            $row[]=$nilai;
            $row[]=$value_progres;       
            $row[]='<div style="float:right;">
             <a href="'.base_url('Todolist/Update?id=').''.encrypt_url($rows->id).'"><i class="fas fa-eye" style="color:#000060;"></i></a> '.$edit.'
             
             </div>';
            $data[]=$row;  
        }


        $totalData = $this->Total_data();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data
        );
        echo json_encode($output);
  
        exit();
    }
    public function Total_data()
    {
       $divisi = $this->session->userdata('divisi_id');
         $user_id = $this->session->userdata('user_id');
        $this->db->where('divisi_id',$divisi);
        $this->db->where('user_create',$user_id,'or','pic',$user_id);
        $query = $this->db->select("COUNT(*) as num")->get("schedule_job");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }




      
    public function Notif()
    { 
    $i=htmlspecialchars($this->input->get('id',true));
                $this->db->set('ntf',1);
                $this->db->where('id',$i);
                $this->db->update('schedule_job');
    redirect('Todolist/Update?id='.encrypt_url($i).'');
   // var_dump($i);
    }




    
      public function Document()
	{
        $i=htmlspecialchars($this->input->post('id_file',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("task");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
 $path = "Doc/$divisi";
    if(!is_dir($path)) //create the folder if it's not exists
    {
      mkdir($path,0755,TRUE);
    } 
    $dok_desc =ucfirst(trim(htmlspecialchars($this->input->post('dok_desc',true))));
        $kd=date('YmdHis');
        $old_name= $_FILES["file"]["name"];
        $file_ext = pathinfo($old_name,PATHINFO_EXTENSION);
        $fileName = "$divisi$kd.$file_ext"; 
  if (!empty($_FILES["file"]["name"]))
        {
        $config['upload_path']          = "Doc/$divisi/";
        $config['allowed_types']        = '*';
        $config['file_name']            = $fileName;
        $config['max_size']             = 2000;
        $config['overwrite']			= true;
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config);
       $up= $this->upload->do_upload('file');
                           $time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 6,
                                'keterangan' =>"Upload file: $dok_desc",
                                'create_date' =>$time
                            );
                            $data1 = array(
                                'document_name' => $dok_desc,
                                'document_type' => $user_id,
                                'document_id_task' => $dec,
                                'divisi_id' => $divisi,
                                'user_create' => $user_id,
                                'create_date' =>$time,
                                'link' =>$fileName
                            );



                            
                                if ($up)
                                {     $update =  $this->db->insert('document', $data1);
                                      $tambah =  $this->db->insert('log_task', $data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Todolist/Update?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Todolist/Update?id= '.$i.'');

                                }
                                
                                     }
        else
        {
       $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Gagal tambah foto </div>');
         redirect('Todolist/Update?id= '.$i.'');
        }














                 }
                    else{
         $data['userPermission'] = $userPermission;
         var_dump($this->session->userdata('per'));
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }
                }
                    
    }







 function Delete_file()
	{   
        $i=htmlspecialchars($this->input->post('id_delete',true));
        $dec=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($dec==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $id=htmlspecialchars($this->input->post('id_file_delete',true));
        $name=htmlspecialchars($this->input->post('name_file_delete',true));
        $dok_desc=htmlspecialchars($this->input->post('desc_file_delete',true));
	    $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');	
        $pageName=array("task");
        $userPermission=array();
        $db = $this->load->database('default',TRUE);
        $permission = $this->Model_permission->getUserPermission($user_id);
		
        foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
        }
        $data['userPermission'] = $userPermission;
        $result=array_intersect($pageName,$userPermission);
        if(count($result)>0)
        {
        $hapus = $this->Model_todolist->Delete_file($id);
        if ($hapus)
                               {
                                unlink("Doc/$divisi/".$name);
                          $time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 6,
                                'keterangan' =>"Delete file: $dok_desc",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('log_task', $data);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data 1</div>');
                                  redirect('Todolist/Update?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data 2 </div>');
                              redirect('Todolist/Update?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Todolist/Update?id= '.$i.'');
                                }	
        }
        else
        {

        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');		
        $this->load->view('templates/auth_footer');	
        }
    
	}

    }




















}