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
                                Update Unit
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
<form method ="post" action="<?=base_url('Unit/Update_unit_process')?>">
<div class="form-row">

    <input type="text" class="form-control" name="id" Value="<?php echo $t->id;?>" placeholder="Input Blok" hidden>
    <div class="form-group col-md-12">
      <label for="inputEmail4">Lokasi Unit</label>
      <select  class="form-control" id="lokasi_unit" name="lokasi_unit" required>
        <option Value="<?php echo $t->id_lok;?>"> <?php echo $t->nama_lokasi;?></option>
        <?php
        foreach($lokasi_kerja as $lok)
            { 
              echo '<option value="'.$lok->id.'">'.$lok->nama_lokasi.'</option>';
            }
            ?>
      </select>
    </div>
    </div>

 <div class="form-row">
      <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">Type</label>
      <select  class="form-control" id="type" name="type_unit" required>
        <option Value="<?php echo $t->type;?>"><?php if($t->type==0){echo 'Unit';} else if($t->type==1){echo 'Fasum/Fasus';}?></option>
<option Value="0">Unit</option>
<option Value="1">Fasum/Fasus</option>
      </select>
  </div>
    <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">Kode Unit</label>
    <input type="text" class="form-control" name="kode_unit" Value="<?php echo $t->kode;?>" placeholder="" readonly>
  </div>
        <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">Nama / Alamat Unit</label>
    <input type="text" class="form-control" name="nama_unit" Value="<?php echo $t->nama_unit;?>" placeholder="Input Nama Unit Seperti Mampang atau Pancoran" required>
  </div>
</div>


    <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Blok</label>
    <input type="text" class="form-control" name="blok" Value="<?php echo $t->blok;?>" placeholder="Input Blok" required>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">No Unit</label>
    <input type="number" class="form-control" name="no_unit" Value="<?php echo $t->no_unit;?>" placeholder="Nomor Unit" required>
  </div>
</div>
<div class="form-row">

 <div class="form-group col-md-6">
      <label for="inputEmail4">Status Unit</label>
      <select  class="form-control" id="status_unit" name="status_unit" required> 
     <option Value="<?php echo $t->status;?>"> <?php echo $t->status_detail;?></option>
   
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
        <?php if ($t->penghuni=='Kosong') {?>
            <option value="Kosong">Kosong</option>
          <?php } else {?>
          <option Value="<?php echo $t->penghuni;?>"> <?php echo $t->nama_penghuni;?></option>
            <?php } ?>  
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
    <input type="text" class="form-control" name="no_sprd" value="<?php echo $t->dok;?>" placeholder="Nomor SPRD" >
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal SPRD</label>
    <input type="date" class="form-control" name="tgl_sprd" value="<?php echo $t->tgl_dok;?>" placeholder="Tanggal SPRD" >
  </div>
</div>




<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">No BAST Masuk</label>
    <input type="text" class="form-control" name="no_bast" value="<?php echo $t->no_bast;?>" placeholder="Nomor BAST" >
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal BAST Masuk</label>
    <input type="date" class="form-control" name="tgl_bast" value="<?php echo $t->tgl_bast;?>" placeholder="Tanggal BAST" >
  </div>
</div>



<!-- tambahan -->





<div class="form-row">
<div class="form-group col-md-6">
      <label for="inputEmail4"> Wilayah</label>
      <select  class="form-control" id="wilayah" name="wilayah"> 
  
     <option Value="<?php echo $t->wilayah;?>"> <?php echo $t->wilayah;?></option>
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
       
        <option Value="<?php echo $t->kondisi;?>"> <?php echo $t->kondisi;?></option>
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
    <input type="date" class="form-control" name="masuk" Value="<?php echo $t->masuk;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal Keluar</label>
    <input type="date" class="form-control" name="keluar" Value="<?php echo $t->keluar;?>">
  </div>
</div>


    <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal Perbaikan</label>
    <input type="date" class="form-control" name="tgl_perbaikan" Value="<?php echo $t->tgl_perbaikan;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nominal Rab</label>
    <input type="number" class="form-control" name="nominal_rab" Value="<?php echo $t->nominal_rab;?>">
  </div>
</div>


 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nominal SPK</label>
    <input type="number" class="form-control" name="no_spk"  Value="<?php echo $t->nominal_spk;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Kontraktor</label>
    <input type="text" class="form-control" name="kontraktor"  Value="<?php echo $t->kontraktor;?>">
  </div>
</div>


<div class="form-row">
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Listrik</label>
    <input type="text" class="form-control" name="id_listrik" Value="<?php echo $t->id_listrik;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID PAM</label>
    <input type="text" class="form-control" name="id_pam" Value="<?php echo $t->id_pam;?>">
  </div>
</div>


<div class="form-row">
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Telp</label>
    <input type="text" class="form-control" name="id_telp" Value="<?php echo $t->id_telp;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Internet 1</label>
    <input type="text" class="form-control" name="internet_1" Value="<?php echo $t->id_internet1;?>">
  </div>
