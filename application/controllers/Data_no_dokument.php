<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_no_dokument extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_no_dokument');
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
        $data['userPermission'] = $userPermission;
        //$data['list'] = $this->Model_no_dokument->List_data();
       // $data['list_type_dokument'] = $this->Model_no_dokument->List_no_dokument();
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Dokument/no_access',$data);	
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
        $pageName=array("admin_bank");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                       
                            $nama =trim(htmlspecialchars($this->input->post('nama_add',true)));
                   
                            $cek = $this->db->get_where('bank', ['nama' => $nama])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal tambah data , Nama bank sudah terdaftar </div>');
                            redirect('Admin/Data_bank');
                        }
                        else
                        {
                           
                            $data = array(
            'nama' => $nama,
            'create_date' =>date("Y-m-d H:i:s"),
            'user_create' => $this->session->userdata('user_id')
        );
                                 $add=$this->db->insert('bank', $data); 
                                 if($this->db->affected_rows($add) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di simpan </div>');
                              redirect('Admin/Data_bank');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal input data </div>');
                             redirect('Admin/Data_bank');

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




    
     public function Edit()
	{
       $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_bank");
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
                   
                            $cek = $this->db->get_where('bank', ['nama' => $nama])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal update data , Nama bank sudah terdaftar </div>');
                            redirect('Admin/Data_bank');
                        }
                        else
            {
                               $edit = $this->Model_dokument->Edit($id,$nama);
                                if ($edit) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di rubah </div>');
                              redirect('Admin/Data_bank');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal rubah data </div>');
                             redirect('Admin/Data_bank');

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

     public function Delete()
	{
       $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_bank");
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
                   
                            $Delete = $this->Model_dokument->Delete($id);
                                if ($Delete) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di rubah </div>');
                              redirect('Admin/Data_bank');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal rubah data </div>');
                             redirect('Admin/Data_bank');

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

?>