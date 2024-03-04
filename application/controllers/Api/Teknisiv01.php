<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Teknisi extends CI_Controller {
	function __construct() {
	date_default_timezone_set("Asia/Bangkok");
	parent::__construct();	
	 $this->load->model('api/Model_counter');	
	}
	
        public function index()
	{
	
	}





public function List_incident()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
 $l = isset($json['limit']) ? $json['limit']: 0;
if ($c!='itbs_v1')
{
$res['status']= 'Instal/update aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
$limit =$l * 30;
$dt =$this->db->query("SELECT A.*,B.desc_status as stat,C.blok,C.no_unit,D.nama_lokasi
 from (select * from schedule_job where  (pic ='$a' or pic1='$a')  and status < 5 order by id desc limit $limit,30 ) A
 left join 
 status_progres B on B.id = A.status
  left join 
 unit C on C.id = A.id_unit
   left join 
 lokasi_kerja D on D.id = A.id_area
 ");
 $dt_=$dt->result();
if (!empty($dt_) )
{	
$res['data'] = $dt_;
$res['status'] = "1";
$json = json_encode($res);
echo $json;
  }
  else
{
$res['status'] = "No data";
$json = json_encode($res);
echo $json;
}
}

}


public function List_history()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
 $l = isset($json['limit']) ? $json['limit']: 0;
if ($c!='itbs_v1')
{
$res['status']= 'Instal/update aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
$limit =$l * 30;
$dt =$this->db->query("SELECT A.*,B.desc_status as stat,C.blok,C.no_unit,D.nama_lokasi
 from (select * from schedule_job where  (pic ='$a' or pic1='$a') and status > 4 order by id desc limit $limit,30 ) A
 left join 
 status_progres B on B.id = A.status
  left join 
 unit C on C.id = A.id_unit

  left join 
 lokasi_kerja D on D.id = A.id_area
 ");
 $dt_=$dt->result();
if (!empty($dt_) )
{	
$res['data'] = $dt_;
$res['status'] = "1";
$json = json_encode($res);
echo $json;
  }
  else
{
$res['status'] = "No data";
$json = json_encode($res);
echo $json;
}
}

}







public function Pengecekan()
		{$this->load->helper('url');
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['incident_id']) ? $json['incident_id']: '';
           $desc = isset($json['desc']) ? $json['desc']: '';
           $img = isset($json['foto']) ? $json['foto']: '';
          $filename = "Sebelum$b"."_".date('YmdHis').".png"; 
          $itbs = isset($json['itbs']) ? $json['itbs']: '';
        
          if ($itbs!='itbs_v1')
{
$res['status']= 'Mohon instal/update aplikasi anda';
 $json = json_encode($res);
 echo $json;
}
else {

                $this->db->set('status',2);
                $this->db->set('value_progres',25);
                $this->db->where('id',$b);
               $this->db->update('schedule_job');
	
                                   if($this->db->affected_rows() > 0){
                                         $data_foto = [
            'incident_id' => $b,
            'foto' => $filename,
            'deskripsi' => 'sebelum',
            'user_create' => $a,
            'create_date' => date("Y-m-d H:i:s"),
            'lat' => '',
            'lon' => ''
            ];

                                $data = array(
                                'id_task' => $b,
                                'user_id' => $a,
                                'log_status' => 2,
                                'keterangan' => "Proses Pengecekan",
                                'create_date' =>date("Y-m-d H:i:s")
                            ); 
							 $add_foto=$this->db->insert('log_task', $data); 
	 $add_foto=$this->db->insert('incident_foto', $data_foto);              
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$image = base64_decode($img);
//rename file name with random number
$path = '../cfm_ug/Doc/incident/';
//image uploading folder path
file_put_contents($path . $filename, $image);
// image is bind and upload to respective folder
        $res['status']= 1;
		  $res['tiket']= $b;
        $json = json_encode($res);
        echo $json;
        }
        else
        {
         $res['status']= 'Gagal Input';
         $json = json_encode($res);
         echo $json;
        }

            



}

}



