<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_report extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_report');
	}
    public function index()
	{
        
                    
    }

 

    
     public function Helpdesk()
    {   
         $i=htmlspecialchars($this->input->get('area',true));
        $id=decrypt_url($i);
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
        $tgl=htmlspecialchars($this->input->get('tgl',true));
          if(empty($tgl))
        {
        $bulan= date("m");
        $tahun= date("Y");
        }
        else {
        $bulan=  date("m", strtotime($tgl)); 
        $tahun=  date("Y", strtotime($tgl)); 
        }
        $data['tanggal'] =$tgl;
        $data['helpdesk'] =$this->Model_report->Helpdesk_list($bulan,$tahun,$id);
          $data['area'] =$this->Model_report->Area();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Report/helpdesk',$data);	
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





                
     public function Export_helpdesk()
    { 
        $i=htmlspecialchars($this->input->get('area',true));
        $id=decrypt_url($i);  
        $user_id = $this->session->userdata('user_id');
  
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
        $tgl=htmlspecialchars($this->input->get('tgl',true));
          if(empty($tgl))
        {
        $bulan= date("m");
        $tahun= date("Y");
        }
        else {
        $bulan=  date("m", strtotime($tgl)); 
        $tahun=  date("Y", strtotime($tgl)); 
        }
      
 


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
     /*        
$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
$objDrawing->setName('LOGO');
$objDrawing->setDescription('LOGO image');
$objDrawing->setImageResource($gdImage);
$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
$objDrawing->setHeight(60);
$objDrawing->setCoordinates('A2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());
*/
foreach(range('A','U') as $columnID) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);  
}

$objPHPExcel->getActiveSheet()->getStyle('A1:U2')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle('A1:U2')->applyFromArray($style);
$objPHPExcel->getActiveSheet()->mergeCells('A1:U1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Laporan Helpdesk');
$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Tiket');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('C2', 'Area');
$objPHPExcel->getActiveSheet()->setCellValue('D2', 'Blok');
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'No Unit');
$objPHPExcel->getActiveSheet()->setCellValue('F2', 'Kategori Laporan');
$objPHPExcel->getActiveSheet()->setCellValue('G2', 'Prioritas');
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'Laporan');
$objPHPExcel->getActiveSheet()->setCellValue('I2', 'Pelapor');
$objPHPExcel->getActiveSheet()->setCellValue('J2', 'Penerima Laporan');
$objPHPExcel->getActiveSheet()->setCellValue('K2', 'Penghuni');
$objPHPExcel->getActiveSheet()->setCellValue('L2', 'Petugas 1');
$objPHPExcel->getActiveSheet()->setCellValue('M2', 'Petugas 2');
$objPHPExcel->getActiveSheet()->setCellValue('N2', 'Petugas Pengerjaan');
$objPHPExcel->getActiveSheet()->setCellValue('O2', 'Progress');
$objPHPExcel->getActiveSheet()->setCellValue('P2', 'Hasil Pekerjaan');
$objPHPExcel->getActiveSheet()->setCellValue('Q2', 'Waktu Laporan');
$objPHPExcel->getActiveSheet()->setCellValue('R2', 'Waktu Selesai');
$objPHPExcel->getActiveSheet()->setCellValue('S2', 'Durasi');
$objPHPExcel->getActiveSheet()->setCellValue('T2', 'Biaya Perbaikan');
$objPHPExcel->getActiveSheet()->setCellValue('U2', 'Kepuasan');


        $rowCount = 3;
        $list=$this->Model_report->Helpdesk_list($bulan,$tahun,$id);
        $no=1;
        $nilai='0';
        	foreach ($list as $t) {
            if($t->rating==1){
              
              $rating='Tidak Puas';}
              else if($t->rating==2){
              
              $rating='Cukup Puas';}
               else  if($t->rating==3){
              
              $rating='Puas';}
               else if($t->rating==4){
              
              $rating='Sangat Puas';}

                else{
              
              $rating='';}

            $open = strtotime(date($t->create_date)); 
                    if (empty($t->finish_date) || $t->finish_date==0) {
            $finish = strtotime(date("Y-m-d H:i:s")); 
            }
            else
            {
            $finish =strtotime(date($t->finish_date)); 
            } 
            $diff = $finish - $open;
            $jam   = floor($diff / 3600);
            $menit = floor(($diff - ( $jam * 3600))/ 60  );
            $hari =  floor($jam / 24);
            $jam1 =  floor(($jam - ( $hari * 24)));
            $durasi = "$hari hari,$jam1 jam,$menit menit ";


        $objPHPExcel->getActiveSheet()->getStyle("A".($rowCount).":U".($rowCount))->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $t->tiket);
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $t->desc_status);
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $t->nama_lokasi);
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $t->blok);
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $t->no_unit);
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $t->type_incident);
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $t->type);
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $t->job_detail);
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $t->pelapor);
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $t->ucreate);
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $t->uhuni);
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $t->name_pic);
         $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $t->name_pic1);
          $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $t->name_pic_complete);
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, "$t->value_progres % completed");
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $t->result);
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, $t->create_date);
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, $t->finish_date);
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, $durasi);
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, $t->nilai);
         $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, $rating);
           $objPHPExcel->getActiveSheet()->getStyle('S'.$rowCount)->getNumberFormat()->setFormatCode('#,##0');

$objPHPExcel->getActiveSheet()->getStyle("S".($rowCount))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
  $rowCount++;
  $no++;
    }
    
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="Report helpdesk.xlsx"');
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