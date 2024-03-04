<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penghuni extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_penghuni');
          $this->load->model('Model_counter');	
	}
    public function index()
	{
           $user_id = $this->session->userdata('user_id');
       
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
         $data['data'] = $this->Model_penghuni->List_penghuni();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Penghuni/List',$data);	
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


       public function Detail_penghuni()
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
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['data'] = $this->Model_penghuni->Detail($dec);
        $data['kerabat'] = $this->Model_penghuni->Kerabat($dec);
        $data['art'] = $this->Model_penghuni->Art($dec);
        $data['kendaraan'] = $this->Model_penghuni->Kendaraan($dec);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Penghuni/Detail',$data);	
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




       public function Kerabat()
	{
           $user_id = $this->session->userdata('user_id');
       
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
         $data['data'] = $this->Model_penghuni->List_kerabat();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Penghuni/List_kerabat',$data);	
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


         public function Art()
	{
           $user_id = $this->session->userdata('user_id');
       
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
         $data['data'] = $this->Model_penghuni->List_art();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Penghuni/List_art',$data);	
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


         public function Kendaraan()
	{
           $user_id = $this->session->userdata('user_id');
       
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
         $data['data'] = $this->Model_penghuni->List_kendaraan();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Penghuni/List_kendaraan',$data);	
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
    

     public function Tambah_penghuni()
	{
  
 $user_id = $this->session->userdata('user_id');
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0){ 

        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Penghuni/Add',$data);	
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



      public function Penghuni_baru_proses()
	{
        $user_id = $this->session->userdata('user_id');
        
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
					{ 

$nama_penghuni =htmlspecialchars($this->input->post('nama_penghuni',true));
$jk =htmlspecialchars($this->input->post('jk',true));
$jabatan =htmlspecialchars($this->input->post('jabatan',true));
$unit_kerja =htmlspecialchars($this->input->post('unit_kerja',true));
$pasangan =htmlspecialchars($this->input->post('pasangan',true));
$hubungan =htmlspecialchars($this->input->post('hubungan',true));
$anak1 =htmlspecialchars($this->input->post('anak1',true));
$anak2 =htmlspecialchars($this->input->post('anak2',true));
$anak3 =htmlspecialchars($this->input->post('anak3',true));
$anak4 =htmlspecialchars($this->input->post('anak4',true));
$telp =htmlspecialchars($this->input->post('telp',true));
$lama_menetap =htmlspecialchars($this->input->post('lama_menetap',true));




        $tiket=$this->Model_counter->getcodepenghuni();

          $data = array(
            'kode' => $tiket,
            'nama' => $nama_penghuni,
            'jk' => $jk,
            'jabatan' => $jabatan,
            'unit_kerja' => $unit_kerja,
            'pasangan' => $pasangan,
            'hubungan' => $hubungan,
            'anak1' =>$anak1,
            'anak2' =>$anak2,
            'anak3' =>$anak3,
            'anak4' =>$anak4,
            'telp' => $telp,
            'lama_menetap' => $lama_menetap,
            'user_create' => $this->session->userdata('user_id'),
            'create_date' => date("Y-m-d H:i:s")
           
        );
                                  $add=$this->db->insert('penghuni', $data); 
                                   $last_id = $this->db->insert_id();
                                 if($this->db->affected_rows($add) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($tiket).'');
                                }
                                else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                                role="alert">Failed </div>');
                               redirect('Penghuni');

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

     public function Update_penghuni()
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
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['data'] = $this->Model_penghuni->Detail($dec);
        $data['kerabat'] = $this->Model_penghuni->Kerabat($dec);
        $data['art'] = $this->Model_penghuni->Art($dec);
        $data['kendaraan'] = $this->Model_penghuni->Kendaraan($dec);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Penghuni/Update_penghuni',$data);	
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




    
      public function Penghuni_update_proses()
	{
    $user_id = $this->session->userdata('user_id');
    $pageName=array("penghuni_data");
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
$nama_penghuni =htmlspecialchars($this->input->post('nama_penghuni',true));
$jk =htmlspecialchars($this->input->post('jk',true));
$jabatan =htmlspecialchars($this->input->post('jabatan',true));
$unit_kerja =htmlspecialchars($this->input->post('unit_kerja',true));
$pasangan =htmlspecialchars($this->input->post('pasangan',true));
$hubungan =htmlspecialchars($this->input->post('hubungan',true));
$anak1 =htmlspecialchars($this->input->post('anak1',true));
$anak2 =htmlspecialchars($this->input->post('anak2',true));
$anak3 =htmlspecialchars($this->input->post('anak3',true));
$anak4 =htmlspecialchars($this->input->post('anak4',true));
$telp =htmlspecialchars($this->input->post('telp',true));
$lama_menetap =htmlspecialchars($this->input->post('lama_menetap',true));
$status =htmlspecialchars($this->input->post('status',true));

          $data = array(
            //'kode' => $tiket,
            'nama' => $nama_penghuni,
            'jk' => $jk,
            'jabatan' => $jabatan,
            'unit_kerja' => $unit_kerja,
            'pasangan' => $pasangan,
            'hubungan' => $hubungan,
            'anak1' =>$anak1,
            'anak2' =>$anak2,
            'anak3' =>$anak3,
            'anak4' =>$anak4,
            'telp' => $telp,
            'lama_menetap' => $lama_menetap,
            'user_change' => $this->session->userdata('user_id'),
            'change_date' => date("Y-m-d H:i:s"),
             'status' => $status
           
        );
        $this->db->where('kode', $id);
       $updat =  $this->db->update('penghuni', $data);
                                 if($this->db->affected_rows($update) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
                                }
                                else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                                role="alert">Failed </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');

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




    
   

    
      public function Kerabat_add()
	{
        $i=htmlspecialchars($this->input->post('tambah_id_kerabat',true));
        $id=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($id==false)
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
       // $id_penghuni=htmlspecialchars($this->input->post('tambah_id_kerabat',true));
        $nama =htmlspecialchars($this->input->post('tambah_nama_kerabat',true));
        $alamat =htmlspecialchars($this->input->post('tambah_alamat_kerabat',true));
        $telp_rumah =htmlspecialchars($this->input->post('tambah_tel_rumah_kerabat',true));
        $telp =htmlspecialchars($this->input->post('tambah_tel_kerabat',true));
        $hubungan =htmlspecialchars($this->input->post('tambah_hubungan_kerabat',true));
       

             $data = array(     'id_penghuni' => $id,
                                'nama' => $nama,
                                'alamat' => $alamat,
                                'telp_rumah' => $telp_rumah,
                                'telp' => $telp,
                                'hubungan' => $hubungan,
                  
                            );
      
        $tambah =  $this->db->insert('penghuni_kerabat', $data);
  
                              if($this->db->affected_rows($tambah) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
                                }
                                else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                                role="alert">Failed </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');

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


    

 function Delete_kerabat()
	{   
        $i=htmlspecialchars($this->input->post('id_delete_kerabat',true));
        $id=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($id==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $id_delete=htmlspecialchars($this->input->post('id_delete_kerabat1',true));
	       $user_id = $this->session->userdata('user_id');
        $pageName=array("penghuni_data");
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
      
         $this->db->where('id', $id_delete);
        $hapus = $this->db->delete('penghuni_kerabat');
		if($this->db->affected_rows($hapus) > 0){
                        
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data </div>');
                                    redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
                                
                         
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                               redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
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





    

    
      public function Art_add()
	{
        $i=htmlspecialchars($this->input->post('tambah_id_art',true));
        $id=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($id==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $user_id = $this->session->userdata('user_id');
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
   
        $nama =htmlspecialchars($this->input->post('tambah_nama_art',true));
        $alamat =htmlspecialchars($this->input->post('tambah_alamat_kerabat',true));
        $telp_rumah =htmlspecialchars($this->input->post('tambah_tel_rumah_art',true));
        $telp =htmlspecialchars($this->input->post('tambah_tel_art',true));
        $keterangan =htmlspecialchars($this->input->post('tambah_keterangan_art',true));
       

             $data = array(     'id_penghuni' => $id,
                                'nama' => $nama,
                                'alamat' => $alamat,
                                'telp_rumah' => $telp_rumah,
                                'telp_hp' => $telp,
                                'keterangan' => $keterangan,
                  
                            );
      
        $tambah =  $this->db->insert('penghuni_art', $data);
  
                              if($this->db->affected_rows($tambah) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
                                }
                                else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                                role="alert">Failed </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');

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


    

 function Delete_art()
	{   
        $i=htmlspecialchars($this->input->post('id_delete_art',true));
        $id=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($id==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $id_delete=htmlspecialchars($this->input->post('id_delete_art1',true));
	       $user_id = $this->session->userdata('user_id');
        $pageName=array("penghuni_data");
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
      
         $this->db->where('id', $id_delete);
        $hapus = $this->db->delete('penghuni_art');
		if($this->db->affected_rows($hapus) > 0){
                        
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data </div>');
                                    redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
                                
                         
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                               redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
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




    
    
      public function Kendaraan_add()
	{
        $i=htmlspecialchars($this->input->post('tambah_id_kendaraan',true));
        $id=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($id==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $user_id = $this->session->userdata('user_id');
        $pageName=array("penghuni_data");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
   
        $nopol =htmlspecialchars($this->input->post('tambah_no_pol_kend',true));
        $merek =htmlspecialchars($this->input->post('tambah_merek_kend',true));
        $warna =htmlspecialchars($this->input->post('tambah_warna_kend',true));
        $type =htmlspecialchars($this->input->post('tambah_type_kend',true));
         $keterangan =htmlspecialchars($this->input->post('tambah_keterangan_kend',true));
    
       

             $data = array(     'id_penghuni' => $id,
                                'nopol' => $nopol,
                                'merek' => $merek,
                                'warna' => $warna,
                                'type' => $type,
                                'remarks' => $keterangan,
                  
                            );
      
        $tambah =  $this->db->insert('penghuni_kendaraan', $data);
  
                              if($this->db->affected_rows($tambah) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
                                }
                                else {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                                role="alert">Failed </div>');
                                redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');

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


    

 function Delete_kendaraan()
	{   
        $i=htmlspecialchars($this->input->post('id_delete_kendaraan',true));
        $id=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                    redirect('Home');
        }
        if ($id==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $id_delete=htmlspecialchars($this->input->post('id_delete_kendaraan1',true));
	       $user_id = $this->session->userdata('user_id');
        $pageName=array("penghuni_data");
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
      
         $this->db->where('id', $id_delete);
        $hapus = $this->db->delete('penghuni_kendaraan');
		if($this->db->affected_rows($hapus) > 0){
                        
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data </div>');
                                    redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
                                
                         
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                               redirect('Penghuni/Update_penghuni?id='.encrypt_url($id).'');
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
