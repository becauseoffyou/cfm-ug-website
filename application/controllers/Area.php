<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area extends CI_Controller {

  public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
        $this->load->model('Model_area');
        $this->load->model('Model_counter');	
	}
    
    public function index()
    {

      $user_id = $this->session->userdata('user_id');
      $pageName=array("area_list");
      $userPermission=array();
      $permission = $this->Model_permission->getUserPermission($user_id);

      foreach($permission as $a)
      {
        $userPermission[] = $a['description'];
      }

      $result=array_intersect($pageName,$userPermission);
            
      if(count($result)>0)      
      { 
          
        $data['data'] = $this->Model_area->List_area();
        /*
        echo '<pre>';
        print_r($data['data']);
        echo '</pre>';
        exit;
        */
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Area/List',$data);	  
        $this->load->view('templates/auth_footer');

      }
      else
      {
          $data['userPermission'] = $userPermission;
          $this->load->view('templates/auth_header');	
          $this->load->view('templates/sidebar_topbar',$data);
          $this->load->view('no_access');	
          $this->load->view('templates/auth_footer');	
      }

    }

      public function Update_area_process()
	{
    $user_id = $this->session->userdata('user_id');  
    $pageName=array("area_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
    {
    $userPermission[] = $a['description'];
		}
    $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
{ 
$id =htmlspecialchars($this->input->post('id',true));
$nama_lokasi =htmlspecialchars($this->input->post('nama_lokasi',true));
$status_aktif =htmlspecialchars($this->input->post('status_aktif',true));
$catatan =htmlspecialchars($this->input->post('catatan',true));
$alamat =htmlspecialchars($this->input->post('alamat',true));
$latitude =htmlspecialchars($this->input->post('latitude',true));
$longitude =htmlspecialchars($this->input->post('longitude',true));
$update = $this->Model_area->Edit_area($user_id,$id,$nama_lokasi,$status_aktif,$catatan,$alamat,$latitude,$longitude);     
if($this->db->affected_rows($update) > 0){
                          $log = array(
                                'id_task' => $id,
                                'user_id' => $user_id,
                                'log_status' => 2,
                                'keterangan' => 'Edit area',
                                'create_date' =>date("Y-m-d H:i:s")
                            );
                               $add_log = $this->Model_area->Add_log($log);
$this->session->set_flashdata('message', '<div class="alert alert-success"role="alert">Success </div>');
                             redirect('Area/Update_area?id='.encrypt_url($id).'');
                                }
                                else {
$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed </div>');
                               redirect('Area/Update_area?id='.encrypt_url($id).'');
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




  public function Add_area()
	{
    $user_id = $this->session->userdata('user_id');
    $pageName=array("area_add");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
    {
    $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['lokasi_kerja'] = $this->Model_area->List_lokasi();
        //$data['status'] = $this->Model_area->Status_Area();
        $data['penghuni'] = $this->Model_area->Penghuni();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Area/Add_area',$data);	
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



     public function New_area_process()
	{
        $user_id = $this->session->userdata('user_id');
        
        $pageName=array("area_add");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
					{ 

$nama_lokasi =htmlspecialchars($this->input->post('nama_lokasi',true));
$keterangan =htmlspecialchars($this->input->post('catatan',true));
$alamat_lengkap =htmlspecialchars($this->input->post('alamat',true));
$latitude =htmlspecialchars($this->input->post('latitude',true));
$longitude =htmlspecialchars($this->input->post('longitude',true));
$tiket=$this->Model_counter->getcodearea();

          $data = array(
            'kode' => $tiket,
            'nama_lokasi' => $nama_lokasi,
            'keterangan' => $keterangan,
            'alamat_lengkap' => $alamat_lengkap,
            'status' => 1,
            'lat' => $latitude,
            'long' => $longitude,
            'user_create' => $this->session->userdata('user_id'),
            'create_date' => date("Y-m-d H:i:s")
        );
        $add=$this->db->insert('lokasi_kerja', $data); 
        $last_id = $this->db->insert_id();
                                 if($this->db->affected_rows($add) > 0){

                          $log = array(
                                'id_task' => $last_id,
                                'user_id' => $user_id,
                                'log_status' => 1,
                                'keterangan' => 'Tambah area',
                                'create_date' =>date("Y-m-d H:i:s")
                            );

                               $add_log = $this->Model_area->Add_log($log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                                redirect('Area/Add_Area');
                            // redirect('Area/Update_area?id='.encrypt_url($last_id).'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Failed </div>');
                             redirect('Area/Add_Area');
                              // redirect('Area/Update_area?id='.encrypt_url($last_id).'');

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





















      public function short()
	{  $id =htmlspecialchars($this->input->get('id',true));
           $user_id = $this->session->userdata('user_id');
       
        $pageName=array("Area_list");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		    }
        $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
         $data['data'] = $this->Model_area->List_Area_short($id);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Area/List',$data);	
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


   



 
     public function Update_area()
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
        $pageName=array("area_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 

        $data['data'] = $this->Model_area->Detail($dec);  
        
        
        $data['lokasi_kerja'] = $this->Model_area->List_lokasi();
        $data['status'] = $this->Model_area->Status_unit();
        $data['penghuni'] = $this->Model_area->Penghuni();
        $data['doc'] = $this->Model_area->Document_area($dec);
        $data['aset'] = $this->Model_area->Aset($dec);
        //$data['data_aset'] = $this->Model_area->Data_aset();
        $data['fasilitas'] = $this->Model_area->Fasilitas($dec);
        $data['data_fasilitas'] = $this->Model_area->Data_fasilitas();
        // $data['fac'] = $this->Model_area->Fasilitas($dec);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Area/Update_area',$data);	
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




     public function Detail_Area()
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
        $pageName=array("area_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['data'] = $this->Model_area->Detail($dec);
        $data['doc'] = $this->Model_area->Document_area($dec);
        $data['aset'] = $this->Model_area->Aset($dec);
        $data['fasilitas'] = $this->Model_area->Fasilitas($dec);
        $data['unit'] = $this->Model_area->Unit($dec);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Area/Detail',$data);	
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




    
      public function Document_add()
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
        $pageName=array("area_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 

        $dok_desc =ucfirst(trim(htmlspecialchars($this->input->post('dok_desc',true))));
        $kd=date('YmdHis');
        $old_name= $_FILES["file"]["name"];
        $file_ext = pathinfo($old_name,PATHINFO_EXTENSION);
        $fileName = "$kd.$file_ext"; 
  if (!empty($_FILES["file"]["name"]))
        {
        $config['upload_path']          = "Doc/file_area/";
        $config['allowed_types']        = 'pdf';
        $config['file_name']            = $fileName;
        $config['max_size']             = 2000;
        $config['overwrite']			= true;
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config);
       $up= $this->upload->do_upload('file');
                           $time=date("Y-m-d H:i:s");
                           $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 1,
                                'keterangan' =>"Upload file: $dok_desc",
                                'create_date' =>$time
                            );
                            $data = array(
                                'unit_id' => $dec,
                                'type' => 1,
                                'nama' => $dok_desc,
                                'user_create' => $user_id,
                                'create_date' =>$time,
                                'file' =>$fileName
                            );



                            
                                if ($up)
                                {     $update =  $this->db->insert('area_file', $data);
                                      $tambah =  $this->db->insert('area_log', $log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Area/Update_area?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Area/Update_area?id= '.$i.'');

                                }
                                
                                     }
        else
        {
       $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Gagal tambah file </div>');
         redirect('Area/Update_area?id= '.$i.'');
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
    
        $pageName=array("area_update");
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
        $hapus = $this->Model_area->Delete_file($id);
        if ($hapus)
                               {
                                unlink("Doc/file_area/".$name);
                          $time=date("Y-m-d H:i:s");
                              $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 3,
                                'keterangan' =>"Delete file: $dok_desc",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('area_log', $log);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data</div>');
                                  redirect('Area/Update_area?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data</div>');
                              redirect('Area/Update_area?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Area/Update_area?id= '.$i.'');
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







    
      public function Img_add()
	{
        $i=htmlspecialchars($this->input->post('id_img',true));
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
        $pageName=array("area_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
    
        $dok_desc =ucfirst(trim(htmlspecialchars($this->input->post('img_desc',true))));
        $kd=date('YmdHis');
        $old_name= $_FILES["file"]["name"];
        $file_ext = pathinfo($old_name,PATHINFO_EXTENSION);
        $fileName = "$kd.$file_ext"; 
  if (!empty($_FILES["file"]["name"]))
        {
        $config['upload_path']          = "Doc/img_area/";
        $config['allowed_types']        = "gif|jpg|png|jpeg";
        $config['file_name']            = $fileName;
        $config['max_size']             = 2000;
        $config['overwrite']			= true;
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config);
       $up= $this->upload->do_upload('file');
                           $time=date("Y-m-d H:i:s");
                           $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 1,
                                'keterangan' =>"Upload img: $dok_desc",
                                'create_date' =>$time
                            );
                            $data = array(
                                'unit_id' => $dec,
                                'type' => 2,
                                'nama' => $dok_desc,
                                'user_create' => $user_id,
                                'create_date' =>$time,
                                'file' =>$fileName
                            );



                            
                                if ($up)
                                {     $update =  $this->db->insert('area_file', $data);
                                      $tambah =  $this->db->insert('area_log', $log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Area/Update_area?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Area/Update_area?id= '.$i.'');

                                }
                                
                                     }
        else
        {
       $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Gagal tambah foto </div>');
         redirect('Area/Update_area?id= '.$i.'');
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







 function Delete_foto()
	{   
        $i=htmlspecialchars($this->input->post('id_delete_foto',true));
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
        $id=htmlspecialchars($this->input->post('id_foto_delete',true));
        $name=htmlspecialchars($this->input->post('name_foto_delete',true));
        $dok_desc=htmlspecialchars($this->input->post('desc_foto_delete',true));
	      $user_id = $this->session->userdata('user_id');
    
        $pageName=array("area_update");
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
        $hapus = $this->Model_area->Delete_file($id);
        if ($hapus)
                               {
                                unlink("Doc/img_area/".$name);
                          $time=date("Y-m-d H:i:s");
                              $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 3,
                                'keterangan' =>"Delete file: $dok_desc",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('area_log', $log);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data</div>');
                                  redirect('Area/Update_area?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data  s</div>');
                              redirect('Area/Update_area?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data  </div>');
                              redirect('Area/Update_area?id= '.$i.'');
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










    
      public function Fasilitas_add()
	{
        $i=htmlspecialchars($this->input->post('id_fasilitas_add',true));
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
        $pageName=array("area_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
 
        $jumlah =htmlspecialchars($this->input->post('jumlah_fasilitas_add',true));
 $fasilitas =htmlspecialchars($this->input->post('fasilitas_unit_add',true));

                           $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 1,
                                'keterangan' =>"Add fasilitas: $fasilitas",
                                'create_date' =>date("Y-m-d H:i:s")
                            );
                            $data = array(
                                'unit_id' => $dec,
                                'fasilitas' => $fasilitas,
                                'jumlah' => $jumlah,
                                'user_create' => $user_id,
                                'create_date' =>date("Y-m-d H:i:s")
                            );



                             $update =  $this->db->insert('area_fasilitas', $data);
                                if ($update)
                                {    
                                      $tambah =  $this->db->insert('area_log', $log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Area/Update_area?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Area/Update_area?id= '.$i.'');

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


    

 function Delete_fasilitas()
	{   
        $i=htmlspecialchars($this->input->post('id_delete_fasilitas',true));
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
        $id=htmlspecialchars($this->input->post('id_fasilitas_delete',true));
	    $user_id = $this->session->userdata('user_id');
    
        $pageName=array("area_update");
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
        $hapus = $this->Model_area->Delete_data_fasilitas($id);
        if ($hapus)
                               {
                             $time=date("Y-m-d H:i:s");
                              $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 3,
                                'keterangan' =>"Delete fasilitas: $id",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('area_log', $log);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data </div>');
                                  redirect('Area/Update_area?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data 2 </div>');
                              redirect('Area/Update_area?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Area/Update_area?id= '.$i.'');
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













































    
      public function Aset_add()
	{
        $i=htmlspecialchars($this->input->post('id_aset_add',true));
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
        $pageName=array("area_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
 
        $nama_aset =htmlspecialchars($this->input->post('nama_aset',true));
        $bagian =htmlspecialchars($this->input->post('bagian',true));
        $nomor_aset =htmlspecialchars($this->input->post('nomor_aset',true));
        $sn =htmlspecialchars($this->input->post('sn',true));
        $jenis =htmlspecialchars($this->input->post('jenis',true));
        $merek =htmlspecialchars($this->input->post('merek',true));
        $bahan =htmlspecialchars($this->input->post('bahan',true));
        $tgl =htmlspecialchars($this->input->post('tgl',true));
        $kondisi =htmlspecialchars($this->input->post('kondisi',true));
        $harga_beli =htmlspecialchars($this->input->post('harga_beli',true));
        $keterangan =htmlspecialchars($this->input->post('keterangan',true));


             $data = array(
                                 'id_area' => $dec,
                                'nama' => $nama_aset,
                                'bagian' => $bagian,
                                'nomor_aset' => $nomor_aset,
                                 'kategori' => $jenis,
                                'merek' => $merek,
                                'bahan' => $bahan,
                                 'nomor_seri' => $sn,
                                'tgl_beli' => $tgl,
                                'kondisi' => $kondisi,
                                 'harga_beli' => $harga_beli,
                                'deskripsi' => $keterangan,
                                'jumlah' => 1,
                                //'file' => 1,
                                'type' => 'area',
                                'status' => 1,
                                'user_create' => $user_id,
                                'create_date' =>date("Y-m-d H:i:s")
                            );
      
        $tambah =  $this->db->insert('aset', $data);
        $last_id = $this->db->insert_id();

                           $time=date("Y-m-d H:i:s");
                           $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 1,
                                'keterangan' =>"Tambah aset  $last_id ",
                                'create_date' =>$time
                            );
                            
                                if ($tambah)
                                {
$this->db->insert('area_log', $log);
       // $kd=date('YmdHis');
        $old_name= $_FILES["file"]["name"];
        $file_ext = pathinfo($old_name,PATHINFO_EXTENSION);
        $fileName = "$last_id.$file_ext"; 
  if (!empty($_FILES["file"]["name"]))
        {
        $config['upload_path']          = "Doc/aset/";
        $config['allowed_types']        = "gif|jpg|png|jpeg";
        $config['file_name']            = $fileName;
        $config['max_size']             = 2000;
        $config['overwrite']			= true;
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config);
        $up= $this->upload->do_upload('file');
        if ($up) {
                $this->db->set('file',$fileName);
                $this->db->where('id',$last_id);
                $this->db->update('aset');

        }
    
      }

                              
                                 
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Area/Update_area?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Area/Update_area?id= '.$i.'');

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


    

 function Delete_aset()
	{   
        $i=htmlspecialchars($this->input->post('id_delete_aset',true));
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
        $id=htmlspecialchars($this->input->post('id_aset_delete',true));
	    $user_id = $this->session->userdata('user_id');
    
        $pageName=array("area_update");
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
        $hapus = $this->Model_area->Delete_data_aset($id);
        if ($hapus)
                               {
                             $time=date("Y-m-d H:i:s");
                              $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 3,
                                'keterangan' =>"Delete aset: $id",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('area_log', $log);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data </div>');
                                  redirect('Area/Update_area?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data 2 </div>');
                              redirect('Area/Update_area?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Area/Update_area?id= '.$i.'');
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
                              
                                $update = $this->Model_area->Edit($dec,$task_name_edit,$task_remarks_edit,$participan_edit,$pr_edit);
                                if ($update)
                                {
                                      $tambah = $this->Model_area->Tambah_comment($data);
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







      
    public function Notif()
    { 
    $i=htmlspecialchars($this->input->get('id',true));
                $this->db->set('ntf',1);
                $this->db->where('id',$i);
                $this->db->update('schedule_job');
    redirect('Area/Update_area?id='.encrypt_url($i).'');
   // var_dump($i);
    }

















}