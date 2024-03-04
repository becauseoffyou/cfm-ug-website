<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<body id="page-top">
 
<div class="container-fluid">
   <?= $this->session->flashdata('message');?>
   <br>
  <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                    <?php if ($this->session->userdata('regional_id')==0){ ?>
  
    <a href="<?=base_url('Admin/User/Add_User')?>" style="float:right; margin:5px;" class="btn_tmp"><i class="fas fa-plus"></i> Tambah</a>
    <?php } ?>
                        <div class="header-icon" >
                            <i class="fa fa-gear"></i>
                        </div>
                        <div class="header-title">
                            <h3>User</h3>
                            <small>
                                Edit User
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


<a href="#" style="float:right" data-toggle="modal" data-target="#mod_upload1" style="float:right; margin:5px;"  ><i ></i>.</a>
<br>
<form method ="post" action="<?=base_url('Admin/User/Edit_user_proses')?>" onSubmit="return vali()">
<?php
        foreach ($user as $us) {
          ?>
          <div class="form-row">
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">User Id</label>
    <input type="text" class="form-control" name="user_id" Value="<?php echo $us->user_id;?>" readonly>
  </div>
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Email</label>
    <input type="email" class="form-control" name="email" Value ="<?php echo $us->email;?>" placeholder="Input Email" required>
  </div>
  </div>



    <div class="form-row">
      <!--
<div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Nip</label>
    <input type="number" class="form-control" name="nip" Value ="<?php echo $us->nip;?>" placeholder="Input No Nip" required>
  </div>-->
<div class="form-group col-md-12">
    <label for="exampleFormControlInput1">Nama</label>
    <input type="text" class="form-control" name="username" Value ="<?php echo $us->username;?>" placeholder="Input Nama" required>
  </div>
  </div>
   <!--
  <div class="form-row">
   
  <div class="form-group col-md-6">
      <label for="inputEmail4">Divisi</label>
      <select  class="form-control" id="divisi" name="divisi" required>
      <option Value ="<?php echo $us->divisi_id;?>"><?php echo $us->divisi;?></option>
        <?php
        foreach($divisi as $div)
            { 
              echo '<option value="'.$div->id.'">'.$div->divisi.'</option>';
            }
            ?>
      </select>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Regional</label>
      <select  class="form-control" id="regional" name="regional" required>
       <option Value ="<?php echo $us->regional_id;?>"><?php echo $us->regional;?></option>
      </select>
    </div>
    </div>
          -->
    <div class="form-row">
      <!--
 <div class="form-group col-md-6">
      <label for="inputEmail4">Lini Bisnis</label>
      <select  class="form-control" id="lini_bisnis" name="lini_bisnis" required>
       <option Value ="<?php echo $us->lini_bisnis;?>"><?php echo $us->lini;?></option>
      </select>
    </div>
          -->
    <div class="form-group col-md-6">
      <label for="inputEmail4">Area</label>
      <select  class="form-control" id="lokasi_kerja" name="lokasi_kerja" required>
           <option Value ="<?php echo $us->lokasi_kerja;?>"><?php echo $us->nama_lokasi;?></option>
        <?php
        foreach($lokasi_kerja as $lok)
            { 
              echo '<option value="'.$lok->id.'">'.$lok->nama_lokasi.'</option>';
            }
            ?>
      </select>
    </div>
       <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Jabatan</label>
    <input type="text" class="form-control" name="jabatan" placeholder="Input Jabatan"  value ='<?php echo $us->jabatan;?>' required>
  </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Telepon</label>
    <input type="number" class="form-control" name="telp" placeholder="Input Tlp" Value ="<?php echo $us->telp;?>" required>
  </div>
  <div class="form-group col-md-6">
    <label for="exampleFormControlInput1">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password kamu" Value ="<?php echo $us->password;?>" required>
  </div>
</div>
    <div class="form-row">
 <div class="form-group col-md-6">
      <label for="inputEmail4">User Type</label>
      <select  class="form-control" id="user_type" name="user_type" required> 
      <option value="<?php echo $us->user_type;?>"><?php echo $us->type;?></option> 
      <?php
        foreach($type as $row_type)
            { 
                echo '<option value="'.$row_type->ut_id.'">'.$row_type->type.'</option>';
             
            }
            ?>
      </select>
    </div>
       <div class="form-group col-md-6">
      <label for="inputEmail4">Status</label>
      <select  class="form-control"  name="status" required> 
      <option value="<?php echo $us->status;?>"><?php if ($us->status==1){ echo "Aktif";}
       else if ($us->status==0)
      {
 echo "Non Aktif";
      } ?>
      </option> 
    
        <option value="1">Aktif</option>
          <option value="0">Non Aktif</option>
        
      </select>
    </div>
    </div>
  <button type="submit" class="btn_tmp" style="float:right;">Submit</button>
  <?php
       }
          ?>
</form>
</div>




         
<script>
     $(document).ready(function(){
$("#divisi").change(function(){
var id_divisi = $("#divisi").val();
// Menggunakan ajax untuk mengirim dan dan menerima data dari server
$.ajax({
    url : "<?=base_url('Admin/User/Get_regional')?>",
    method : "POST",
    data : {id_divisi:id_divisi},
    async : true,
    dataType : 'json',
    success: function(data){
        var html = '';
        var i;

        for(i=0; i<data.length; i++){
            html += '<option value='+data[i].id+'>'+data[i].regional+'</option>';
        }
        $('#regional').html(html);

    }
   
});

$.ajax({
    url : "<?=base_url('Admin/User/Get_lini_bisnis')?>",
    method : "POST",
    data : {id_divisi:id_divisi},
    async : true,
    dataType : 'json',
    success: function(data){
        var html = '';
        var i;
        for(i=0; i<data.length; i++){
            html += '<option value='+data[i].id+'>'+data[i].lini_bisnis+'</option>';
        }
        $('#lini_bisnis').html(html);

    }
   
});
return false;
});
});
</script>

 </body>