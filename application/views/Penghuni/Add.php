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
                                Tambah Penghuni
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>



<br>
<form method ="post" action="<?=base_url('Penghuni/Penghuni_baru_proses')?>">




   <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nama</label>
    <input type="text" class="form-control" name="nama_penghuni" placeholder="Nama Penghuni" required>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Jenis Kelamin</label>
     <select  class="form-control"  name="jk" required>
        <option Value="">Pilih</option>
     <option Value="Laki-Laki">Laki-Laki</option>
      <option Value="Perempuan">Perempuan</option>
      </select>
  </div>
</div>



 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Jabatan</label>
    <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" >
  </div>
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Unit Kerja</label>
    <input type="text" class="form-control" name="unit_kerja" placeholder="Unit Kerja" >
  </div>
</div>


 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nama Pasangan</label>
    <input type="text" class="form-control" name="pasangan" placeholder="Pasangan" >
  </div>
   <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Hubungan</label>
     <select  class="form-control"  name="hubungan">
        <option Value="">Pilih</option>
     <option Value="Suami">Suami</option>
      <option Value="Istri">Istri</option>
      </select>
  </div>
</div>



<div class="form-row">
    <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 1</label>
    <input type="text" class="form-control" name="anak1" placeholder="Anak 1" >
  </div>
     <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 2</label>
    <input type="text" class="form-control" name="anak2" placeholder="Anak 2" >
  </div>
     <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 3</label>
    <input type="text" class="form-control" name="anak3" placeholder="Anak 3" >
  </div>
     <div class="form-group col-md-3">
    <label for="exampleFormControlInput1">Anak 4</label>
    <input type="text" class="form-control" name="anak4" placeholder="Anak 4" >
  </div>

</div>


 <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Telp</label>
    <input type="tel" class="form-control" name="telp" placeholder="No Telephone" required>
  </div>

     <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Lama Tinggal Sejak</label>
    <input type="date" class="form-control" name="lama_menetap" >
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




         


 </body>