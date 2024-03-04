<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Aset extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_aset');
	}
    public function index()
	{  

        $i=htmlspecialchars($this->input->get('unit',true));
        $unit=decrypt_url($i);
 
        if (!empty($i) && $unit==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_aset");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
				if(count($result)>0)
					{
                        
        //$unit=htmlspecialchars($this->input->get('unit',true));
        $area=htmlspecialchars($this->input->get('area',true));            
        $data['userPermission'] = $userPermission;
        
        $data['data_unit'] = $unit;
        $data['data_area'] = $area;
        $data['list'] = $this->Model_aset->List_data($unit,$area);
        $data['area'] = $this->Model_aset->List_lokasi();
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Aset/List',$data);	
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
 

    public function Tambah()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("aset_add");
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
                   
                            $cek = $this->db->get_where('aset', ['nama' => $nama])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal tambah data , Nama Aset sudah terdaftar </div>');
                            redirect('Aset');
                        }
                        else
                        {
                           
                            $data = array(
            'nama' => $nama,
            'create_date' =>date("Y-m-d H:i:s"),
            'user_create' => $this->session->userdata('user_id')
        );
                                 $add=$this->db->insert('aset', $data); 
                                 if($this->db->affected_rows($add) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di simpan </div>');
                              redirect('Aset');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal input data </div>');
                             redirect('Aset');

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
        $pageName=array("aset_update");
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
                   
                            $cek = $this->db->get_where('aset', ['nama' => $nama])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal update data , Nama Aset sudah terdaftar </div>');
                            redirect('Aset');
                        }
                        else
            {
                               $edit = $this->Model_aset->Edit($id,$nama);
                                if ($edit) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di rubah </div>');
                              redirect('Aset');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal rubah data </div>');
                             redirect('Aset');

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
        $pageName=array("aset_delete");
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
                   
                            $Delete = $this->Model_aset->Delete($id);
                                if ($Delete) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di hapus </div>');
                              redirect('Aset');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal hapus data </div>');
                             redirect('Aset');

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



    

	public function Export_aset()
	{     $i=htmlspecialchars($this->input->get('unit',true));
        $unit=decrypt_url($i);
 
        if (!empty($i) && $unit==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Data tidak ditemukan</div>');
    
                  redirect('Home');
        }
        else {

             $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_aset");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
				if(count($result)>0)
					{ 

	  // load excel library
  $this->load->library('Excel');
  //$unit=htmlspecialchars($this->input->get('unit',true));
        $area=htmlspecialchars($this->input->get('area',true));           
        $listInfo = $this->Model_aset->List_data($unit,$area);
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
foreach(range('A','P') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}

$objPHPExcel->getActiveSheet()->getStyle('A1:P2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:P2')->applyFromArray($style);
	  // set Header
 $objPHPExcel->getActiveSheet()->mergeCells('A1:A2');
 $objPHPExcel->getActiveSheet()->setCellValue('A1', 'No');
  $objPHPExcel->getActiveSheet()->mergeCells('B1:B2');
 $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Group');
  $objPHPExcel->getActiveSheet()->mergeCells('C1:C2');
 $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Unit');
  $objPHPExcel->getActiveSheet()->mergeCells('D1:D2');
 $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Nama Aset');
  $objPHPExcel->getActiveSheet()->mergeCells('E1:E2');
 $objPHPExcel->getActiveSheet()->setCellValue('E1', 'Bagian Rumah Dinas');
  $objPHPExcel->getActiveSheet()->mergeCells('F1:F2');
 $objPHPExcel->getActiveSheet()->setCellValue('F1', 'Kode Barang Mandiri');
  $objPHPExcel->getActiveSheet()->mergeCells('G1:J1');
 $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Uraian Barang');
 $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Jenis');
 $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Merek');
 $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Type/Bahan');
 $objPHPExcel->getActiveSheet()->setCellValue('J2', 'Jumlah');
  $objPHPExcel->getActiveSheet()->mergeCells('K1:K2');
 $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Kondisi Fisik');
  $objPHPExcel->getActiveSheet()->mergeCells('L1:L2');
 $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Tahun Perolehan');
  $objPHPExcel->getActiveSheet()->mergeCells('M1:M2');
 $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Foto');
  $objPHPExcel->getActiveSheet()->mergeCells('N1:N2');
 $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Keterangan');
   $objPHPExcel->getActiveSheet()->mergeCells('O1:O2');
 $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Nomor Seri');
  $objPHPExcel->getActiveSheet()->mergeCells('P1:P2');
 $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Harga Beli');
       
	  $rowCount = 3;
       $no=1;
	  foreach ($listInfo as $list) {
        $da="$list->nama_unit  $list->blok $list->no_unit ";
         
      $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $no);
      $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $list->nama_lokasi);
      $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $da);
      $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $list->nama);
      $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $list->bagian);
      $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $list->nomor_aset);
      $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $list->kategori);
      $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $list->merek);
      $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $list->bahan);
      $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $list->jumlah);
      $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $list->kondisi);
      $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $list->tgl_beli);
      $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, '');
      $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $list->deskripsi);
      $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $list->nomor_seri);
      $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $list->harga_beli);
      $objPHPExcel->getActiveSheet()->getStyle("P".($rowCount))->getNumberFormat()->setFormatCode('#,##0'); 
      $objPHPExcel->getActiveSheet()->getStyle("P".($rowCount))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
              $objPHPExcel->getActiveSheet()->getStyle("A".($rowCount).":P".($rowCount))->applyFromArray($style);
 
      $rowCount++;
      $no++;
      }
      
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	  header('Content-Disposition: attachment;filename="Report_aset.xlsx"');
	  header('Cache-Control: max-age=0');
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save('php://output');  
    }
}
      }



          function Unit_data()
                {
                    $type=$this->input->post('area');
                    $data_unit=$this->Model_aset->Unit_data($type);
                    $data=array();
                    //var_dump($data_unit);
                    foreach($data_unit as $d){
                        $data['blok']= $d->blok;
                        $data['id']= encrypt_url($d->id);
                        $data['no_unit']= $d->no_unit;
                        $data['nama_unit']= $d->nama_unit;
                        $res['data'][] = $data;
                    }
                    echo json_encode($res);
                   
				}













                
    
      public function Aset_unit_add()
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
                  //  $dec=htmlspecialchars($this->input->post('id_unit_add',true));
                   // var_dump($dec);
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
                                 redirect('Aset');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Aset');

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



    public function Aset_area_add()
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
                   $dec=htmlspecialchars($this->input->post('id_unit_add',true));
                   // var_dump($dec);
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


             $data = array(      // 'id_unit' => $dec,
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
                                 redirect('Aset');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal </div>');
                             redirect('Aset');

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