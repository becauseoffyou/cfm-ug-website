<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Data_dokument extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_no_dokument');
	}
    public function index()
	{
        $user_id = $this->session->userdata('user_id');
        $pageName=array("dashboard");
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
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('Dokument/list',$data);	
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
          0=>'A.document_name',
           1=>'A.link',
            2=>'B.username',
             3=>'A.create_date',
            
        
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
                  
                }
                else
                {
                    $this->db->or_like($sterm,$search);
                     $this->db->where('A.divisi_id',$divisi);
                }
                $x++;
            }                 
        }
                $this->db->limit($length,$start);
                $this->db->select("A.*,B.username as name_pic");
                $this->db->from('document as A');
                $this->db->join('user as B', 'B.user_id = A.user_create ','LEFT');
                $this->db->where('A.divisi_id',$divisi);
                $this->db->order_by("A.id","desc");
                $result_data = $this->db->get();
        $data = array();
        $no=1;
        foreach($result_data->result() as $rows)
        {
           

           // $action=

            $row= array();
            //$row[]= $rows->id;
            
           $row[]= $rows->document_name;
           $row[]= '<small>'.anchor(base_url('Doc/'.$this->session->userdata('divisi_id').'/'.$rows->link.''),''.$rows->link.'',array('target' => '_blank', 'class' => 'btn btn-secondary')).'</small>';
            $row[]=$rows->name_pic;
            $row[]=$rows->create_date;
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
    
        $query = $this->db->select("COUNT(*) as num")->get("document");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }






    
}

?>