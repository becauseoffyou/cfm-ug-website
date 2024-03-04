<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
<title>CMS</title>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/ug-title.png"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>C.M.S</title>
<link rel="stylesheet" href="style.css">
</head>
<style>
body{
background-color: black;
color: white;
text-align:center;
display:block;
}

h1 {
color: red;
}

h6{
color: red;
text-decoration: underline;
}

</style>
<body>
<div class="w3-display-middle">
<h1 class="w3-jumbo w3-animate-top w3-center"><code>Cash Management System</code></h1>
<hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
<h3 class="w3-center w3-animate-right">APPS UG MANDIRI</h3>
<hr class="w3-border-white w3-animate-left" style="margin:auto;width:50%">
<br>
<i style=" width:50%; font-size:24px;">Mohon maaf user anda tidak bisa akses ke aplikasi web CMS, user untuk web hanya di peruntukan untuk admin,leader CPC,monitoring FLM,scheduler,verifikator dan manager jika anda bukan 
salah 1 dari user tersebut silahkan login menggunakan APK atau hubungi admin.</i>
<!--<a href="http://103.73.125.93/crflm/"><h3 class="w3-center w3-animate-right"><i >Sign in C.M.S.</i></h3></a>
-->
</div>

</body>
</html>

<?php
         if ($st->stat == 'SCH')
         {
           ?>
           <h4><i class="badge badge-danger">Schedule</i></h4>
           <?php
           
         }
       else  if ($st->stat == 'DEL')
         {
           ?>
           <h4><i class="badge badge-danger">Delete</i></h4>
           <?php
           
         }
         else  if ($st->stat == 'TTP')
         {
           ?>
           <h4><i class="badge badge-danger">Titipan</i></h4>
           <?php
           
         }
         else if ($st->stat == 'REC')
         {
           ?>
           <h4><i class="badge badge-info">Receive</i></h4>
           <?php
         }
         else if ($st->stat == 'STR')
         {
           ?>
           <h4><i class="badge badge-info">Sortir</i></h4>
           <?php
         }
         else if ($st->stat == 'ASGN')
         {
           ?>
           <h4><i class="badge badge-info">Assign</i></h4>
           <?php
         }
         else if ($st->stat == 'LOAD')
         {
           ?>
            <h4><i class="badge badge-info">Loading</i></h4>
           <?php
         }
         else if ($st->stat == 'SCL')
         {
           ?>
            <h4><i class="badge badge-info">Cek Loading</i></h4>
           <?php
         }
         else if ($st->stat == 'UP')
         {
           ?>
           <h4><i class="badge badge-info">Pick up</i></h4>
           <?php
         }
         else if ($st->stat == 'ARR')
         {
           ?>
           <h4><i class="badge badge-warning">Arrive</i></h4>
           <?php
         }
         else if ($st->stat == 'WORK')
         {
           ?>
            <h4><i class="badge badge-warning">Start work</i></h4>
           <?php
         }
         else if ($st->stat == 'FIN')
         {
           ?>
           <h4><i class="badge badge-success">Finish</i></h4>
           <?php
         }
         else if ($st->stat == 'RET')
         {
           ?>
           <h4><i class="badge badge-success">Return</i></h4>
           <?php
         }
         else if ($st->stat == 'COM')
         {
           ?>
           <h4><i class="badge badge-success">Completed</i></h4>
           <?php
         }
         else if ($st->stat == 'CHG')
         {
           ?>
           <h4><i class="badge badge-success">Change</i></h4>
           <?php
         }
         else if ($st->stat == 'CNCL')
         {
           ?>
           <h4><i class="badge badge-success">Cancel</i></h4>
           <?php
         }
         else if ($st->stat == 'EJ')
         {
           ?>
           <h4><i class="badge badge-success">EJ</i></h4>
           <?php
         }
         else if ($st->stat == 'EDIT')
         {
           ?>
           <h4><i class="badge badge-danger">Edit</i></h4>
           <?php
         }
         else if ($st->stat == 'ADD')
         {
           ?>
           <h4><i class="badge badge-danger">Add by web</i></h4>
           <?php
         }
         else if ($st->stat == 'PENGOSONGAN')
         {
           ?>
           <h4><i class="badge badge-danger">PENGOSONGAN</i></h4>
           <?php
         }
         else if ($st->stat == 'BTL')
         {
           ?>
           <h4><i class="badge badge-danger">Batal isi</i></h4>
           <?php
         }
         else
         {
           ?>
           <h4><i class="badge badge-danger"><?php echo $st->stat;?></i></h4>
           <?php
         }
         ?>