<link href="<?=base_url('assets/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<title>UG Mandiri | UGResS</title>
<style>
*{
	margin:0;
	padding:0;
	box-sizing:border-box;
}
body{
	height:100vh;
	font: 16px Arial;  

	display:flex;
	flex-direction:column;
	justify-content:center;
	align-items: center;
	/*background: url("images/bgr.jpg") no-repeat center center fixed;*/
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}
.formm{
	width:380px;
	height:560px;
	position:relative;
	background-color:#ffffff;
	display:flex;
	flex-direction:column;
	justify-content:center;
	border-radius:15px;
	padding: 0 15px;
	box-shadow: 0px 0px 10px 2px #000040;
}
.formm input{
	width:100%;
	height:50px;
	padding-top:10px;
	background-color: #FFF;
	border :none;
	border-bottom: 2px solid #000040;
	outline:none;
	background-color: transparent;
}
.formm label {
	transform: translateY(-50px);
	pointer-events: none;
	color:grey;
}
.contentEmail,.contentPass{
	position:absolute;
	top:20px;
	transition: all 1s ease;
	background-color: transparent;
}
#gg{
	position:absolute;
	align-self:center;
	bottom:180px;
	right:15px;
	transition: all 1s ease;
	color:#000040;
	cursor:pointer;
}
.formm input:focus+ .labelPass .contentPass,
.formm input:valid+ .labelPass .contentPass {
	transform: translateY(-120%);
	font-size: 14px;
	color: #000040;
}	
.formm input:focus+ .labelEmail .contentEmail,
.formm input:valid+ .labelEmail .contentEmail {
	transform: translateY(-120%);
	font-size: 14px;
	color: #000040;
}

.btn {
	background-color:#000040 !important;
	color : #fff;
	width: 150px;
	height : 40px;
	justify-content:center;
	font-size:16px;
	outline:none;
	cursor:pointer;
	transition:all 1s ease;
}
.formm input[type="submit"]{
    padding: 4px 16px;
   	margin-top:40px;
    border: 2px solid #000040;
    border-radius: 15px;
    cursor: pointer; 
	font-weight:bold;
}
.btn:hover{
transform : translateY(10px);	
color: #000040;	
background-color:#fff !important;
}
h2 {
	align-self:center;
	margin-bottom:30px;
	z-index: 9999;
}

.kotak1{
	width: 220px;
	height: 220px;
	padding:5px;
	z-index: 2;
	background-color: transparent;
}


.pr {
  position: fixed;
  width: 100%;
  height: 100%;
  z-index: 9999;
 background-color:rgba(0,0,0, 0.5);
}
.pr .load_ing {
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%,-50%);
  font: 14px arial;
}
		
.load_er {
  margin: auto;
  border: 5px solid #EAF0F6;
  border-radius: 50%;
  border-top: 5px solid #EAF0F6;
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
</style>
<body>
	<div class="pr">
  <div class="load_ing">
 <div class="load_er">

  </div>
  </div>
</div>
<?= $this->session->flashdata('message');?>


	
<form  action="<?=base_url('Auth/LoginValidation')?>" method="post">
<div class="formm">
<center>
<div class="kotak1" >
<img  src="<?php echo base_url(); ?>images/logo/Logo_biru.png?<?=time()?>" style='width:215px;height:215px;'>
</div>
</center>

                                     
<input type="text" name="username" id='username' autocomplete="off" required>

<label  class="labelEmail">
<span class="contentEmail">Username</span>
</label>

<input type="password" id="pass" name="password" required>
<label class="labelPass">
<span class="contentPass">Password</span>
</label>
<span toggle="#password-field" id="gg" class="fa fa-fw fa-eye field-icon toggle-password"></span>
 <input class= "btn" onclick="load()" name="ms" type="submit" value="Sign In">
 
</div>
</form>
<a href ="https://api.whatsapp.com/send?phone=">
<i class="fab fa-whatsapp" style=" color:  #25d366; width:60; height: 100; position: fixed !important; bottom: 5px; right: 10px; z-index: 9999;"></i></a>
</div>
<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
<script type="text/javascript">
 $("body").on('click', '.toggle-password', function() {
  $(this).toggleClass('fa-eye fa-eye-slash');
  var input = $("#pass");
  if (input.attr('type') === 'password') {
    input.attr('type', 'text');
  }
  else {
    input.attr('type', 'password');
  }
});
</script> 

<script>
 function load(){
	  var a = document.getElementsByName("username")[0].value;
	   var b = document.getElementsByName("password")[0].value;

	   if (a !== '' && b !== '')
	   {
$(".pr").fadeIn("slow");
}
//alert("ok");
}
</script>
</body>
