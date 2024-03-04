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
                    <a href="<?=base_url('Area/Add_Area')?>" style="float:right; margin:5px;" class="btn_tmp"><i class="fas fa-plus"></i> Tambah</a>
                        <div class="header-icon" >
                          <i class="fas fa-map"></i>
                        </div>
                        <div class="header-title">
                            <h3>Area</h3>
                            <small>
                                List of area
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
                                        Detail
                                    </th>
                                      <th>
                                        Update
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
          <?php foreach ($data as $d) { 
         $label_status="label-info"; ?>
                                      <tr style='font-weight:600; text-align:center;'>
                                        <td style='text-align:left;'>
                                        Kode : <?php echo $d->kode; ?><br>
                                        Area : <?php echo $d->nama_lokasi; ?>
                                        <br>Jumlah Unit : <?php echo $d->total; ?></td>

<td><a href="<?php echo base_url('Area/Detail_area?id='.encrypt_url($d->id).'')?>"><i class="fas fa-eye" style="color:#000060; font-size: 20px;"></i><a></td>
<td><a href="<?php echo base_url('Area/Update_area?id='.encrypt_url($d->id).'')?>"><i class="fa fa-pencil" style="color:#000060; font-size: 20px;"></i><a></td>
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


</body>

</html>