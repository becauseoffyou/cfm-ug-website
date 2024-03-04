<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
  .boxb{
width:100%;
text-align:center;
justify-content:center;
border-radius:5px;
padding:10px 0;
border:none;


}
.isiboxb{
border: 1px solid #EBF0FF;
margin :10px 5px 2px 5px;
width:200px;
height:305px;
float: center;
background-color:#ffffff;
border-radius:15px;
padding: 5px;
position : relative;
cursor: pointer;  
display : inline-block;
text-align:center;
outline: none;
}
.gambar{
border:none;
width:auto;
height:200px;
margin:50% auto;
position : absolute;
padding:5px;

}
.gambar img{
width:100%;
height:auto;
}
.judul{
color:grey;
background-color:transparent;
padding :5px;
display:flex;
bottom:10px;
margin-top:1px;
font-size: 12px;
position : absolute;
width:98%;
overflow: hidden;
text-overflow: ellipsis; 
}

  
.isiboxb:hover {
        transform: translateY(-10px);
        border: 1px solid #0171b9;
        box-shadow: 1px 1px 10px grey;
        text-decoration:none;

    }
@media screen and (max-width:600px) {
.isiboxb{
width:150px;
height:230px;
}

}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0;
}
    </style>
    <div class="container">
<div class="container-fluid">
<i><h4>Update Surat Keluar</h4></i>
</div>

<div class="container-fluid">
    @if ($message = Session::get('suc'))
<div class="alert alert-success" role="alert">
    {{ $message }}
</div>
@endif
    @if ($message = Session::get('er'))
<div class="alert alert-danger" role="alert">
    {{ $message }}
</div>
@endif
<br>


<form method ="post" action="/update_surat_keluar"  enctype="multipart/form-data">
     {{ csrf_field() }}
       @foreach ($surat_keluar as $key => $sk)
        <div class="form-row">
     <div class="form-group col-md-12">
       <input type="text" class="form-control" name="id" value="{{$id}}" required hidden>
      <label for="inputEmail4">No surat</label>
      <input type="text" class="form-control" name="no_surat" value="{{$sk->no_surat}}" required readonly>
  </div>
  </div>
     <div class="form-row">
     <div class="form-group col-md-6">
      <label for="inputEmail4">Kebutuhan</label>
      <select  class="form-control"  name="kebutuhan_surat" required> 
       <option  value="{{$sk->kebutuhan_surat}}">{{$sk->kebutuhan_surat}}</option> 
      <option  value="External">External</option> 
      <option  value="Internal">Internal</option> 
      </select>
    </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Type Surat</label>
      <select  class="form-control" id="type_surat" name="type_surat" required> 
      <option  value="{{$sk->type_surat}}">{{$sk->type_surat}}</option> 
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
     <option  value="{{$sk->lini_bisnis}}">{{$sk->lb}}</option> 
         @foreach ($lini_bisnis as $d)
      <option Value="{{ $d->id }}">{{ $d->lini_bisnis }}</option>
       @endforeach
      </select>
    </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tanggal Surat</label>
    <input type="date" class="form-control" name="tanggal" value="{{$sk->tanggal_surat}}" required>
  </div>
    </div>
  

   <div class="form-row">
        <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Tujuan</label>
    <input type="text" class="form-control" name="tujuan" value="{{$sk->tujuan}}" placeholder="Input Tujuan Surat" required>
  </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Perihal</label>
    <textarea type="text" style="text-decocartion:none;" spellcheck="false" class="form-control" name="perihal">{{$sk->perihal}}</textarea>
  </div>


  </div>

     <div class="form-row">
       <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Posisi HardCopy Surat</label>
    <textarea type="text" style="text-decocartion:none;" spellcheck="false" class="form-control" name="posisi_surat">{{$sk->posisi_surat}}</textarea>
  </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Catatan Tambahan</label>
    <textarea type="text" style="text-decocartion:none;" spellcheck="false" class="form-control" name="keterangan">{{$sk->keterangan}}</textarea>
  </div>
  </div>
     <div class="form-row" style="float:right;">
  <button type="submit" class="btn btn-primary" >Submit</button>
     </div>
          @endforeach
