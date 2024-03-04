<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
   
</head>
<body>



   
    <!-- End navigation-->

<div class="container-fluid" >
    <div class ="col-md-6">
    <?= $this->session->flashdata('message');?>
    </div>
    </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                    
                         <a  data-toggle="modal" data-target="#tambah" data-rel="tooltip" href='#' title="Tambah" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i></a>
                     <a style="float:right; margin:5px;color:#fff;" class="btn btn-success">Export Excel</a>
                        <div class="header-icon" >
                            <i class="fas fa-headset"></i></i>
                        </div>
                        <div class="header-title">
                            <h3>Helpdesk</h3>
                            <small>
                                List of report
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">


                    <div>
                        <div>
                            <div class="table-responsive">
                            <table class="table table-vertical-align-middle table-responsive-sm" id='ab'>
                                <thead >
                                <tr>
                                      <th>
                                        Tiket
                                    </th> 
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Report
                                    </th>
                                  
                                    <th>
                                        Pelapor
                                    </th>
                                       <th>
                                        Durasi
                                    </th>
                                    <th>
                                        Progress
                                    </th>
                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
     
            </div>

        </div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Laporan Baru</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Helpdesk/New_task')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">

<div class="form-group">
<label for="exampleFormControlInput1">Pelapor</label>
<textarea  name="pelapor"  rows="4" class='form-control' required="required"></textarea>
</div>


<div class="form-group">
<label for="exampleFormControlInput1">Laporan Problem</label>
<textarea  name="task_name"  rows="4" class='form-control' required="required"></textarea>
</div>



<div class="form-group">
<label for="exampleFormControlInput1">Area</label>
 <select  class="form-control" name="id_area_add" id="id_area_add"  required>
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
 <select  class="form-control" name="id_unit_add" id="id_unit_add" required>
        <option Value="">Pilih</option>

      </select>
      </div>

<div class="form-group">
   <label for="exampleFormControlInput1">Type </label>
  <select class='form-control' name='type' id='type'  required>
<option value="">Pilih</option>
<?php foreach($type as $p) { ?>
<option value="<?php echo $p->id;?>"><?php echo $p->type;?></option>
<?php } ?>
</select>
</div>

<div class="form-group">
   <label for="exampleFormControlInput1">Petugas 1</label>
  <select class='form-control' name='pic1'id='pic1'>
<option value="">Pilih</option>
<?php foreach($pic as $p) { ?>
<option value="<?php echo $p->user_id;?>"><?php echo $p->username;?></option>
<?php } ?>
</select>
</div>


<div class="form-group">
   <label for="exampleFormControlInput1">Petugas 2</label>
  <select class='form-control' name='pic2'id='pic2' >
<option value="">Pilih</option>
<?php foreach($pic as $p) { ?>
<option value="<?php echo $p->user_id;?>"><?php echo $p->username;?></option>
<?php } ?>
</select>
</div>

<!--
<div class="form-group">
   <label for="exampleFormControlInput1">Priority</label>
  <select class='form-control' name='pr'>
<option value="">Pilih</option>
<option value="High">High</option>
<option value="Medium">Medium</option>
<option value="Low">Low</option>
</select>
</div>

-->
      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Save</button>
    </div>
    </form>
    </div>
  </div>
</div>








<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Update Cancel</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Helpdesk/Cancel')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text"id="id_cancel"  name="id_cancel" required hidden>

<div class="form-group">
<label for="exampleFormControlInput1">Cancel Note</label>
<textarea  name="task_cancel"  rows="4" class='form-control' required="required"></textarea>
</div>
      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    </form>
    </div>
  </div>
</div>





<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Helpdesk/Edit')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text" id="id_edit"  name="id_edit" required hidden>


<div class="form-group">
<label for="exampleFormControlInput1">Detail Laporan</label>
<textarea  name="task_name_edit" id="task_name_edit"    rows="4" class='form-control' required="required"></textarea>
</div>

<div class="form-group">
<label for="exampleFormControlInput1">Solusi</label>
<textarea  name="task_remarks_edit" id="task_remarks_edit" rows="4" class='form-control' ></textarea>
</div>


<div class="form-group">
   <label for="exampleFormControlInput1">Teknisi</label>
  <select class='form-control' name='participan_edit' id='participan_edit'>
<option value="">Pilih</option>
<?php foreach($pic as $p) { ?>
<option value="<?php echo $p->user_id;?>"><?php echo $p->username;?></option>
<?php } ?>
</select>
</div>


<div class="form-group">
   <label for="exampleFormControlInput1">Prioritas</label>
  <select class='form-control' name='pr_edit'  id='pr_edit' required>
<option value="">Pilih</option>
<option value="High">High</option>
<option value="Medium">Medium</option>
<option value="Low">Low</option>
</select>
</div>






      </div>
      
      <div class="modal-footer">
      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
      <button class="btn btn-primary" type="submit">Submit</button>
    </div>
    </form>
    </div>
  </div>
</div>

 <script>
$(document).ready(function() {
    // Untuk sunting
    $('#cancel').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
          modal.find('#id_cancel').attr("value",div.data('id'));
   
    });
    $('#update').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
          modal.find('#id_edit').attr("value",div.data('id'));
          modal.find('#task_name_edit').text(div.data('job_detail'));
            modal.find('#task_remarks_edit').text(div.data('note'));
              modal.find("#participan_edit option:selected").attr("value",div.data('pic')).text(div.data('name_pic'));
                modal.find("#pr_edit option:selected").attr("value",div.data('type')).text(div.data('type'));
    });
});
</script>

<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
  
<script>
$(document).ready(function(e){
 
  var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this
  $('#ab').DataTable({
     "pageLength" : 10,
     "processing": true,
     "serverSide": true,
     //"order": [],
     "ordering":false,
     "ajax":{
          url :  base_url+'Helpdesk/List_data1?status=<?php echo $id ;?>',
              type : 'POST',
              deferLoading:57
            },
  }); // End of DataTable
}); // End Document Ready Function
 </script>
<script>
$("#id_area_add").change(function(){
var area = $("#id_area_add").val();
//alert(area)
 
$.ajax({
    url : "<?=base_url('Helpdesk/Unit_data')?>",
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
     val += "<option value='" + data.data[index].id + "'>" + data.data[index].nama_unit + " " + ((data.data[index].blok !== null && data.data[index].blok !== '') ? data.data[index].blok : '') + "." + data.data[index].no_unit + "/" + data.data[index].nama_penghuni + "</option>";
    });
	    $('#id_unit_add').html(val);
	   }
	   else
	   {
		alert('Unit tidak ditemukan');
	  $('#id_unit_add').html(val);

	   }
    },

});
});
</script>

</body>

</html>