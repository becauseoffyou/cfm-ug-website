<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Absensi extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_user');
         $this->load->model('Model_absensi');
	}
    public function index()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("absensi");
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
        $tanggal= date("Y-m-d");
        }
        else {
           $tanggal=  date("Y-m-d", strtotime($tgl)); 
        }
        $data['tgl'] =  $tanggal; 
        $data['list'] = $this->Model_absensi->List_absensi($tanggal);
        $data['bar1'] = $this->Model_absensi->Bar1($tanggal);
        $data['bar2'] = $this->Model_absensi->Bar2($tanggal);
        $data['bar3'] = $this->Model_absensi->Bar3($tanggal);
        $data['bar4'] = $this->Model_absensi->Bar4($tanggal);
        $data['bar5'] = $this->Model_absensi->Bar5($tanggal);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Absensi/List_absensi',$data);	
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

    public function Detail()
	{
        $i=htmlspecialchars($this->input->get('id',true));
        $id=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">User tidak ditemukan</div>');
    
                    redirect('Absensi/Absensi');
        }
        if ($id==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">User tidak ditemukan</div>');
    
                    redirect('Absensi/Absensi');
        }
        else {
        $user_id = $this->session->userdata('user_id');
        $pageName=array("absensi");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
       $data['data'] = $this->Model_absensi->Detail($id);
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
         $this->load->view('Absensi/Detail_absensi',$data);	
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


     public function Maps()
	{
        
     
        $user_id = $this->session->userdata('user_id');
        $pageName=array("absensi");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
       $data['lat'] = htmlspecialchars($this->input->get('lat',true));
       $data['long'] = htmlspecialchars($this->input->get('long',true));
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
         $this->load->view('Absensi/Maps',$data);	
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



  public  function hari($day) {
        $hari = $day;
        switch ($hari) {
            case "Sun":
                $hari = "Minggu";
                break;
            case "Mon":
                $hari = "Senin";
                break;
            case "Tue":
                $hari = "Selasa";
                break;
            case "Wed":
                $hari = "Rabu";
                break;
            case "Thu":
                $hari = "Kamis";
                break;
            case "Fri":
                $hari = "Jum'at";
                break;
            case "Sat":
                $hari = "Sabtu";
                break;
        }
        return $hari;
    }
    

     public function History_absensi()
	{
        $user_id = $this->session->userdata('user_id');
        $divisi_id = $this->session->userdata('divisi_id');
        $pageName=array("absensi");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
        $get_user=htmlspecialchars($this->input->get('pegawai',true));
        $tgl=htmlspecialchars($this->input->get('bulan',true));
                         if(empty($tgl))
        {
        $t= date("Y-m-d");
        }
        else {
           $t=  date("Y-m-d", strtotime($tgl)); 
        }

	$this->db->select(
		'*');
		$this->db->from('user as A');
		$this->db->where('A.status',1);
		$this->db->where('A.divisi_id',$divisi_id);
		$user_cek = $this->db->get()->result();     
        $this->db->select(
		'A.username');

        $this->db->from('user as A');
        $this->db->where('A.user_id',$get_user);
		$this->db->where('A.status',1);
		$this->db->where('A.divisi_id',$divisi_id);
		$user_get = $this->db->get()->row_array(); 
        $u=!empty($user_get['username'])?$user_get['username']:"-";
 
         $tahun = date('Y', strtotime($t)); 
         $bulan = date('m', strtotime($t)); 

        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
for ($i=0; $i <$tanggal; $i++) { 
$a="-";
$a1="-";
$b="-";
$b1="-";
$c="-"; 

$t1 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($t)));


 $this->db->select("A.id,A.in_absen,A.ket_in,A.out_absen,A.ket_out");
                $this->db->from('absensi_ as A');
                $this->db->where('A.divisi',$this->session->userdata('divisi_id'));
                  $this->db->where('A.user_id',$get_user);
                $this->db->where('A.tanggal',$t1);
                $this->db->group_by('A.tanggal');
                 $s = $this->db->get()->row_array();
if($s) {
       $a=!empty($s['in_absen'])?$s['in_absen']:"-";
       $a1=!empty($s['ket_in'])?$s['ket_in']:"-";
       $b=!empty($s['out_absen'])?$s['out_absen']:"-";
       $b1=!empty($s['ket_out'])?$s['ket_out']:"-";
       $c=!empty($s['id'])?$s['id']:"-";
      
      }
$day = date('D', strtotime($t1)); 
$dy = $this->hari($day);
  $res[]=  
       [ 'tanggal'=>$t1, 
         'hari'=>$dy,
         'in_absen'=>$a,
         'out_absen'=>$b,  
         'ket_in'=>$a1, 
         'ket_out'=>$b1, 
         'id'=>$c
       ];
}

 
$data['hasil'] = $res;
$data['user'] = $user_cek;
$data['un'] = $u;
$data['iud'] = !empty($get_user)?$get_user:"";
$data['tgl'] = $t;

        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
         $this->load->view('Absensi/History',$data);	
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



    public function Pdf()
	{
        
        $divisi_id = $this->session->userdata('divisi_id');
        $get_user=htmlspecialchars($this->input->get('pegawai',true));
        $tgl=htmlspecialchars($this->input->get('bulan',true));
                         if(empty($tgl))
        {
        $t= date("Y-m-d");
        }
        else {
           $t=  date("Y-m-d", strtotime($tgl)); 
        }

	$this->db->select(
		'*');
		$this->db->from('user as A');
		$this->db->where('A.status',1);
		$this->db->where('A.divisi_id',$divisi_id);
		$user_cek = $this->db->get()->result();     
       
        $this->db->select(
		'A.username,C.divisi');
        $this->db->from('user as A');
        $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
         $this->db->where('A.user_id',$get_user);
		$this->db->where('A.status',1);
		$this->db->where('A.divisi_id',$divisi_id);
		$user_get = $this->db->get()->row_array(); 
       $u=!empty($user_get['username'])?$user_get['username']:"-";
       $d=!empty($user_get['divisi'])?$user_get['divisi']:"-";
      $th = date('M Y', strtotime($t)); 
         $tahun = date('Y', strtotime($t)); 
         $bulan = date('m', strtotime($t)); 

        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
for ($i=0; $i <$tanggal; $i++) { 
$a="-";
$a1="-";
$b="-";
$b1="-";
$c="-"; 

$t1 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($t)));


 $this->db->select("A.id,A.in_absen,A.ket_in,A.out_absen,A.ket_out");
                $this->db->from('absensi_ as A');
                $this->db->where('A.user_id',$get_user);
                $this->db->where('A.divisi',$this->session->userdata('divisi_id'));
                $this->db->where('A.tanggal',$t1);
                 $s = $this->db->get()->row_array();
if($s) {
       $a=!empty($s['in_absen'])?$s['in_absen']:"-";
       $a1=!empty($s['ket_in'])?$s['ket_in']:"-";
       $b=!empty($s['out_absen'])?$s['out_absen']:"-";
       $b1=!empty($s['ket_out'])?$s['ket_out']:"-";
       $c=!empty($s['id'])?$s['id']:"-";
      
      }
$day = date('D', strtotime($t1)); 
$dy = $this->hari($day);
  $res[]=  
       [ 'tanggal'=>$t1, 
         'hari'=>$dy,
         'in_absen'=>$a,
         'out_absen'=>$b,  
         'ket_in'=>$a1, 
         'ket_out'=>$b1, 
         'id'=>$c
       ];
}

 
$data['hasil'] = $res;
$data['user'] = $user_cek;
$data['un'] = $u;
$data['div'] = $d;
$data['th'] = $th;

	$this->load->library('Pdf');
    
    
						$path = 'images/logo/Logo_biru.png';
						$type = pathinfo($path, PATHINFO_EXTENSION);
						$dt = file_get_contents($path);
						$data['img'] = 'data:image/' . $type . ';base64,' . base64_encode($dt); 
						
					 
					
					
					$this->pdf->setPaper('A4', 'potrait');
					
					
					$this->pdf->filename = "Absensi_$u.pdf";

         $this->pdf->load_view('Absensi/pdf',$data);	
     
             
    }


   public function Test()
	{
         $this->db->select("A.username");
                $this->db->from('user as A');
                 $s = $this->db->get()->result();
              
$data['head']=$s;


                 

              
                 var_dump($s);
                 $this->load->view('Absensi/test',$data);	


    }

