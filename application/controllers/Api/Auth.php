<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {

	function __construct() {
	date_default_timezone_set("Asia/Bangkok");
	parent::__construct();		
	}
        public function index()
	{
	
	}

public function acakCaptcha()
		{
$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789"; 
//untuk menyatakan $pass sebagai array
$pass = array(); 
//masukkan -2 dalam string length
$panjangAlpha = strlen($alphabet) - 2; 
for ($i = 0; $i < 5; $i++) {
  $n = rand(0, $panjangAlpha);
  $pass[] = $alphabet[$n];
    }
   //ubah array menjadi string
   return implode($pass); 
}


public function Login()
{

  /*
  echo '<pre>';
  var_dump(json_decode(trim(file_get_contents('php://input')), true));
  echo '</pre>';
  die;
  */

  $code = $this->acakCaptcha();

  $js = file_get_contents('php://input');
  $json = json_decode($js,true);	
  $a = isset($json['user']) ? $json['user']: '';
  $b = isset($json['password']) ? $json['password']: '';
  $d = isset($json['tok_ken']) ? $json['tok_ken']: '';
  $c = isset($json['itbs']) ? $json['itbs']: '';

  if ($c!='itbs_v1')
  {
    $res['status']= 'gagal masuk pastikan anda berada di aplikasi yang benar';
    $json = json_encode($res);
    echo $json;
  }
  else{

  $user = $this->db->get_where('user', ['user_id' => $a])->row_array();

  if ($user){

    if($user['status'] == 0){
      $res['status']= 'User Non Aktif mohon hubungi admin';
      $json = json_encode($res);
      echo $json;
    }
    else
    {

      if($user['password'] === $b){
    
        $code1 = encrypt_url($code);
        $this->db->set('token_ntf',$d);
        $this->db->set('ist',$code);
        $this->db->where('user_id',$a);
        $this->db->where('password',$b);    
        $i= $this->db->update('user');

        $res['status']= 'Berhasil';
        $res['usid']= $user['user_id'] ;
        $res['nama']= $user['username'];
        $res['type']= $user['user_type'];
        $res['srt']= $code1;
        $json = json_encode($res);
        echo $json; 

      }
      else
      {
        $res['status']= 'Invalid User name and password';
        $json = json_encode($res);
        echo $json; 
      }

    }

  }
  else 
  {
  $res['status']= 'Invalid User name and password';
  $json = json_encode($res);
  echo $json;
  }
  }
}



public function Change_pass()
{
$code = $this->acakCaptcha();
$js = file_get_contents('php://input');
$json = json_decode($js,true);	
$a = isset($json['user']) ? $json['user']: '';
$b = isset($json['lama']) ? $json['lama']: '';
$d = isset($json['baru']) ? $json['baru']: '';
$c = isset($json['itbs']) ? $json['itbs']: '';
  if ($c!='itbs_v1')
{
$res['status']= 'gagal masuk pastikan anda berada di aplikasi yang benar';
$json = json_encode($res);
echo $json;
}
else{

$user = $this->db->get_where('user', ['user_id' => $a])->row_array();
if ($user){
	if($user['status'] == 0){
  $res['status']= 'User Non Aktif mohon hubungi admin';
  $json = json_encode($res);
    echo $json;
                }
else
{
  if($user['password'] === $b){
$code1 = encrypt_url($code);
$this->db->set('password',$d);
$this->db->set('user_change',$a);
$this->db->where('user_id',$a);
$this->db->where('password',$b);
$i= $this->db->update('user');

  $res['status']= '1';
  $json = json_encode($res);
  echo $json; 
}
else
{
$res['status']= 'Invalid password';
$json = json_encode($res);
echo $json; 
}
}
}
else 
{
$res['status']= 'Invalid User name and password';
$json = json_encode($res);
echo $json;
}
}
}



 	public function Profile()
		{
          $js = file_get_contents('php://input');
          $json = json_decode($js,true);	
          $a = isset($json['user']) ? $json['user']: '';
          $c = isset($json['itbs']) ? $json['itbs']: '';
       
          if ($c!='itbs_v1')
{
$res['status']= 'Update / Instal aplikasi anda';
$json = json_encode($res);
echo $json;
}
else{
$this->db->select('A.username,A.email,A.nip,A.telp');
$this->db->from('user as A');
$this->db->where('A.user_id',$a);    
$user = $this->db->get()->row_array();
if ($user){	
  $res['status']= '1';
  $res['nip']= $user['nip'];
   $res['telp']= $user['telp'];
  $res['username']= $user['username'];
  $res['email']= $user['email'];
  $json = json_encode($res);
  echo $json;
}             
else
{
$res['status']= 'Gagal load profile';
$json = json_encode($res);
    echo $json; 

}
}



}





public function Foto_profile(){
  $js = file_get_contents('php://input');
  $json = json_decode($js,true);	
  $a = isset($json['name']) ? $json['name']: '';
 /*       if (!empty($_FILES["image"]["name"]))
        {
        $newname=$a;
        //$config['upload_path']          = '../laravel1/public/images';
        $config['upload_path']          = '../foto_user/';
        $config['allowed_types']        = '*';
        $config['file_name']            = $newname;
        $config['max_size']             = 1000;
        $config['overwrite']			= true;
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('image');
        $res['status']= '1';
        $json = json_encode($res);
        echo $json;
        }
        else
        {
  $res['status']= 'Berhasil namun foto gagal terupload';
  $json = json_encode($res);
  echo $json;
          }
*/
  $res['status']= 'Ganti foto hanya boleh di lakukan oleh admin';
  $json = json_encode($res);
  echo $json;
        }











public function Permission()
{

  $ver='v1';
  $js = file_get_contents('php://input');
  $json = json_decode($js,true);	

  $u = isset($json['user']) ? $json['user']: '';
  $a = isset($json['user_type']) ? $json['user_type']: '';
  $c = isset($json['itbs']) ? $json['itbs']: '';
  $d = isset($json['tk']) ? $json['tk']: '1';

  if ($ver!= 'v1')
  {
  
    $res['status'] = "2";
    $res['msg']= 'https://drive.google.com/file/d/1oBocgO20thiHgZyCr30dgbzWzAxxZZ_F/view?usp=sharing';
    $json = json_encode($res);
    echo $json;

  }
  else{

    // $user =$this->db->query("SELECT up_id,permission_id from user_permission WHERE user_type ='$a'");
 
    $cek =$this->db->get_where('user', ['user_id' => $u])->row_array();
 
    if($cek) {
  
      $dec = encrypt_url($cek['ist']);

      if ($d == $dec)
      {
        $res['status'] = "1";
        $json = json_encode($res);
        echo $json;
      }
      else {
     
        $res['status'] = "4";
        $res['msg'] = "User id digunakan di device lain";
        $json = json_encode($res);
        echo $json;
  
      }

    }
    else{
     
      $res['status'] = "5";
      $res['msg'] = "User tidak valid mohon login ulang";
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

  $user = isset($_POST['user']) ? $_POST['user']: '0';
 $img = isset($_POST['foto']) ? $_POST['foto']: '';

            if ($c!='a1')
            {
            $res['status']= 'gagal masuk pastikan anda berada di aplikasi yang benar '.$c.'';
            $json = json_encode($res);
            echo $json;
            }
            else{

$tm=date("Y-m-d H:i:s");
$nm="$user";
$filename = $nm .'.'. 'png';
  $this->db->set('signature',$filename);
  $this->db->where('user_id',$nm);
  $up= $this->db->update('user');
          

                
 $img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$image = base64_decode($img);


//rename file name with random number
$path = '../cfm_ug/Doc/sign_user/';
//image uploading folder path
$upload=file_put_contents($path . $filename, $image);
// image is bind and upload to respective folder
         if($upload){
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