public function Progres()
		{$this->load->helper('url');
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['incident_id']) ? $json['incident_id']: '';
           $desc = isset($json['desc']) ? $json['desc']: '';
           $img = isset($json['foto']) ? $json['foto']: '';
          $filename = "Proses$b"."_".date('YmdHis').".png"; 
          $itbs = isset($json['itbs']) ? $json['itbs']: '';
        
          if ($itbs!='itbs_v1')
{
$res['status']= 'Mohon instal/update aplikasi anda';
 $json = json_encode($res);
 echo $json;
}
else {

                $this->db->set('status',3);
                $this->db->set('value_progres',50);
                $this->db->where('id',$b);
               $this->db->update('schedule_job');
	   if($this->db->affected_rows() > 0){
                                         $data_foto = [
              'incident_id' => $b,
            'foto' => $filename,
            'deskripsi' => 'proses',
            'user_create' => $a,
            'create_date' => date("Y-m-d H:i:s"),
            'lat' => '',
            'lon' => ''
            ];

                                $data = array(
                                'id_task' => $b,
                                'user_id' => $a,
                                'log_status' => 3,
                                'keterangan' => "Proses Perbaikan",
                                'create_date' =>date("Y-m-d H:i:s")
                            ); 
							 $add_foto=$this->db->insert('log_task', $data); 
	 $add_foto=$this->db->insert('incident_foto', $data_foto);              
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$image = base64_decode($img);
//rename file name with random number
$path = '../cfm_ug/Doc/incident/';
//image uploading folder path
file_put_contents($path . $filename, $image);
// image is bind and upload to respective folder
        $res['status']= 1;
		  $res['tiket']= $b;
        $json = json_encode($res);
        echo $json;
        }
        else
        {
         $res['status']= 'Gagal Input';
         $json = json_encode($res);
         echo $json;
        }

            



}

}




public function Tambah_foto()
		{$this->load->helper('url');
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['incident_id']) ? $json['incident_id']: '';
           $desc = isset($json['desc']) ? $json['desc']: '';
           $img = isset($json['foto']) ? $json['foto']: '';
          $filename = "Proses$b"."_".date('YmdHis').".png"; 
          $itbs = isset($json['itbs']) ? $json['itbs']: '';
        
          if ($itbs!='itbs_v1')
{
$res['status']= 'Mohon instal/update aplikasi anda';
 $json = json_encode($res);
 echo $json;
}
else {

         
                                         $data_foto = [
              'incident_id' => $b,
            'foto' => $filename,
            'deskripsi' => "sebelum $desc",
            'user_create' => $a,
            'create_date' => date("Y-m-d H:i:s"),
            'lat' => '',
            'lon' => ''
            ];

                                $data = array(
                                'id_task' => $b,
                                'user_id' => $a,
                                'log_status' => 3,
                                'keterangan' => "Tambah Foto",
                                'create_date' =>date("Y-m-d H:i:s")
                            ); 
							 $add_foto=$this->db->insert('log_task', $data); 
                if($this->db->affected_rows() > 0){
	 $add_foto=$this->db->insert('incident_foto', $data_foto);              
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$image = base64_decode($img);
//rename file name with random number
$path = '../cfm_ug/Doc/incident/';
//image uploading folder path
file_put_contents($path . $filename, $image);
// image is bind and upload to respective folder
        $res['status']= 1;
		  $res['tiket']= $b;
        $json = json_encode($res);
        echo $json;
        }
        else
        {
         $res['status']= 'Gagal Input';
         $json = json_encode($res);
         echo $json;
        }

            



}

}