public function Cd1()
	{
$a = rand(0, 2000);
$newformat = date('H:i:s',$a);
 
return $newformat;
    }

    public function Cd2()
	{
//$yourdatetime = "17:00:00";
//$timestamp = strtotime($yourdatetime);
$a = rand(1658916000, 1658941199);
$newformat = date('H:i:s',$a);
 
return $newformat;
    }

 public function Cc()
	{
         $i=htmlspecialchars($this->input->get('pegawai',true));
        $get_user=decrypt_url($i);
      if(empty($i))
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Proses gagal</div>');
    
                    redirect('Absensi/Absensi/History_absensi');
        }
        if ($get_user==false)
        {
           $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Proses gagal</div>');
    
                    redirect('Absensi/Absensi/History_absensi');
        }
        else {
        $divisi_id = $this->session->userdata('divisi_id');
        $tgl=htmlspecialchars($this->input->get('bulan',true));
                         if(empty($tgl))
        {
        $t= date("Y-m-d");
        }
        else {
           $t=  date("Y-m-d", strtotime($tgl)); 
        }

	
      $th = date('M Y', strtotime($t)); 
         $tahun = date('Y', strtotime($t)); 
         $bulan = date('m', strtotime($t)); 

        $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
for ( $i=0; $i <$tanggal; $i++) { 
$flag=0; 

$t1 = date('Y-m-d', strtotime('+'.$i.' days', strtotime($t)));
$day = date('D', strtotime($t1)); 
if ($day != "Sun" && $day != "Sat" )
{
$day_con = $day;
}
else
{
 $day_con = "0";
}
if($day_con != "0") {
 $data = array(
                            'divisi' => "1",
                            'tanggal' => $t1,
                            'in_absen' => $this->Cd1(),
                            'out_absen' => $this->Cd2(),
                            'keterangan' => "",
                            'user_id' => $get_user,
                            'status' => "0",
                            'lat_in' => "-6.246.162",
                            'long_in' => "1.068.053.305",
                            'stat_in' => "1",
                            'lat_out' => "-6.246.162",
                            'long_out' => "1.068.053.305",
                            'user_create' => $get_user,
                            'stat_out' => "1"
                        );
                         
                         //var_dump($day_con); 
                         
                         	$this->db->select(
		'A.id
		');
		$this->db->from('absensi_ as A');
		$this->db->where('A.tanggal',$t1);
        $this->db->where('A.user_id',$get_user);
		$cek = $this->db->get()->row_array();
        if ($cek){
            
        }
        else {
        $this->db->insert('absensi_', $data); 
        }
                         
                    }
                }
                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                            role="alert">Proses selesai</div>');
    
                    redirect("Absensi/Absensi/History_absensi?bulan=$tgl&pegawai=$get_user");
                   
}


     
             
    }


