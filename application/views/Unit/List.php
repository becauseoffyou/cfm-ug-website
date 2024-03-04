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
                       <!-- <div class="pull-right text-right" style="line-height: 14px">
                            <small>App Pages<br>Basic<br> <span class="c-white">Projects</span></small>
                        </div>-->
                    <a href="<?=base_url('Unit/Add_Unit')?>" style="float:right; margin:5px;" class="btn_tmp"><i class="fas fa-plus"></i> Tambah</a>
                  <a style="float:right; 
                  margin:5px;
                  color:#fff;
                  width:auto;
                  display: flex;
                  align-items:center;" 
                  href="<?=base_url('Unit/Export_temp')?>" 
                  class="btn_tmp">
                  <i class="fas fa-download"></i> Export Excel</a>
                        <div class="header-icon" >
                          <i class="fas fa-home"></i>
                        </div>
                        <div class="header-title">
                            <h3>Unit</h3>
                            <small>
                                List of unit
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">


                    <div>
                                <div class="table-responsive">
	<table class="table table-bordered table-striped" id='ab'>
                                <thead >
                                <tr style='text-align:center;'>
                                   <th>
                                        Area
                                    </th> 
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Penghuni
                                    </th>
                               
                                    <th>
                                        View
                                    </th>

                                      <th>
                                        Update
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $d) { 
                                        if ($d->status==1){$label_status="label-info";}
           else if ($d->status==2){$label_status="label-success";}
           else if ($d->status==3){$label_status="label-warning";}
           else if ($d->status==4){$label_status="label-danger";}
           else{$label_status="";}
                                      
                                      ?>
                                      <tr style='font-weight:600; text-align:left;'>
                                       <td ><?php echo $d->nama_lokasi; ?>
                                      </td>
                                        <td style='text-align:left;' class='<?php echo $label_status?>'>
                                        Kode Unit : <?php echo $d->kode; ?> <br>
                                        <?php echo $d->nama_unit; ?> <br>
                                         <?php echo $d->blok; ?>.<?php echo $d->no_unit; ?>
                                        <br><?php echo $d->status_detail; ?>
                                      </td>
   <td ><?php echo $d->nama_penghuni; ?>
                                      </td>
                                             </td>

                                        <td >
                                        
             <a href="<?php echo base_url('Unit/Detail_unit?id='.encrypt_url($d->id).'')?>"><i class="fas fa-eye" style="color:#000060; font-size: 20px;"></i><a>
                 
                  
             
           
                                      </td>
                                      <td>
                                          <a href="<?php echo base_url('Unit/Update_unit?id='.encrypt_url($d->id).'')?>"><i class="fa fa-pencil" style="color:#000060; font-size: 20px;"></i><a>
                                    </td>
                                    </tr>
                                 <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
     
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
   <form method ="post" action="<?=base_url('Todolist/Edit')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">
<input type="text" id="id_edit"  name="id_edit" required hidden>


<div class="form-group">
<label for="exampleFormControlInput1">Task name</label>
<textarea  name="task_name_edit" id="task_name_edit"    rows="4" class='form-control' required="required"></textarea>
</div>


<div class="form-group">
<label for="exampleFormControlInput1">Remarks</label>
<textarea  name="task_remarks_edit" id="task_remarks_edit" rows="4" class='form-control' required="required"></textarea>
</div>


<div class="form-group">
   <label for="exampleFormControlInput1">Participan</label>
  <select class='form-control' name='participan_edit' id='participan_edit'  required>
<option value="">Pilih</option>
<?php foreach($pic as $p) { ?>
<option value="<?php echo $p->user_id;?>"><?php echo $p->username;?></option>
<?php } ?>
</select>
</div>



<div class="form-group">
   <label for="exampleFormControlInput1">Priority</label>
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
  $('#ab').DataTable(); // End of DataTable
}); // End Document Ready Function
 </script>
<script>

$("a").click(function() {
setInterval(function(){
  $(".pr").fadeOut("slow");
}, 7000);
        });  
  </script>

</body>

</html>