public function Pending()
		{$this->load->helper('url');
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['incident_id']) ? $json['incident_id']: '';
           $desc = isset($json['desc']) ? $json['desc']: '';
           $pending = isset($json['pending']) ? $json['pending']: '';
           $img = isset($json['foto']) ? $json['foto']: '';
          $filename = "Pending$b"."_".date('YmdHis').".png"; 
          $itbs = isset($json['itbs']) ? $json['itbs']: '';
        
          if ($itbs!='itbs_v1')
{
$res['status']= 'Mohon instal/update aplikasi anda';
 $json = json_encode($res);
 echo $json;
}
else {

                $this->db->set('status',4);
                $this->db->set('value_progres',50);
                $this->db->where('id',$b);
               $this->db->update('schedule_job');
	   if($this->db->affected_rows() > 0){
                                         $data_foto = [
              'incident_id' => $b,
            'foto' => $filename,
            'deskripsi' => 'pending',
            'user_create' => $a,
            'create_date' => date("Y-m-d H:i:s"),
            'lat' => '',
            'lon' => ''
            ];

                                $data = array(
                                'id_task' => $b,
                                'user_id' => $a,
                                'log_status' => 4,
                                'keterangan' => "Pending Perbaikan : $pending",
                                'create_date' =>date("Y-m-d H:i:s")
                            ); 
							 $add_foto=$this->db->insert('log_task', $data); 
	 $add_foto=$this->db->insert('incident_foto', $data_foto);              
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$image = base64_decode($img);
//rename file name with random number
$path = '../cfm_ug/Doc/incident/';
//image uploading folder path
file_put_contents($path . $filename, $image);
// image is bind and upload to respective folder
        $res['status']= 1;
		  $res['tiket']= $b;
        $json = json_encode($res);
        echo $json;
        }
        else
        {
         $res['status']= 'Gagal Input';
         $json = json_encode($res);
         echo $json;
        }

            



}

}



public function Finish()
		{$this->load->helper('url');
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['incident_id']) ? $json['incident_id']: '';
           $desc = isset($json['desc']) ? $json['desc']: '';
            $sol = isset($json['solusi']) ? $json['solusi']: '';
             $has = isset($json['hasil']) ? $json['hasil']: '';
             $nil = isset($json['nilai']) ? $json['nilai']: '';
           $img = isset($json['foto']) ? $json['foto']: '';
          $filename = "Proses$b"."_".date('YmdHis').".png"; 
          $itbs = isset($json['itbs']) ? $json['itbs']: '';
        
          if ($itbs!='itbs_v1')
{
$res['status']= 'Mohon instal/update aplikasi anda';
 $json = json_encode($res);
 echo $json;
}
else {

              //  $this->db->set('status',5);
                $this->db->set('note',$sol);
                $this->db->set('result',$has);
              //  $this->db->set('value_progres',100);
              //  $this->db->set('nilai',$nil);
                $this->db->where('id',$b);
               $this->db->update('schedule_job');
	   if($this->db->affected_rows() > 0){
                                         $data_foto = [
              'incident_id' => $b,
            'foto' => $filename,
            'deskripsi' => "setelah $desc",
            'user_create' => $a,
            'create_date' => date("Y-m-d H:i:s"),
            'lat' => '',
            'lon' => ''
            ];

            /*
                                $data = array(
                                'id_task' => $b,
                                'user_id' => $a,
                                'log_status' => 5,
                                'keterangan' => "Finish : $has",
                                'create_date' =>date("Y-m-d H:i:s")
                            ); 
							 $add_foto=$this->db->insert('log_task', $data); 
               */
	 $add_foto=$this->db->insert('incident_foto', $data_foto);              
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$image = base64_decode($img);
//rename file name with random number
$path = '../cfm_ug/Doc/incident/';
//image uploading folder path
file_put_contents($path . $filename, $image);
// image is bind and upload to respective folder
        $res['status']= 1;
		  $res['tiket']= $b;
        $json = json_encode($res);
        echo $json;
        }
        else
        {
         $res['status']= 'Gagal Input';
         $json = json_encode($res);
         echo $json;
        }

            



}

}







public function List_unit()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
 $l = isset($json['limit']) ? $json['limit']: 0;
