<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style>
   .page-item.active .page-link {
      color:#fff;
    }
    </style>
  <body>
  <?= $this->session->flashdata('message');?>
    <!-- Begin Page Content -->
    <section class="section">
    <div class="container-fluid">

    <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                    <?php if ($this->session->userdata('regional_id')==0){ ?>
  
    <a href="<?=base_url('Admin/User/Add_User')?>" style="float:right; margin:5px;" class="btn_tmp"><i class="fas fa-plus"></i> Tambah</a>
    <?php } ?>
                        <div class="header-icon" >
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="header-title">
                            <h3>User</h3>
                            <small>
                                List User
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
      <br>
<div class="table-responsive">
      <table id="User" class="table table-striped table-bordered" >
          <thead>
            <tr>
            <th>User ID</th>
              <th>Nama</th>
              <th>Area</th>
              <th>Type</th>
              <th>Status </th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php
    
        foreach ($user as $ub) {
          ?>
         <tr>
         <td><?php echo $ub->user_id;?></td>
         <td><?php echo $ub->username;?></td>
        
      
         <td><?php echo $ub->lok;?></td>
         <td><?php echo $ub->type_user;?></td>
         <td><?php 
         if ($ub->status == '1')
         {
           ?>
           Aktif
           <?php
           
         }
         else if ($ub->status == '0')
         {
           ?>
           Non aktif
           <?php
         }
  
         else 
         {
           ?>
           NULL
           <?php
         }
         ?>
         </td>
         <?php
         if($ub->user_id == 'admin') {
    ?>
       <td><a class="btn btn-danger"><i class="fa fa-lock" href="" style="color:white;"></i></a></td>
       <?php } else { ?>
         <td>
         <a class="btn_tmp" href="<?=base_url('Admin/User/Edit_user?id=')?><?php echo encrypt_url($ub->user_id) ?>">Edit</a></td>
         <?php } 
    
    ?>
    
         
     
          </tr>
          <?php
        }
      
        ?>
       </table>
      </div>
      </div>
   
 
   
<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
  <script>
     $(document).ready(function() {
  $('#User').DataTable();

});
 </script>
    </body>
</html>