public function Update_note()
	{
        
     
        $user_id = $this->session->userdata('user_id');
        $pageName=array("absensi");
		$userPermission=array();
		$permission = $this->Model_permission->getUserPermission($user_id);
		foreach($permission as $a)
        {
        $userPermission[] = $a['description'];
		}
       $result=array_intersect($pageName,$userPermission);
					if(count($result)>0)
					{ 
                                $user=htmlspecialchars($this->input->post('user',true));
                                 $jam_in=htmlspecialchars($this->input->post('jam_in',true));
                                $jam_out = htmlspecialchars($this->input->post('jam_out',true));
                                $bln=htmlspecialchars($this->input->post('bln',true));
                                $id = htmlspecialchars($this->input->post('id_mod',true));
                                $ket_in=htmlspecialchars($this->input->post('ket_in',true));
                                $ket_out = htmlspecialchars($this->input->post('ket_out',true));

                                 $edit = $this->Model_absensi->Update_note($id,$jam_in,$jam_out,$ket_in,$ket_out);
                                if ($edit)
                                {
                                $this->session->set_flashdata('message', '<div class="alert alert-success" 
                                role="alert">Update berhasil</div>');
                                redirect("Absensi/Absensi/History_absensi?bulan=$bln&pegawai=$user");
                                }
                                else {
                            $this->session->set_flashdata('message', '<div class="alert alert-danger" 
                            role="alert">Update gagal</div>');
                            redirect("Absensi/Absensi/History_absensi?bulan=$bln&pegawai=$user");
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