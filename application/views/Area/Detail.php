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


	.content
      {
height: auto;
background:#ffffff;
width: 95%;
margin-top: 50px;
text-align:center;
font-family: Arial;
margin: 0 auto; 
display:flex;
justify-content:center;
align-items:center;
        }																		


.isiboxb{
     border-radius:5px;
border: 1px solid #EBF0FF;
margin :5px 5px 2px 5px;
width:300px;
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
}

.text_judul{
box-sizing:border-box; 
font-size: 24px;
font-weight: 600;
width:100%;
text-align:left;
color:#223263;
overflow: hidden;
text-overflow: ellipsis; 
}
.btn_keranjang{
box-sizing:border-box; 
font-size: 18px;
padding:5px;
font-weight: 460;
height:50px;
border-radius:15px;
width:clamp(300px,50%,500px);
display: flex;
justify-content: center;
color:#ffffff;
overflow: hidden;
background:#51b9ec;
align-items:center;
margin:5px auto;
border:none;
}
.btn_keranjang:hover {
		transform: translateY(-2px);
		cursor: pointer;
    color :#ffffff;
    text-decoration:none;
		}
.text_judul_des{
box-sizing:border-box; 
font-size: 22px;
font-weight: 600;
text-align:left;
color:#223263;
}

.harga_detail{
color:#40BFFF;
background-color:#fff;
text-align:left;
font-weight: 600;
font-size: 22px;
}

.rat_detail{
color:grey;
background-color:#fff;
text-align:left;
font-size: 22px;
}
.ket {
	color:#9098B1;
  background:#ffffff;
  overflow-x: hidden;
  overflow-y: scroll; 
  height:250px;
  text-overflow: ellipsis;
  white-space:pre-wrap;
  hyphens: auto;
  padding:1px;
  scrollbar-color: rgb(81,185,236) #9098B1 !important;
  scrollbar-width: thin !important;

}
/* width */
.ket::-webkit-scrollbar {
  width: 10px;
 
}
.ket::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px grey; 
  border-radius: 10px;
}
/* Handle */
.ket::-webkit-scrollbar-thumb {
  background: #51b9ec; 
  border-radius: 5px;
  cursor: pointer;
}
/* Handle on hover */
.ket::-webkit-scrollbar-thumb:hover {
  background: #9098B1; 
}

p{
  margin:2px;
  color:#9098B1;
  
  
}

.nama_toko{
box-sizing:border-box; 
cursor: pointer;
width:100%;
display: flex;
background:#ffffff;
color: #9098B1;
text-decoration: none !important;

}
.nama_toko:hover {
  	transform: translateY(-3px);
  color: #51b9ec;
}
.nama_toko_judul{
display: block !important;;
margin:5px;
}












   #map {
      height: 400px;
    }
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
  color: #fff !important;
  font-weight: bold;
  font-size: 18px;
  transition: 0.8s ease;
  border-radius: 50%;
  background: #000060;
  user-select: none;
  margin:5px;
}

