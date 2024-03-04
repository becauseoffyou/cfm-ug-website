<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<body id="page-top">
 
<div class="container-fluid">
   <?= $this->session->flashdata('message');?>
   <br>

    <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
       
                        <div class="header-icon" >
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="header-title">
                            <h3>Penghuni</h3>
                            <small>
                                Update Penghuni
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>



<br>
<?php foreach($data as $d)  {?>
<form method ="post" action="<?=base_url('Penghuni/Penghuni_update_proses')?>">
  <input type="text" class="form-control" name="id" placeholder=""  value='<?php echo $d->kode; ?>' hidden>
 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Kode Penghuni</label>
    <input type="text" class="form-control" name="kode" placeholder=""  value='<?php echo $d->kode; ?>' readonly>
  </div>

     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Status</label>
     <select  class="form-control"  name="status">
        <option Value="0"><?php if($d->status==0){ echo 'Aktif';} else {echo'Non Aktif';}?></option>
     <option Value="0">Aktif</option>
      <option Value="1">Non Aktif</option>
      </select>
  </div>
  
</div>


   <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nama</label>
    <input type="text" class="form-control" name="nama_penghuni" placeholder="Nama Penghuni"  value='<?php echo $d->nama; ?>' required>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Jenis Kelamin</label>
     <select  class="form-control"  name="jk" required>
        <option Value="<?php echo $d->jk; ?>"><?php echo $d->jk; ?></option>
         <option Value="">Pilih</option> 
     <option Value="Laki-Laki">Laki-Laki</option>
      <option Value="Perempuan">Perempuan</option>
      </select>
  </div>
</div>



 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Jabatan</label>
    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" value='<?php echo $d->jabatan; ?>' >
  </div>
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Unit Kerja</label>
    <input type="text" class="form-control" name="unit_kerja" placeholder="Unit Kerja" value='<?php echo $d->unit_kerja; ?>'>
  </div>
</div>


 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nama Pasangan</label>
    <input type="text" class="form-control" name="pasangan" placeholder="Pasangan" value='<?php echo $d->pasangan; ?>' >
  </div>
   <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Hubungan</label>
     <select  class="form-control"  name="hubungan">

        <option Value="<?php echo $d->hubungan; ?>"><?php echo $d->hubungan; ?></option>
           <option Value="">Pilih</option> 
     <option Value="Suami">Suami</option>
      <option Value="Istri">Istri</option>
      </select>
  </div>
</div>



<div class="form-row">
    <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 1</label>
    <input type="text" class="form-control" name="anak1" placeholder="Anak 1" value='<?php echo $d->anak1; ?>'>
  </div>
     <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 2</label>
    <input type="text" class="form-control" name="anak2" placeholder="Anak 2" value='<?php echo $d->anak2; ?>'>
  </div>
     <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 3</label>
    <input type="text" class="form-control" name="anak3" placeholder="Anak 3" value='<?php echo $d->anak3; ?>'>
  </div>
     <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 4</label>
    <input type="text" class="form-control" name="anak4" placeholder="Anak 4" value='<?php echo $d->anak4; ?>'>
  </div>

</div>


 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Telp</label>
    <input type="tel" class="form-control" name="telp" placeholder="No Telephone" value='<?php echo $d->telp; ?>' required>
  </div>

     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Lama Tinggal Sejak</label>
    <input type="date" class="form-control" name="lama_menetap" value='<?php echo $d->lama_menetap; ?>' >
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


<br>
         


            <div class="container-fluid">
               <hr>

            <div class="row">

                <div class="col-md-6">
                    <div class="panel">

                        <div class="panel-body">

                     
                                 <a  data-toggle="modal" data-target="#tambah_kerabat" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Tambah Kerabat</a>
                              
                            <h4>Kerabat</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr style='text-align:center;'>

                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Hubungan</th>
                                      <th>Delete</th>
                                </tr>
                                </thead>
                               <tbody>
                                <?php foreach($kerabat as $k){ ?>
                                  <tr>
                                <td><?php echo $k->nama;?></td>
                                 <td><?php echo $k->alamat;?></td>
                                  <td><?php echo $k->telp_rumah;?> / <?php echo $k->telp;?></td>
                                   <td><?php echo $k->hubungan;?></td>
              <td style='text-align:center;'>
              <a  href="javascript:;"
                    data-id ="<?php echo $k->id;?>"
                     data-toggle="modal" data-target="#delete_kerabat" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>
                      
                     </td>

                                
                                <?php } ?>
                               

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                

                <div class="col-md-6">
                    <div class="panel">

                        <div class="panel-body">

                       
                                      
                                 <a  data-toggle="modal" data-target="#tambah_art" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Tambah ART</a>
                              
                            <h4>ART</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr style='text-align:center;'>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Keterangan</th>
                                      <th>Delete</th>
                                </tr>
                                </thead>
                                     <tbody>
                                <?php foreach($art as $a){ ?>
                                  <tr>
                                <td><?php echo $a->nama;?></td>
                                 <td><?php echo $a->alamat;?></td>
                                  <td><?php echo $a->telp_rumah;?> / <?php echo $a->telp_hp;?></td>
                                   <td><?php echo $a->keterangan;?></td>
              <td style='text-align:center;'>
              <a  href="javascript:;"
                    data-id ="<?php echo $a->id;?>"
                     data-toggle="modal" data-target="#delete_art" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>
                      
                     </td>

                                
                                <?php } ?>
                               

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


            <hr>


              <div class="row">

                <div class="col-md-12">
                    <div class="panel">

                        <div class="panel-body">

                     
                                 <a  data-toggle="modal" data-target="#tambah_kendaraan" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success">Tambah Kendaraan</a>
                              
                            <h4>Kendaraan</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr style='text-align:center;'>

                                    <th>No Polisi</th>
                                     <th>Type</th>
                                    <th>Merek</th>
                                    <th>Warna</th>
                                    <th>Keterangan</th>
                                      <th>Delete</th>
                                </tr>
                                </thead>
                               <tbody>
                                <tbody>
                                <?php foreach($kendaraan as $m){ ?>
                                  <tr>
                                <td><?php echo $m->nopol;?></td>
                                 <td><?php echo $m->type;?></td>
                                  <td><?php echo $m->merek;?> </td>
                                   <td><?php echo $m->warna;?> </td>
                                   <td><?php echo $m->remarks;?></td>
              <td style='text-align:center;'>
              <a  href="javascript:;"
                    data-id ="<?php echo $m->id;?>"
                     data-toggle="modal" data-target="#delete_kendaraan" data-rel="tooltip" title="Cancel" ><i class="fas fa-times" style="color:red; margin:10px;"></i></a>
                      
                     </td>

                                
                                <?php } ?>
                               

                                </tbody>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                
<!--
                <div class="col-md-6">
                    <div class="panel">

                        <div class="panel-body">

                       
                                      
                                 <a  data-toggle="modal" data-target="#tambah_foto" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Tambah Peliharaan</a>
                              
                            <h4>Peliharaan</h4>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Keterangan</th>
                                      <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                        
    

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
-->




            </div>

            </div>





<div class="modal fade" id="tambah_kerabat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Kerabat</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Penghuni/Kerabat_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($d->kode); ?>" name="tambah_id_kerabat" required hidden>

<div class="form-group">
<label for="exampleFormControlInput1">Nama</label>
<input class='form-control' type="text"  name="tambah_nama_kerabat" required>
</div>  

<div class="form-group">
<label for="exampleFormControlInput1">Alamat</label>
<textarea  name="tambah_alamat_kerabat"  rows="4" class='form-control' ></textarea>
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Telp Rumah</label>
<input class='form-control' type="number"  name="tambah_tel_rumah_kerabat" >
</div>  


<div class="form-group">
<label for="exampleFormControlInput1">Telp Hp</label>
<input class='form-control' type="number"  name="tambah_tel_kerabat">
</div>  


<div class="form-group">
<label for="exampleFormControlInput1">Hubungan</label>
<input class='form-control' type="text"  name="tambah_hubungan_kerabat">
</div> 

</div>  
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
    </form>
    </div>
  </div>
</div>



<div class="modal fade" id="tambah_art" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah ART</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Penghuni/Art_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($d->kode); ?>" name="tambah_id_art" required hidden>

<div class="form-group">
<label for="exampleFormControlInput1">Nama</label>
<input class='form-control' type="text"  name="tambah_nama_art" required>
</div>  

<div class="form-group">
<label for="exampleFormControlInput1">Alamat</label>
<textarea  name="tambah_alamat_kerabat"  rows="4" class='form-control' ></textarea>
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Telp Rumah</label>
<input class='form-control' type="number"  name="tambah_tel_rumah_art" >
</div>  


<div class="form-group">
<label for="exampleFormControlInput1">Telp Hp</label>
<input class='form-control' type="number"  name="tambah_tel_art">
</div>  


<div class="form-group">
<label for="exampleFormControlInput1">Ketrangan</label>
<input class='form-control' type="text"  name="tambah_keterangan_art">
</div> 
      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
    </form>
    </div>
  </div>
</div>




<div class="modal fade" id="tambah_kendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Kendaraan</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Penghuni/Kendaraan_add')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"  value="<?php echo encrypt_url($d->kode); ?>" name="tambah_id_kendaraan" required hidden>

<div class="form-group">
<label for="exampleFormControlInput1">No Polisi</label>
<input class='form-control' type="text"  name="tambah_no_pol_kend" required>
</div>  


<div class="form-group">
<label for="exampleFormControlInput1">Merek</label>
<input class='form-control' type="text"  name="tambah_merek_kend" >
</div>  


<div class="form-group">
<label for="exampleFormControlInput1">Warna</label>
<input class='form-control' type="test"  name="tambah_warna_kend">
</div>  


<div class="form-group">
<label for="exampleFormControlInput1">Type</label>
    <select  class="form-control"  name="tambah_type_kend" required>
    <option Value="">Pilih</option> 
     <option Value="Motor">Motor</option>
      <option Value="Mobil">Mobil</option>
      </select>
</div> 

<div class="form-group">
<label for="exampleFormControlInput1">Ketrangan</label>
<input class='form-control' type="text"  name="tambah_keterangan_kend">
</div> 
      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Simpan</button>
    </div>
    </form>
    </div>
  </div>
</div>







<div class="modal fade" id="delete_kerabat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Kerabat</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus data kerabat ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Penghuni/Delete_kerabat')?>" enctype="multipart/form-data" role="form">
    <input type="text"  value="<?php echo encrypt_url($d->kode); ?>" name="id_delete_kerabat" required hidden>
      <input class='form-control' type='text' name='id_delete_kerabat1' id='id_delete_kerabat1'  required hidden> 
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>

 <script>
$(document).ready(function() {
    $('#delete_kerabat').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) 
        var modal = $(this)
        modal.find('#id_delete_kerabat1').attr("value",div.data('id'));
        
    });
});
</script>

