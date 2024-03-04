<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fasilitas extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_fasilitas');
	}
    public function index()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_fasilitas");
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
          $data['list'] = $this->Model_fasilitas->List_data();
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Fasilitas/List',$data);	
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
        $pageName=array("fasilitas_add");
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
                   
                            $cek = $this->db->get_where('fasilitas', ['nama' => $nama])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal tambah data , Nama Fasilitas sudah terdaftar </div>');
                            redirect('Fasilitas');
                        }
                        else
                        {
                           
                            $data = array(
            'nama' => $nama,
            'create_date' =>date("Y-m-d H:i:s"),
            'user_create' => $this->session->userdata('user_id')
        );
                                 $add=$this->db->insert('fasilitas', $data); 
                                 if($this->db->affected_rows($add) > 0){
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di simpan </div>');
                              redirect('Fasilitas');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal input data </div>');
                             redirect('Fasilitas');

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
        $pageName=array("fasilitas_update");
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
                   
                            $cek = $this->db->get_where('fasilitas', ['nama' => $nama])->row_array();
                            if($cek) 
                            {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal update data , Nama Fasilitas sudah terdaftar </div>');
                            redirect('Fasilitas');
                        }
                        else
            {
                               $edit = $this->Model_fasilitas->Edit($id,$nama);
                                if ($edit) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di rubah </div>');
                              redirect('Fasilitas');
                                }
                                else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Gagal rubah data </div>');
                             redirect('Fasilitas');

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
        $pageName=array("fasilitas_delete");
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
                   
                            $Delete = $this->Model_fasilitas->Delete($id);
                                if ($Delete) {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Data berhasil di hapus </div>');
                               redirect('Fasilitas');
                                }
                                else {
                               $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                               role="alert">Gagal hapus data </div>');
                               redirect('Fasilitas');

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



    

	public function Export_nama_fasilitas()
	{ 

             $user_id = $this->session->userdata('user_id');
        $pageName=array("admin_fasilitas");
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
  $listInfo = $this->Model_fasilitas->List_data();
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
    foreach(range('A','C') as $columnID) {
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
            $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    }
	  // set Header
      $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nama Fasilitas');
          $objPHPExcel->getActiveSheet()->getStyle("A1")->applyFromArray($style);
	  $rowCount = 2;
       
	  foreach ($listInfo as $list) {
         
      $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $list->nama);
       $objPHPExcel->getActiveSheet()->getStyle("A".($rowCount))->applyFromArray($style);
       $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $rowCount++;
      }
      
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	  header('Content-Disposition: attachment;filename="List_nama_fasilitas.xlsx"');
	  header('Cache-Control: max-age=0');
	  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	  $objWriter->save('php://output');
    }  
      }




    
}