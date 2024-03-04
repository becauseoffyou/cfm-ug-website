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
                            <h3>Area</h3>
                            <small>
                                Add Area
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>



<br><form method ="post" action="<?=base_url('Area/New_area_process')?>">

   
    <div class="form-row">
    <div class="form-group col-md-12">
    <label for="exampleFormControlInput1">Nama Lokasi</label>
    <input type="text" class="form-control" name="nama_lokasi"  placeholder="Nama lokasi" required>
  </div>
 
</div>
<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Catatan</label>
   <textarea  name="catatan"  rows="4" class='form-control' ></textarea>
  </div>

     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Alamat lengkap</label>
   <textarea  name="alamat"  rows="4" class='form-control' required="required"></textarea>
  </div>

</div>

<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Latitude</label>
    <input type="text" class="form-control" name="latitude" placeholder="latitude">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Longtitude</label>
    <input type="text" class="form-control" name="longitude"  placeholder="longitude">
  </div>
</div>


<div class="form-row">
   <div class="form-group col-md-12">
  <button type="submit" class="btn_tmp" style="float:right;">Simpan</button>
  </div>
  <hr>
   </div>
</form>
</div>
<br>




         
<script>
     $(document).ready(function(){
$("#divisi").change(function(){
  alert
// variabel dari nilai combo box 
var id_divisi = $("#divisi").val();
// Menggunakan ajax untuk mengirim dan dan menerima data dari server
$.ajax({
    url : "<?=base_url('Admin/User/Get_regional')?>",
    method : "POST",
    data : {id_divisi:id_divisi},
    async : true,
    dataType : 'json',
    success: function(data){
        var html = '';
        var i;

        for(i=0; i<data.length; i++){
            html += '<option value='+data[i].id+'>'+data[i].regional+'</option>';
        }
        $('#regional').html(html);

    }
   
});

$.ajax({
    url : "<?=base_url('Admin/User/Get_lini_bisnis')?>",
    method : "POST",
    data : {id_divisi:id_divisi},
    async : true,
    dataType : 'json',
    success: function(data){
        var html = '';
        var i;

        for(i=0; i<data.length; i++){
            html += '<option value='+data[i].id+'>'+data[i].lini_bisnis+'</option>';
        }
        $('#lini_bisnis').html(html);

    }
   
});
return false;
});
});
</script>

 </body>