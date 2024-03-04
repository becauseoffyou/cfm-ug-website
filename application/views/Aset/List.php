<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<style>
</style>
  <body>

    <!-- Begin Page Content -->
    <section class="section">
    <div class="container-fluid">
    <?= $this->session->flashdata('message');?>

  



   <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                     <?php
      $atm=array("aset_add");
      $result=array_intersect($atm,$userPermission);
      if(count($result)>0)
      {
        ?>

     <a  data-toggle="modal" data-target="#tambah_aset_area" data-rel="tooltip" href='#' title="Tambah" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i> Aset Area</a>
     <a  data-toggle="modal" data-target="#tambah_aset_unit" data-rel="tooltip" href='#' title="Tambah" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i> Aset Unit</a>
 
        <?php
      }
        ?>


       
                        <div class="header-icon" >
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="header-title">
                            <h3>Master Aset</h3>
                            <small>
                                List Master Aset                            </small>
                        </div>
                    </div>
   
       
                    <hr>
                    <form method ="GET" action="<?=base_url('Aset')?>" enctype="multipart/form-data" role="form"> 
<div class="row">  

<div class="col-md-3">                    
<label>Area</label>
 <select  class="form-control" id="area" name="area">
        <option Value="">Pilih</option>
        <?php
        foreach($area as $lok)
            { 
              echo '<option value="'.$lok->id.'">'.$lok->nama_lokasi.'</option>';
            }
            ?>
      </select>
</div>
<div class="col-md-3">                    
<label>Unit</label>
	<select class='form-control' name='unit' id='unit' >
<option value="">Pilih</option>
		</select>	
</div>
<div class="col-md-4">                    
<br>

<button class="btn btn-primary"  style="float:left;margin:8px 0px;" type="submit">Cek</button>
  <a href='<?=base_url('Aset/Export_aset?area=')?><?php echo $data_area;?>&unit=<?php echo encrypt_url($data_unit); ?>' title="export" style="float:left; margin:8px 5px;" class="btn btn-success"> Export To Excel</a>
</div>
   
</div>
 </form>
                </div>
            </div>
  
    <br>



    <br>
      <div class="table-responsive">
      <table id="ab" class="table table-striped table-bordered" >
       <!--   <thead>
            <tr>
           
            th>Kode</th>
              <th>Nama</th>
              <th>Aksi</th>
         
            </tr>
    
           
          </thead>
          <tbody>

           <?php foreach ($list as $d) { ?>
              <tr>
 <th ><?php echo $d->id; ?></th>
  <th ><?php echo $d->nama; ?></th>

  <th>
 <a style='float:right; margin:5px;' href="javascript:;"
    data-id ="<?php echo $d->id;?>"
    data-nama ="<?php echo $d->nama;?>"
    data-toggle="modal" data-target="#edit" data-rel="tooltip" title="Edit"
    ><i class="fas fa-edit" style="color:blue;"></i></a>

            <a style='float:right; margin:5px;' href="javascript:;"
                    data-id ="<?php echo $d->id;?>"
                    data-nama ="<?php echo $d->nama;?>"
                     data-toggle="modal" data-target="#delete" data-rel="tooltip" title="Delete"
            ><i class="fas fa-times" style="color:red;"></i></a>


  </th>
           </tr>
            <?php }?>
         
          </tbody>
           -->

<thead>
  <tr style='text-align:center;'>
  <th rowspan='2'>No</th>
   <th rowspan='2'>Group</th>
     <th rowspan='2'>Unit</th>
      <th rowspan='2'>Nama Aset</th>
   <th rowspan='2'>Bagian Rumah Dinas</th>
    <th rowspan='2'>Kode Barang Mandiri</th>
     <th colspan='4'>Uraian Barang</th>
        <th rowspan='2'>Kondisi Fisik</th>
   <th rowspan='2'>Tahun Perolehan</th>
    <th rowspan='2'>Foto</th>
    <th rowspan='2'>Keterangan</th>
      <th rowspan='2'>Nomor Seri</th>
        <th rowspan='2'>Harga Beli</th>
           </tr>
           <tr>
             <th>Jenis</th>
              <th>Merk</th>
               <th>Type/Bahan</th>
                <th>Jumlah</th>
                
           </tr>
           </thead>
