<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style>
   .page-item.active .page-link {
      color:#fff;
    }
    </style>
  <body>
 
    <!-- Begin Page Content -->
    <section class="section">
    <div class="container-fluid">
       <?= $this->session->flashdata('message');?>
   <?php if ($this->session->userdata('regional_id')==0){ ?>
  
  
    <?php } ?>
   
            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                       <!-- <div class="pull-right text-right" style="line-height: 14px">
                            <small>App Pages<br>Basic<br> <span class="c-white">Projects</span></small>
                        </div>
                         <a  data-toggle="modal" data-target="#tambah" data-rel="tooltip" href='#' title="Tambah" style="float:right; margin:5px;" class="btn btn-success"><i class="fas fa-plus"> </i></a>-->
                        <div class="header-icon" >
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </div>
                        <div class="header-title">
                            <h3>Absensi</h3>
                            <small>
                                List Hari Ini                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
      <br>
 <form method="get"  action="<?=base_url('Absensi/Absensi')?>" enctype="multipart/form-data">
	<div class="form-row">
 <div class="form-group col-md-6">
</div>
 <div class="form-group col-md-6">
  <label>Cek</label>
 <input type="date" class="form-control" name="tgl" required>
  <button class="btn btn-primary"  onClick=" javascript:return confirm('Sort by tanggal?')" id="btn" type="submit" style ="box-shadow: 2px 2px 2px #5868ec;
    padding: 5px; width:70px; margin:5px; float:right;">Cek</button>
</div>

</div>
</form>
      <br>
        <div class="row">
 
      <div class="col-md-12">
        <canvas id="myChart" style="
                      height: 80vh;
                      width: 100vw;
                      align-items: center;
                      justify-content: center;
                      display: flex;`"></canvas>
 
      </div>

    </div>

     <br>
<div class="table-responsive">
      <table id="User" class="table table-hover" >
          <thead>
            <tr style="text-align:center;">
              <th>#</th>
              <th>Username</th>
               <th>Tanggal</th>
              <th>Masuk</th>
              <th>Pulang</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
<?php
$no=1;
  foreach($list as $key => $ls) {
  ?>
            <tr  style="text-align:center;">
               <th 
               <?php
               if ($ls->stat_in == 2 || $ls->stat_out == 2 ) {?>
          style="background-color: #FBBC05; color:#fff; text-align:center;"
 <?php } else if ($ls->in_absen == "" ) { ?>
         style="background-color: red; color:#fff; text-align:center;"
<?php } else { ?>
style="background-color: #34A853; color:#fff; text-align:center;"
<?php } ?>
              ><?php echo $no; ?></th>
              
              <td style="text-align:left;"><?php echo  $ls->username; ?></td>
               <td><?php echo $tgl; ?></td>
              <td <?php if ($ls->in_absen > "07:30:00") {?>
         style="color: red;  text-align:center;"
<?php } else { ?>
 style="color: #34A853;  text-align:center;"
         <?php } ?> ><?php echo  $ls->in_absen; ?></td>     
              <td <?php if ($ls->out_absen < "16:30:00") { ?>
         style="color: red; text-align:center;"
<?php } else {?>
 style="color: #34A853; text-align:center;"
         <?php } ?>><?php echo  $ls->out_absen; ?></td>
              <td style="text-align:center;">
              
              <?php if($ls->in_absen !="") {?>
              <a type="button" class="btn btn-primary" href="<?=base_url('Absensi/Absensi/Detail?')?>id=<?php echo encrypt_url($ls->id); ?>">Detail</a>
          <?php } else {?>
            <a class="btn btn-danger"><i class="fa fa-exclamation" style="color:white;"></i></a>
            <?php } ?>
            </td>
</tr>
 <?php 
 $no++;
} ?>
</tbody>
</table>
<!--
<a type="button" class="btn btn-primary" href="/export_absensi">Export</a>
-->
</div>
      </div>
  
   
<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
  <script>
     $(document).ready(function() {
  $('#User').DataTable();

});
 </script>

 <script src="<?=base_url('assets/');?>vendor/chart.js/Chart.min.js"></script>
 <script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: ["Tidak Absen", "Absen masuk di kantor", "Absen masuk di luar kantor", "Absen pulang di kantor", "Absen pulang di luar kantor",],
      datasets: [{
          label: '',
          data: [
           <?php echo $bar1;?>, 
           <?php echo $bar2;?>, 
           <?php echo $bar3;?>, 
           <?php echo $bar4;?>,
          <?php echo $bar5;?>
          ],
          backgroundColor: [
              'rgba(255, 99, 132)',
              'rgba(54, 162, 235)',
              'rgba(255, 206, 86)',
              'rgba(75, 192, 192)',
              'rgba(153, 102, 255)',
              
          ],
          borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 2
      }]
  },
  options: {
      legend: {
        display: false
    },
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true
              }
          }]
      }
  }
});
</script>

    </body>
</html>