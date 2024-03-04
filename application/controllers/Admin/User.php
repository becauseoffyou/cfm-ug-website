<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_user');
	}
    public function index()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_user_list");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['user'] = $this->Model_user->List_user();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Admin/List_user',$data);	
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

     public function Add_User()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_user_add");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['divisi'] = $this->Model_user->List_divisi();
        $data['lokasi_kerja'] = $this->Model_user->List_lokasi();
        $data['type'] = $this->Model_user->List_user_type();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Admin/Add_user',$data);	
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

    public function Add_user_proses()
	{
        $user_id = $this->session->userdata('user_id');
        $nip = trim(htmlspecialchars($this->input->post('nip',true)));
        $pageName=array("admin_user_add");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ $id_lok= htmlspecialchars($this->input->post('lokasi_kerja',true));
                            //$user_id = $this->Model_user->Getkodeuser($id_lok);
                            $cek_user = $this->db->get_where('user', ['user_id' => $nip])->row_array();
                            if($cek_user) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal Create User , Username sudah terdaftar </div>');
                            redirect('Admin/User/Add_User');
                        }
                        else
                        {
                           
                            $data = array(
                                'user_id' => trim(htmlspecialchars($this->input->post('nip',true))),
                                'username' => trim(htmlspecialchars($this->input->post('username_add',true))),
                                'jabatan' => trim(htmlspecialchars($this->input->post('jabatan',true))),
                                'nip' => htmlspecialchars($this->input->post('nip',true)),
                                'telp' => htmlspecialchars($this->input->post('telp',true)),
                                'regional_id' => htmlspecialchars($this->input->post('regional',true)),
                                'divisi_id' => htmlspecialchars($this->input->post('divisi',true)),
                                'lini_bisnis' => htmlspecialchars($this->input->post('lini_bisnis',true)),
                                'lokasi_kerja' => htmlspecialchars($this->input->post('lokasi_kerja',true)),
                                'password' => htmlspecialchars($this->input->post('password_add',true)),
                                'email' => htmlspecialchars($this->input->post('email',true)),
                                'user_type' => htmlspecialchars($this->input->post('user_type',true)),
                                'status' => "1",
                                'create_date' =>date("Y-m-d H:i:s"),
                                'user_create' => $this->session->userdata('user_id')
                            );
                         $tambah = $this->Model_user->Tambah_user($data);
                                if ($tambah)
                                {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">User berhasil di buat. user id anda adalah '.$user_id.' </div>');
                                redirect('Admin/User/Add_User');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal Create User </div>');
                            redirect('Admin/User/Add_User');

                                }
                                
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




    
     public function Edit_User()
	{
        $i=htmlspecialchars($this->input->get('id',true));
        $user=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">User tidak ditemukan</div>');
    
                    redirect('Admin/User');
        }
        if ($user==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">User tidak ditemukan</div>');
    
                    redirect('Admin/User');
        }
        else {



        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_user_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['divisi'] = $this->Model_user->List_divisi();
        $data['lokasi_kerja'] = $this->Model_user->List_lokasi();
        $data['type'] = $this->Model_user->List_user_type();
        $data['user'] = $this->Model_user->Cek_user($user);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Admin/Edit_user',$data);	
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



    
    
     public function Edit_profile()
	{
        $i=htmlspecialchars($this->input->get('id',true));
        $user=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">User tidak ditemukan</div>');
    
                    redirect('Admin/User');
        }
        if ($user==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">User tidak ditemukan</div>');
    
                    redirect('Admin/User');
        }
        else {



        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_user_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
				
        $data['divisi'] = $this->Model_user->List_divisi();
        $data['lokasi_kerja'] = $this->Model_user->List_lokasi();
        $data['type'] = $this->Model_user->List_user_type();
        $data['user'] = $this->Model_user->Cek_user($user);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Admin/Edit_profile',$data);	
        $this->load->view('templates/auth_footer');	
                
        }    
    }

    public function Edit_user_proses()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_user_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                                $user=htmlspecialchars($this->input->post('user_id',true));
                                $username=htmlspecialchars($this->input->post('username',true));
                                $jabatan= trim(htmlspecialchars($this->input->post('jabatan',true)));
                                $nip = htmlspecialchars($this->input->post('nip',true));
                                $telp = htmlspecialchars($this->input->post('telp',true));
                                $email = htmlspecialchars($this->input->post('email',true));
                                $password = htmlspecialchars($this->input->post('password',true));
                                $user_type = htmlspecialchars($this->input->post('user_type',true));
                                $status =htmlspecialchars($this->input->post('status',true));
                                $divisi = htmlspecialchars($this->input->post('divisi',true));
                                $regional = htmlspecialchars($this->input->post('regional',true));
                                $lini_bisnis = htmlspecialchars($this->input->post('lini_bisnis',true));
                                $lokasi_kerja =htmlspecialchars($this->input->post('lokasi_kerja',true));
                                $change_date =date("Y-m-d H:i:s");
                                $user_change = $this->session->userdata('user_id');
                                $edit = $this->Model_user->Edit_user($user,$username,$jabatan,$nip,$telp,$email,$user_type,$password,$status,$divisi,$regional,$lini_bisnis,$lokasi_kerja,$change_date,$user_change);
                                if ($edit)
                                {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">User berhasil di ubah </div>');
                                redirect('Admin/User/Edit_user?id='.encrypt_url($user).'');
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal ubah user </div>');
                            redirect('Admin/User/Edit_user?id='.encrypt_url($user).'');
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



     public function Edit_profile_proses()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_user_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
				
                                $user=htmlspecialchars($this->input->post('user_id',true));
                                $telp = htmlspecialchars($this->input->post('telp',true));
                                $email = htmlspecialchars($this->input->post('email',true));
                                $password = htmlspecialchars($this->input->post('password',true));
                                $change_date =date("Y-m-d H:i:s");
                                $user_change = $this->session->userdata('user_id');
                                $edit = $this->Model_user->Edit_profile($user,$telp,$email,$password);
                                if ($edit)
                                {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">User berhasil di ubah </div>');
                                redirect('Admin/User/Edit_profile?id='.encrypt_url($user).'');
                                }
                                else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                                role="alert">Gagal ubah user </div>');
                                redirect('Admin/User/Edit_profile?id='.encrypt_url($user).'');
                                }
                        	
            
                    
    }


    

                  function Get_regional()
                {
                    $id_divisi=$this->input->post('id_divisi');
                    $data=$this->Model_user->List_regional_sub($id_divisi);
                    echo json_encode($data);


                }

                     function Get_lini_bisnis()
                {
                    $id_divisi=$this->input->post('id_divisi');
                    $data=$this->Model_user->List_lini_bisnis_sub($id_divisi);
                    echo json_encode($data);
                }


    
}