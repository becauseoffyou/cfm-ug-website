<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {
public function __construct()
	{
        parent::__construct();
        date_default_timezone_set("Asia/Bangkok");
        $this->load->model('auth/Auth_Mdl');
        $this->load->model('Model_permission');
         $this->load->model('Model_dashboard');
	}


    public function index()
	{
        $i=htmlspecialchars($this->input->get('area',true));
        $id=decrypt_url($i);
        
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
		if(count($result)>0)
		{            
        $data['unit'] =$this->Model_dashboard->Data_unit($id);
        $data['area'] =$this->Model_dashboard->Area();
        $data['data_unit'] =$this->Model_dashboard->List_unit($id);
        $data['data_problem'] =$this->Model_dashboard->List_helpdesk($id);
        $nama_area='All';
         $q = $this->db->query("SELECT nama_lokasi FROM lokasi_kerja  where  id='$id'");
         if($q->num_rows()>0){
             foreach($q->result_array() as $k){
                $nama_area=$k['nama_lokasi'];
             }
           
         }
        $data['id_area'] =$i;
        $data['nama_lokasi'] =$nama_area;
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('home',$data);	
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


    


    public function Short()
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
		if(count($result)>0)
					{ 
    
         $data['A1'] =$this->Model_dashboard->A1();
          $data['A2'] =$this->Model_dashboard->A2();
           $data['A3'] =$this->Model_dashboard->A3();
            $data['A4'] =$this->Model_dashboard->A4();
               $data['B1'] =$this->Model_dashboard->B1();
            $data['B2'] =$this->Model_dashboard->B2();
        $data['userPermission'] = $userPermission;
        $this->load->view('templates/auth_header');	
        $this->load->view('templates/sidebar_topbar',$data);
        $this->load->view('home',$data);	
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
         0=>'A.create_date',
          1=>'A.job_detail',
           2=>'A.type',
            3=>'B.username',
             4=>'A.value_progres',   
       
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
             $this->db->select("A.*,B.username as name_pic, C.divisi,D.desc_status");
                $this->db->from('schedule_job as A');
                $this->db->join('user as B', 'B.user_id = A.pic ','LEFT');
                $this->db->join('divisi as C', 'A.divisi_id = C.id ','LEFT');
                $this->db->join('status_progres as D', 'D.id = A.status ','LEFT');
                $this->db->where('A.divisi_id',$divisi);
                $this->db->order_by("A.id","desc");
                $result_data = $this->db->get();
        $data = array();
        $no=1;
        foreach($result_data->result() as $rows)
        {
            $row= array();
         if ($rows->status==1){$label_status="label label-warning";}
           else if ($rows->status==2){$label_status="label label-info";}
           else if ($rows->status==3){$label_status="label label-success";}
           else if ($rows->status==4){$label_status="label label-danger";}
           else{$label_status="";}

        $status='<span class="'.$label_status.'">'.$rows->desc_status.'</span>';
        $task_name='<a href="#">'.$rows->job_detail.'</a><div class="small"><i class="fa fa-clock-o"></i> Created '.$rows->create_date.'</div>';
        
          if ($rows->type=='High'){$label_pr="label label-danger";}
           else if ($rows->type=='Medium'){$label_pr="label label-info";}
           else if ($rows->type=='Low'){$label_pr="label label-success";}
           else{$label_pr="";}
            $open = strtotime(date($rows->create_date)); 
                    if (empty($rows->finish_date) || $rows->finish_date==0) {
            $finish = strtotime(date("Y-m-d H:i:s")); 
            }
            else
            {
            $finish =strtotime(date($rows->finish_date)); 
            } 
            $diff = $finish - $open;
            $jam   = floor($diff / 3600);
            $menit = floor(($diff - ( $jam * 3600))/ 60  );
            $hari =  floor($jam / 24);
            $jam1 =  floor(($jam - ( $hari * 24)));
            $nilai = "$hari hari,$jam1 jam,$menit menit ";

             $value_progres='<div class="progress m-b-none full progress-small">
                            <div style="width: '.$rows->value_progres.'%" class="progress-bar progress-bar-success"></div>
                                        </div>
                                        <small>'. $rows->value_progres.'% compleated:</small>';

              if ($this->session->userdata('user_id')== $rows->user_create &&  $rows->status!=3 &&  $rows->status!=4){
                $edit=' <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-toggle="modal" data-target="#cancel" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>

                          <a  href="javascript:;"
                    data-id ="'.encrypt_url($rows->id).'"
                     data-job_detail ="'.$rows->job_detail.'"
                      data-note ="'.$rows->note.'"
                       data-name_pic ="'.$rows->name_pic.'"
                        data-pic ="'.$rows->pic.'"
                         data-type ="'.$rows->type.'"
                   
                     data-toggle="modal" data-target="#update" data-rel="tooltip" title="Edit" ><i class="fa fa-pencil" ></i></a>';
              }
              else {
             $edit='';
              }                          

           // $action=

            $row= array();
            //$row[]= $rows->id;
              $row[]= $status;
            $row[]= $task_name;
            $row[]= '<span class="'.$label_pr.'">'.$rows->type.'</span>';
            $row[]=$rows->name_pic;
            $row[]=$nilai;
            $row[]=$value_progres;       
            $row[]='<div style="float:right;">
             <a href="'.base_url('Todolist/Update?id=').''.encrypt_url($rows->id).'"><i class="fas fa-eye" style="color:#000060;"></i></a> '.$edit.'
             
             </div>';
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
        $this->db->where('divisi_id',$divisi);
        $query = $this->db->select("COUNT(*) as num")->get("schedule_job");
        $result = $query->row();
        if(isset($result)) return $result->num;
        return 0;
    }


     public function Notif()
    {
         // $notif = $this->session->userdata('user_id');
                    $data=$this->Model_dashboard->Notif();
                    echo json_encode($data);

    }
    
     public function Notif_update()
    { 
    $i=htmlspecialchars($this->input->get('id',true));
                $this->db->set('ntf',1);
                $this->db->where('id',$i);
                $this->db->update('schedule_job');
    redirect('Helpdesk/Update?id='.encrypt_url($i).'');
   // var_dump($i);
    }
    

    
}