</div>


<div class="form-row">
  <div class="form-group col-md-6">
  <label for="exampleFormControlInput1">ID Internet 2</label>
    <input type="text" class="form-control" name="internet_2" Value="<?php echo $t->id_internet2;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">ID Internet 3</label>
    <input type="text" class="form-control" name="internet_3" Value="<?php echo $t->id_internet3;?>">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
  <label for="exampleFormControlInput1">ID Internet 4</label>
    <input type="text" class="form-control" name="internet_4" Value="<?php echo $t->id_internet4;?>">
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Daya Listrik</label>
    <input type="text" class="form-control" name="daya_listrik" Value="<?php echo $t->daya_listrik;?>">
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-6">
  <label for="exampleFormControlInput1">Hak Menempati</label>
    <select  class="form-control" id="hak_penempatan" name="hak_penempatan" required> 
          <option Value="<?php echo $t->hak_menempati;?>"> <?php echo $t->hak_menempati;?></option>
            <option value="Ya">Ya</option> 
               <option value="Tidak">Tidak</option> 
      </select> 
  </div>

     <div class="form-group col-md-6">
      <label for="inputEmail4">Klasifikasi</label>
      <select  class="form-control" id="klasifikasi" name="klasifikasi"> 
        
       <option Value="<?php echo $t->klasifikasi;?>"> <?php echo $t->klasifikasi;?></option>
      <?php
        foreach($klasifikasi as $kl)
            { ?>
                <option value="<?php echo $kl->klasifikasi;?>"><?php echo $kl->klasifikasi; ?></option>
             
         <?php   }
            ?>
      </select>
    </div>
</div>

<!-- tambahan -->



















<div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Catatan</label>
   <textarea  name="catatan"  rows="4" class='form-control' ><?php echo $t->keterangan;?></textarea>
  </div>
     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Alamat Lengkap</label>
   <textarea  name="alamat_lengkap"  rows="4" class='form-control' required="required"><?php echo $t->alamat_lengkap;?></textarea>
  </div>
  <!--
  <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">Akhir Masa Sewa</label>
    <input type="date" class="form-control" name="tgl_akhir" value="<?php echo $t->akhir_kontrak;?>" required>
  </div>
            -->
</div>


<div class="form-row">
      <div class="form-group col-md-6">
      <label for="inputEmail4">Status Aktif</label>
      <select  class="form-control"  name="status_aktif" required> 
        <?php if ($t->status_unit=='1') {?>
            <option value="<?php echo $t->status_unit; ?>">Aktif</option>
          <?php } else {?>
       Non Aktif
            <?php } ?>  
      <option value="0">Non Aktif</option>
       <option value="1">Aktif</option>
      </select>
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

                     
                                 <a  data-toggle="modal" data-target="#tambah_file" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Add File Unit</a>
                              
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
                                    <td><?php echo $d->user_create; ?></td>
                                
                                    <td>
                                   <small>
                                  <?php echo anchor(base_url('Doc/file_unit/'.$d->file.''), ''.$d->file.'', array('target' => '_blank', 'class' => 'btn btn-secondary'));?>
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

                       
                                      
                                 <a  data-toggle="modal" data-target="#tambah_foto" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Add Foto Unit</a>
                              
                            <h4>Foto Unit</h4>
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
                               


     <?php if (file_exists('Doc/img_unit/'.$d->file.'')) {
       ?>
          
          <img style=" width: 160px;height:160px;cursor:pointer;" src='<?php echo base_url('Doc/img_unit/'.$d->file.'')?>?<?=time()?>' onclick="onClick(this)" data-toggle="modal" data-target="#myModal">
      
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
                                   
                                      <th>Ubah</th>
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
                 
                     data-toggle="modal" data-target="#delete_aset" data-rel="tooltip" title="Cancel" ><i class="fa fa-pencil" style="color:#000060; margin:10px;"></i></a>
                       
                     
                     
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
   <form method ="post" action="<?=base_url('Unit/Fasilitas_add')?>" enctype="multipart/form-data" role="form">
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
   <form method ="post" action="<?=base_url('Unit/Aset_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($t->id); ?>" name="id_unit_add" required hidden>
<input type="text"  value="<?php echo $t->id_lok; ?>" name="id_area_add" required hidden>


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
   <form method ="post" action="<?=base_url('Unit/Document_add')?>" enctype="multipart/form-data" role="form">
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
   <form method ="post" action="<?=base_url('Unit/Img_add')?>" enctype="multipart/form-data" role="form">
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

    <form method ="post" action="<?=base_url('Unit/Delete_fasilitas')?>" enctype="multipart/form-data" role="form">
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

    <form method ="post" action="<?=base_url('Unit/Delete_file')?>" enctype="multipart/form-data" role="form">
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

    <form method ="post" action="<?=base_url('Unit/Delete_foto')?>" enctype="multipart/form-data" role="form">
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