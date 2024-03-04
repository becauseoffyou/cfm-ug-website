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

   <?php
      $atm=array("admin_user_list");
      $result=array_intersect($atm,$userPermission);
      if(count($result)>0)
      {
        ?>
        
          
   <a  data-toggle="modal" data-target="#tambah" data-rel="tooltip" href='#' title="Tambah" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i> Add Dokument</a>
 
        <?php
      }
        ?>



   <div class="kotak"> <h3>List Dokument</h3>
    </div>
    <br>
      <div class="table-responsive">
      <table id="ab" class="table table-striped table-bordered" >
          <thead>
            <tr>
           
              <th>No Dokument</th>
              <th>Nama</th>
              <th>Aksi</th>
         
            </tr>
    
           
          </thead>
          <tbody>

           <?php foreach ($list as $d) { ?>
              <tr>
 <th ><?php echo $d->no_dokement; ?></th>
  <th ><?php echo $d->ty; ?></th>

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
        </table>
      
      </div>

  </div>
  



<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Bank</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Admin/Data_bank/Tambah')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">


 <div class="form-group">
<label for="exampleFormControlInput1">Nama Bank</label>
<input class='form-control' type='text' id="nama_add" name="nama_add"  required>
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


  
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Bank</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Admin/Data_bank/Edit')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">


<div class="form-group">
<label for="exampleFormControlInput1">ID Bank</label>
<input class='form-control' type='text' id="id_edit" name="id_edit"  required readonly>
</div>

 <div class="form-group">
<label for="exampleFormControlInput1">Nama Bank</label>
<input class='form-control' type='text' id="nama_edit" name="nama_edit"  required>
</div>


      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Update</button>
    </div>
    </form>
    </div>
  </div>
</div>



 <script>
$(document).ready(function() {
    // Untuk sunting
    $('#edit').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        // Isi nilai pada field

          modal.find('#id_edit').attr("value",div.data('id'));
        modal.find('#nama_edit').attr("value",div.data('nama'));
    });
});
</script>


<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Delete Bank</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus data ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Admin/Data_bank/Delete')?>" enctype="multipart/form-data" role="form">
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









    </body>
</html>
