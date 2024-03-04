<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<body id="page-top">
 
<div class="container-fluid">
   <?= $this->session->flashdata('message');?>
   <br>
  <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                        <div class="header-icon" >
                            <i class="fa fa-gear"></i>
                        </div>
                        <div class="header-title">
                            <h3>Profile</h3>
                            <small>
                                Edit Profile
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


<a href="#" style="float:right" data-toggle="modal" data-target="#mod_upload1" style="float:right; margin:5px;"  ><i ></i>.</a>
<br>
<form method ="post" action="<?=base_url('Admin/User/Edit_profile_proses')?>" onSubmit="return vali()">
<?php
        foreach ($user as $us) {
          ?>
          <div class="form-row">
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">User Id</label>
    <input type="text" class="form-control" name="user_id" Value="<?php echo $us->user_id;?>" readonly>
  </div>

  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nama</label>
    <input type="text" class="form-control" name="username" Value ="<?php echo $us->username;?>" placeholder="Input Nama" required readonly>
  </div>
  </div>
    <div class="form-row">
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Email</label>
    <input type="email" class="form-control" name="email" Value ="<?php echo $us->email;?>" placeholder="Input Email" required>
  </div>


    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Telepon</label>
    <input type="number" class="form-control" name="telp" placeholder="Input Tlp" Value ="<?php echo $us->telp;?>" required>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password kamu" Value ="<?php echo $us->password;?>" required>
  </div>
</div>
    
  <button type="submit" class="btn_tmp" style="float:right;">Submit</button>
  <?php
       }
          ?>
</form>
</div>






 </body>