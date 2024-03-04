<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Unit extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_unit');
          $this->load->model('Model_counter');	
	}
    public function index()
	{
           $user_id = $this->session->userdata('user_id');
       
        $pageName=array("unit_list");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
         $data['data'] = $this->Model_unit->List_unit();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Unit/List',$data);	
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
	{ // $id =htmlspecialchars($this->input->get('id',true));
       $user_id = $this->session->userdata('user_id');
        $i=htmlspecialchars($this->input->get('status',true));
        $id=decrypt_url($i);  

          $area=htmlspecialchars($this->input->get('area',true));
        $area_data=decrypt_url($area);  
        $pageName=array("unit_list");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		    }
        $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
         $data['data'] = $this->Model_unit->List_unit_short($id,$area_data);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Unit/List',$data);	
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


     public function Add_unit()
	{
  
 $user_id = $this->session->userdata('user_id');
        $pageName=array("unit_add");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['lokasi_kerja'] = $this->Model_unit->List_lokasi();
        $data['status'] = $this->Model_unit->Status_unit();
        $data['penghuni'] = $this->Model_unit->Penghuni();
        $data['wilayah'] = $this->Model_unit->Wilayah();
        $data['kondisi'] = $this->Model_unit->Kondisi();
         $data['klasifikasi'] = $this->Model_unit->Klasifikasi();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Unit/Add_unit',$data);	
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



      public function New_unit_process()
	{
        $user_id = $this->session->userdata('user_id');
        
        $pageName=array("unit_add");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
					{ 

//$task_name =ucfirst(trim(htmlspecialchars($this->input->post('task_name',true))));

$lokasi_unit =htmlspecialchars($this->input->post('lokasi_unit',true));
$nama =htmlspecialchars($this->input->post('nama_unit',true));
$blok =htmlspecialchars($this->input->post('blok',true));
$no_unit =htmlspecialchars($this->input->post('no_unit',true));
$status_unit =htmlspecialchars($this->input->post('status_unit',true));
$penghuni =htmlspecialchars($this->input->post('penghuni',true));
$no_sprd =htmlspecialchars($this->input->post('no_sprd',true));
$tgl_sprd =htmlspecialchars($this->input->post('tgl_sprd',true));
$no_bast =htmlspecialchars($this->input->post('no_bast',true));
$tgl_bast =htmlspecialchars($this->input->post('tgl_bast',true));
$catatan =htmlspecialchars($this->input->post('catatan',true));
$alamat_lengkap =htmlspecialchars($this->input->post('alamat_lengkap',true));
$tgl_akhir =htmlspecialchars($this->input->post('tgl_akhir',true));

$type_unit =htmlspecialchars($this->input->post('type_unit',true));


$wilayah =htmlspecialchars($this->input->post('wilayah',true));
$kondisi =htmlspecialchars($this->input->post('kondisi',true));
$masuk =htmlspecialchars($this->input->post('masuk',true));
$keluar =htmlspecialchars($this->input->post('keluar',true));
$tgl_perbaikan =htmlspecialchars($this->input->post('tgl_perbaikan',true));
$nominal_rab =htmlspecialchars($this->input->post('nominal_rab',true));
$nominal_spk =htmlspecialchars($this->input->post('no_spk',true));
$kontraktor =htmlspecialchars($this->input->post('kontraktor',true));
$id_listrik =htmlspecialchars($this->input->post('id_listrik',true));
$id_pam =htmlspecialchars($this->input->post('id_pam',true));
$id_telp =htmlspecialchars($this->input->post('id_telp',true));
$internet_1 =htmlspecialchars($this->input->post('internet_1',true));
$internet_2 =htmlspecialchars($this->input->post('internet_2',true));
$internet_3 =htmlspecialchars($this->input->post('internet_3',true));
$internet_4 =htmlspecialchars($this->input->post('internet_4',true));
$daya_listrik =htmlspecialchars($this->input->post('daya_listrik',true));
$hak_menempati =htmlspecialchars($this->input->post('hak_penempatan',true));
$klasifikasi =htmlspecialchars($this->input->post('klasifikasi',true));



        $tiket=$this->Model_counter->getcodeunit();

          $data = array(
            'kode' => $tiket,
             'id_lok' => $lokasi_unit,
            'nama_unit' => $nama,
            'blok' => $blok,
            'no_unit' => $no_unit,
            'status' => $status_unit,
            'penghuni' => $penghuni,
            'dok' =>$no_sprd,
            'tgl_dok' => $tgl_sprd,
            'no_bast' => $no_bast,
            'tgl_bast' => $tgl_bast,
            'wilayah' => $wilayah,
            'kondisi' => $kondisi,
            'masuk' => $masuk,
            'keluar' => $keluar,
            'tgl_perbaikan' => $tgl_perbaikan,
            'nominal_rab' => $nominal_rab,
            'nominal_spk' =>$nominal_spk,
            'kontraktor' => $kontraktor,
            'id_listrik' => $id_listrik,
            'id_pam' => $id_pam,
             'id_telp' => $id_telp,
            'id_internet1' => $internet_1,
            'id_internet2' => $internet_2,
            'id_internet3' => $internet_3,
            'id_internet4' => $internet_4,
            'daya_listrik' => $daya_listrik,
            'hak_menempati' =>$hak_menempati,
            'klasifikasi' => $klasifikasi,
            'keterangan' => $catatan,
            //'akhir_kontrak' => $tgl_akhir,
            'user_create' => $this->session->userdata('user_id'),
            'create_date' => date("Y-m-d H:i:s"),
            'alamat_lengkap' => $alamat_lengkap,
            'status_unit' => 1,
            'type' =>$type_unit
        );
        $add=$this->db->insert('unit', $data); 
                                   $last_id = $this->db->insert_id();
                                 if($this->db->affected_rows($add) > 0){

                          $log = array(
                                'id_task' => $last_id,
                                'user_id' => $user_id,
                                 'log_status' => 1,
                                'keterangan' => $catatan,
                                'create_date' =>date("Y-m-d H:i:s")
                            );

                               $add_log = $this->Model_unit->Add_log($log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                             redirect('Unit/Update_unit?id='.encrypt_url($last_id).'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Failed </div>');
                               redirect('Unit/Update_unit?id='.encrypt_url($last_id).'');

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

     public function Update_unit()
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
        $pageName=array("unit_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['lokasi_kerja'] = $this->Model_unit->List_lokasi();
        $data['status'] = $this->Model_unit->Status_unit();
        $data['penghuni'] = $this->Model_unit->Penghuni();
        $data['data'] = $this->Model_unit->Detail($dec);
        $data['doc'] = $this->Model_unit->Document_unit($dec);
        $data['aset'] = $this->Model_unit->Aset($dec);
        $data['data_aset'] = $this->Model_unit->Data_aset();
         $data['fasilitas'] = $this->Model_unit->Fasilitas($dec);
        $data['data_fasilitas'] = $this->Model_unit->Data_fasilitas();

             $data['wilayah'] = $this->Model_unit->Wilayah();
        $data['kondisi'] = $this->Model_unit->Kondisi();
         $data['klasifikasi'] = $this->Model_unit->Klasifikasi();
        // $data['fac'] = $this->Model_unit->Fasilitas($dec);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Unit/Update_unit',$data);	
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




     public function Detail_unit()
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
        $pageName=array("unit_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
      $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $data['lokasi_kerja'] = $this->Model_unit->List_lokasi();
        $data['status'] = $this->Model_unit->Status_unit();
        $data['penghuni'] = $this->Model_unit->Penghuni();
        $data['data'] = $this->Model_unit->Detail($dec);
        $data['doc'] = $this->Model_unit->Document_unit($dec);
        $data['aktifitas'] = $this->Model_unit->Aktifitas_unit($dec);
        $data['aset'] = $this->Model_unit->Aset($dec);
        $data['fasilitas'] = $this->Model_unit->Fasilitas($dec);


    


        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Unit/Detail',$data);	
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
        $pageName=array("unit_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
                    /*
 $path = "Doc/$divisi";
    if(!is_dir($path)) //create the folder if it's not exists
    {
      mkdir($path,0755,TRUE);
    } 
    */
        $dok_desc =ucfirst(trim(htmlspecialchars($this->input->post('dok_desc',true))));
        $kd=date('YmdHis');
        $old_name= $_FILES["file"]["name"];
        $file_ext = pathinfo($old_name,PATHINFO_EXTENSION);
        $fileName = "$kd.$file_ext"; 
  if (!empty($_FILES["file"]["name"]))
        {
        $config['upload_path']          = "Doc/file_unit/";
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
                                {     $update =  $this->db->insert('unit_file', $data);
                                      $tambah =  $this->db->insert('unit_log', $log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Unit/Update_unit?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Unit/Update_unit?id= '.$i.'');

                                }
                                
                                     }
        else
        {
       $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Gagal tambah file </div>');
         redirect('Unit/Update_unit?id= '.$i.'');
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
    
        $pageName=array("unit_update");
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
        $hapus = $this->Model_unit->Delete_file($id);
        if ($hapus)
                               {
                                unlink("Doc/file_unit/".$name);
                          $time=date("Y-m-d H:i:s");
                              $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 3,
                                'keterangan' =>"Delete file: $dok_desc",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('unit_log', $log);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data</div>');
                                  redirect('Unit/Update_unit?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data 2 </div>');
                              redirect('Unit/Update_unit?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Unit/Update_unit?id= '.$i.'');
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
        $i=htmlspecialchars($this->input->post('id_unit_add',true));
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
           $id_area=htmlspecialchars($this->input->post('id_area_add',true));
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


             $data = array(       'id_unit' => $dec,
                                 'id_area' => $id_area,
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
$this->db->insert('unit_log', $log);
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
                                 redirect('Unit/Update_unit?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Unit/Update_unit?id= '.$i.'');

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
    
        $pageName=array("unit_update");
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
        $pageName=array("unit_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
				{ 
                    /*
 $path = "Doc/$divisi";
    if(!is_dir($path)) //create the folder if it's not exists
    {
      mkdir($path,0755,TRUE);
    } 
    */
        $dok_desc =ucfirst(trim(htmlspecialchars($this->input->post('img_desc',true))));
        $kd=date('YmdHis');
        $old_name= $_FILES["file"]["name"];
        $file_ext = pathinfo($old_name,PATHINFO_EXTENSION);
        $fileName = "$kd.$file_ext"; 
  if (!empty($_FILES["file"]["name"]))
        {
        $config['upload_path']          = "Doc/img_unit/";
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
                                {     $update =  $this->db->insert('unit_file', $data);
                                      $tambah =  $this->db->insert('unit_log', $log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Unit/Update_unit?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Unit/Update_unit?id= '.$i.'');

                                }
                                
                                     }
        else
        {
       $this->session->set_flashdata('message', '<div class="alert alert-danger" 
        role="alert">Gagal tambah foto </div>');
         redirect('Unit/Update_unit?id= '.$i.'');
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
    
        $pageName=array("unit_update");
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
        $hapus = $this->Model_unit->Delete_file($id);
        if ($hapus)
                               {
                                unlink("Doc/img_unit/".$name);
                          $time=date("Y-m-d H:i:s");
                              $log = array(
                                'id_task' => $dec,
                                'user_id' => $user_id,
                                'log_status' => 3,
                                'keterangan' =>"Delete file: $dok_desc",
                                'create_date' =>$time
                            );
                              $input =$this->db->insert('unit_log', $log);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data</div>');
                                  redirect('Unit/Update_unit?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data 2 </div>');
                              redirect('Unit/Update_unit?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Unit/Update_unit?id= '.$i.'');
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
                              
                                $update = $this->Model_unit->Edit($dec,$task_name_edit,$task_remarks_edit,$participan_edit,$pr_edit);
                                if ($update)
                                {
                                      $tambah = $this->Model_unit->Tambah_comment($data);
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





 /*

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
             <a href="'.base_url('Unit/Update_unit?id=').''.encrypt_url($rows->id).'"><i class="fas fa-eye" style="color:#000060;"></i></a> '.$edit.'
             
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
*/



      
    public function Notif()
    { 
    $i=htmlspecialchars($this->input->get('id',true));
                $this->db->set('ntf',1);
                $this->db->where('id',$i);
                $this->db->update('schedule_job');
    redirect('Unit/Update_unit?id='.encrypt_url($i).'');
   // var_dump($i);
    }








      public function Update_unit_process()
	{
        $user_id = $this->session->userdata('user_id');
        
    $pageName=array("unit_update");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
		if(count($result)>0)
					{ 

//$task_name =ucfirst(trim(htmlspecialchars($this->input->post('task_name',true))));
$id =htmlspecialchars($this->input->post('id',true));
$nama =htmlspecialchars($this->input->post('nama_unit',true));
$lokasi_unit =htmlspecialchars($this->input->post('lokasi_unit',true));
$blok =htmlspecialchars($this->input->post('blok',true));
$no_unit =htmlspecialchars($this->input->post('no_unit',true));
$status_unit =htmlspecialchars($this->input->post('status_unit',true));
$penghuni =htmlspecialchars($this->input->post('penghuni',true));
$no_sprd =htmlspecialchars($this->input->post('no_sprd',true));
$tgl_sprd =htmlspecialchars($this->input->post('tgl_sprd',true));
$no_bast =htmlspecialchars($this->input->post('no_bast',true));
$tgl_bast =htmlspecialchars($this->input->post('tgl_bast',true));
$catatan =htmlspecialchars($this->input->post('catatan',true));
$alamat_lengkap =htmlspecialchars($this->input->post('alamat_lengkap',true));
$tgl_akhir =htmlspecialchars($this->input->post('tgl_akhir',true));
$status_aktif =htmlspecialchars($this->input->post('status_aktif',true));

$wilayah =htmlspecialchars($this->input->post('wilayah',true));
$kondisi =htmlspecialchars($this->input->post('kondisi',true));
$masuk =htmlspecialchars($this->input->post('masuk',true));
$keluar =htmlspecialchars($this->input->post('keluar',true));
$tgl_perbaikan =htmlspecialchars($this->input->post('tgl_perbaikan',true));
$nominal_rab =htmlspecialchars($this->input->post('nominal_rab',true));
$nominal_spk =htmlspecialchars($this->input->post('no_spk',true));
$kontraktor =htmlspecialchars($this->input->post('kontraktor',true));
$id_listrik =htmlspecialchars($this->input->post('id_listrik',true));
$id_pam =htmlspecialchars($this->input->post('id_pam',true));
$id_telp =htmlspecialchars($this->input->post('id_telp',true));
$internet_1 =htmlspecialchars($this->input->post('internet_1',true));
$internet_2 =htmlspecialchars($this->input->post('internet_2',true));
$internet_3 =htmlspecialchars($this->input->post('internet_3',true));
$internet_4 =htmlspecialchars($this->input->post('internet_4',true));
$daya_listrik =htmlspecialchars($this->input->post('daya_listrik',true));
$hak_menempati =htmlspecialchars($this->input->post('hak_penempatan',true));
$klasifikasi =htmlspecialchars($this->input->post('klasifikasi',true));
$type_unit =htmlspecialchars($this->input->post('type_unit',true));

$update = $this->Model_unit->Edit_unit($id,$nama,$lokasi_unit,$blok,$no_unit,$status_unit,$penghuni,$no_sprd,$tgl_sprd,$no_bast,$tgl_bast,$catatan,$alamat_lengkap,$status_aktif,
        $wilayah,$kondisi,$masuk,$keluar,$tgl_perbaikan,$nominal_rab,$nominal_spk,$kontraktor,$id_listrik,$id_pam,$id_telp,$internet_1,$internet_2,$internet_3,$internet_4,$daya_listrik,$hak_menempati,$klasifikasi,$type_unit
);
     
      
                                 if($this->db->affected_rows($update) > 0){

                        
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Success </div>');
                             redirect('Unit/Update_unit?id='.encrypt_url($id).'');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Failed </div>');
                               redirect('Unit/Update_unit?id='.encrypt_url($id).'');

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
        $pageName=array("unit_update");
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



                             $update =  $this->db->insert('unit_fasilitas', $data);
                                if ($update)
                                {    
                                      $tambah =  $this->db->insert('unit_log', $log);
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil</div>');
                                 redirect('Unit/Update_unit?id= '.$i.'');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Unit/Update_unit?id= '.$i.'');

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
    
        $pageName=array("unit_update");
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
        $hapus = $this->Model_unit->Delete_data_fasilitas($id);
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
                              $input =$this->db->insert('unit_log', $log);
                              if($input) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Berhasil hapus data </div>');
                                  redirect('Unit/Update_unit?id= '.$i.'');
                                }
                                  else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data 2 </div>');
                              redirect('Unit/Update_unit?id= '.$i.'');
                                }	
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                              redirect('Unit/Update_unit?id= '.$i.'');
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





    

 function Import_unit()
	{

$type = htmlspecialchars($this->input->post('type_1',true));
$problem= htmlspecialchars($this->input->post('problem_id_1',true));
 $contact_name = htmlspecialchars($this->input->post('pic_1',true));
        $contact_no = htmlspecialchars($this->input->post('pic_info_1',true));
$user_id = $this->session->userdata('user_id');	        
        $this->load->library('Excel');
        if(isset($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=2; $row<=$highestRow; $row++)
				{  
                $idatm = trim($worksheet->getCellByColumnAndRow(0, $row)->getValue());
   $cek = $this->db->query("SELECT koordinator,location_name,fe,bank from atm WHERE atm_id = '$idatm' AND  active='1'");
   $cek_array= $cek->result_array();
   $cek_row= $cek->num_rows();
    if ($cek_row > 0) {

        if ($type == "CM")
        {
        $tiket=$this->Model_counter->getcodecm();;
        }
        else if ($type == "PM")

        {
            $tiket=$this->Model_counter->getcodepm(); 
        }

         else if ($type == "UP")

        {
            $tiket=$this->Model_counter->getcodeup(); 
        }


         else if ($type == "OT")

        {
            $tiket=$this->Model_counter->getcodeot(); 
        }
  

     foreach($cek_array as $kr){
        $lokasi= $kr['location_name'];
        $fe= $kr['fe']; 
        $bank= $kr['bank']; 
        $koordinator= $kr['koordinator']; 
    }
                 $data[0] = array(
                'type' => $type,
                'incident_no' => $tiket,
                'bank' => $bank,
                'atm_id' => $idatm,
                'lokasi' =>  $lokasi,
                'report_date' => date("Y-m-d"),
                'report_by' => '',
                'contact_report' => '',
                'pic' => $contact_name,
                'pic_tlp' => $contact_no,
                'problem_id' => $problem,
                'remarks' => '',
                 'koordinator' => $koordinator,
                'fe' => $fe,
                'status' => 0,
                'user_create' => $user_id,
                'create_date' => date("Y-m-d H:i:s")
            );
                     $upload=$this->db->insert_batch('incident', $data);
                      $insert_id = $this->db->insert_id($upload);
                   if ($upload)
                          {
                        $data1[0] = array(
                        'incident_id' => $insert_id,
                        'status' => 0,
                        'note' => 'Import Incident',
                        'user_id' => $user_id,
                        'create_date' => date("Y-m-d H:i:s")
                    );
                     $this->db->insert_batch('incident_log', $data1);
                            echo "Data $idatm Imported successfully \n";   
                          }
                          else{
                            echo "Failed Imported $idatm \n"; 
                          } 


 } else
                                {

                            echo "Failed Imported $idatm tidak terdaftar \n"; 
                          
				}




                
            }
         
			
        }
	
		}




}









public function Export_temp()
	{ 
	  // load excel library
  $this->load->library('Excel');
  $listInfo = $this->Model_unit->List_unit();
  $objPHPExcel = new PHPExcel();
  $objPHPExcel->setActiveSheetIndex(0);

    $style = array(
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
            )
            ),
            'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));
    //untuk auto size colomn
    foreach(range('A','AF') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1:AF1')->getFont()->setBold(true);
    }
	  // set Header
      $objPHPExcel->getActiveSheet()->getStyle('A1:AF1')->getFont()->setBold(true);
      $objPHPExcel->getActiveSheet()->getStyle('A1:AF1')->applyFromArray($style);
      $objPHPExcel->getActiveSheet()->setCellValue('A1', 'KODE AREA');
      $objPHPExcel->getActiveSheet()->setCellValue('B1', 'NAMA AREA');
      $objPHPExcel->getActiveSheet()->setCellValue('C1', 'KODE UNIT');
       $objPHPExcel->getActiveSheet()->setCellValue('D1', 'NAMA UNIT');
      $objPHPExcel->getActiveSheet()->setCellValue('E1', 'BLOK'); 
      $objPHPExcel->getActiveSheet()->setCellValue('F1', 'NO UNIT'); 
      $objPHPExcel->getActiveSheet()->setCellValue('G1', 'NAMA PENGHUNI');
      $objPHPExcel->getActiveSheet()->setCellValue('H1', 'NO SPRD');
      $objPHPExcel->getActiveSheet()->setCellValue('I1', 'TANGGAL SPRD'); 
      $objPHPExcel->getActiveSheet()->setCellValue('J1', 'NO BAST'); 
      $objPHPExcel->getActiveSheet()->setCellValue('K1', 'TANGGAL BAST');
      $objPHPExcel->getActiveSheet()->setCellValue('L1', 'WILAYAH');
      $objPHPExcel->getActiveSheet()->setCellValue('M1', 'KONDISI'); 
      $objPHPExcel->getActiveSheet()->setCellValue('N1', 'TANGGAL MASUK'); 
      $objPHPExcel->getActiveSheet()->setCellValue('O1', 'TANGGAL KELUAR'); 
      $objPHPExcel->getActiveSheet()->setCellValue('P1', 'TANGGAL PERBAIKAN');
      $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'NOMINAL RAB');
      $objPHPExcel->getActiveSheet()->setCellValue('R1', 'NOMINAL SPK'); 
      $objPHPExcel->getActiveSheet()->setCellValue('S1', 'KONTRAKTOR'); 
      $objPHPExcel->getActiveSheet()->setCellValue('T1', 'ID LISTRIK');
      $objPHPExcel->getActiveSheet()->setCellValue('U1', 'ID PAM');
      $objPHPExcel->getActiveSheet()->setCellValue('V1', 'ID TELP');
      $objPHPExcel->getActiveSheet()->setCellValue('W1', 'ID INTERNET 1');
      $objPHPExcel->getActiveSheet()->setCellValue('X1', 'ID INTERNET 2');
      $objPHPExcel->getActiveSheet()->setCellValue('Y1', 'ID INTERNET 3');
      $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'ID INTERNET 4');
      $objPHPExcel->getActiveSheet()->setCellValue('AA1', 'DAYA LISTRIK');
      $objPHPExcel->getActiveSheet()->setCellValue('AB1', 'HAK MENEMPATI');
      $objPHPExcel->getActiveSheet()->setCellValue('AC1', 'KLASIFIKASI');
      $objPHPExcel->getActiveSheet()->setCellValue('AD1', 'KETERANGAN');
      $objPHPExcel->getActiveSheet()->setCellValue('AE1', 'ALAMAT LENGKAP');
      $objPHPExcel->getActiveSheet()->setCellValue('AF1', 'STATUS UNIT');
	  // set Row
	  $rowCount = 2;
	  foreach ($listInfo as $list) {
      
        $objPHPExcel->getActiveSheet()->getStyle("A".($rowCount).":AF".($rowCount))->applyFromArray($style);
          $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $list->kode_area);
             $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $list->nama_lokasi);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $list->kode);
                 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $list->nama_unit);
          $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $list->blok);
          $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $list->no_unit);
          $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $list->nama_penghuni);
          $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $list->dok);
          $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $list->tgl_dok);
          $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $list->no_bast);
          $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $list->tgl_bast);
          $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $list->wilayah);
          $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $list->kondisi);
          $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $list->masuk);
          $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $list->keluar);
          $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $list->tgl_perbaikan);
          $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, $list->nominal_rab);
          $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, $list->nominal_spk);
          $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, $list->kontraktor);
          $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, $list->id_listrik);
          $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, $list->id_pam);
          $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, $list->id_telp);
          $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, $list->id_internet1);
          $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, $list->id_internet2);
          $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowCount, $list->id_internet3);
          $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowCount, $list->id_internet4);
          $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$rowCount, $list->daya_listrik);
          $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$rowCount, $list->hak_menempati);
          $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$rowCount, $list->klasifikasi);
          $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$rowCount, $list->keterangan);
          $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$rowCount, $list->alamat_lengkap);
          $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$rowCount, $list->status_detail);
          
		  $rowCount++;
      }
      
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	  header('Content-Disposition: attachment;filename="Data Unit.xlsx"');
	  header('Cache-Control: max-age=0');
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save('php://output');  
      }





















}
