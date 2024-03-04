<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<body id="page-top">
 
<div class="container-fluid">
   <?= $this->session->flashdata('message');?>
   <br>

    <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
       
                        <div class="header-icon" >
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="header-title">
                            <h3>User</h3>
                            <small>
                                Add User
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


<a href="#" style="float:right" data-toggle="modal" data-target="#mod_upload1" style="float:right; margin:5px;"  ><i ></i>.</a>
<br>
<form method ="post" action="<?=base_url('Admin/User/Add_user_proses')?>">
<div class="form-row">
  
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nip</label>
    <input type="number" class="form-control" name="nip" placeholder="Input No Nip" required>
  </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nama</label>
    <input type="text" class="form-control" name="username_add" placeholder="Input Nama" required>
  </div>
  </div>
  <!--
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">Divisi</label>
      <select  class="form-control" id="divisi" name="divisi" required>
      <option Value="">Pilih</option>
        <?php
        foreach($divisi as $div)
            { 
              echo '<option value="'.$div->id.'">'.$div->divisi.'</option>';
            }
            ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Regional</label>
      <select  class="form-control" id="regional" name="regional" required>
      <option Value="">Pilih</option>
      </select>
    </div>
    </div>
          -->
    <div class="form-row">
      <!--
 <div class="form-group col-md-6">
      <label for="inputEmail4">Lini Bisnis</label>
      <select  class="form-control" id="lini_bisnis" name="lini_bisnis" required>
      <option Value="">Pilih</option>
      </select>
    </div>
          -->
    <div class="form-group col-md-6">
      <label for="inputEmail4">Area</label>
      <select  class="form-control" id="lokasi_kerja" name="lokasi_kerja" required>
        <option Value="">Pilih</option>
        <?php
        foreach($lokasi_kerja as $lok)
            { 
              echo '<option value="'.$lok->id.'">'.$lok->nama_lokasi.'</option>';
            }
            ?>
      </select>
    </div>
     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Jabatan</label>
    <input type="text" class="form-control" name="jabatan" placeholder="Input Jabatan" required>
  </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Telepon</label>
    <input type="number" class="form-control" name="telp" placeholder="Input Tlp" required>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Password</label>
    <input type="password" class="form-control" name="password_add" placeholder="Password" required>
  </div>
</div>
<div class="form-row">
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Email</label>
    <input type="email" class="form-control" name="email" placeholder="Email" required>
  </div>
 <div class="form-group col-md-6">
      <label for="inputEmail4">User Type</label>
      <select  class="form-control" id="user_type" name="user_type" required> 
      <option value="">Pilih</option> 
      <?php
        foreach($type as $row_type)
            { ?>
                <option value="<?php echo $row_type->ut_id;?>"><?php echo $row_type->type; ?></option>
             
         <?php   }
            ?>
      </select>
    </div>
    </div>
  <button type="submit" class="btn_tmp" style="float:right;">Submit</button>
</form>
</div>










<div class="modal fade" id="mod_upload1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Upload</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">
    <div class="container">
  <br />
  <h2 style = "text-align:left">Upload user</h2>
		<hr>
		<div class="par">
		<a href="<?php echo base_url('Export_import/Export_import/Export_temp_user'); ?>" class="btn btn-info">Download</a>
		</div>
		<hr>
  <form method="post" id="import_user" enctype="multipart/form-data">
   <p><label>Select Excel File</label>
   <input type="file" name="file" id="file" required accept=".xls, .xlsx" /></p>

   <input type="submit" name="import" value="Import" class="btn btn-info" />
   <hr>
   <div id="spinner" class="spinner" style="display:none;">
    <img id="img-spinner" src="<?php echo base_url(); ?>images/logo/spiner1.gif"/>
</div>
   <div class="progress">
    <div class="progress-bar"></div>
</div>
<div id="uploadStatus"></div>

  </form>
  <br />
 </div>
    </div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
    </div>
    </form>
  </div>
</div>
</div>











<script>
$(document).ready(function(){
 $('#import_user').on('submit', function(event){
  event.preventDefault();
  $.ajax({
    xhr: function(data) {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = ((evt.loaded / evt.total) * 100);
                        $(".progress-bar").width(percentComplete+'%');
                        $(".progress-bar").html(percentComplete+'%');
                        $('#spinner').show();
                        
                    }
                }, false);
                return xhr;
            },
   url:"<?php echo base_url(); ?>Export_import/Export_import/Import_user",
   method:"POST",
   data:new FormData(this),
   contentType:false,
   cache:false,
   processData:false,
   async : true,
   beforeSend: function(data){
                $(".progress-bar").width('0%');
             
            },
            error:function(data){
              $('#file').val('');
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
               // alert(data);
                location.reload(true); 
            },
   success:function(data){
    $('#file').val('');
    alert(data);
    location.reload(true); 
   }

  })
 });
});
</script>
<script>

$("a").click(function() {
setInterval(function(){
  $(".pr").fadeOut("slow");
}, 3000);
        });  


</script>
 </body>