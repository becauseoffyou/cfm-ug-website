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
      $atm=array("fasilitas_add");
      $result=array_intersect($atm,$userPermission);
      if(count($result)>0)
      {
        ?>
        
          
  
    <a  data-toggle="modal" data-target="#tambah" data-rel="tooltip" href='#' title="Tambah" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i> Tambah Nama Fasilitas</a>

     <a href='<?php echo base_url('Fasilitas/Export_nama_fasilitas'); ?>' title="Export" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i> Export To Excel</a>
 
        <?php
      }
        ?>


       
                        <div class="header-icon" >
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="header-title">
                            <h3>Nama Fasilitas</h3>
                            <small>
                                List Nama Fasilitas                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
  
    <br>



    <br>
      <div class="table-responsive">
      <table id="ab" class="table table-striped table-bordered" >
        <thead>
            <tr style='text-align:center;'>
           
          
              <th>Nama</th>
              <th>Aksi</th>
         
            </tr>
    
           
          </thead>
          <tbody>

           <?php foreach ($list as $d) { ?>
              <tr>

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
    


        </table>
      
      </div>

  </div>
  



<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah Nama Fasilitas</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Fasilitas/Tambah')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">


 <div class="form-group">
<label for="exampleFormControlInput1">Nama Fasilitas</label>
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
      <h5 class="modal-title" id="exampleModalLabel">Edit Fasilitas</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Fasilitas/Edit')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">


<div class="form-group">
<label for="exampleFormControlInput1">ID Fasilitas</label>
<input class='form-control' type='text' id="id_edit" name="id_edit"  required readonly>
</div>

 <div class="form-group">
<label for="exampleFormControlInput1"> Fasilitas</label>
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
      <h5 class="modal-title" id="exampleModalLabel">Delete Fasilitas</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">Apakah anda yakin untuk menghapus data ?</div>
    <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

    <form method ="post" action="<?=base_url('Fasilitas/Delete')?>" enctype="multipart/form-data" role="form">
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




    </body>
</html>
