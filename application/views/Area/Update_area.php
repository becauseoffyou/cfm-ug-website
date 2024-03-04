<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<body id="page-top">
 
<div class="container-fluid">
   <?= $this->session->flashdata('message');?>
   <br>

    <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
       
                        <div class="header-icon" >
                            <i class="fa fa-map"></i>
                        </div>
                        <div class="header-title">
                            <h3>Area</h3>
                            <small>
                                Update Area
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

   <?php
    
        foreach ($data as $t) {
          ?>

<br>
<form method ="post" action="<?=base_url('Area/Update_area_process')?>">
    <input type="text" class="form-control" name="id" Value="<?php echo $t->id;?>" required hidden>


      <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Kode Area</label>
    <input type="text" class="form-control" name="kode_area" Value="<?php echo $t->kode;?>" placeholder="" readonly>
  </div>
        </div>
   
    <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nama Lokasi</label>
    <input type="text" class="form-control" name="nama_lokasi" Value="<?php echo $t->nama_lokasi;?>" placeholder="Nama Lokasi" required>
  </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Status Aktif</label>
      <select  class="form-control"  name="status_aktif" required> 
        <?php if ($t->status=='1') {?>
            <option value="<?php echo $t->status; ?>">Aktif</option>
          <?php } else {?>
       Non Aktif
            <?php } ?>  
      <option value="0">Non Aktif</option>
       <option value="1">Aktif</option>
      </select>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Catatan</label>
   <textarea  name="catatan"  rows="4" class='form-control' ><?php echo $t->keterangan;?></textarea>
  </div>

     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Alamat lengkap</label>
   <textarea  name="alamat"  rows="4" class='form-control' required="required"><?php echo $t->alamat_lengkap;?></textarea>
  </div>

</div>

<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Latitude</label>
    <input type="text" class="form-control" name="latitude" value="<?php echo $t->lat;?>" placeholder="latitude">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Longtitude</label>
    <input type="text" class="form-control" name="longitude" value="<?php echo $t->long;?>" placeholder="longitude">
  </div>
</div>


<div class="form-row">
   <div class="form-group col-md-12">
  <button type="submit" class="btn_tmp" style="float:right;">Update</button>
  </div>
  <hr>
   </div>
</form>

<br>
          <hr>

            <div class="row">

                <div class="col-md-6">
                    <div class="panel">

                        <div class="panel-body">

                     
                                 <a  data-toggle="modal" data-target="#tambah_file" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Add File Area</a>
                              
                            <h4>Document Atachment</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Document Name</th>
                                    <th>User Create</th>
                                    <th>View</th>
                                      <th>Delete</th>
                                </tr>
                                </thead>
                               <tbody>
                                        <?php
                                        $no=1;
 foreach ($doc as $key => $d) { if ($d->type==1){ ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                        <small><?php echo $d->nama; ?></small>
                                    </td>
                                    <td>
                                      <?php echo $d->user_create; ?>
                                    </td>
                                
                                    <td>
                                <small>
                                  <?php echo anchor(base_url('Doc/file_area/'.$d->file.''), ''.$d->file.'', array('target' => '_blank', 'class' => 'btn btn-secondary'));?>
                                </small>
                                  </td>

                                  <td>
                                    
                          
                                  <a  href="javascript:;"
                    data-id ="<?php echo $d->id;?>"
                    data-name ="<?php echo $d->file;?>"
                    data-desc ="<?php echo $d->nama;?>"
                     data-toggle="modal" data-target="#delete_file" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>
                       
                     
                     
                     </td>
                                </tr>
                              
                             <?php
                             $no++;
 }
}?>
    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                

                <div class="col-md-6">
                    <div class="panel">

                        <div class="panel-body">

                       
                                      
                                 <a  data-toggle="modal" data-target="#tambah_foto" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Add Foto Area</a>
                              
                            <h4>Foto</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Images Name</th>
                                    <th>User Create</th>
                                    <th>View</th>
                                      <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $no=1;
                                       foreach ($doc as $key => $d) { if ($d->type==2){ ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                        <small><?php echo $d->nama; ?></small>
                                    </td>
                                    <td><?php echo $d->user_create; ?></td>
                                
                                    <td>
                               


     <?php if (file_exists('Doc/img_area/'.$d->file.'')) {
       ?>
          
          <img style=" width: 160px;height:160px;cursor:pointer;" src='<?php echo base_url('Doc/img_area/'.$d->file.'')?>?<?=time()?>' onclick="onClick(this)" data-toggle="modal" data-target="#myModal">
      
             <?php  
          } else { ?> 
                 <img src='../images/logo/no_image.png?<?=time()?>' onclick="onClick(this)" data-toggle="modal" data-target="#myModal"> 
         
         <?php  
     } ?>
                                  </td>

                                  <td>
                                    
                          
                                  <a  href="javascript:;"
                    data-id ="<?php echo $d->id;?>"
                    data-name ="<?php echo $d->file;?>"
                    data-desc ="<?php echo $d->nama;?>"
                     data-toggle="modal" data-target="#delete_foto" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>
                       
                     
                     
                     </td>
                                </tr>
                              
                             <?php
                             $no++;
 }
}?>
    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


             <div class="row">

                <div class="col-md-6">
                    <div class="panel">

                        <div class="panel-body">

                     
                                 <a  data-toggle="modal" data-target="#tambah_aset" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Add Aset Inventaris</a>
                              
                            <h4>Aset Inventaris</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                   
                                      <th>Delete</th>
                                </tr>
                                </thead>
                               <tbody>
                                        <?php
                                        $no=1;
 foreach ($aset as $key => $as) {?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                        <small><?php echo $as->nama; ?></small>
                                    </td>
                                    <td><?php echo $as->jumlah; ?></td>
                                
                               

                                  <td>
                                    
                          
                                  <a  href="javascript:;"
                    data-id ="<?php echo $as->id;?>"
                    data-name ="<?php echo $as->nama;?>"
                 
                     data-toggle="modal" data-target="#delete_aset" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:#00060; margin:10px;"></i></a>
                       
                     
                     
                     </td>
                                </tr>
                              
                             <?php
                             $no++;
 
}?>
    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                



   <div class="col-md-6">
                    <div class="panel">

                        <div class="panel-body">

                     
                                 <a  data-toggle="modal" data-target="#tambah_fasilitas" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Add Fasilitas</a>
                              
                            <h4>Fasilitas</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr>

                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Jumlah</th>
                                   
                                      <th>Delete</th>
                                </tr>
                                </thead>
                               <tbody>
                                        <?php
                                        $no=1;
 foreach ($fasilitas as $key => $fs) {?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td>
                                        <small><?php echo $fs->nama_fasilitas; ?></small>
                                    </td>
                                    <td><?php echo $fs->jumlah; ?></td>
                                
                               

                                  <td>
                                    
                          
                                  <a  href="javascript:;"
                    data-id ="<?php echo $fs->id;?>"
                    data-name ="<?php echo $fs->nama_fasilitas;?>"
                 
                     data-toggle="modal" data-target="#delete_fasilitas" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>
                       
                     
                     
                     </td>
                                </tr>
                              
                             <?php
                             $no++;
 
}?>
    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>




              
            </div>


            </div>




 <script>
$(document).ready(function() {
    // Untuk sunting
    $('#delete_file').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        modal.find('#id_file_delete').attr("value",div.data('id'));
        modal.find('#name_file_delete').attr("value",div.data('name'));
         modal.find('#desc_file_delete').attr("value",div.data('desc'));
          modal.find('#desc_teks').html(div.data('desc'));
    });
});
</script>


 <script>
