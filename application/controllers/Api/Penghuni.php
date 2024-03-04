<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Penghuni extends CI_Controller {
	function __construct() {
	date_default_timezone_set("Asia/Bangkok");
	parent::__construct();	
	 $this->load->model('api/Model_counter');	
	}
	
        public function index()
	{
	
	}


public function Unit_cek()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
if ($c!='itbs_v1')
{
$res['status']= 'Instal/update aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
 $dt =$this->db->query("SELECT A.id,A.blok,A.no_unit from unit A where penghuni='$a'");
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





public function Helpdesk_add()
		{$this->load->helper('url');
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $b = isset($json['id']) ? $json['id']: '';
		   $c = isset($json['type']) ? $json['type']: '';
		    $d = isset($json['lat']) ? $json['lat']: '';
          $f = isset($json['lon']) ? $json['lon']: '';
           $desc = isset($json['desc']) ? $json['desc']: '';
           $img = isset($json['foto']) ? $json['foto']: '';
          $filename = "Penghuni$b"."_".date('YmdHis').".png"; 
          $itbs = isset($json['itbs']) ? $json['itbs']: '';
        
          if ($itbs!='itbs_v1')
{
$res['status']= 'Mohon instal/update aplikasi anda';
 $json = json_encode($res);
 echo $json;
}
else {
  $tiket=$this->Model_counter->getcodecm();

	 $data_incident = [
            'tiket' => $tiket,
            'id_unit' => $b,
            'job_detail' => $desc,
             'status' => 1,
            'user_create' => $a,
            'create_date' => date("Y-m-d H:i:s"),
            'ntf' => 0,
			      'type' => $c
            ];



	  $add=$this->db->insert('schedule_job', $data_incident); 
          $last_id = $this->db->insert_id();
                                 if($this->db->affected_rows($add) > 0){
                                         $data_foto = [
            'incident_id' => $last_id,
            'foto' => $filename,
            'deskripsi' => 'penghuni',
            'user_create' => $a,
            'create_date' => date("Y-m-d H:i:s"),
            'lat' => $d,
            'lon' => $f
            ];

                                $data = array(
                                'id_task' => $last_id,
                                'user_id' => $a,
                                'log_status' => 1,
                                'keterangan' => "Create report incident : $desc",
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
		  $res['tiket']= $last_id;
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






public function History_tiket()
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
$dt =$this->db->query("SELECT A.*,B.desc_status as stat,C.blok,C.no_unit
 from (select * from schedule_job where user_create ='$a' order by id desc limit $limit,30 ) A
 left join 
 status_progres B on B.id = A.status
  left join 
 unit C on C.id = A.id_unit
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

$res['foto'] = $foto_;
$res['time'] = $time_;
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



public function Test_data()
{
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$lat = isset($json['key1']) ? $json['key1']: '';
$lon = isset($json['key2']) ? $json['key2']: '';
$nama = isset($json['nm']) ? $json['nm']: '';



 $data = [   'nama' => $nama,
            'lat' => $lat,
            'lon' => $lon,
            'create_date' => date("Y-m-d H:i:s")
            ];



	  $add=$this->db->insert('test_data', $data); 
        
                                 if($this->db->affected_rows($add) > 0){
$res['data'] = 'berhasil';
$res['status'] = "1";
$json = json_encode($res);
echo $json;
                                 } else {
$res['data'] = 'gagal';
$res['status'] = "2";
$json = json_encode($res);
echo $json;

} 

}


public function Test_data1()
{




    $apiKey = 'AIzaSyCMhs89utNpSjWK4mUsJJ9wfTsTgdIb6P8';

    // Mendapatkan data IP pengguna
    $ip = $_SERVER['REMOTE_ADDR'];

    // Membuat permintaan ke Google Maps Geolocation API
    $url = "https://www.googleapis.com/geolocation/v1/geolocate?key={$apiKey}";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{}');
    $response = curl_exec($ch);
    curl_close($ch);

    // Mengolah respons JSON
    $result = json_decode($response, true);

    if (isset($result['location'])) {
        $latitude = $result['location']['lat'];
        $longitude = $result['location']['lng'];

        // Menampilkan koordinat
      
    } else {
        echo "Gagal mendapatkan koordinat.";
    }














}





	}