if ($c!='itbs_v1')
{
$res['status']= 'Instal/update aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
$limit =$l * 20;
$dt =$this->db->query("SELECT A.*,B.username as nama_penghuni,C.status_detail
 from (select * from unit where penghuni ='$a' order by id desc limit $limit,20 ) A
 left join 
 user B on B.user_id = A.penghuni
  left join 
 status C on C.id = A.status

 
 ");
 $dt_=$dt->result();
if (!empty($dt_) )
{	
$res['data'] = $dt_;
$res['status'] = "1";
$json = json_encode($res);
echo $json;
  }
  else
{
$res['status'] = "No data";
$json = json_encode($res);
echo $json;
}
}

}



public function Detail_tiket()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
 $l = isset($json['incident_id']) ? $json['incident_id']: '';
if ($c!='itbs_v1')
{
$res['status']= 'Instal/update aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
                $this->db->select("A.*,B.username as name_pic, C.blok,C.no_unit,D.desc_status,E.username as name_author");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic ','LEFT');
                $this->db->join('unit as C', 'C.id = A.id_unit ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->join('user as E', 'E.user_id = A.user_create ','LEFT');
                $this->db->where('A.id',$l);
                $this->db->limit(1);
                 $dt = $this->db->get();

 $dt_=$dt->result();
if (!empty($dt_) )
{	

               $this->db->select("A.*,B.username");
                $this->db->from('log_task as A');
                  $this->db->join('user as B', 'B.user_id = A.user_id ','LEFT');
                $this->db->where('A.id_task',$l);
                 $this->db->order_by('A.id','desc');
                $time = $this->db->get();
  $time_=$time->result();

                 $this->db->select("A.*");
                $this->db->from('incident_foto as A');
                $this->db->where('A.incident_id',$l);
                $foto = $this->db->get();
$foto_=$foto->result();
                $this->db->select("A.*");
                $this->db->from('biaya_perbaikan as A');
                $this->db->where('A.incident_id',$l);
$biaya =$this->db->get();
 $biaya_=$biaya->result();
 
$res['biaya_perbaikan'] = $biaya_;
$res['foto'] = $foto_;
$res['time'] = $time_;
$res['data'] = $dt_;
$res['status'] = "1";
$json = json_encode($res);
echo $json;
  }
  else
{
  $res['biaya'] = '';
$res['foto'] = '';
$res['time'] = '';
$res['data'] = '';
$res['status'] = "No data";
$json = json_encode($res);
echo $json;
}
}

}









public function Detail_unit()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
 $unit = isset($json['unit']) ? $json['unit']: '';
if ($c!='itbs_v1')
{
$res['status']= 'Instal/update aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
                $this->db->select("A.*,B.username as nama_penghuni, C.nama_lokasi,D.status_detail");
                $this->db->from('unit as A');
                $this->db->join('user as B', 'B.user_id = A.penghuni ','LEFT');
                $this->db->join('lokasi_kerja as C', 'C.id = A.id_lok ','LEFT');
                $this->db->join('status as D', 'D.id = A.status ','LEFT');
                $this->db->where('A.id',$unit);
                $this->db->limit(1);
                $dt = $this->db->get();

 $dt_=$dt->result();
if (!empty($dt_) )
{	
              $this->db->select("A.*");
              $this->db->from('unit_file as A');
              $this->db->where('A.unit_id',$unit);
              $foto = $this->db->get();
$foto_=$foto->result();

$res['foto'] = $foto_;
$res['data'] = $dt_;
$res['status'] = "1";
$json = json_encode($res);
echo $json;
  }
  else
{
$res['status'] = "No data";
$json = json_encode($res);
echo $json;
}
}

}





    public function Signature()
	{
$this->load->helper('url');
$c='a1';
 $js = file_get_contents('php://input');
            //$json = json_decode($js,true);	
 $incident_id = isset($_POST['incident_id']) ? $_POST['incident_id']: '0';
  $nama = isset($_POST['nama']) ? $_POST['nama']: '0';
   $a = isset($_POST['user']) ? $_POST['user']: '0';
 $img = isset($_POST['foto']) ? $_POST['foto']: '';

            if ($c!='a1')
            {
            $res['status']= 'gagal masuk pastikan anda berada di aplikasi yang benar '.$c.'';
            $json = json_encode($res);
            echo $json;
            }
            else{

$tm=date("Y-m-d H:i:s");
$nm="$incident_id";
$filename = $nm .'.'. 'png';

  $this->db->set('status',5);
  $this->db->set('value_progres',100);
  $this->db->set('file_upload',$filename);
  $this->db->set('nama_signature',$nama);
  $this->db->where('id',$incident_id);
  $up= $this->db->update('schedule_job');
            if($this->db->affected_rows($up) > 0){

               $data = array(
                                'id_task' => $incident_id,
                                'user_id' => $a,
                                'log_status' => 5,
                                'keterangan' => "Finish",
                                'create_date' =>date("Y-m-d H:i:s")
                            ); 
							 $add=$this->db->insert('log_task', $data); 

                
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$image = base64_decode($img);


//rename file name with random number
$path = '../cfm_ug/Doc/sign/';
//image uploading folder path
file_put_contents($path . $filename, $image);
// image is bind and upload to respective folder
       
                    $res['status'] = "1";
                    $json = json_encode($res);
                    echo $json;
                    }             
                    else
                    {
                    $res['status']= 'Gagal load data';
                    $json = json_encode($res);
                    echo $json;
                    }
                    






                    
                    }
		
        }