</form>
<br>
<br>

 

  <hr>        
</div>

<div class="container-fluid">
<i><h4>Upload File Surat Keluar</h4></i>
 <form action="/uploadfile_surat_keluar" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
            <div class="row">
      <input type="text" class="form-control" name="id_file" value="{{$id}}" required hidden>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlInput1">pdf,xlx,xlsx,csv,docx,jpg,jpeg,png</label>
                    <input type="file" name="file" class="form-control" required>
               <br>
         
                    <button type="submit" class="btn btn-success" style="float:right;">Upload</button>
            
                </div>
   
            </div>
        </form>
</div>
<hr>
<div class="container-fluid">
<i><h4>File Surat Keluar</h4></i>

<div class="table-responsive">
      <table id="User" class="table table-striped table-bordered" >
          <thead>
            <tr>
              <th>#</th>
              <th>Nama File</th>
              <th>Tanggal Upload</th>
              <th colspan="2">Aksi</th>
              </tr>
          </thead>
          <tbody>
             @forelse ($files as $key => $file)
            <tr>
               <th>{{$loop->iteration}}</th>
                <td>{{$file->nama}}</td>
                 <td>{{$file->create_date}}</td>
              <td><a type="button" class="btn btn-primary" target="blank" href="uploads/surat_keluar/{{ $file->nama}}">View</a></td>
       <td>
 
      <a name="del" href="javascript:;"
  data-id ="{{$id}}"
  data-id_file ="{{$file->id}}"
  data-nama_file = "{{$file->nama}}"
  data-toggle="modal" data-target="#mod_del"><i class="far fa-times-circle" style="color:red;"></i></a>
 
      </td>
              </tr>
               @empty
 <tr>Belum ada file</tr>
@endforelse
              </tbody>
       </table>
</div>

<hr>
<div class="container-fluid">
<i><h4>Log Surat Keluar</h4></i>
 @foreach ($logs as $key => $log)
<i style="font-size:12px;color:#000020;">{{ $log->us_create}} ({{ $log->us_create}}) : {{ $log->create_date}} </i>
<p style="font-size:12px">{{ $log->keterangan}} </p> 
<hr>
@endforeach


</div>

</div>




</div>

<div class="modal fade" id="mod_del" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
           <h4 class="modal-title" id="myModalLabel" style="color:#51b9ec;">ITBS</h4>
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
          <p class="modal-title" id="myModalLabel" style="color:#51b9ec;">Apakah anda ingin menghapus <span id="nama_alamat_del"></span> ?</p>
      
      </div>
       <div class="modal-footer">
    <div style="float:right">
       <form action="/delete_surat_keluar" method="post" enctype="multipart/form-data">
          {{ csrf_field() }}
      <input type="text" class="form-control" name="id" id="id" value=""  required hidden>
        <input type="text" class="form-control" name="id_file" id="id_file" value="" required hidden>  
        <input type="text" class="form-control" name="nama_file"  id="nama_file" value="" required hidden> 
       
        <a  data-dismiss="modal" style="color:white;" class="btn btn-primary"  id='btnNo'>No</a>
    <button  class="btn btn-danger" type="submit" style="color:white;" onclick="Del_ad()" id='btnYes'>Yes</button>
</form>
</div>
        </div>
    </div>
  </div>
</div>

  <script src="assets/ckeditor/ckeditor.js"></script>
  <script type="text/javascript">
      CKEDITOR.replace( 'editor',{height: 250} );
    </script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
     <script>
$(document).ready(function() {
    $('#mod_del').on('show.bs.modal', function (e) {
var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
var modal = $(this)
modal.find('#id').attr("value",div.data('id'));  
modal.find('#nama_file').attr("value",div.data('nama_file')); 
modal.find('#id_file').attr("value",div.data('id_file')); 
    });
});
</script>
@endsection