$(document).ready(function() {
    // Untuk sunting
    $('#delete_foto').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        modal.find('#id_foto_delete').attr("value",div.data('id'));
        modal.find('#name_foto_delete').attr("value",div.data('name'));
         modal.find('#desc_foto_delete').attr("value",div.data('desc'));
          modal.find('#desc_teks_foto').html(div.data('desc'));
    });
});
</script>

<!--
 <script>
$(document).ready(function() {
    // Untuk sunting
    $('#delete_aset').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        modal.find('#id_aset_delete').attr("value",div.data('id'));
        modal.find('#desc_aset').attr("value",div.data('name'));
        
    });
});
</script>
-->

 <script>
$(document).ready(function() {
    // Untuk sunting
    $('#delete_fasilitas').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        modal.find('#id_fasilitas_delete').attr("value",div.data('id'));
        modal.find('#desc_fasilitas').attr("value",div.data('name'));
        
    });
});
</script>






<div class="modal fade" id="tambah_fasilitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Fasilitas</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Area/Fasilitas_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_fasilitas_add" required hidden>
<div class="form-group">
   <label for="exampleFormControlInput1">Fasilitas </label>
  <select class='form-control' name='fasilitas_unit_add'  required>
<option value="">Pilih</option>
<?php foreach($data_fasilitas as $af) { ?>
<option value="<?php echo $af->id;?>"><?php echo $af->nama;?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Jumlah</label>
<input class='form-control' type="number"  name="jumlah_fasilitas_add" required>
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


<div class="modal fade" id="tambah_aset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Aset Inventaris</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Area/Aset_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_aset_add" required hidden>

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




<div class="modal fade" id="tambah_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah File</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Area/Document_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_file" required hidden>
<div class="form-group">
<label for="exampleFormControlInput1">Description File</label>
<textarea  name="dok_desc"  rows="4" class='form-control' required="required"></textarea>
</div>
      
      
<div class="form-group">
<label for="exampleFormControlInput1">File</label>
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


<div class="modal fade" id="tambah_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Foto</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Area/Img_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_img" required hidden>
<div class="form-group">
<label for="exampleFormControlInput1">Description File</label>
<textarea  name="img_desc"  rows="4" class='form-control' required="required"></textarea>
</div>
      
      
<div class="form-group">
<label for="exampleFormControlInput1">File</label>
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

<!--

<div class="modal fade" id="delete_aset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Aset</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus file <span id='desc_aset'> </span> ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Unit/Delete_aset')?>" enctype="multipart/form-data" role="form">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_delete_aset" required hidden>
      <input class='form-control' type='text' name='id_aset_delete' id='id_aset_delete'  required hidden> 
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="delete_fasilitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete fasilitas</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus data <span id='desc_aset'> </span> ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Area/Delete_fasilitas')?>" enctype="multipart/form-data" role="form">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_delete_fasilitas" required hidden>
      <input class='form-control' type='text' name='id_fasilitas_delete' id='id_fasilitas_delete'  required hidden> 
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus file <span id='desc_teks'> </span> ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Area/Delete_file')?>" enctype="multipart/form-data" role="form">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_delete" required hidden>
      <input class='form-control' type='text' name='id_file_delete' id='id_file_delete'  required hidden> 
      <input class='form-control' type='text' name='name_file_delete' id='name_file_delete'  hidden>
      <input class='form-control' type='text' name='desc_file_delete' id='desc_file_delete'  hidden>
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>
-->


<div class="modal fade" id="delete_foto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus foto <span id='desc_teks_foto'> </span> ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Area/Delete_foto')?>" enctype="multipart/form-data" role="form">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_delete_foto" required hidden>
      <input class='form-control' type='text' name='id_foto_delete' id='id_foto_delete'  required hidden> 
      <input class='form-control' type='text' name='name_foto_delete' id='name_foto_delete'  hidden>
      <input class='form-control' type='text' name='desc_foto_delete' id='desc_foto_delete'  hidden>
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>
  













  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
           <h5 class="modal-title" id="myModalLabel">Image preview</h5>
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








<?php } ?>
         
<script>

$("a").click(function() {
setInterval(function(){
  $(".pr").fadeOut("slow");
}, 2000);
        });  
  </script>

  <script>
function onClick(element) {
document.getElementById("img01").src = element.src;
document.getElementById("modal01").style.display = "block";
}
</script>   

 </body>