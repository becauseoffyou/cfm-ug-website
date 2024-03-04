<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="stylesheet" href="<?=base_url('assets/');?>styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="<?=base_url('assets/');?>styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="<?=base_url('assets/');?>styles/stroke-icons/style.css"/>
 <style>


 .slide_box {
  height: 460px;
  width:100%;
  position: relative;
  top: auto;
  margin:bottom:5px;
  padding:5px;
}

    .slide_1 {
  width:100%;
  height: 400px;
  padding:2px;
  background:transparent;
	display:flex;
	justify-content: center;
  align-items:center;

}
    .slide_g {
  width:100%;
  height: 400px;
  cursor: pointer;
 
}
.slide1_g img {
  object-fit:contain;
  margin:0;
  cursor:pointer;
}
.prev_img, .next_img {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: 30px;
  height: 30px;
  display:flex;
  align-items:center;
  justify-content: center;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.8s ease;
  border-radius: 50%;
  background: #51b9ec;
  user-select: none;
  margin:5px;
}

.next_img {
  right: 5px;
  border-radius:  50%;
}
.prev_img:hover, .next_img:hover {
  background-color: #717171;
  text-decoration:none;
  color: white;
  cursor: pointer;
}
.link_bawah {
  display: flex;
  align-items:center;
  justify-content: center;
  transition:background-color 0.6s ease;
}
.active:hover {
  background-color: #717171;
  cursor: pointer;
  
}
.muncul {
-webkit-animation: fadein 2s; /* Safari, Chrome and Opera > 12.1 */
-moz-animation: fadein 2s; /* Firefox < 16 */
-ms-animation: fadein 2s; /* Internet Explorer */
-o-animation: fadein 2s; /* Opera < 12.1 */
animation: fadein 2s;
}

.frame_bawah {
  opacity: 0.6;
  margin:2px;
  height:50px;
  width:50px;
  border-radius:5px;
  cursor:pointer;
}

.active,.frame_bawah:hover {
  opacity: 1;
  border:2px solid #51b9ec;
}














  
.vertical-container {
  /* this class is used to give a max-width to the element it is applied to, and center it horizontally when it reaches that max-width */
  width: 98%;
  margin: 0 auto;
}
.vertical-container::after {
  /* clearfix */
  content: '';
  display: table;
  clear: both;
}
.v-timeline {
  position: relative;
  padding: 0;
  margin-top: 2em;
  margin-bottom: 2em;
}
.v-timeline::before {
  content: '';
  position: absolute;
  top: 0;
  left: 18px;
  height: 100%;
  width: 4px;
  background: #3d404c;
}
.vertical-timeline-content .btn {
  float: right;
}
.vertical-timeline-block {
  position: relative;
  margin: 2em 0;
}
.vertical-timeline-block:after {
  content: "";
  display: table;
  clear: both;
}
.vertical-timeline-block:first-child {
  margin-top: 0;
}
.vertical-timeline-block:last-child {
  margin-bottom: 0;
}
.vertical-timeline-icon {
  position: absolute;
  top: 0;
  left: 0;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  font-size: 16px;
  border: 1px solid #3d404c;
  text-align: center;
  background: grey ;
  color: #ffffff;
}
.vertical-timeline-icon i {
  display: block;
  width: 24px;
  height: 24px;
  position: relative;
  left: 50%;
  top: 50%;
  margin-left: -12px;
  margin-top: -9px;
}
.vertical-timeline-content {
  position: relative;
  margin-left: 60px;
  background-color: transparent;
  border-radius: 0.25em;
  border: 1px solid #00bfff;
  padding:5px;
}
.vertical-timeline-content:after {
  content: "";
  display: table;
  clear: both;
}
.vertical-timeline-content h2 {
  font-weight: 400;
  margin-top: 4px;
}
.vertical-timeline-content p {
  margin: 1em 0 0 0;
  line-height: 1.6;
}
.vertical-timeline-content .vertical-date {
  font-weight: 500;
  text-align: right;
 
}
.vertical-date small {
  color: grey;
  font-weight: 400;
}
.vertical-timeline-content:after,
.vertical-timeline-content:before {
  right: 100%;
  top: 20px;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;

  position: absolute;
  pointer-events: none;
}
.vertical-timeline-content:after {
  border-color: transparent;
  border-right-color: #00bfff;
  border-width: 10px;
  margin-top: -10px;
  
}
.vertical-timeline-content:before {
  border-color: transparent;
  border-right-color: #00bfff;
  border-width: 11px;
  margin-top: -11px;
}
.vertical-timeline-content h2 {
  font-size: 16px;
}

