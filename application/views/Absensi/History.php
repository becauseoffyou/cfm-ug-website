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
                                History Absensi                           </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
      <br>
 <form method="get"  action="<?=base_url('Absensi/Absensi/History_absensi')?>" enctype="multipart/form-data">
		<div class="form-row">
 <div class="form-group col-md-4">
   <label>Bulan</label>
 <input type="month" placeholder="2020" class="form-control" name="bulan"  required>
 </div>
 <div class="form-group col-md-4">
   <label>Pegawai</label>
<select  class="form-control" name="pegawai" required> 
        <option  value="">Pilih</option> 
  <?php
        foreach($user as $us)
            { 
                echo '<option value="'.$us->user_id.'">'.$us->username.'</option>';
            }
            ?>
      </select>
 </div>
  <div class="form-group col-md-2">
   
  <button class="btn btn-primary"  onClick=" javascript:return confirm('Sort by bulan?')"  type="submit" style ="box-shadow: 2px 2px 2px #5868ec;
    padding: 5px; width:50px; bottom:0; position:absolute;">Cek</button>
</div>
</div>
</form>
      <br>
    <h5 style="color:#000080;"><i>Pegawai : <?php echo $un;?></i></h4>
<?php if ($iud != "" ) { ?>
 <form method="get" action="<?=base_url('Absensi/Absensi/Pdf')?>"   enctype="multipart/form-data">
	<div class="form-row">
  <div class="form-group col-md-12">
    <input type="hidden" class="form-control" name="pegawai" value="<?php echo $iud;?>" required>
     <input type="hidden"  class="form-control" name="bulan"  value="<?php echo $tgl;?>" required>
  <button class="btn btn-danger"    type="submit" style ="box-shadow: 2px 2px 2px #5868ec;
    padding: 5px; width:50px;">Print</button>
</div>
</div>
</form>
 <?php } ?>
<hr>

</form>
      <br>
  
 <form method="get" action="<?=base_url('Absensi/Absensi/Cc')?>"   enctype="multipart/form-data">
	<div class="form-row">
  <div class="form-group col-md-12">
    <input type="hidden" class="form-control" name="pegawai" value="<?php echo encrypt_url($iud);?>" required>
     <input type="hidden"  class="form-control" name="bulan"  value="<?php echo $tgl;?>" required>
  <button class="btn btn-warning"    type="submit" style ="box-shadow: 2px 2px 2px #5868ec;
    padding: 5px; width:100px;">Generate</button>
</div>
</div>
</form>

<hr>
        
     <br><div class="table-responsive">
      <table id="User" class="table table-hover" >
          <thead>
          <tr style="text-align:center;">
        <th>#</th>
        <th>Tanggal</th>
        <th>Hari</th>
        <th>Masuk</th>
        <th>Pulang</th>
        <th>Keterangan Masuk</th>
        <th>Keterangan Pulang</th>
        <th>Action</th>
          </tr>
          </thead>
          <tbody>
<?php
$no=1;
  foreach ($hasil as $key => $s) { ?>

  <tr  <?php if ($s["hari"] == "Sabtu" ||  $s["hari"] == "Minggu" ) { ?>
         style="color: red;"
           <?php 

} ?> >
        <th>  <?php echo $no; ?></th>
              <td><?php echo $s['tanggal'] ;?></td>
              <td style="text-align:left;"><?php echo $s['hari'] ;?></td>
              <td><?php  echo $s['in_absen'] ;?></td>
              <td><?php echo $s['out_absen'] ;?></td>
              <td><?php echo $s['ket_in'] ;?></td>
              <td><?php echo $s['ket_out'] ;?></td> 
               <td>
                <?php if ($s['id'] !='-') {?>
                    <a href="javascript:;"
                    data-id ="<?php echo $s['id'] ;?>"
                    data-jam_in ="<?php echo $s['in_absen'];?>"
                    data-jam_out ="<?php echo $s['out_absen'];?>"
                    data-ket_in ="<?php echo $s['ket_in'];?>"
                    data-ket_out ="<?php echo $s['ket_out'];?>"
                    data-toggle="modal" data-target="#mod_up" data-rel="tooltip" title="Edit"
                            class="btn btn-info">Update Note
                        </a>
                           <?php }?>
                     </td>       
</tr>
 <?php 
 $no++;
} ?>
</tbody>
</table>

</div>
      </div>




  <div class="modal fade" id="mod_up" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Update Note</h5>
      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true"> </span>
      </button>
    </div>
    <div class="modal-body">
    <form method ="post" ACTION="<?=base_url('Absensi/Absensi/Update_note')?>" enctype="multipart/form-data" role="form">
    <input type="text" class="form-control"   id="id_mod" name="id_mod" hidden>
    <input type="hidden" class="form-control" name="user" value="<?php echo $iud;?>" required>
     <input type="hidden"  class="form-control" name="bln"  value="<?php echo $tgl;?>" required>
   <div class="form-group">
    <label for="exampleFormControlInput1">Jam Masuk</label>
     <input type="time" class="form-control" id="jam_in" name="jam_in" required>
  
  
  </div>

   <div class="form-group">
    <label for="exampleFormControlInput1">Jam Pulang</label>
    <input  type='time' class="form-control" id="jam_out" name="jam_out" required>
  
  </div>
  
     <div class="form-group">
    <label for="exampleFormControlInput1">Keterangan Masuk</label>
     <textarea  class="form-control" id="ket_in" name="ket_in" ></textarea>
  
  
  </div>
    <div class="form-group">
    <label for="exampleFormControlInput1">Keterangan Keluar</label>
    <textarea  class="form-control" id="ket_out" name="ket_out" ></textarea>
  
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
    $('#mod_up').on('show.bs.modal', function (e) {
        var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
        var modal = $(this)
        // Isi nilai pada field
        modal.find('#id_mod').attr("value",div.data('id'));
        modal.find('#ket_out').text(div.data('ket_out'));
        modal.find('#ket_in').text(div.data('ket_in'));

         modal.find('#jam_out').attr("value",div.data('jam_out'));
         modal.find('#jam_in').attr("value",div.data('jam_in'));
        //modal.find('#jam_out').attr(div.date('Y-m-d\TH:i', strtotime(data('jam_in'))));
    });
});
</script>
   
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