<div class="modal fade" id="delete_art" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Art</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus data ART ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Penghuni/Delete_art')?>" enctype="multipart/form-data" role="form">
    <input type="text"  value="<?php echo encrypt_url($d->kode); ?>" name="id_delete_art" required hidden>
      <input class='form-control' type='text' name='id_delete_art1' id='id_delete_art1'  required hidden> 
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>

 <script>
$(document).ready(function() {
    $('#delete_art').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) 
        var modal = $(this)
        modal.find('#id_delete_art1').attr("value",div.data('id'));
        
    });
});
</script>
  






<div class="modal fade" id="delete_kendaraan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Art</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus data Kendaraan ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Penghuni/Delete_kendaraan')?>" enctype="multipart/form-data" role="form">
    <input type="text"  value="<?php echo encrypt_url($d->kode); ?>" name="id_delete_kendaraan" required hidden>
      <input class='form-control' type='text' name='id_delete_kendaraan1' id='id_delete_kendaraan1'  required hidden> 
      <button class="btn btn-danger" type="submit" >Hapus</button>
</form>
    </div>
  </div>
</div>
</div>

 <script>
$(document).ready(function() {
    $('#delete_kendaraan').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) 
        var modal = $(this)
        modal.find('#id_delete_kendaraan1').attr("value",div.data('id'));
        
    });
});
</script>
  






<?php } ?>


         

 </body>