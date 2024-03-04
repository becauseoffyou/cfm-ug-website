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
                    <a href="<?=base_url('Penghuni/Tambah_penghuni')?>" style="float:right; margin:5px;" class="btn_tmp"><i class="fas fa-plus"></i> Tambah</a>
                  <a style="float:right; 
                  margin:5px;
                  color:#fff;
                  width:auto;
                  display: flex;
                  align-items:center;" 
                  href="<?=base_url('Unit/Export_temp')?>" 
                  class="btn_tmp">
                  <i class="fas fa-download"></i> Export Excel</a>-->
                        <div class="header-icon" >
                          <i class="fas fa-car"></i>
                        </div>
                        <div class="header-title">
                            <h3>Kendaraan Penghuni</h3>
                            <small>
                                List Kendaraan Penghuni
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
                                        Penghuni
                                    </th> 
                                    <th>
                                        No Polisi
                                    </th>
                                     <th>
                                        Type
                                     </th>
                                    <th>
                                        Merek
                                     </th>
                                      <th>
                                        Warna
                                     </th>
                                       <th>
                                        Keterangan
                                     </th>
                                       <th>
                                        Detail
                                    </th>
                               
                                </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $d) { 
                                    
                                      ?>
                                      <tr style='font-weight:600; text-align:left;'>
                                       <td ><?php echo $d->penghuni; ?></td>
                                        <td ><?php echo $d->nopol; ?></td>
                                         <td ><?php echo $d->type; ?>  </td> 
                                          <td ><?php echo $d->merek; ?>  </td>       
                                            <td ><?php echo $d->warna; ?>  </td>  
                                             <td ><?php echo $d->remarks; ?>  </td>        
                                         <td style=' text-align:center;'><a href="<?php echo base_url('Penghuni/Detail_penghuni?id='.encrypt_url($d->id_penghuni).'')?>"><i class="fa fa-eye" style="color:#000060; font-size: 20px;"></i><a></td>     
                                   
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