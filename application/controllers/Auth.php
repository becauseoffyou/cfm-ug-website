<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct() {
		date_default_timezone_set("Asia/Bangkok");
		parent::__construct();		
	}

    public function index()
	{

		$this->load->library('session');

		if ($this->session->userdata('user_id')) 
		{
			redirect('Home');
		}
		else 
		{
	        $this->load->view('templates/auth_header');		
            $this->load->view('auth/login');  
		}

	}

	public function LoginValidation()
	{

		$rules = [
		[
			'field' => 'username', //<- ini mengikuti nama input di form
			'label' => 'Username',
			'rules' => 'required|alpha_numeric']
		];

    	$this->load->library('form_validation');
    	$this->form_validation->set_rules($rules);
 		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" 
			role="alert">Gagal masuk pastikan username dan password benar </div>');
			redirect('Auth');
 		}
 		else {

			$username = trim(htmlspecialchars($this->input->post('username',true)));
			$password = trim($this->input->post('password'));
			//$user = $this->db->get_where('user', ['user_id' => $username])->row_array();

			$this->db->select(
			'A.user_id,
			A.username,
			A.divisi_id,
			A.password,
			A.user_type
			');
			
			$this->db->from('user as A');
			$this->db->where('A.status', 1);
			$this->db->where('A.user_id', $username);
			$user1 = $this->db->get()->row_array();
			//permission
	
			if($user1){

				if($password == $user1['password']){

					//$ip = $this->input->ip_address();
					
					$data = [
						'user_id'   => $user1['user_id'],
						'username'  => $user1['username'],
						'user_type' => $user1['user_type'],
						'divisi_id' => $user1['divisi_id'],
					
					];

					$this->session->set_userdata($data);
					redirect('Splash');
					
				}
				else 
				{
					$this->session->set_flashdata('message', '<div class="alert alert-danger" 
					role="alert">Gagal masuk</div>');
					redirect('Auth');
				}

			}
			else 
			{
				$this->session->set_flashdata('message', '<div class="alert alert-danger" 
				role="alert">Gagal masuk</div>');
				redirect('Auth');
			}

		}
	
	}

		public function Logout()
		{
    		$this->load->library('session');	
    		$this->session->sess_destroy();
			redirect('Auth');	
		}

		public function EditProfile()
		{
			$this->load->model('auth/Auth_Mdl');
			$kode=htmlspecialchars($this->input->post('user_id',true));
			$nama=htmlspecialchars($this->input->post('nama',true));
			$tlp=htmlspecialchars($this->input->post('tlp',true));
			$pass=htmlspecialchars($this->input->post('pass',true));
			$email=htmlspecialchars($this->input->post('email',true));
			$change=date("Y-m-d");
			$user_change=$this->session->userdata('user_id');
			$edit = $this->Auth_Mdl->Edit_Profile($kode,$nama,$tlp,$pass,$email,$change,$user_change);
			if($edit) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" 
			role="alert">user berhasil di ubah </div>');
			redirect('Home');	
			}
			else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" 
			role="alert">Gagal Edit User </div>');
			redirect('Home');

			}
		}
		


		public function NOACCES()
		{
			$this->load->library('session');	
    		$this->session->sess_destroy();
			$this->load->view('Welcome_message');
		   
		}
	}