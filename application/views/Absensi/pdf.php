<style>
#id {
       border-collapse: collapse;
        font-size: 12px;
        font-family: "Times New Roman", Times, serif;
        width:100%; 
        height:auto;
        text-align:center;
        color:grey;
}
#id2 {
    border:none;
    font-size: 16px;
    font-family: "Times New Roman", Times, serif;
    color:#1b1e23;
}
.id3 {
    border:none;
    font-size: 14px;
    font-family: "Times New Roman", Times, serif;
    color:#1b1e23;
    width:100%;
}
#id2 td {
    text-align: left;
    font-family: "Times New Roman", Times, serif;
    font-size: 16px;
     border:none;
}
#id th, td {
    border: 1px solid black;
    height:20px;
}
	</style>
  </style>
    <body>
<img style="width:160px;
 height:40px; 
 float:right; 
 top:10px; 
 right:12px;
 position:absolute;" src="<?php echo $img; ?>"/>
<br>
<br>
<table id="id2">
<thead>
<tr>
<td>Pegawai</td>
<td style="width:20px; text-align:right !important;">:</td>
<td><?php echo $un ;?></td>
</tr>
<tr>
<td>Divisi</td>
<td style="width:20px; text-align:right; !important;">:</td>
<td><?php echo $div;?></td>
</tr>
<tr>
<td>Bulan</td>
<td style="width:20px; text-align:right; !important;">:</td>
<td><?php echo $th;?></td>
</tr>
</thead>
</table>
<hr>

<table id="id">
          <thead>
          <tr style="text-align:center;">
        <th>#</th>
        <th>Tanggal</th>
        <th>Hari</th>
        <th>Masuk</th>
        <th>Pulang</th>
        <th>Keterangan Masuk</th>
        <th>Keterangan Pulang</th>
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
</tr>
 <?php 
 $no++;
} ?>
</tbody>
</table>

<br>
<table class="id3">
<thead>
<tr  style="text-align:center !important;">
<th>Mengetahui,</th>
<th>Menyetujui,</th>
</tr>
</thead>
<tbody>
  
<tr  style="text-align:center !important;">
<th>
<br>
<br>
<br>
<br>
  (        Arif Rahmansyah        )</th>
<th>
<br>
<br>
<br>
<br>
  (     Muhamad Kurnia Rahman     )</th>
</tr>
<tr></tr>
</tbody>
</table>
<i style="float:right;font-size:8px;position:fixed
;bottom:10px;"> 
	Di cetak oleh <?= $this->session->userdata('username') ?> pada <?= date('d-m-Y H:i:s');?>
		</i>
</body>




