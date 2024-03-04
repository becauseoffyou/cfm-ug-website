<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0;
}
    </style>
    <div class="container">
<div class="container-fluid">
<i><h4>Tambah Surat Keluar</h4></i>
</div>

<div class="container-fluid">

<br>
<form method ="post" action="/form_add_surat_keluar"  enctype="multipart/form-data">
  
<div class="form-row">
 <div class="form-group col-md-6">
      <label for="inputEmail4">Kebutuhan</label>
      <select  class="form-control"  name="kebutuhan_surat" required> 
         <option  value="">Pilih</option> 
      <option  value="External">External</option> 
      <option  value="Internal">Internal</option> 
      </select>
    </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Type Surat</label>
      <select  class="form-control" id="type_surat" name="type_surat" required> 
      <option  value="">Pilih</option> 
  @foreach ($surat_type as $ts)
      <option Value="{{$ts->type}}">{{ $ts->type }}</option>
       @endforeach
      </select>
  </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputEmail4">Lini Bisnis</label>
      <select  class="form-control" id="lini_bisnis" name="lini_bisnis"  required>
      <option Value="">Pilih</option>
         @foreach ($lini_bisnis as $d)
      <option Value="{{ $d->id }}">{{ $d->lini_bisnis }}</option>
       @endforeach
      </select>
    </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal Surat</label>
    <input type="date" class="form-control" name="tanggal" required>
  </div>
    </div>
  

   <div class="form-row">
        <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tujuan</label>
    <input type="text" class="form-control" name="tujuan" placeholder="Input Tujuan Surat" required>
  </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Perihal</label>
    <textarea type="text" style="text-decocartion:none;" spellcheck="false" class="form-control" name="perihal"></textarea>
  </div>


  </div>

     <div class="form-row">
       <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Posisi HardCopy Surat</label>
    <textarea type="text" style="text-decocartion:none;" spellcheck="false" class="form-control" name="posisi_surat"></textarea>
  </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Catatan Tambahan</label>
    <textarea type="text" style="text-decocartion:none;" spellcheck="false" class="form-control" name="keterangan"></textarea>
  </div>
  </div>
     <div class="form-row" style="float:right;">
  <button type="submit" class="btn btn-primary" >Submit</button>
     </div>
</form>
<br>
<br>
</div>
</div>






