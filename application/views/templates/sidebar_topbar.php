<head>
</head>

<style>
  body
{
    font-family: 'Helvetica', 'Arial', sans-serif;
    color: #444444;
    background-color: #FAFAFA;
}
  .nav-item span , .nav-item i, .nav-item a {
    color:#000040 !important;
  }
  hr {
    background-color:#000040 !important;
  }
  .cntn
      {
  height: auto;
	background:#f8f9fc;
  width: 100%;
  font-family: Arial; 
  margin: 0;
  padding:15px 0 15px 0;
        }
  .sidebar .nav-item .nav-link[data-toggle="collapse"]::after {
  color: #000040;
  }
  .sidebar-dark.toggled #sidebarToggle::after ,.sidebar-dark #sidebarToggle::after {
  color: #fff;
}
  .bdg {
  top:20px;
  right:15px;
  position:absolute;
   min-width: 18px;
  height:18px;
  padding:1px;
  font-size:8px;
  border-radius: 50%;
  background-color: red;
  color: white;
  align-items:center;
  justify-content: center;
}

.card_cust {
    position: relative;
    display:block;
    width: 100%;
    background:#f8f9fc;
    border-radius:10px;
    background:#f8f9fc; 
    padding:10px; 
    margin:10px 0;
}
 
.btn_tmp {
	background-color:#000040 !important;
	color : #fff !important;
	width: 100px;
	height : 40px;
	font-size:16px;
	outline:none;
	cursor:pointer;
	transition:all 1s ease;
  border: 2px solid #000040 !important;
  border-radius: 15px;
  text-align:center;
  text-decoration: none !important;
  padding:5px 5px;
}
.btn_tmp:hover{
/* transform : translateY(5px);	*/
color: #000040 !important;	
background-color:#fff !important;
}
.logo {
  width: 100%;
  height: 50px;
  padding : 3px;	
  z-index: 2; 
  margin:0;
  background-color:#Eef3f7;
}
.ignielPelangi 
{
    background: linear-gradient(45deg, #000040, #Eef3f7, #Eef3f7,#000040, #000040, #Eef3f7, #Eef3f7,#Eef3f7);
    background-size: 500% 500%;
    -webkit-animation: ignielGradient 12s ease infinite;
    -moz-animation: ignielGradient 12s ease infinite;
    animation: ignielGradient 12s ease infinite;
  	z-index: 1;
  	text-align: center;
  	vertical-align: center;
	  align-items:center;
	  padding : 2px;
    display:flex;
}
@-webkit-keyframes ignielGradient {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
@-moz-keyframes ignielGradient {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
@keyframes ignielGradient {
    0%{background-position:0% 50%}
    50%{background-position:100% 50%}
    100%{background-position:0% 50%}
}
</style>
<!-- Page Wrapper -->
<div id="wrapper">
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background:#Eef3f7;">

  <!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=base_url('Home')?>" >
<div class='ignielPelangi'><img class="logo"  src="<?php echo base_url(); ?>images/logo/logo.png?<?php time(); ?>"/></div>
</a>
    
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  <hr class="sidebar-divider my-0">
  <!-- Nav Item - Dashboard -->

  <!-- SIDE BAR TIDAK DIMUNCULKAN REQUEST BY USER -->

<!-- <li class="nav-item">
    <a class="nav-link" href="<?=base_url('Home')?>" >
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span style="font-size:14px;">Dashboard</span></a>
  </li>


		

<li class="nav-item">
    <a class="nav-link" href="<?=base_url('Helpdesk/Approve_manager')?>" >
      <i class="fas fa-fw fa-pencil-alt"></i>
      <span style="font-size:14px;">Approve</span></a>
  </li> -->

















    
 
	
		
  
  
  
  

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading bagian drop down awal yang ini -->
  <div class="sidebar-heading" style="color:#000040;">
    Interface
  </div>
   <!-- Nav Item - Admin-->

<?php

$menuAdministration = array("admin_user_list","admin_permission");

$result=array_intersect($menuAdministration,$userPermission);


?>

<?php

/*
          echo '<pre>';
          print_r($result);
          echo '</pre>';
          exit;
          */

$menutask=array("task");
$result=array_intersect($menutask,$userPermission);

if(count($result)>0)
{
?>
       
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Coltask" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-tasks"></i>
      <span style="font-size:14px;" >Tasks</span>
    </a>

    <div id="Coltask" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Task Page</h6>

        <?php
        $admin_user_list=array("no_dokument_list");
        $result=array_intersect($admin_user_list,$userPermission);
        if(count($result)>0)
        {
        ?>
          <a class="collapse-item" href="<?=base_url('Todolist')?>"><i class="fas fa-plus"></i> My Tasks</a>
        <?php
        }
        ?>

      </div>
    </div>

  </li>

<?php
}
?>

<?php
$menudok=array("helpdesk_list");
$result=array_intersect($menudok,$userPermission);
if(count($result)>0)
{
 ?>
       <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Collapsehelpdesk" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-headset"></i></i>
      <span style="font-size:14px;" >Helpdesk</span>
    </a>

    <div id="Collapsehelpdesk" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Helpdesk List</h6>




     
               <?php
      $admin_user_list=array("helpdesk_list");
      $result=array_intersect($admin_user_list,$userPermission);
      if(count($result)>0)
      {
        ?>
     <a class="collapse-item" href="<?=base_url('Helpdesk')?>"><i class="fas fa-list"></i>
     Helpdesk</a>
        <?php
      }
        ?>



         <?php
      $admin_user_list=array("helpdesk_list");
      $result=array_intersect($admin_user_list,$userPermission);
      if(count($result)>0)
      {
        ?>
     <a class="collapse-item" href="<?=base_url('Data_report/Helpdesk')?>"><i class="fas fa-download"></i>
     Report</a>
        <?php
      }
        ?>

      </div>
    </div>
    </li>



<?php
}
 ?>















 <?php
$menureport=array("report_task");
$result=array_intersect($menureport,$userPermission);
if(count($result)>0)
{
 ?>
       <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Collapsereport" aria-expanded="true" aria-controls="collapseTwo">
   <i class="fas fa-folder"></i>
      <span style="font-size:14px;" >Report</span>
    </a>

    <div id="Collapsereport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Report Page</h6>

                  <?php
      $report_task=array("report_task");
      $result=array_intersect($report_task,$userPermission);
      if(count($result)>0)
      {
        ?>
       <a class="collapse-item" href="<?=base_url('Data_report/Task')?>"><i class="fas fa-plus"></i> Report Task</a>
     
       <?php } ?>
      </div>
    </div>
    </li>



<?php
}
 ?>









  <hr class="sidebar-divider d-none d-md-block" >
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle" style="background:#000040;"></button>
  </div>
</ul>



<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column" >
  <!-- Main Content -->
  <div id="content">

    <!-- Topbar /bagian atas dari sini-->
       <nav class="navbar navbar-expand navbar-light topbar mb-3 static-top" style="background:#Eef3f7; color:#000040;">
      <!-- Sidebar Toggle (Topbar) -->
      <button  id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" >
        <i style="background:#f8f9fc; color:#000040;" class="fa fa-bars"></i>
      </button>
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
      
        <!-- Nav Item - Alerts -->
      
        
        <!-- Nav Item - User Information -->
    
        <!-- Nav Item - User Information -->
  <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 <span class="mr-2 d-none d-lg-inline text-white-600 small" id="tanggalwaktuatas" style="style:float:right; right:20px;"></span>


          <div class="topbar-divider d-none d-sm-block"></div>


                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter" style="color:#fff !important;"><div id='jml_notif'></div></span>
                   
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"  aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header" style="background:#000040;">
                  Notifikasi
                </h6>
                <div id='notif'></div>
         <!--       <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
-->
                <a class="dropdown-item text-center small text-gray-500" href="<?=base_url('Helpdesk')?>">Show All Task</a>
              </div>
            </li>

             <li class="nav-item dropdown no-arrow" >
       
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       
         
       

          <div class="topbar-divider d-none d-sm-block"></div>
          <span class="mr-2 d-none d-lg-inline text-white-600 small"><?php echo $this->session->userdata('username'); ?></span>
         <!--  <img class="img-profile rounded-circle"  src="images/default.png"/>-->
         <i class="fas fa-user"></i>
          </a>
          <!-- Dropdown - User Information -->
     
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
         
        
          
            <div class="dropdown-divider"></div>

               <a class="dropdown-item" href="<?=base_url('Admin/User/Edit_profile?id=')?><?php echo encrypt_url( $this->session->userdata('user_id'));?>">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Profile
            </a>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
           
          </div>
        
          
        </li>

       

      </ul>

    </nav>






    <!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Logout jika anda ingin mengakhiri season</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <a class="btn_tmp" href="<?=base_url('Auth/Logout')?>">Logout</a>
    </div>
  </div>
</div>
</div>
 
<div class="cntn" >


<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>




<script>
var tw = new Date();
if (tw.getTimezoneOffset() == 0) (a=tw.getTime() + ( 7 *60*60*1000))
else (a=tw.getTime());
tw.setTime(a);
var tahun= tw.getFullYear ();
var hari= tw.getDay ();
var bulan= tw.getMonth ();
var tanggal= tw.getDate ();
var hariarray=new Array("Minggu,","Senin,","Selasa,","Rabu,","Kamis,","Jum'at,","Sabtu,");
var bulanarray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember");
document.getElementById("tanggalwaktuatas").innerHTML = hariarray[hari]+" "+tanggal+" "+bulanarray[bulan]+" "+tahun;
</script>


<script type="text/javascript">
    $(document).ready(function(){

    function autoRefreshPage()
   {
           
       $.ajax({
    url : "<?=base_url('Home/Notif')?>",
    method : "POST",
    async : true,
    dataType : 'json',
    success: function(data){
    var val =  "";
		var len = data.length;
    if(len > 0){
$.each(data, function(index,value){
   val +="<a class='dropdown-item d-flex align-items-center' href='<?=base_url('Home/Notif_update?id=')?>"+data[index].id+"'>"+
                   "<div class='mr-3'>"+
                    "<div class='icon-circle bg-primary'>"+
                     "<i class='fas fa-file-alt text-white'></i>"+
                    "</div></div><div><div class='small text-gray-500'>"+data[index].create_date+"</div><span class='font-weight-bold'>"+data[index].job_detail+"</span></div></a>";
       });
	    $('#notif').html(val);
       $('#jml_notif').html(data.length);
	   }
	   else
	   {
		//alert('');
	  $('#notif').html(val);
   // alert('');

	   }
    },

});
   }
   autoRefreshPage();


setInterval(function() {
     $.ajax({
    url : "<?=base_url('Home/Notif')?>",
    method : "POST",
    async : true,
    dataType : 'json',
    success: function(data){
    var val =  "";
		var len = data.length;
    if(len > 0){
$.each(data, function(index,value){
   val +="<a class='dropdown-item d-flex align-items-center' href='<?=base_url('Home/Notif_update?id=')?>"+data[index].id+"'>"+
                   "<div class='mr-3'>"+
                    "<div class='icon-circle bg-primary'>"+
                     "<i class='fas fa-file-alt text-white'></i>"+
                    "</div></div><div><div class='small text-gray-500'>"+data[index].create_date+"</div><span class='font-weight-bold'>"+data[index].job_detail+"</span></div></a>";
       });
	    $('#notif').html(val);
       $('#jml_notif').html(data.length);
       //alert('');
	   }
	   else
	   {
		//alert('');
	  $('#notif').html(val);
   //alert('');

	   }
    },

});
  }, 10000); 

 
    });
</script>

