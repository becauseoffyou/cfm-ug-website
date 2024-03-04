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
    display: grid;
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
/*
.isiboxb{
border: 1px solid #EBF0FF;
margin :10px 5px 2px 5px;
width:200px;
height:auto;
float: center;
background-color:#ffffff;
border-radius:5;
padding: none;
position : relative;
cursor: pointer;  
display : inline-block;
text-align:center;
outline: none;

}
*/
.isiboxb{
     border-radius:5px;
border: 1px solid #EBF0FF;
margin :5px 5px 2px 5px;
width:200px;
height:30px;font-size:12px;
float: center;
background-color:#fff;
border-radius:5;
padding: none;
cursor: pointer;  
display : inline-block;
text-align:left;
position:relative;
outline: none;
padding:5px;

}
a {
  text-decoration:none !important;
  cursor:pointer !important;
}


@media  (max-width: 1000px) {
  .card_dash 
  {
    width:95%;
  }

}

.container {
   display: flex;
  align-items: center; /* Memusatkan vertikal */
  height: 300px; 
  text-overflow: ellipsis; }

.container p {
  margin:0; /* Jarak antara teks dan kotak */
}

.container .box {
  width: 20px; /* Lebar kotak */
  height: 20px; /* Tinggi kotak */
  background-color: #f2f2f2;
  margin-right:5px; /* Warna latar belakang kotak */
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


              <form method ="get" action="<?=base_url('Home')?>">
                <h5><i>Area</i></h5>
            <div class="form-row">


    <div class="form-group col-md-6">
    
      <select  class="form-control" id="area" name="area">
        <option Value="">Pilih</option>
        <?php
        foreach($area as $lok)
        { ?>
          <option value="<?php echo encrypt_url($lok->id);?>"><?php echo $lok->nama_lokasi ?></option>
        <?php   
        } ?>
      </select>
    </div>

       <div class="form-group col-md-6">
        
        <button type="submit" class="btn_tmp" style='top:30px;'>Cek</button>
  </div>

       
    </div>
       </form>


  <div class="form-row">
<div class="form-group col-md-6">
 
<h5><i>Unit</i></h5>
 <div class="card_cust">

 <div class="table-responsive">
      <table  class="table table-hover" >
          <thead style="font-size:14px;">
            <tr>
              <th>Status</th>
               <th>Jumlah</th>
               
            </tr>
          </thead>
          <tbody style="font-size:14px;">
          <?php foreach ($unit as $d) { 

            if ($d->status==1){$label_status="label-info";}
           else if ($d->status==2){$label_status="label-success";}
           else if ($d->status==3){$label_status="label-warning";}
           else if ($d->status==4){$label_status="label-danger";}
           else{$label_status="";}
            ?>
              <tr>
               <td style='text-align:left;font-weight:bold' class='<?php echo $label_status?>'> <a href='<?php echo base_url('Unit/short?area=');?><?php echo $id_area; ?>&status=<?php echo encrypt_url($d->status); ?>' style='color:#fff;'><?php echo $d->status_detail; ?></a>
                                      </td>

                                        <td style='text-align:center;font-weight:bold;'>

                                        <a href='<?php echo base_url('Unit/short?area=');?><?php echo $id_area; ?>&status=<?php echo encrypt_url($d->status); ?>' style='color:grey;font-weight:600;'><?php echo $d->jml; ?></a>
                                      </td>
            </tr>

            <?php }?>
</tbody>
<tfooter>
        </tfooter>
</table>

</div>   
</div>
</div>




<div class="form-group col-md-6">
 
<!-- <h5><i>Laporan Problem</i></h5> -->
 <div class="card_cust">

 <div class="table-responsive">
      <table  class="table table-hover" >
          <thead style="font-size:14px;">
            <tr>
              <th>Status</th>
               <th>Jumlah</th>
               
            </tr>
          </thead>
          <tbody style="font-size:14px;">
          <?php foreach ($data_problem as $rows) { 

            if ($rows->status==1){$label_status1="label-warning";}
           else if ($rows->status==2){$label_status1="label-info";}
           else if ($rows->status==3){$label_status1="label-success";}
           else if ($rows->status==4){$label_status1="label-danger";}
            else if ($rows->status==5){$label_status1="label-success";}
             else if ($rows->status==6){$label_status1="label-danger";}
           else{$label_status1="";}
            ?>
              <tr>
               <td style='text-align:left;font-weight:bold;' class='<?php echo $label_status1?>'>

               <a href='<?php echo base_url('Helpdesk/short?status=');?><?php echo encrypt_url($rows->status); ?>' style='color:#fff;'><?php echo $rows->desc_status; ?></a>
                                      </td>

                                        <td style='text-align:center;font-weight:bold;'><?php echo $rows->jml; ?>
                                      </td>
            </tr>

            <?php }?>
</tbody>
<tfooter>
        </tfooter>
</table>

</div>   


</div>
</div>








</div>





  <div class="form-row">
    <h5><i>List Unit : <?php echo $nama_lokasi ?></i></h5>
 <div class="card_cust">

     <?php foreach($data_unit as $u) { 
                                       if ($u->status==1){$label_status="label-info";}
           else if ($u->status==2){$label_status="label-success";}
           else if ($u->status==3){$label_status="label-warning";}
           else if ($u->status==4){$label_status="label-danger";}
           else{$label_status="";}
                              ?>
                             
<a class="isiboxb" href="<?php echo base_url('Unit/Detail_unit?id='.encrypt_url($u->id).'')?>">
   <div  class='<?php echo $label_status?>' style='border-radius:5px; width:20px;height:20px; margin-right:5px; float:left;'></div><div style='font-weight:bold;margin:0;white-space: nowrap; text-overflow: ellipsis; 
  overflow: hidden;'><?php echo $u->nama_unit; ?> <?php echo $u->blok; ?> <?php echo $u->no_unit; ?> </div>
                            </a>

                         <?php   } ?>  

          </div>
            </div>




</div>

 

<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
  


</body>

</html>