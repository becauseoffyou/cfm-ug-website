<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_permission extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_user_permission');
	}
    public function index()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_permission");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
				if(count($result)>0)
					{ 
        $data['userPermission'] = $userPermission;
           $data['type'] = $this->Model_user_permission->Type();
          $data['permission'] = $this->Model_user_permission->Permission();
          $data['list'] = $this->Model_user_permission->List_data();
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Permission/List',$data);	
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

 

    public function Tambah()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_permission");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                       
                            $id =trim(htmlspecialchars($this->input->post('id',true)));
                            $type =trim(htmlspecialchars($this->input->post('user_type',true)));
                            $cek = $this->db->get_where('user_permission', ['user_type' => $type,
                            'permission_id' => $id,
                            ])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal tambah data , Nama Permission sudah terdaftar </div>');
                            redirect('Admin/Data_permission');
                        }
                        else
                        {
                           
                            $data = array(
                                'user_type' => $type,
            'permission_id' => $id,
            'create_date' =>date("Y-m-d H:i:s"),
            'user_create' => $this->session->userdata('user_id')
        );
                                 $add=$this->db->insert('user_permission', $data); 
                                 if($this->db->affected_rows($add) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di simpan </div>');
                              redirect('Admin/Data_permission');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal input data </div>');
                             redirect('Admin/Data_permission');

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


/*

    
     public function Edit()
	{
       $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_permission");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                       
                            $nama =trim(htmlspecialchars($this->input->post('nama_edit',true)));
                            $id =trim(htmlspecialchars($this->input->post('id_edit',true)));
                   
                            $cek = $this->db->get_where('Permission', ['nama' => $nama])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal update data , Nama Permission sudah terdaftar </div>');
                            redirect('Admin/Data_permission');
                        }
                        else
            {
                               $edit = $this->Model_user_permission->Edit($id,$nama);
                                if ($edit) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di rubah </div>');
                              redirect('Admin/Data_permission');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal rubah data </div>');
                             redirect('Admin/Data_permission');

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
*/
    

    public function Delete()
	{
       $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_permission");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                       
                           
                            $id =trim(htmlspecialchars($this->input->post('id_delete',true)));
                   
                            $Delete = $this->Model_user_permission->Delete($id);
                                if ($Delete) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di hapus </div>');
                              redirect('Admin/Data_permission');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                             redirect('Admin/Data_permission');

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