<tbody>
  
    <?php 
    $no=1;
    
    foreach ($list as $d) { ?>
  <tr>
  <td><?php echo $no;?></td>
  <td> <?php echo $d->nama_lokasi;?></td>
  <td><?php echo $d->nama_unit;?> <?php echo $d->blok;?>.<?php echo $d->no_unit;?></td>
  <td> <?php echo $d->nama;?></td>
  <td> <?php echo $d->bagian;?></td>
  <td> <?php echo $d->nomor_aset;?></td>
  <td> <?php echo $d->kategori;?></td>
  <td> <?php echo $d->merek;?></td>
  <td> <?php echo $d->bahan;?></td>
  <td style='text-align:right;'> <?php echo $d->jumlah;?></td>
  <td style='text-align:right;'> <?php echo $d->kondisi;?> %</td>
  <td style='text-align:center;'> <?php echo $d->tgl_beli;?></td>
  <td>	<img  src="<?php if (file_exists('Doc/aset/'.$d->file.'')) { echo base_url('Doc/aset/'.$d->file.'');}else{echo base_url('images/logo/no_image.png');} ?>" onclick="onClick(this)" data-toggle="modal" style="width:50px; height:50px; margin:5px; cursor: pointer;" data-target="#myModal"></td>
  <td> <?php echo $d->deskripsi;?></td>
  <td> <?php echo $d->nomor_seri;?></td>
  <td> Rp. <?php echo number_format($d->harga_beli);?></td>
 
    </tr>
   <?php $no++;
  } ?>
            
           </tbody>



        </table>
      
      </div>

  </div>



  <div class="modal fade" id="tambah_aset_unit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Aset Inventaris Unit</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Aset/Aset_unit_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">

    
<div class="form-group">
<label for="exampleFormControlInput1">Area</label>
 <select  class="form-control" name="id_area_add" id="id_area_unit"  required>
        <option Value="">Pilih</option>
        <?php
        foreach($area as $lok)
            { 
              echo '<option value="'.$lok->id.'">'.$lok->nama_lokasi.'</option>';
            }
            ?>
      </select>
      </div>


          
<div class="form-group">
<label for="exampleFormControlInput1">Unit</label>
 <select  class="form-control" name="id_unit_add" id="id_aset_unit" required>
       

      </select>
      </div>

<div class="form-group">
<label for="exampleFormControlInput1">Nama Aset</label>
<input class='form-control' type="text"  name="nama_aset" required  placeholder="Nama Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Bagian penempatan</label>
<input class='form-control'  type="text" name="bagian" required placeholder="Penempatan seperti Rang Tamu">
</div>


<div class="form-group">
<label for="exampleFormControlInput1">Nomor Aset</label>
<input class='form-control' type="text"  name="nomor_aset"  placeholder="Nomor Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Nomor Seri</label>
<input class='form-control' type="text"  name="sn"  placeholder="Serial Number">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Jenis</label>
<input class='form-control' type="text"  name="jenis"  placeholder="Jenis Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Merek</label>
<input class='form-control' type="text"  name="merek"  placeholder="Merek Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Bahan</label>
<input class='form-control' type="text"  name="bahan"  placeholder="Bahan Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Tanggal Perolehan</label>
<input class='form-control' type="date"  name="tgl"  placeholder="Bahan Aset" required>
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Kondisi dalam %</label>
<input class='form-control' type="number" name="kondisi"  placeholder="Kondisi">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Harga Beli</label>
<input class='form-control' type="number" name="harga_beli"  placeholder="Harga Beli">
</div>


<div class="form-group">
<label for="exampleFormControlInput1">Keterangan</label>
<textarea  name="keterangan"  rows="4" class='form-control' ></textarea>
</div>
      
      
<div class="form-group">
<label for="exampleFormControlInput1">Foto</label>
<input class='form-control' type='file' name='file' required>
</div>

      
    
<hr>
      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
    </form>
    </div>
  </div>
</div>
  

<div class="modal fade" id="tambah_aset_area" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Aset Inventaris Area</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Aset/Aset_area_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">

    
<div class="form-group">
<label for="exampleFormControlInput1">Area</label>
 <select  class="form-control" name="id_area_add" required>
        <option Value="">Pilih</option>
        <?php
        foreach($area as $lok)
            { 
              echo '<option value="'.$lok->id.'">'.$lok->nama_lokasi.'</option>';
            }
            ?>
      </select>
      </div>

