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
                            <h3>List Document</h3>
                            <small>
                                List of all Document
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
                                        Document Name
                                    </th>
                                    <th>
                                        Link
                                    </th>
                                     <th>
                                       User Create
                                    </th>
                                    <th>
                                        Create Date
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
          url :  base_url+'Data_dokument/List_data',
              type : 'POST',
              deferLoading:57
            },
  }); // End of DataTable
}); // End Document Ready Function
 </script>

<script>

$("a").click(function() {
setInterval(function(){
  $(".pr").fadeOut("slow");
}, 1000);
        });  
  </script>
</body>

</html>