.panel {
  background-color: transparent;
  -webkit-box-shadow: none;
  -moz-box-shadow: none;
  box-shadow: none;
  color: #000040;
  border-radius: 3px;
  margin-bottom: 20px;
   border: 1px solid #00bfff;
}
.panel .panel-body {
  padding: 5px 15px 15px 15px;
}
.panel.panel-filled .panel-body {
  padding-top: 10px;
}
.panel .panel-footer {
  background-color: transparent;
  border: none;
}
  </style>
    <!-- Main content-->
    <div class="container-fluid" >
    <div class ="col-md-6">
    <?= $this->session->flashdata('message');?>
    </div>
    </div>

        <div class="container-fluid">

          <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
       
                        <div class="header-icon" >
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="header-title">
                            <h3>Penghuni</h3>
                            <small>
                                Detail Penghuni
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            

<?php foreach($data as $t){ ?>

            <div class="row m-t-sm">

                <div class="col-md-12">
                    <div class="panel panel-filled">

                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-2">
                                    <div>
                              
                                    
                                         
                                         <i class="fas fa-address-card"> Kode Penghuni : <?php echo $t->kode;?></i>
                                      
                                          <br>
                                          <i class='fas fa-user'> Penghuni: <?php echo $t->nama;?></i>
                                          <br>
                                             <b>
                                            Status :
                                          </b>
                                          <p> 
                                      <?php if($t->status==0){ echo 'Aktif';} else {echo'Non Aktif';}?>
                                          </p>

                                           <b>Jenis Kelamin</b><p><?php echo $t->jk;?></p>
                                           <b>Unit Kerja</b><p><?php echo $t->unit_kerja;?></p>
                                             <b>Jabatan</b><p><?php echo $t->jabatan;?></p>
                                               <b>Suami/Istri</b><p><?php echo $t->pasangan;?> (<?php echo $t->hubungan;?>)</p>
                                              

                                    </div>
                                </div>

                                 <div class="col-md-10">
      <b>
                                    Kerabat
                                </b>
                                <br>
                                       <table class="table table-striped">
                                <thead>
                                <tr style='text-align:center;'>

                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Hubungan</th>
                                </tr>
                                </thead>
                               <tbody>
                                <?php foreach($kerabat as $k){ ?>
                                  <tr>
                                <td><?php echo $k->nama;?></td>
                                 <td><?php echo $k->alamat;?></td>
                                  <td><?php echo $k->telp_rumah;?> / <?php echo $k->telp;?></td>
                                   <td><?php echo $k->hubungan;?></td>
                                
                                <?php } ?>
                               

                                </tbody>
                            </table>
                            <br>
                                <b>
                                    Art
                                </b>
                                <br>
      <table class="table table-striped">
                                <thead>
                                <tr style='text-align:center;'>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telp</th>
                                    <th>Keterangan</th>
                                   
                                </tr>
                                </thead>
                                     <tbody>
                                <?php foreach($art as $a){ ?>
                                  <tr>
                                <td><?php echo $a->nama;?></td>
                                 <td><?php echo $a->alamat;?></td>
                                  <td><?php echo $a->telp_rumah;?> / <?php echo $a->telp_hp;?></td>
                                   <td><?php echo $a->keterangan;?></td>
          

                                
                                <?php } ?>
                               

                                </tbody>
                            </table>


                                    
                                    <br>
                                  <b>
                                    Kendaraan
                                </b>
                                <br>

 <table class="table table-striped">
                                <thead>
                                <tr style='text-align:center;'>

                                    <th>No Polisi</th>
                                     <th>Type</th>
                                    <th>Merek</th>
                                    <th>Warna</th>
                                    <th>Keterangan</th>
                                    
                                </tr>
                                </thead>
                               <tbody>
                                <tbody>
                                <?php foreach($kendaraan as $m){ ?>
                                  <tr>
                                <td><?php echo $m->nopol;?></td>
                                 <td><?php echo $m->type;?></td>
                                  <td><?php echo $m->merek;?> </td>
                                   <td><?php echo $m->warna;?> </td>
                                   <td><?php echo $m->remarks;?></td>
           

                                
                                <?php } ?>
                               

                                </tbody>

                                </tbody>
                            </table>






   </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


    








<?php } ?>
    </div>       
<script>

$("a").click(function() {
setInterval(function(){
  $(".pr").fadeOut("slow");
}, 2000);
        });  
  </script>

  <script>
function onClick(element) {
document.getElementById("img01").src = element.src;
document.getElementById("modal01").style.display = "block";
}
</script>   
</body>

</html>