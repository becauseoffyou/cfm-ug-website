<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>images/logo/icon_ug.png?<?=time()?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>UGResS</title>
  <!-- Custom fonts for this template-->
    <link href="<?=base_url('assets/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?=base_url('assets/font/');?>styles/pe-icons/pe-icon-7-stroke.css"/>
   <link rel="stylesheet" href="<?=base_url('assets/font/');?>fontawesome/css/font-awesome.css"/>
  <link href="<?=base_url('assets/');?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="<?=base_url('assets/');?>css/sb-admin-2.min.css" rel="stylesheet">
</head>
<style>





 
th {
  color:#000060 !important;
}
.view-header {
  margin: 20px 0;
  min-height: 50px;
  padding: 0 15px;
}
.view-header .header-icon {
  font-size: 60px;
  color: #000060;
  width: 68px;
  float: left;
  margin-top: -8px;
  line-height: 0;
}
.view-header .header-title {
  margin-left: 75px;
    color: #000060;
}
.view-header .header-title h3 {
  margin-bottom: 2px;
    color: #000060;
}


.label-accent {
  background-color: #000060;
  color:#fff;
}

.label-default {
  background-color: #44464f;
  color:#fff;
}
.label-primary {
  background-color: #0f83c9;
  color:#fff;
}
.label-success {
  background-color: #1bbf89;
  color:#fff;
}
.label-info {
  background-color: #56c0e0;
  color:#fff;
}
.label-warning {
  background-color: #f7af3e;
  color:#fff;
}
.label-danger {
  background-color: #db524b;
  color:#fff;
}
.label {
  display: inline;
  padding: .2em .6em .3em;
  font-size: 75%;
  font-weight: bold;
  line-height: 1;
  color: #fff;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: .25em;
}



.progress {
  border-radius: 2px;
  margin-bottom: 10px;
}
.progress-bar {
  background-color: #2f323b;
  text-align: right;
  padding-right: 10px;
  color: #949ba2;
}
.progress-small,
.progress-small .progress-bar {
  height: 10px;
}
.progress-bar-primary {
  border-right: 4px solid #0d74b1;
}
.progress-bar-success {
  border-right: 4px solid #18a979;
}
.progress-bar-info {
  border-right: 4px solid #0d74b1;
}
.progress-bar-warning {
  border-right: 4px solid #f6a526;
}
.progress-bar-danger {
  border-right: 4px solid #d73e36;
}
.full .progress-bar-success {
  background-color: #1bbf89;
  border-right: 4px solid #18a979;
}
.full .progress-bar-info {
  background-color: #0f83c9;
  border-right: 4px solid #0d74b1;
}
.full .progress-bar-warning {
  background-color: #f7af3e;
  border-right: 4px solid #f6a526;
}
.full .progress-bar-danger {
  background-color: #db524b;
  border-right: 4px solid #d73e36;
}
.full .progress-bar-primary {
  background-color: #0f83c9;
  border-right: 4px solid #0d74b1;
}
.full .progress-bar {
  color: #ffffff;
}

.small {
  font-size: 90%;
  
}

a {  color: #000460;
  text-decoration: none;}
      





 
  td {
 font-size:14px;
  }

  th {
    font-size:14px;
  }

.kotak {
 /* border-left: 10px solid #F7AF2E;
  border-right: 10px solid #F7AF2E; */
  padding: 8px;
  width:350px;
  height:50px;
  background-color: #000040;
  background: linear-gradient(to right, #000040, #000040);
  color:white;
  text-align:center;
  border-top-left-radius: 35px;
  border-bottom-right-radius: 35px;
  text-transform: capitalize;
}

.pr {
  position: fixed;
  width: 100%;
  height: 100%;
  z-index: 9999;
 background-color:rgba(0,0,0, 0.5);
}
.pr .load_ing1 {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  font: 14px arial;
}
		
.load_er1 {
  margin: auto;
  border: 5px solid #EAF0F6;
  border-radius: 50%;
  border-top:  5px solid #009E9B;
  width: 50px;
  height: 50px;
  animation: spinner 1s linear infinite;
    position: absolute;
	 background-color: linear-gradient(to right, #000046, #000046);
}

@keyframes spinner {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>
<body id="page-top">

	<div class="pr">
  <div class="load_ing1">
 <div class="load_er1">

  </div>
  </div>
</div>
  <script src="<?=base_url('assets/');?>vendor/jquery/jquery.min.js"></script>
<script>


//window.onbeforeunload = function () {
//$(".pr").fadeOut("slow");
//}
window.onload = function() {
  $(".pr").fadeOut("slow");

$("a").click(function() {
  var href = $(this).attr('href');
if(href) {
  if (href!="#" && href!="" && href !="javascript:;" && href !="#page-top") {
           $(".pr").fadeIn("slow");
           //alert("ok");
           }
           }
        });      
        
}

        

$(document).ready(function() {
$(".pr").fadeOut("slow");


});


</script>
