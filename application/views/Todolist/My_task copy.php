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
                        </div>
                         <a  data-toggle="modal" data-target="#tambah" data-rel="tooltip" href='#' title="Tambah" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i></a>-->
                        <div class="header-icon" >
                            <i class="pe page-header-icon pe-7s-box1"></i>
                        </div>
                        <div class="header-title">
                            <h3>Task</h3>
                            <small>
                                List of all Task
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
                            <table class="table table-vertical-align-middle table-responsive-sm" id='ab'>
                                <thead >
                                <tr>
                                    
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Task name
                                    </th>
                                     <th>
                                        Priority
                                    </th>
                                    <th>
                                        Participate
                                    </th>
                                       <th>
                                        Time
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
            <div class="pull-right">
     
            </div>

        </div>

<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
   <form method ="post" action="<?=base_url('Todolist/New_task')?>" enctype="multipart/form-data" role="form">
    <div class="modal-body">


<div class="form-group">
<label for="exampleFormControlInput1">Task name</label>
<textarea  name="task_name"  rows="4" class='form-control' required="required"></textarea>
</div>


<div class="form-group">
<label for="exampleFormControlInput1">Remarks</label>
<textarea  name="task_remarks"  rows="4" class='form-control' required="required"></textarea>
</div>


<div class="form-group">
   <label for="exampleFormControlInput1">Participan</label>
  <select class='form-control' name='id'id='id'  required>
<option value="">Pilih</option>
<?php foreach($pic as $p) { ?>
<option value="<?php echo $p->user_id;?>"><?php echo $p->username;?></option>
<?php } ?>
</select>
</div>


<div class="form-group">
   <label for="exampleFormControlInput1">Priority</label>
  <select class='form-control' name='pr'  required>
<option value="">Pilih</option>
<option value="High">High</option>
<option value="Medium">Medium</option>
<option value="Low">Low</option>
</select>
</div>


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
   <form method ="post" action="<?=base_url('Todolist/Cancel')?>" enctype="multipart/form-data" role="form">
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
          url :  base_url+'Todolist/List_data',
              type : 'POST',
              deferLoading:57
            },
  }); // End of DataTable
}); // End Document Ready Function
 </script>


</body>

</html>