public function List_biaya()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
 $i = isset($json['incident_id']) ? $json['incident_id']: 0;
if ($c!='itbs_v1')
{
$res['status']= 'Instal/update aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
$dt =$this->db->query("SELECT A.*
 from biaya_perbaikan A where A.incident_id='$i' 
 ");
 $dt_=$dt->result();
if (!empty($dt_) )
{	
$res['data'] = $dt_;
$res['status'] = "1";
$json = json_encode($res);
echo $json;
  }
  else
{
$res['status'] = "No data";
$json = json_encode($res);
echo $json;
}
}

}
        


public function Biaya_perbaikan()
		{$this->load->helper('url');
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['incident_id']) ? $json['incident_id']: '';
           $desc = isset($json['desc']) ? $json['desc']: '';
            $qty = isset($json['qty']) ? $json['qty']: '';
             $har = isset($json['harga']) ? $json['harga']: '';
          $itbs = isset($json['itbs']) ? $json['itbs']: '';
        
          if ($itbs!='itbs_v1')
{
$res['status']= 'Mohon instal/update aplikasi anda';
 $json = json_encode($res);
 echo $json;
}
else {
	  
                              $data = array(
                                'incident_id' => $b,
                                'desk' => $desc,
                                'qty' => $qty,
                             'biaya' => $har,
                             'user_create' => $a,
                                'create_date' =>date("Y-m-d H:i:s")
                            ); 
							 $add_data=$this->db->insert('biaya_perbaikan', $data); 
                if($this->db->affected_rows() > 0){
        $res['status']= 1;
		  $res['tiket']= $b;
        $json = json_encode($res);
        echo $json;
        }
        else
        {
         $res['status']= 'Gagal Input';
         $json = json_encode($res);
         echo $json;
        }

            



}

}



	public function delete_list_biaya()
	{
	        $c='a1';
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['incident_id']) ? $json['incident_id']: '';
           $id = isset($json['id']) ? $json['id']: '';
            if ($c!='a1')
            {
            $res['status']= 'gagal masuk pastikan anda berada di aplikasi yang benar '.$c.'';
            
            $json = json_encode($res);
            echo $json;
            }
            else{
         $this->db->where('id', $id);
    $up= $this->db->delete('biaya_perbaikan');
            if($this->db->affected_rows($up) > 0){
       
                    $res['status'] = "1";
                    $json = json_encode($res);
                    echo $json;
                    }             
                    else
                    {
                    $res['status']= 'Gagal load data';
                    $json = json_encode($res);
                    echo $json;
                    }
                    }
		
        }




	}