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
<style>

  .card_cust {
    position: relative;
    display:block;
    width: 100%;
    background:#fff;
    border-radius:10px;
    padding:10px; 
    margin:10px 0;
    text-align:center;
    box-shadow:2px 2px 2px 2px grey;
    border: 1px  grey;
}
.card_dash {
    position: relative;
    width: 48%;
    height:100px;
   /* background:#009E9B !important; */
    border-radius:10px;
    padding:5px; 
    margin:5px;
    display : inline-block;
    color:#f8f9fc;
    text-align:left;
    cursor:pointer;
    border-left: 10px solid #000060;
    color:#fff !important;
}

.card_dash p {
   font-size:16px;
   font-weight:600;
   bottom:5px;
   left:10px;
   position:absolute;
   
}

.card_dash span{
   font-size:18px;
   font-weight:600;
   top:10px;
   left:10px;
   position:absolute;

}

@media  (max-width: 1000px) {
  .card_dash 
  {
    width:95%;
  }

}
  </style>
<body>



   
    <!-- End navigation-->

<div class="container-fluid" >
    <div class ="col-md-6">
    <?= $this->session->flashdata('message');?>
    </div>
    </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="view-header">
               <!-- <div class="pull-right text-right" style="line-height: 14px">
                            <small>App Pages<br>Basic<br> <span class="c-white">Projects</span></small>
                        </div>-->
                        <div class="header-icon" >
                           <i class="fas fa-fw fa-tachometer-alt">  </i>
                        </div>
                        <div class="header-title">
                            <h3 >Dashboard</h3>
                            <small>
                                
                            </small>
                        </div>
                    </div>
                 
                </div>
                  
               




            </div>
  <hr>

  <div class="form-row">
<div class="form-group col-md-12">
  <div class="card_cust">
<p style='color:#00006; font-size:18px;
   font-weight:600;'>Total Unit <?php echo $A1+$A2+$A3+$A4 ?></p>
<a class="card_dash"  href="<?=base_url('Unit/short?id=1')?>" style="background-color:#56c0e0"><p>Berpenghuni</p>
<span><?php echo $A1 ?></span>
</a>
<a class="card_dash" href="<?=base_url('Unit/short?id=2')?>"  style="background-color:#1bbf89"><p>Kosong Siap Huni</p>
<span><?php echo $A2 ?></span>
</a>
<a class="card_dash"  href="<?=base_url('Unit/short?id=3')?>" style="background-color:#f7af3e"><p>Kosong Tidak Siap Huni
</p>
<span><?php echo $A3 ?></span>
</a>
<a class="card_dash" href="<?=base_url('Unit/short?id=4')?>" style="background-color:#db524b"><p>Selesai Masa Pakai</p>
<span><?php echo $A4 ?></span>
</a>
</div>
</div>
</div>



 <div class="form-row">
<div class="form-group col-md-12">
  <div class="card_cust">
<p style='color:#00006; font-size:18px;
   font-weight:600;'>Total Laporan <?php echo $B1+$B2 ?></p>
<a class="card_dash" href="<?=base_url('Helpdesk/short')?>" style="background-color:#db524b"><p>Progress</p>
<span><?php echo $B1 ?></span>
</a>
<a class="card_dash" href="<?=base_url('Helpdesk/short?id=5')?>" style="background-color:#1bbf89"><p>Selesai</p>
<span><?php echo $B2 ?></span>
</a>

</div>
</div>
</div>

</div>

 

<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
  


</body>

</html>