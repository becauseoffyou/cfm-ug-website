<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ini_set('memory_limit', '-1');
class Export_import extends CI_Controller
{
	public function __construct()
	{
        date_default_timezone_set("Asia/Jakarta");
		parent::__construct();
       // $this->load->model('ATM_M/MATM');
        //$this->load->model('Mode_export_import/Model_export_import_atm');
          $this->load->model('Model_permission');
         $this->load->model('Model_user');
           $this->load->model('Model_counter');	
        $this->load->library('Excel');
	}

	function index()
	{

	}
    function Import_user()
	{
        $dat = date("Y-m-d");
      $us_id =  $this->session->userdata('user_id');
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
                    
                    $nama = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $area = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $jabatan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $telp = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $pass = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $email = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $type = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                 $user_id = $worksheet->getCellByColumnAndRow(7, $row)->getValue();

                    //$user_id = $this->Model_user->Getkodeuser($area);

                    if(!is_numeric($telp))
                    {
                    echo "Data telpon pada baris ID $nama tidak valid \n"; 
                    $telp = "0";
                    }
                  
                 /*   else if 
                    (!preg_match("/^[a-zA-Z-' ]*$/",$area)) {
                        echo "Data user id $user_id tidak valid \n"; 
                        $user_id = trim($user_id);
                      }

                      else if 
                      (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "Data email pada baris ID $user_id tidak valid \n";
                        $email = "null";
                      }
*/



                    $count2  = $this->db->query("SELECT user_id FROM user where user_id='$user_id'");
                    if ($count2->num_rows()>0) 
                            {
                               
                                echo " user id $user_id  sudah terdaftar \n"; 
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                                role="alert">Cek kembali user sudah terdaftar </div>');
                             
                             }
                           
                       else
                       {
                   

                        $data[0] = array(
                            'user_id' => $user_id,
                            'username' => $nama,
                            'lokasi_kerja' => $area,
                             'jabatan' => $jabatan,
                            'telp' => $telp,
                            'password' => $pass,
                            'email' => $email,
                             'user_type' => $type,
                            'status'=>1
                                );
                               $up0= $this->db->insert_batch('user', $data);
                               if($up0)
                               {
                                   echo "$user_id Upload berhasil \n";
                               }
                            else 
                               {
                                   echo " $user_id Upload gagal \n";
                               }
                             
                       }
                  
            } 
      
  
		}

  
	}
	
    else 
                               {
                                   echo " Upload gagal excel error \n";
                               }


    }









                
     public function Export_temp_user()
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
    
 


  $this->load->library('Excel');
  $objPHPExcel = new PHPExcel();
  $objPHPExcel->setActiveSheetIndex(0);

  //$gdImage = imagecreatefrompng('images/logo/logo_excel.PNG');
  $style = array(
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
            )
            ),
            'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));

foreach(range('A','G') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nama');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Area');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Jabatan');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Telp');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Pass');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Email');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Type');


    
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="User.xlsx"');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('php://output'); 
                 }
                    else{
         $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('no_access');	
        $this->load->view('templates/auth_footer');	

                    }

                }


                 function Import_unit()
	{
        $dat = date("Y-m-d");
      $user_id =  $this->session->userdata('user_id');
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
                    
                    $alamat = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $blok = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $no_unit = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $penghuni = trim($worksheet->getCellByColumnAndRow(3, $row)->getValue());
                    $jabatan = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $telp = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $tanggal_menempati = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                     $tanggal_pindah = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $daya = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $pln = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
                    $pam = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                    $ket = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                    $status = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $area = $worksheet->getCellByColumnAndRow(13, $row)->getValue();


        $sc='';

if (!empty($penghuni) || $penghuni !=''){
           $sc =$this->Model_counter->getcodepenghuni();
            $data[0] = array(
            'kode' => $sc,
            'nama' => $penghuni,
           // 'jk' => $jk,
            'jabatan' => $jabatan,
          /*  'unit_kerja' => $unit_kerja,
            'pasangan' => $pasangan,
            'hubungan' => $hubungan,
            'anak1' =>$anak1,
            'anak2' =>$anak2,
            'anak3' =>$anak3,
            'anak4' =>$anak4,*/
            'telp' => $telp,
           // 'lama_menetap' => $lama_menetap,
            'user_create' => $this->session->userdata('user_id'),
            'create_date' => date("Y-m-d H:i:s"));            
            $up0=$this->db->insert_batch('penghuni', $data);
}

                      // $count  =  $this->db->query("SELECT id FROM penghuni WHERE kode ='$sc'")->result();
                      //  $co = $count[0]->id; 
                          $dd=$this->Model_counter->getcodeunit();
                        $data1[0]= array(
                            'kode' => $dd,
                            'id_lok' => $area,
                            'nama_unit' => $alamat,
                            'blok' => $blok,
                            'no_unit' => $no_unit,
                            'status' => $status,
                             'penghuni' => $sc,
                            'id_listrik' => $pln,
                            'id_pam' => $pam,
                            'daya_listrik' => $daya,
                            'hak_menempati' => 'Ya',
                            'keterangan' => $ket,
                            'status_unit' => 1,
                            'user_create' => $user_id,
                            'create_date' => date("Y-m-d H:i:s")
                        );
                        $this->db->insert_batch('unit', $data1); 
                        if($up0)
                            {
                                echo "$penghuni Upload berhasil \n";
                            }
                         else 
                            {
                                echo " $penghuni Upload gagal \n";
                            }
                        












                             
                       
                  
            } 
      
  
		}

  
	}
	
    else 
                               {
                                   echo " Upload gagal excel error \n";
                               }


    }









                
     public function Export_temp_unit()
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
    
 


  $this->load->library('Excel');
  $objPHPExcel = new PHPExcel();
  $objPHPExcel->setActiveSheetIndex(0);

  //$gdImage = imagecreatefrompng('images/logo/logo_excel.PNG');
  $style = array(
        'borders' => array(
        'allborders' => array(
        'style' => PHPExcel_Style_Border::BORDER_THIN
            )
            ),
            'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ));

foreach(range('A','K') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}

$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Alamat');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Blok');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'No Unit');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Id Penghuni');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Tanggal Menempati');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Tanggal Pindah');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Tlp');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Listrik');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'PLN');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'PAM');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'Keterangan');

    
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="User.xlsx"');
      header('Cache-Control: max-age=0');
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
      $objWriter->save('php://output'); 
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