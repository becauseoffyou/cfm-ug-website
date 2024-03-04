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
                    
                
                        <div class="header-icon" >
                            <i class="fas fa-headset"></i></i>
                        </div>
                        <div class="header-title">
                            <h3>Approve Helpdesk</h3>
                            <small>
                                List of request
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
            <div class="pull-right">
     
            </div>

        </div>



      </div>
      


<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
  
<script>
$(document).ready(function(e){
 
  var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this
  $('#ab').DataTable({
     "pageLength" : 100,
     "processing": true,
     "serverSide": true,
     //"order": [],
     "ordering":false,
     "ajax":{
          url :  base_url+'Helpdesk/List_data_manager',
              type : 'POST',
              deferLoading:57
            },
  }); // End of DataTable
}); // End Document Ready Function
 </script>

</body>

</html>