<div class="form-group">
<label for="exampleFormControlInput1">Nama Aset</label>
<input class='form-control' type="text"  name="nama_aset" required  placeholder="Nama Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Bagian penempatan</label>
<input class='form-control'  type="text" name="bagian" required placeholder="Penempatan seperti Rang Tamu">
</div>


<div class="form-group">
<label for="exampleFormControlInput1">Nomor Aset</label>
<input class='form-control' type="text"  name="nomor_aset"  placeholder="Nomor Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Nomor Seri</label>
<input class='form-control' type="text"  name="sn"  placeholder="Serial Number">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Jenis</label>
<input class='form-control' type="text"  name="jenis"  placeholder="Jenis Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Merek</label>
<input class='form-control' type="text"  name="merek"  placeholder="Merek Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Bahan</label>
<input class='form-control' type="text"  name="bahan"  placeholder="Bahan Aset">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Tanggal Perolehan</label>
<input class='form-control' type="date"  name="tgl"  placeholder="Bahan Aset" required>
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Kondisi dalam %</label>
<input class='form-control' type="number" name="kondisi"  placeholder="Kondisi">
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Harga Beli</label>
<input class='form-control' type="number" name="harga_beli"  placeholder="Harga Beli">
</div>


<div class="form-group">
<label for="exampleFormControlInput1">Keterangan</label>
<textarea  name="keterangan"  rows="4" class='form-control' ></textarea>
</div>
      
      
<div class="form-group">
<label for="exampleFormControlInput1">Foto</label>
<input class='form-control' type='file' name='file' required>
</div>

      
    
<hr>
      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
    </form>
    </div>
  </div>
</div>






<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Aset</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus data ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Aset/Delete')?>" enctype="multipart/form-data" role="form">
      <input class='form-control' type='text' name='id_delete' id='id_delete'  required hidden> 
      <input class='form-control' type='text' name='nama_delete' id='nama_delete'  hidden>
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>


 <script>
$(document).ready(function() {
    // Untuk sunting
    $('#delete').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
          modal.find('#id_delete').attr("value",div.data('id'));
        modal.find('#nama_delete').attr("value",div.data('nama'));
    });
});
</script>

  
 
<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>

<script>

$("a").click(function() {
setInterval(function(){
  $(".pr").fadeOut("slow");
}, 1000);
        });  
  </script>


<script>
$(document).ready(function(e){
  $('#ab').DataTable(); // End of DataTable
}); // End Document Ready Function
 </script>




 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
           <h5 class="modal-title" id="myModalLabel">Image prev_img</h5>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <img src="" id="img01" style="width: 100%; height: auto;" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <script>
function onClick(element) {
document.getElementById("img01").src = element.src;
document.getElementById("modal01").style.display = "block";
}
</script> 



<script>
$("#id_area_unit").change(function(){
var area = $("#id_area_unit").val();
//alert(area)
 
$.ajax({
    url : "<?=base_url('Aset/Unit_data')?>",
    method : "POST",
    data : {area:area},
    async : true,
    dataType : 'json',
    success: function(data){
    var val =  "<option value=''>All</option>";
		var len = data.data.length;
    if(len > 0){
    $.each(data.data, function(index,value){
      //console.log(data.data.length);
    val +="<option value="+data.data[index].id+">"+data.data[index].nama_unit+"-"+data.data[index].blok+"."+data.data[index].no_unit+"</option>";
    });
	    $('#id_aset_unit').html(val);
	   }
	   else
	   {
		alert('Unit tidak ditemukan');
	  $('#id_aset_unit').html(val);

	   }
    },

});
});
</script>



<script>
$("#area").change(function(){
var area = $("#area").val();
$.ajax({
    url : "<?=base_url('Aset/Unit_data')?>",
    method : "POST",
    data : {area:area},
    async : true,
    dataType : 'json',
    success: function(data){
    var val =  "<option value=''>All</option>";
		var len = data.data.length;
    if(len > 0){
    $.each(data.data, function(index,value){
      //console.log(data.data.length);
    val +="<option value="+data.data[index].id+">"+data.data[index].nama_unit+"-"+data.data[index].blok+"."+data.data[index].no_unit+"</option>";
    });
	  $('#unit').html(val);
	  }
	  else
	  {
		alert('Unit tidak ditemukan');
	  $('#unit').html(val);
	   }
    },

});
});
</script>
    </body>
</html>
