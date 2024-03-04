<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Helpdesk extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_Helpdesk');
          $this->load->model('Model_counter');	
	}
    public function index()
	{
           $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("helpdesk_list");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
			
                    { 
        $data['area'] =$this->Model_Helpdesk->List_lokasi();
        $data['type'] =$this->Model_Helpdesk->Type_incident();
        $data['pic'] =$this->Model_Helpdesk->Pic();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Helpdesk/My_task',$data);	
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


     public function short()
	{
           $user_id = $this->session->userdata('user_id');
        //$divisi = $this->session->userdata('divisi_id');
        $i=htmlspecialchars($this->input->get('status',true));
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
        $pageName=array("helpdesk_list");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
			
                    { 
        $data['id']=htmlspecialchars($this->input->get('status',true));
        $data['area'] =$this->Model_Helpdesk->List_lokasi();
        $data['type'] =$this->Model_Helpdesk->Type_incident();
        $data['pic'] =$this->Model_Helpdesk->Pic();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Helpdesk/My_task1',$data);	
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
       
        $user_id = $this->session->userdata('user_id');
        $pageName=array("helpdesk_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['data'] = $this->Model_Helpdesk->Detail($dec);
         $data['doc'] = $this->Model_Helpdesk->Document($dec);
         $data['biaya'] = $this->Model_Helpdesk->Biaya($dec);
         $data['log'] = $this->Model_Helpdesk->Log_task($dec);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Helpdesk/Update',$data);	
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


     public function push_notif($cem2,$pesan)
    {
        /* API URL */
        
        $url = 'https://fcm.googleapis.com/fcm/send';
		$kode=$cem2;
		$key ='key=AAAAJGT5IQo:APA91bGw2XZT3UCJdmf13c-hDNmCJwQhGv1vO5d3VlCCHYUc9jckwfX2kc9HAaqdVYHWxNKGH9tneEvh9bDhLhiU1sfbhkt327u1hBuZp-QGT7InsZ8dv8jNg-c0mLgzHNPKUDNmrppE';
  $data =array("to"  => $kode,
		'notification' => array('body' => $pesan,
        'title'=> 'Help desk new incident'));
    $fields = json_encode($data);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch,CURLOPT_VERBOSE, true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type:application/json',
                    'Authorization:'.$key
	));      
    $result = curl_exec($ch);
	curl_close($ch);
	return $result;
    }


          function Unit_data()
                {
                    $type=$this->input->post('area');
                    $data_unit=$this->Model_Helpdesk->Unit_data($type);
                    $data=array();
                    //var_dump($data_unit);
                    foreach($data_unit as $d){
                        $data['blok']= $d->blok;
                        $data['id']= $d->id;
                        $data['no_unit']= $d->no_unit;
                        $data['nama_unit']= $d->nama_unit;
                         $data['nama_penghuni']= $d->nama;
                        $res['data'][] = $data;
                    }
                    echo json_encode($res);
                   
				}


      public function New_task()
	{
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("helpdesk_add");
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
//$task_remarks =ucfirst(trim(htmlspecialchars($this->input->post('task_remarks',true))));
$task_type=htmlspecialchars($this->input->post('type',true));
$task_pic1 =htmlspecialchars($this->input->post('pic1',true));
$task_pic2 =htmlspecialchars($this->input->post('pic2',true));
$pr =htmlspecialchars($this->input->post('pr',true));
$unit =htmlspecialchars($this->input->post('id_unit_add',true));
$id_area =htmlspecialchars($this->input->post('id_area_add',true));
$pelapor =htmlspecialchars($this->input->post('pelapor',true));


$nama_unit='';
$blok='';
$no_unit='';

    $cek_unit  = $this->db->query("SELECT A.id_lok,A.blok,A.no_unit,A.nama_unit FROM unit A  where A.id='$unit'")->row_array();
    if ($cek_unit) {
    $nama_unit= $cek_unit['nama_unit'];
    $blok= $cek_unit['blok'];
    $no_unit= $cek_unit['no_unit'];
                   
    }

$tiket=$this->Model_counter->getcodecm();
          $data_task = array(
            'tiket' => $tiket,
             'id_area' => $id_area,
            'id_unit' => $unit,
            'type' => $pr,
            'job_detail' => $task_name,
            'pelapor' => $pelapor,
            'status' => 1,
            'value_progres' => 0,
            'pic' => $task_pic1,
             'pic1' => $task_pic2,
            'user_create' => $this->session->userdata('user_id'),
            'create_date' =>date("Y-m-d H:i:s"),
            'type_problem' => $task_type,
            'ntf' => 0   
        );
$add=$this->db->insert('schedule_job', $data_task); 
$last_id = $this->db->insert_id();
if($this->db->affected_rows($add) > 0){
// notif
                    $pesan = "New Incident $tiket $task_name  $nama_unit Blok : $blok No : Unit $no_unit" ;
      $cem = $this->db->query("SELECT token_ntf FROM user WHERE user_type=7");
foreach ($cem->result() as $rows) {
    $cem2 = $rows->token_ntf;
    if (!empty($cem2) || $cem2 !== '') {
        $this->push_notif($cem2, $pesan);
    }
}

                  /*  $cem  = $this->db->query("SELECT token_ntf FROM user  where user_id='$task_pic'")->row_array();
                    $cem1  = $this->db->query("SELECT token_ntf FROM user  where user_id='$task_pic1'")->row_array();
                    if ($cem) {
                    $cem2= $cem['token_ntf'];
                    if(!empty($cem2['token_ntf']))
                    {
                    $this->push_notif($cem2,$pesan);  
                    } 
                    }
                    $cem2='';
                      if ($cem1) {
                    $cem2= $cem1['token_ntf'];
                    if(!empty($cem1['token_ntf']))
                    {
                    $this->push_notif($cem2,$pesan);  
                    } 
                    }
                    */

                                $data = array(
                                'id_task' => $last_id,
                                'user_id' => $user_id,
                                'log_status' => 1,
                                'keterangan' => "Add task : $task_name",
                                'create_date' =>date("Y-m-d H:i:s")
                            );
                             $tambah = $this->Model_Helpdesk->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                              redirect('Helpdesk/Update?id= '.encrypt_url($last_id).'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Failed </div>');
                              redirect('Helpdesk/Update?id= '.encrypt_url($last_id).'');

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
        $pageName=array("helpdesk_update");
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
                                $tambah = $this->Model_Helpdesk->Tambah_comment($data);
                                if ($tambah)
                                {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Helpdesk/Update?id= '.$i.'');

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
        $pageName=array("helpdesk_update");
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
                                $update = $this->Model_Helpdesk->Take_job($dec);
                                if ($update)
                                {
                                $tambah = $this->Model_Helpdesk->Tambah_comment($data);

                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Helpdesk/Update?id= '.$i.'');

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
    $sol=ucfirst(trim(htmlspecialchars($this->input->post('task_solusi',true))));
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
        $pageName=array("helpdesk_update");
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
                                 'log_status' => 5,
                                'keterangan' =>"Completed task : $res",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_Helpdesk->Complete($dec,$res,$time,$sol);
                                if ($update)
                                {
                                      $tambah = $this->Model_Helpdesk->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Helpdesk/Update?id= '.$i.'');

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
        $pageName=array("helpdesk_update");
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
                                 'log_status' => 6,
                                'keterangan' =>"Cancel task : $res",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_Helpdesk->Cancel($dec,$time,$res);
                                if ($update)
                                {
                                      $tambah = $this->Model_Helpdesk->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                  redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Helpdesk/Update?id= '.$i.'');

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
        $pageName=array("helpdesk_update");
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
$participan_edit1 =trim(htmlspecialchars($this->input->post('participan_edit1',true)));
$participan_edit2 =trim(htmlspecialchars($this->input->post('participan_edit2',true)));
$pr_edit =trim(htmlspecialchars($this->input->post('pr_edit',true)));

$id_area_edit =trim(htmlspecialchars($this->input->post('id_area_edit',true)));
$id_unit_edit =trim(htmlspecialchars($this->input->post('id_unit_edit',true)));
$type_edit =trim(htmlspecialchars($this->input->post('type_edit',true)));
$time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                 'log_status' => 8,
                                'keterangan' =>"Edit task",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_Helpdesk->Edit($dec,$task_name_edit,$task_remarks_edit,$participan_edit1,$participan_edit2,$pr_edit,$id_area_edit,$id_unit_edit,$type_edit);
                                if ($update)
                                {
                                      $tambah = $this->Model_Helpdesk->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                  redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                                redirect('Helpdesk/Update?id= '.$i.'');

                                }

                 }
                    else{
         $data['userPermission'] = $userPermission;
         //var_dump($this->session->userdata('per'));
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
        $pageName=array("helpdesk_update");
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
                                 'log_status' => 3,
                                'keterangan' =>"Update task : $task_progres",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_Helpdesk->Update($dec,$value_progres,$task_progres);
                                if ($update)
                                {
                                      $tambah = $this->Model_Helpdesk->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Helpdesk/Update?id= '.$i.'');

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





     public function List_data1()
    { 
        
       $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("helpdesk_list");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
        
        
        $i = $this->input->get("status");
      
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
    //var_dump($dec);
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
             5=>'D.desc_status',  
             6=>'A.tiket'
        
           
           
       
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
                 
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
              
                  
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                   
                }
                $x++;
            }                 
        }
                $this->db->limit($length,$start);
                $this->db->select("A.*,B.username as name_pic, C.divisi,D.desc_status,F.username as name_pic1,G.username as name_pic2");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.user_create ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->join('unit as E', 'E.id = A.id_unit ','LEFT');
                $this->db->join('user as F', 'F.user_id = A.pic ','LEFT');
                $this->db->join('user as G', 'G.user_id = A.pic1 ','LEFT');
             $this->db->where('A.status',$dec);
             /*    if ($dec == 5)
                 {
               $this->db->where('A.status', 5);
               }
               else {
                 $this->db->where('A.status <', 5);
               } */
                //$this->db->where('A.user_create',$user_id,'or','A.pic',$user_id);
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
            else if ($rows->status==5){$label_status="label label-success";}
             else if ($rows->status==6){$label_status="label label-danger";}
           else{$label_status="";}
     $jumlahkarakter=20;
     $cetak = substr($rows->job_detail, 0, $jumlahkarakter);
        $status='<span class="'.$label_status.'">'.$rows->desc_status.'</span>';
        $task_name='<a href="#">'.$cetak.'</a><div class="small"><i class="fa fa-clock-o"></i> Created '.$rows->create_date.'</div>';
        
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

             //  $tiket='<i class="fa fa-ticket"></i> Ticket : <br><small>'. $rows->tiket.'</small><br>
             //  <i class="fa fa-clock-o"></i> Durasi : <br> <small>'.$nilai.'</small>';     
             $tiket=' <i class="fa fa-clock-o"></i> Durasi : <br> <small>'.$nilai.'</small>';                       

            // $tiket='<i class="fa fa-ticket"></i> Ticket : <br><small>'. $rows->tiket.'</small>';
              if ( $rows->status!=5 &&  $rows->status!=6){
                $edit=' <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-toggle="modal" data-target="#cancel" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>

                          <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-job_detail ="'.$rows->job_detail.'"
                      data-note ="'.$rows->note.'"
                       data-name_pic1 ="'.$rows->name_pic1.'"
                        data-pic1 ="'.$rows->pic.'"
                          data-name_pic2 ="'.$rows->name_pic2.'"
                        data-pic2 ="'.$rows->pic1.'"
                         data-type ="'.$rows->type.'"
                   
                     data-toggle="modal" data-target="#update" data-rel="tooltip" title="Edit" ><i style="color:#000060;margin:10px;" class="fa fa-pencil" ></i></a>';
              }
              else {
             $edit='';
              }                          

  

            $row= array();
          $row[]= $rows->name_pic1;
              $row[]= $status;
            $row[]= $task_name;
            //'<span class="'.$label_pr.'">'.$rows->type.'</span>';
            $row[]=$rows->pelapor;
            $row[]=$tiket;
            $row[]=$value_progres;       
            $row[]='<div style="float:right;">
             <a style="color:#000060;margin:10px;" href="'.base_url('Helpdesk/Update?id=').''.encrypt_url($rows->id).'"><i class="fas fa-eye" style="color:#000060;margin:10px;"> </i>
             
            </a> <a style="color:#000060;margin:10px;" href="'.base_url('Helpdesk/Surat_tugas?id=').''.encrypt_url($rows->id).'"><i class="fas fa-print" style="color:#000060;margin:10px;"> </i></a>'.$edit.'
             
             </div>';
            $data[]=$row;  
        }


        $totalData = $this->Total_data1($dec);
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data
        );
        echo json_encode($output);
  
        exit();
    }

    public function Total_data1($dec)
    {
        $this->db->where('status',$dec);
        $query = $this->db->select("COUNT(*) as num")->get("schedule_job");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }





     public function List_data()
    { 
        
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("helpdesk_list");
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
           2=>'E.nama_unit',
            3=>'B.username',
             4=>'A.value_progres', 
             5=>'D.desc_status',  
             6=>'A.tiket'
        
           
           
       
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
                   
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
              
                  
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                     
                }
                $x++;
            }                 
        }
                $this->db->limit($length,$start);
              $this->db->select("A.*,B.username as name_pic, C.divisi,D.desc_status,F.username as name_pic1,G.username as name_pic2,E.nama_unit,E.blok,E.no_unit,H.type as type_name");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.user_create ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->join('unit as E', 'E.id = A.id_unit ','LEFT');
                $this->db->join('user as F', 'F.user_id = A.pic ','LEFT');
                $this->db->join('user as G', 'G.user_id = A.pic1 ','LEFT');
                 $this->db->join('type_incident as H', 'H.id = A.type_problem ','LEFT');
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
            else if ($rows->status==5){$label_status="label label-success";}
             else if ($rows->status==6){$label_status="label label-danger";}
           else{$label_status="";}
     $jumlahkarakter=20;
     $cetak = substr($rows->job_detail, 0, $jumlahkarakter);
        $status='<span class="'.$label_status.'">'.$rows->desc_status.'</span>';
        $task_name='<div class="small">
    Rumah   : '.$rows->nama_unit.' <br>
    Blok / No : '.$rows->blok.' '.$rows->no_unit.'<br>
    Keluhan   : '.$cetak.'<br>
    Petugas 1 : '.$rows->name_pic1.'<br>
    Petugas 2 : '.$rows->name_pic2.'<br>
   
        <i class="fa fa-clock-o"></i> Created '.$rows->create_date.'
        </div>';
        
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

             //  $tiket='<i class="fa fa-ticket"></i> Ticket : <br><small>'. $rows->tiket.'</small><br>
             //  <i class="fa fa-clock-o"></i> Durasi : <br> <small>'.$nilai.'</small>';     
             $tiket=' <i class="fa fa-clock-o"></i> Durasi : <br> <small>'.$nilai.'</small>';                       

            // $tiket='<i class="fa fa-ticket"></i> Ticket : <br><small>'. $rows->tiket.'</small>';
              if ( $rows->status!=5 &&  $rows->status!=6){
                $edit=' <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-toggle="modal" data-target="#cancel" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>

                      <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-job_detail ="'.$rows->job_detail.'"
                      data-note ="'.$rows->note.'"
                       data-name_pic1 ="'.$rows->name_pic1.'"
                        data-pic1 ="'.$rows->pic.'"
                          data-name_pic2 ="'.$rows->name_pic2.'"
                        data-pic2 ="'.$rows->pic1.'"
                         data-type ="'.$rows->type.'"
                              data-id_area ="'.$rows->id_area.'"
                        data-id_unit ="'.$rows->id_unit.'"
                         data-type_problem ="'.$rows->type_problem.'"
                             data-id_arean ="'.$rows->nama_unit.'"
                        data-id_unitn ="'.$rows->nama_unit.'"
                         data-typen ="'.$rows->type_name.'"
                   
                     data-toggle="modal" data-target="#update" data-rel="tooltip" title="Edit" ><i style="color:#000060;margin:10px;"  class="fa fa-pencil" ></i></a>';
              }
              else {
             $edit='';
              }                          

  

            $row= array();
          $row[]= $rows->tiket;
              $row[]= $status;
            $row[]= $task_name;
            //'<span class="'.$label_pr.'">'.$rows->type.'</span>';
            $row[]=$rows->pelapor;
            $row[]=$tiket;
            $row[]=$value_progres;       
                  $row[]='<div style="float:right;">
             <a  href="'.base_url('Helpdesk/Update?id=').''.encrypt_url($rows->id).'"><i class="fas fa-eye" style="color:#000060;margin:10px;"> </i>
             
            </a> <a  href="'.base_url('Helpdesk/Surat_tugas?id=').''.encrypt_url($rows->id).'"><i class="fas fa-print" style="color:#000060;margin:10px;"> </i></a>'.$edit.'
             
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
       // $this->db->where('divisi_id',$divisi);
      //  $this->db->where('user_create',$user_id,'or','pic',$user_id);
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
    redirect('Helpdesk/Update?id='.encrypt_url($i).'');
   // var_dump($i);
    }


/*

    
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
        $config['max_size']             = 1000;
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
                                 redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Helpdesk/Update?id= '.$i.'');

                                }
                                
                                     }
        else
        {
       $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Gagal tambah foto </div>');
         redirect('Helpdesk/Update?id= '.$i.'');
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

*/





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
        $pageName=array("helpdesk_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
 $path = "Doc/incident/";
    if(!is_dir($path)) //create the folder if it's not exists
    {
      mkdir($path,0755,TRUE);
    } 
    $dok_desc =ucfirst(trim(htmlspecialchars($this->input->post('dok_desc',true))));
        $kd=date('YmdHis');
        $old_name= $_FILES["file"]["name"];
        $file_ext = pathinfo($old_name,PATHINFO_EXTENSION);
        $fileName = "Pengelola-$kd.$file_ext"; 
  if (!empty($_FILES["file"]["name"]))
        {
        $config['upload_path']          = $path;
        $config['allowed_types']        = '*';
        $config['file_name']            = $fileName;
        $config['max_size']             = 1000;
        $config['overwrite']			= true;
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config);
       $up= $this->upload->do_upload('file');
                           $time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 8,
                                'keterangan' =>"Upload file: $dok_desc",
                                'create_date' =>$time
                            );
                        $data_foto = [
            'incident_id' => $dec,
            'foto' => $fileName,
            'deskripsi' => 'pengelola '.$dok_desc.'',
            'user_create' => $user_id,
            'create_date' => date("Y-m-d H:i:s"),
            'lat' => '',
            'lon' => ''
            ];



                            
                                if ($up)
                                {     $update =  $this->db->insert('incident_foto', $data_foto);
                                      $tambah =  $this->db->insert('log_task', $data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Helpdesk/Update?id= '.$i.'');

                                }
                                
                                     }
        else
        {
       $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Gagal tambah foto </div>');
         redirect('Helpdesk/Update?id= '.$i.'');
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
        $pageName=array("helpdesk_update");
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
        $hapus = $this->Model_Helpdesk->Delete_file($id);
        if ($hapus)
                               {
                                unlink("Doc/incident/".$name);
                          $time=date("Y-m-d H:i:s");
                           $data = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 8,
                                'keterangan' =>"Delete file: $dok_desc",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('log_task', $data);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data 1</div>');
                                  redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data 2 </div>');
                              redirect('Helpdesk/Update?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Helpdesk/Update?id= '.$i.'');
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












public function Surat_tugas(){
						date_default_timezone_set("Asia/Bangkok");
                      
                        $a1 = htmlspecialchars($this->input->get('id',true));
					
                        $nopol = htmlspecialchars($this->input->get('nopol',true));
		if(empty($a1))
        {
		  $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal Membuat Surat Tugas</div>');
    
                    redirect('Helpdesk');
		}
          
		$id=decrypt_url($a1);
          

                     if($id==false)
   {
		  $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal Membuat Surat Tugas</div>');
    
                    redirect('Helpdesk');
		}


 $this->db->select("A.*,B.username as name_pic,B.jabatan,B1.username as name_pic1, C.blok,C.no_unit,nama_unit,F.nama_lokasi");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic ','LEFT');
                $this->db->join('user as B1', 'B1.user_id = A.pic1 ','LEFT');
                $this->db->join('unit as C', 'C.id = A.id_unit ','LEFT');
                $this->db->join('lokasi_kerja as F', 'F.id = A.id_area ','LEFT');
                $this->db->where('A.id',$id);
                $this->db->limit(1);
                $surat_tugas = $this->db->get()->result();



						$data['detail']=$surat_tugas;
						$this->load->library('pdf');
						$path = 'images/logo/Logo_biru11.png';
						$type = pathinfo($path, PATHINFO_EXTENSION);
						$dt = file_get_contents($path);
						$data['img'] = 'data:image/' . $type . ';base64,' . base64_encode($dt); 
						//$data['hari'] =$this->hari();
					 
					$this->pdf->setPaper('A4', 'potrait');
					
					$this->pdf->filename = "Surat Tugas.pdf";
					$this->pdf->load_view('Report/surat_tugas', $data);
		// $this->load->view('Report/surat_tugas',$data);
					}


                    
    public function New_biaya()
	{

         $i=htmlspecialchars($this->input->post('id_biaya',true));
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
        $pageName=array("helpdesk_update");
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
                                'incident_id' => $dec,
                                'desk' => ucfirst(trim(htmlspecialchars($this->input->post('desk_biaya',true)))),
                                'qty' => trim(htmlspecialchars($this->input->post('qty_biaya',true))),
                                'biaya' => trim(htmlspecialchars($this->input->post('biaya',true))),
                                'user_create' => $user_id,
                                'create_date' =>date("Y-m-d H:i:s")
                            );
                                $this->db->insert('biaya_perbaikan', $data);
        if($this->db->affected_rows() > 0)
                                {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Helpdesk/Update?id= '.$i.'');

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



    

    public function Delete_biaya()
	{

         $i=htmlspecialchars($this->input->post('id_delete_biaya',true));
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
        $pageName=array("helpdesk_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                         $id=htmlspecialchars($this->input->post('id_biaya_delete',true));
        $this->db->where('id', $id);
        $this->db->delete('biaya_perbaikan');
		if($this->db->affected_rows() > 0){
                                
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                            redirect('Helpdesk/Update?id= '.$i.'');

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










    public function Job_order(){
						date_default_timezone_set("Asia/Bangkok");
                      
                        $a1 = htmlspecialchars($this->input->get('id',true));
					
                        $nopol = htmlspecialchars($this->input->get('nopol',true));
		if(empty($a1))
        {
		  $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal Membuat Surat Tugas</div>');
    
                    redirect('Helpdesk');
		}
          
		$id=decrypt_url($a1);
          

                     if($id==false)
   {
		  $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal Membuat Surat Tugas</div>');
    
                    redirect('Helpdesk');
		}


                $this->db->select("A.*,B.username as name_pic,B.jabatan,B1.username as name_pic1,B2.username as usc, C.blok,C.no_unit,C.nama_unit,D.nama,D.jabatan,G.username as manager,G.user_id as gb");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic ','LEFT');
                $this->db->join('user as B1', 'B1.user_id = A.pic1 ','LEFT');
                $this->db->join('user as B2', 'B2.user_id = A.user_create ','LEFT');
                $this->db->join('unit as C', 'C.id = A.id_unit ','LEFT');
                $this->db->join('penghuni as D', 'D.kode = C.penghuni ','LEFT');
             //   $this->db->join('lokasi_kerja as F', 'F.id = A.id_area ','LEFT');
                $this->db->join('user as G', 'G.user_id = A.manager ','LEFT');
                $this->db->where('A.id',$id);
                $this->db->limit(1);
                $surat_tugas = $this->db->get()->result();
             /*    
                $this->db->select('username');
                $query = $this->db->get('table_name');
                $result = $query->row_array(); 
                        $data['manager']=$result['username'];*/
						$data['detail']=$surat_tugas;
						$this->load->library('pdf');
           /*
                        foreach($surat_tugas as $s ){
                        $penghuni= $s->penghuni;
                        $jabatan = $s->jabatan;
                        $petugas1 = $s->name_pic;
                        $petugas2 = $s->name_pic1;
                        $penerima_laporan=  $s->usc;
                        $alamat= "$s->nama_lokasi $s->blok $s->no_unit";

                        }
*/


						$path = 'images/logo/Logo_biru11.png';
						$type = pathinfo($path, PATHINFO_EXTENSION);
						$dt = file_get_contents($path);
						$data['img'] = 'data:image/' . $type . ';base64,' . base64_encode($dt); 
						
					
					
				//	$this->pdf->setPaper('A4', 'landscape');
					
					
					//$this->pdf->filename = "Job Order.pdf";
					$this->pdf->load_view('Report/Job_order', $data);
		//$this->load->view('Report/surat_tugas',$data);

       
					
					
					}









//Approve manager











     public function List_data_manager()
    { 
        
        $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("helpdesk_list");
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
           2=>'E.nama_unit',
            3=>'B.username',
             4=>'A.value_progres', 
             5=>'D.desc_status',  
             6=>'A.tiket'
        
           
           
       
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
                   
        }
        
        if(!empty($search))
        {
            $x=0;
            foreach($valid_columns as $sterm)
            {
                if($x==0)
                {
                    $this->db->like($sterm,$search);
              
                  
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                     
                }
                $x++;
            }                 
        }
                $this->db->limit($length,$start);
              $this->db->select("A.*,B.username as name_pic, C.divisi,D.desc_status,F.username as name_pic1,G.username as name_pic2,E.nama_unit,E.blok,E.no_unit");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.user_create ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->join('unit as E', 'E.id = A.id_unit ','LEFT');
                $this->db->join('user as F', 'F.user_id = A.pic ','LEFT');
                $this->db->join('user as G', 'G.user_id = A.pic1 ','LEFT');
                 $this->db->where('A.manager','');
                 $this->db->where('A.status',5);
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
            else if ($rows->status==5){$label_status="label label-success";}
             else if ($rows->status==6){$label_status="label label-danger";}
           else{$label_status="";}
     $jumlahkarakter=20;
     $cetak = substr($rows->job_detail, 0, $jumlahkarakter);
        $status='<span class="'.$label_status.'">'.$rows->desc_status.'</span>';
        $task_name='<div class="small">
    Rumah   : '.$rows->nama_unit.' '.$rows->blok.' '.$rows->no_unit.'<br>
    Keluhan   : '.$cetak.'<br>
    Petugas 1 : '.$rows->name_pic1.'<br>
    Petugas 2 : '.$rows->name_pic2.'<br>
   
        <i class="fa fa-clock-o"></i> Created '.$rows->create_date.'
        </div>';
        
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

             //  $tiket='<i class="fa fa-ticket"></i> Ticket : <br><small>'. $rows->tiket.'</small><br>
             //  <i class="fa fa-clock-o"></i> Durasi : <br> <small>'.$nilai.'</small>';     
             $tiket=' <i class="fa fa-clock-o"></i> Durasi : <br> <small>'.$nilai.'</small>';                       

            // $tiket='<i class="fa fa-ticket"></i> Ticket : <br><small>'. $rows->tiket.'</small>';
              if ( $rows->status!=5 &&  $rows->status!=6){
                $edit=' <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-toggle="modal" data-target="#cancel" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>

                      <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-job_detail ="'.$rows->job_detail.'"
                      data-note ="'.$rows->note.'"
                       data-name_pic1 ="'.$rows->name_pic1.'"
                        data-pic1 ="'.$rows->pic.'"
                          data-name_pic2 ="'.$rows->name_pic2.'"
                        data-pic2 ="'.$rows->pic1.'"
                         data-type ="'.$rows->type.'"
                   
                     data-toggle="modal" data-target="#update" data-rel="tooltip" title="Edit" ><i style="color:#000060;margin:10px;"  class="fa fa-pencil" ></i></a>';
              }
              else {
             $edit='';
              }                          

  

            $row= array();
          $row[]= $rows->tiket;
              $row[]= $status;
            $row[]= $task_name;
            //'<span class="'.$label_pr.'">'.$rows->type.'</span>';
            $row[]=$rows->pelapor;
            $row[]=$tiket;
            $row[]=$value_progres;       
                  $row[]='<div style="float:right;">
             <a  href="'.base_url('Helpdesk/Update?id=').''.encrypt_url($rows->id).'"><i class="fas fa-eye" style="color:#000060;margin:10px;"> </i>
             
            </a> <a  href="'.base_url('Helpdesk/Surat_tugas?id=').''.encrypt_url($rows->id).'"><i class="fas fa-print" style="color:#000060;margin:10px;"> </i></a>'.$edit.'
             
             </div>';
            $data[]=$row;  
        }


        $totalData = $this->Total_data_approve();
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $totalData,
            "recordsFiltered" => $totalData,
            "data" => $data
        );
        echo json_encode($output);
  
        exit();
    }
    public function Total_data_approve()
    {
      
         $user_id = $this->session->userdata('user_id');
       $this->db->where('manager','');
      //  $this->db->where('user_create',$user_id,'or','pic',$user_id);
        $query = $this->db->select("COUNT(*) as num")->get("schedule_job");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }

















    public function Approve_manager()
	{
           $user_id = $this->session->userdata('user_id');
        $divisi = $this->session->userdata('divisi_id');
        $pageName=array("approve_manager");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
			
                    { 
        //$data['area'] =$this->Model_Helpdesk->List_lokasi();
        //$data['type'] =$this->Model_Helpdesk->Type_incident();
        $data['pic'] =$this->Model_Helpdesk->Pic();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Helpdesk/Approve',$data);	
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







      public function Approve()
	{
        $i=htmlspecialchars($this->input->post('id_approve',true));
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
        $pageName=array("approve_manager");
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
                                 'log_status' => 9,
                                'keterangan' =>"Approve helpdesk",
                                'create_date' =>$time
                            );
                              
                                $update = $this->Model_Helpdesk->Approve($dec,$user_id);
                                if ($update)
                                {
                                      $tambah = $this->Model_Helpdesk->Tambah_comment($data);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Helpdesk/Update?id= '.$i.'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Helpdesk/Update?id= '.$i.'');

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













}