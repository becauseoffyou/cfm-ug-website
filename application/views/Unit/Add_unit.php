<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<body id="page-top">
 
<div class="container-fluid">
   <?= $this->session->flashdata('message');?>
   <br>

    <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
       
                        <div class="header-icon" >
                            <i class="fa fa-home"></i>
                        </div>
                        <div class="header-title">
                            <h3>Unit</h3>
                            <small>
                                Add Unit
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>



<br>
<form method ="post" action="<?=base_url('Unit/New_unit_process')?>">
<div class="form-row">

  
    <div class="form-group col-md-6">
      <label for="inputEmail4">Area Unit</label>
      <select  class="form-control" id="lokasi_unit" name="lokasi_unit" required>
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
    <label for="exampleFormControlInput1">Nama / Alamat Unit</label>
    <input type="text" class="form-control" name="nama_unit" placeholder="Input Nama Unit Seperti Mampang atau Pancoran" required>
  </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">Type</label>
      <select  class="form-control" id="type" name="type_unit" required>
        <option Value="">Pilih</option>
<option Value="0">Unit</option>
<option Value="1">Fasum/Fasus</option>
      </select>
  </div>
      <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">Blok</label>
    <input type="text" class="form-control" name="blok" placeholder="Input Blok" required>
  </div>
  <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">No Unit</label>
    <input type="number" class="form-control" name="no_unit" placeholder="Nomor Unit" required>
  </div>
</div>
<div class="form-row">

 <div class="form-group col-md-6">
      <label for="inputEmail4">Status Unit</label>
      <select  class="form-control" id="status_unit" name="status_unit" required> 
      <option value="">Pilih</option> 
   
      <?php
        foreach($status as $row_status)
            { ?>
                <option value="<?php echo $row_status->id;?>"><?php echo $row_status->status_detail; ?></option>
             
         <?php   }
            ?>
      </select>
    </div>

     <div class="form-group col-md-6">
      <label for="inputEmail4">Penghuni</label>
      <select  class="form-control" id="penghuni" name="penghuni" > 
        <option value="">Pilih</option> 
             <option value="Kosong">Kosong</option> 
    
      <?php
        foreach($penghuni as $p)
            { ?>
                <option value="<?php echo $p->kode;?>"><?php echo $p->nama; ?></option>
             
         <?php   }
            ?>
      </select>
    </div>

    
    </div>


   <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">No SPRD</label>
    <input type="text" class="form-control" name="no_sprd" placeholder="Nomor SPRD" >
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal SPRD</label>
    <input type="date" class="form-control" name="tgl_sprd" placeholder="Tanggal SPRD" >
  </div>
</div>




<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">No BAST Masuk</label>
    <input type="text" class="form-control" name="no_bast" placeholder="Nomor BAST" >
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal BAST Masuk</label>
    <input type="date" class="form-control" name="tgl_bast" placeholder="Tanggal BAST" >
  </div>
</div>

<!-- TAMBAHAN -->
<div class="form-row">
<div class="form-group col-md-6">
      <label for="inputEmail4"> Wilayah</label>
      <select  class="form-control" id="wilayah" name="wilayah"> 
      <option value="">Pilih</option> 
   
      <?php
        foreach($wilayah as $w)
            { ?>
                <option value="<?php echo $w->wilayah;?>"><?php echo $w->wilayah; ?></option>
             
         <?php   }
            ?>
      </select>
    </div>

     <div class="form-group col-md-6">
      <label for="inputEmail4">Kondisi Rumah Dinas</label>
      <select  class="form-control" id="kondisi" name="kondisi" > 
        <option value="">Pilih</option> 
    
      <?php
        foreach($kondisi as $k)
            { ?>
                <option value="<?php echo $k->kondisi;?>"><?php echo $k->kondisi; ?></option>
             
         <?php   }
            ?>
      </select>
    </div>
    </div>


     <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal Masuk</label>
    <input type="date" class="form-control" name="masuk" >
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal Keluar</label>
    <input type="date" class="form-control" name="keluar">
  </div>
</div>


    <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal Perbaikan</label>
    <input type="date" class="form-control" name="tgl_perbaikan" >
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nominal Rab</label>
    <input type="number" class="form-control" name="nominal_rab">
  </div>
</div>


 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nominal SPK</label>
    <input type="number" class="form-control" name="no_spk" >
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Kontraktor</label>
    <input type="text" class="form-control" name="kontraktor">
  </div>
</div>


<div class="form-row">
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Listrik</label>
    <input type="text" class="form-control" name="id_listrik">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID PAM</label>
    <input type="text" class="form-control" name="id_pam">
  </div>
</div>


<div class="form-row">
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Telp</label>
    <input type="text" class="form-control" name="id_telp">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Internet 1</label>
    <input type="text" class="form-control" name="internet_1">
  </div>
</div>


<div class="form-row">
  <div class="form-group col-md-6">
  <label for="exampleFormControlInput1">ID Internet 2</label>
    <input type="text" class="form-control" name="internet_2">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Internet 3</label>
    <input type="text" class="form-control" name="internet_3">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
  <label for="exampleFormControlInput1">ID Internet 4</label>
    <input type="text" class="form-control" name="internet_4">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Daya Listrik</label>
    <input type="text" class="form-control" name="daya_listrik">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
  <label for="exampleFormControlInput1">Hak Menempati</label>
    <select  class="form-control" id="hak_penempatan" name="hak_penempatan" required> 
        <option value="">Pilih</option> 
            <option value="Ya">Ya</option> 
               <option value="Tidak">Tidak</option> 
      </select> 
  </div>

     <div class="form-group col-md-6">
      <label for="inputEmail4">Klasifikasi</label>
      <select  class="form-control" id="klasifikasi" name="klasifikasi"> 
        <option value="">Pilih</option> 
    
      <?php
        foreach($klasifikasi as $kl)
            { ?>
                <option value="<?php echo $kl->klasifikasi;?>"><?php echo $kl->klasifikasi; ?></option>
             
         <?php   }
            ?>
      </select>
    </div>
</div>




<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Catatan</label>
   <textarea  name="catatan"  rows="4" class='form-control'></textarea>
  </div>
     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Alamat Lengkap</label>
   <textarea  name="alamat_lengkap"  rows="4" class='form-control' required="required"></textarea>
  </div>
</div>

<div class="form-row">
   <div class="form-group col-md-12">
  <button type="submit" class="btn_tmp" style="float:right;">Submit</button>
  </div>
   </div>
</form>
</div>
<br>




         
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
  <h2 style = "text-align:left">Upload unit</h2>
		<hr>
		<div class="par">
		<a href="<?php echo base_url('Export_import/Export_import/Export_temp_unit'); ?>" class="btn btn-info">Download</a>
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


<a href="#" style="float:right" data-toggle="modal" data-target="#mod_upload1" style="float:right; margin:5px;"  ><i ></i>.</a>








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
   url:"<?php echo base_url(); ?>Export_import/Export_import/Import_unit",
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
             console.log(data)
              $('#file').val('');
                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
               // alert(data);
              // location.reload(true); 
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