<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
-webkit-appearance: none;
margin: 0;

}
 a {
    text-decoration: none !important;
}
</style>
<body>
<div class="container">
<div class="container-fluid">

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
                               Detail Absensi                           </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
</div>
<div class="container-fluid">

<table class="table table-borderless">
  <tbody>
   <?php   foreach ($data as $key => $data) { ?>
  <tr style="text-align:left;">
      <th style="width:150px;" scope="row">Nama</th>
      <td style="width:10px;">:</td>
      <td><?php echo $data->nama;?></td>
    </tr>
     <tr style="text-align:left;">
      <th scope="row">Tanggal</th>
      <td style="width:10px;">:</td>
      <td><?php echo date("d/m/Y", strtotime($data->tanggal));?></td>
    </tr>
     <tr style="text-align:left;">
      <th scope="row"> Waktu Masuk</th>
      <td style="width:10px;">:</td>
      <td><?php echo $data->in_absen;?> 
        </td>
    </tr>

      <tr style="text-align:left;">
      <th scope="row"> Lokasi Masuk</th>
      <td style="width:10px;">:</td>
      <td>
 <?php if ($data->stat_in == 1 ) { 
     echo "Absen di kantor";
 }
 else if
       ($data->stat_in == 2 ) {
echo "Absen di luar kantor";  echo $data->ket_in;?>
      <?php if (!file_exists('../uploads/absensi/'.$data->file_in.'')) {
?>
 <img src='../../images/logo/no_image.png?<?=time()?>'  width='100px' height='auto' onclick="onClick(this)" data-toggle="modal" data-target="#myModal">
<?php  
} else { ?> 
 <img src='../../../uploads/absensi/<?=$data->file_in;?>?<?=time()?>'  width='100px' height='auto' onclick="onClick(this)" data-toggle="modal" data-target="#myModal">
 
 <?php  
} ?>
</a>
       <?php  
} ?>



      <?php if ($data->lat_in != "" ) {
?>
       <a href="<?=base_url('Absensi/Absensi/Maps?lat=')?><?php echo $data->lat_in;?>&long=<?php echo $data->long_in;?>">  <i class="fa fa-map-marker" style="color:red;" aria-hidden="true"></i></a>
       
        <?php  
} ?>
        </td>
    </tr>
     <tr style="text-align:left;">
      <th scope="row">Waktu Pulang</th>
      <td style="width:10px;">:</td>
      <td><?php echo $data->out_absen;?>
        </td>
    </tr>


     <tr style="text-align:left;">
      <th scope="row">Lokasi Pulang</th>
      <td style="width:10px;">:</td>
      <td>
     
       <?php  if ($data->stat_out == 1 )  {?>
     Absen di kantor
          <?php } else if ($data->stat_out == 2 ) { ?>
     Absen di luar kantor <?php echo $data->ket_out;?>

<?php if (!file_exists('../uploads/absensi/'.$data->file_out.'')) {
?>
 <img src='../../images/logo/no_image.png?<?=time()?>'  width='100px' height='auto' onclick="onClick(this)" data-toggle="modal" data-target="#myModal">
<?php  
} else { ?> 
 <img src='../../../uploads/absensi/<?=$data->file_out;?>?<?=time()?>'  width='100px' height='auto' onclick="onClick(this)" data-toggle="modal" data-target="#myModal">
 
 <?php  
} ?>


           <?php  
} 
         if ($data->lat_out != "" ) { ?>
       <a href="<?=base_url('Absensi/Absensi/Maps?lat=')?><?php echo $data->lat_out;?>&long=<?php echo $data->long_out;?>">  <i class="fa fa-map-marker" style="color:red;" aria-hidden="true"></i></a>



       
             <?php  
} ?>


        </td>
    </tr>

    <tr style="text-align:left;">
      <th style="width:100px;" scope="row">Keterangan</th>
      <td style="width:10px;">:</td>
      <td><?php echo $data->keterangan;?></td>
    </tr>
  <?php }?>
  </tbody>
</table>

</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel">Image preview</h5>
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
</body>
	<script>
function onClick(element) {
document.getElementById("img01").src = element.src;
document.getElementById("modal01").style.display = "block";
}
</script>  
<script src="assets/js/jquery-3.3.1.min.js"></script>
  <script>
     $(document).ready(function() {
  $('#User').DataTable();

});
 </script>