.next_img {
  right: 5px;
  border-radius:  50%;
}
.prev_img:hover, .next_img:hover {
  background-color: transparent;
  text-decoration:none;
  color: #fff !important;
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
  border:2px solid #000060;
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
  background: #000060;
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
  border: 1px solid #000060;
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
  border: 1px solid #000060;
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
   border: 1px solid transparent;
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
   <?php
    
        foreach ($data as $t) {

          ?>
        <div class="container-fluid">

          <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
       
                        <div class="header-icon" >
                            <i class="fa fa-map"></i>
                        </div>
                        <div class="header-title">
                            <h3>Area</h3>
                            <small>
                                Detail Area
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>

          
 








            <div class="row">

                <div class="col-md-12">
                    <div class="panel panel-filled">
                        <div class="panel-body">
    <div class="row">
          <div class="col-md-6" style="display:flex;justify-content:center;">

<div class="slide_box">
    
      <div class="slide_1">
	<?php 	  foreach ($doc as $key => $d) { if ($d->type==2){ ?>
<div class="slide muncul">
  	<img  src="<?php if (file_exists('Doc/img_area/'.$d->file.'')) { echo base_url('Doc/img_area/'.$d->file.'');}else{echo base_url('images/logo/no_image.png');} ?>" onclick="onClick(this)" data-toggle="modal" class="slide_g slide1" data-target="#myModal"> 
</div>

<?php  } } ?>

</div>
<a class="prev_img" id="prev_img" onclick="klik(-1)">&#10094;</a>
<a class="next_img" onclick="klik(1)">&#10095;</a>

<div class="link_bawah">
<?php 
	 foreach ($doc as $key => $d) { if ($d->type==2){ ?>

  <img class="frame_bawah" src="<?php if (file_exists('Doc/img_area/'.$d->file.'')) { echo base_url('Doc/img_area/'.$d->file.'');}else{echo base_url('images/logo/no_image.png');} ?>" id="<?php echo $key +1;?>" onclick="currentSlide(id)">
   <?php  } } ?>
</div>


</div>
</div>


<script>
var slideIndex = 0;
showSlides(slideIndex);


function klik(n) {
  showSlides(slideIndex += n);
 

}

function currentSlide(n) {
 
 showSlides(slideIndex = n);
 //alert(n);
}


function showSlides(n) {
  if (n==1)
  {
    $('#prev_img').prop('hidden', true);
  }
  else{
    $('#prev_img').prop('hidden', false);
  }
  var i;
  var slides = document.getElementsByClassName("slide");
  var dots = document.getElementsByClassName("frame_bawah");
  var a = document.getElementsByClassName("prev_img");
  var b = document.getElementsByClassName("next_img");

  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

          
<div class="col-md-6">   

 <b>
                                    Kode Area
                                </b>
                                    <br>
                                    <p>
                                        <?php echo $t->kode; ?>
                               </p>
<i class="fas fa-map">
<?php echo $t->nama_lokasi;?>
</i><br>
<i class="fas fa-tags"> Koordinat: <br> 
<small><?php echo $t->lat;?>,<?php echo $t->long;?></i></small>
<br>
 <b>
                                    Keterangan
                                </b>
                                    <br>
                                    <p>
                                        <?php echo $t->keterangan; ?>
                               </p>

                                 <b>
                                    Alamat Lengkap
                                </b>
                                    <br>
                                    <p>
                                        <?php echo $t->alamat_lengkap; ?>
                               </p>
                                              
                                          <br>
                             
   <div class="row" > 
                            <div class="col-md-6" > 
                                     <b>
                                    Aset Inventaris
                                </b>
                                <?php foreach($aset as $st) { ?>
                                    <li>
                                   <?php echo $st->nama;?> Qty <?php echo $st->jumlah;?>
                                </li>
                                  <?php } ?>
                                    <br>

                                    
                                </div>
                                     <div class="col-md-6"> 
                           <b>
                                    Fasilitas
                                </b>
                                <?php foreach($fasilitas as $fs) { ?>
                                    <li>
                                   <?php echo $fs->nama_fasilitas;?> Qty <?php echo $fs->jumlah;?>
                                </li>
                                  <?php } ?>
                                    <br>
                                     </div>
                                        </div>


        
          </div>
                                </div>       
            





            


  

           <br>         
                  

      <div id="map"></div>
      

</div>
</div>

</div>

</div>


            <div class="row">

             <div class="col-md-4">
                

                            <h4>Dokument File</h4>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Document</th>
                                
                        
                                    
                                </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $no=1;
 foreach ($doc as $key => $d) { if ($d->type==1){ ?>
                                <tr>
                                 
                                
                                
                                
                                 <td style='text-align:center;'>
                                   <small>
                                  <?php echo anchor(base_url('Doc/file_area/'.$d->file.''), ''.$d->file.'', array('target' => '_blank', 'class' => 'btn btn-secondary'));?>
</small>
<br>
   <small><?php echo $d->nama; ?></small>
                                  </td>

                          
                                </tr>
                              
                             <?php
                             $no++;
 }
}?>
    

                                </tbody>
                            </table>

                        </div>
                  
          

                
        

             <div class="col-md-8" style='text-align: center;'>
                   

                            <h4>Unit</h4>
                      
                            <?php foreach($unit as $u) { 
                                       if ($u->status==1){$label_status="label-info";}
           else if ($u->status==2){$label_status="label-success";}
           else if ($u->status==3){$label_status="label-warning";}
           else if ($u->status==4){$label_status="label-danger";}
           else{$label_status="";}
                              ?>
<a class="isiboxb" href="<?php echo base_url('Unit/Detail_unit?id='.encrypt_url($u->id).'')?>">
   <div  class='<?php echo $label_status?>' style='border-radius:5px; width:20px;height:20px; margin-right:5px; float:left;'></div><div style='font-weight:bold;margin:0;white-space: nowrap; text-overflow: ellipsis; 
  overflow: hidden;'><?php echo $u->nama_unit; ?> <?php echo $u->blok; ?> <?php echo $u->no_unit; ?> <?php echo $u->status_detail; ?>  </div>
                            </a>
                         <?php   } ?>  

                </div>
                  </div>
                

                
         


             </div>
              </div>

<script>
$(document).ready(function(e){
 
  var base_url = "<?php echo base_url();?>"; // You can use full url here but I prefer like this
  $('#ab').DataTable(); // End of DataTable
}); // End Document Ready Function
 </script>

 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
           <h5 class="modal-title" id="myModalLabel">Image prev_imgiew</h5>
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




 <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2aydOihJBxeEEqpkBSTZzHAOvZ9ZqRWk&callback=initMap">
    </script>
<script>
    function initMap() {
      // Set the coordinates and zoom level for the map
      var myLatLng = {lat: <?php echo $t->lat;?>, lng: <?php echo $t->long;?>};
      var mapOptions = {
        center: myLatLng,
        zoom: 15
      };
      // Create a new Google Map object
      var map = new google.maps.Map(document.getElementById('map'), mapOptions);
      // Add a marker to the map
      var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'San Francisco'
      });
    }
  
  </script>




<?php } ?>
         
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