<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--<meta http-equiv="refresh" content="15" >-->
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>styles/pe-icons/pe-icon-7-stroke.css" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>styles/pe-icons/helper.css" />
  <link rel="stylesheet" href="<?= base_url('assets/'); ?>styles/stroke-icons/style.css" />
  
  <style>
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
      background: grey;
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
      padding: 5px;
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
  <div class="container-fluid">
    <div class="col-md-6">
      <?= $this->session->flashdata('message'); ?>
    </div>
  </div>
  <?php

  foreach ($data as $t) {

    if ($t->rating == 1) {

      $rating = 'Tidak Puas';
    } else if ($t->rating == 2) {

      $rating = 'Cukup Puas';
    } else  if ($t->rating == 3) {

      $rating = 'Puas';
    } else if ($t->rating == 4) {

      $rating = 'Sangat Puas';
    } else {

      $rating = '';
    }
  ?>
    <div class="container-fluid">

      <div class="row m-t-sm">

        <div class="col-md-12">
          <div class="panel panel-filled">

            <div class="panel-body">

              <div class="row">

                <div class="col-md-6">
                  <div>

                    <i class="fas fa-headset" style='font-size:50px;'></i>
                    <br>
                    <hr>
                    <i class="fa fa-map"> <?php echo $t->nama_lokasi; ?></i><br>
                    <i class="fa fa-home">Unit : <?php echo $t->nama_unit; ?> <?php echo $t->blok; ?>.<?php echo $t->no_unit; ?></i><br>
                    <i class="fa fa-user"> Penghuni :<?php echo $t->npenghuni; ?></i>
                    <p>
                      Laporan: <?php echo $t->job_detail; ?>
                    </p>

                    <i class="fa fa-ticket"> Ticket: <?php echo $t->tiket; ?></i>
                    <br>

                    <i class="fa fa-user"> Pelapor: <?php echo $t->pelapor; ?></i>
                    <br>

                    <i class="fa fa-user"> Pembuat Tiket: <?php echo $t->name_author; ?></i>
                    <br>

                    <i class="fa fa-user"> Petugas 1: <?php echo $t->name_pic; ?></i>
                    <br>

                    <i class="fa fa-user"> Petugas 2: <?php echo $t->name_pic1; ?></i>
                    <br>

                    <i class="fa fa-user"> Petugas Progres: <?php echo $t->name_pic_complete; ?></i>
                    <br>
                    <p>Prioritas :
                      
                    <span class="label 
                                        <?php if ($t->type == 'High') {
                                          echo 'label-danger';
                                        } else if ($t->type == 'Medium') {
                                          echo 'label-info';
                                        } else if ($t->type == 'Low') {
                                          echo 'label-success';
                                        }
                                        ?>
                                        "><?php echo $t->type; ?></span>
                    </p>
                    <a href="<?php echo base_url("Helpdesk/Job_order?id=") ?> <?php echo encrypt_url($t->id); ?>"><i class="fas fa-print" style="color:#000060;margin:10px;"> Print Job Order </i></a>
                  </div>
                </div>
                <div class="col-md-3">

                  <b>
                    Solusi
                  </b>
                  <br>
                  <p>
                    <?php echo $t->note; ?>




                  </p>

                  <br>
                  <b>
                    Last Update
                  </b>
                  <br>
                  <p>
                    <?php echo $t->last_update; ?>



                  </p>

                  <br>
                  <b>
                    Result
                  </b>
                  <br>
                  <p>
                    <?php echo $t->result; ?>



                  </p>


                  <br>
                  <b>
                    Biaya
                  </b>
                  <br>
                  <p style='color:green;'>
                    Rp. <?php echo number_format($t->total_biaya_perbaikan); ?>
                  </p>


                  <br>
                  <b>
                    Kepuasan
                  </b>
                  <br>
                  <p style='color:green;'>
                    <?php echo $rating; ?>



                  </p>


                </div>

                <div class="col-md-3">
                  <p>
                    <?php if ($t->status == 1) {
                      $label_status = "label label-warning";
                    } else if ($t->status == 2) {
                      $label_status = "label label-info";
                    } else if ($t->status == 3) {
                      $label_status = "label label-success";
                    } else if ($t->status == 4) {
                      $label_status = "label label-danger";
                    } else if ($t->status == 5) {
                      $label_status = "label label-success";
                    } else if ($t->status == 6) {
                      $label_status = "label label-success";
                    } else {
                      $label_status = "";
                    } ?>
                    Last Status : <span class="<?php echo $label_status; ?>"><?php echo $t->desc_status; ?></span>
                  </p>
                  <div class="progress m-b-none full progress-small">
                    <div style="width: <?php echo $t->value_progres; ?>%" class="progress-bar progress-bar-success"></div>
                  </div>
                  <small><?php echo $t->value_progres; ?>% compleated:</small>
                  <small>
                    <br>
                    <i class="fa fa-clock-o"></i> Created : <?php echo $t->create_date; ?>
                    <br>
                    <i class="fa fa-clock-o"></i> Completed : <?php echo $t->finish_date; ?>
                    <br>
                    <i class="fa fa-clock-o"></i> Duration : <?php
                                                              $open = strtotime(date($t->create_date));
                                                              if (empty($t->finish_date) || $t->finish_date == 0) {
                                                                $finish = strtotime(date("Y-m-d H:i:s"));
                                                              } else {
                                                                $finish = strtotime(date($t->finish_date));
                                                              }
                                                              $diff = $finish - $open;
                                                              $jam   = floor($diff / 3600);
                                                              $menit = floor(($diff - ($jam * 3600)) / 60);
                                                              $hari =  floor($jam / 24);
                                                              $jam1 =  floor(($jam - ($hari * 24)));
                                                              $nilai = "$hari hari,$jam1 jam,$menit menit ";

                                                              echo $nilai;
                                                              ?>


                  </small>
                  <br>
                  <br>

                  <!--

   <?php if ($t->status == 1) {
    ?>
<form method ="post" action="<?= base_url('Helpdesk/Take_job') ?>" enctype="multipart/form-data" role="form">
<input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_take_job" required hidden>
<button  style="float:right; margin:5px;" class="btn btn-primary" type="submit">Take Job</button>
</form>
<?php } ?> -->
                  <?php if ($t->status < 5) {
                  ?>
                    <a data-toggle="modal" data-target="#progres" data-rel="tooltip" href='#' title="Progress" style="float:right; margin:5px;" class="btn btn-success"> Progress</a>
                    <a data-toggle="modal" data-target="#complete" data-rel="tooltip" href='#' title="Complete" style="float:right; margin:5px;" class="btn btn-success"> Complete</a>

                  <?php } ?>





                  <?php if ($t->status == 5 && $t->manager == '') {
                  ?>
                    <a data-toggle="modal" data-target="#approve" data-rel="tooltip" href='#' title="Progress" style="float:right; margin:5px;" class="btn btn-primary"> Approve</a>


                  <?php } ?>


                </div>
              </div>

            </div>
          </div>
        </div>
      </div>





      <div class="row">

        <div class="col-md-6">
          <a data-toggle="modal" data-target="#comment" data-rel="tooltip" href='#' title="Add Comment" style="float:right; margin:5px;" class="btn btn-success"> Add Comment</a>
          <h4> Recent Activity</h4>

          <div class="v-timeline vertical-container">
            <?php
            foreach ($log as $key => $l) { ?>
              <div class="vertical-timeline-block">
                <div class="vertical-timeline-icon" <?php if ($key == 0) { ?>style="background:#0f83c9;" <?php } ?>>
                  <i class="fa fa-arrow-up"></i>
                </div>
                <div class="vertical-timeline-content">
                  <div class="p-sm">
                    <span class="vertical-date pull-right"> <small> <?php echo $l->create_date; ?></small> </span>
                    <h2 style="color:#0f83c9;"> <?php echo $l->username; ?></h2>
                    <p> <?php echo $l->keterangan; ?></p>
                  </div>
                </div>
              </div>
            <?php
            } ?>




          </div>

        </div>


        <div class="col-md-6">
          <div class="panel">

            <div class="panel-body">

              <a data-toggle="modal" data-target="#tambah_file" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Add File</a>

              <h4>Document Atachment</h4>
              <table class="table table-striped">
                <thead>
                  <tr>



                    <th>User Create</th>
                    <th>View</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($doc as $key => $d) { ?>

                    <td><?php echo $d->name_pic; ?>


                      <br>
                      <?php echo $d->deskripsi; ?>
                    </td>

                    <td>
                      <small>
                        <!--    <?php echo anchor(base_url('Doc/incident/' . $d->foto . ''), '' . $d->foto . '', array('target' => '_blank', 'class' => 'btn btn-secondary')); ?> -->
                        <img src="<?php if (file_exists('Doc/incident/' . $d->foto . '')) {
                                    echo base_url('Doc/incident/' . $d->foto . '');
                                  } else {
                                    echo base_url('images/logo/no_image.png');
                                  } ?>" onclick="onClick(this)" data-toggle="modal" style="width:50px; height:50px; margin:5px;" data-target="#myModal">

                      </small>
                    </td>

                    <td>


                      <a href="javascript:;" data-id="<?php echo $d->id; ?>" data-name="<?php echo $d->foto; ?>" data-desc="<?php echo $d->foto; ?>" data-toggle="modal" data-target="#delete_file" data-rel="tooltip" title="Cancel"><i class="fas fa-times" style="color:red; margin:10px;"></i></a>


                      <!--       <i class="fas fa-lock" style="color:red; margin:10px;"></i>-->


                    </td>
                    </tr>

                  <?php
                    $no++;
                  } ?>


                </tbody>
              </table>














              <hr>

              <a data-toggle="modal" data-target="#tambah_biaya" data-rel="tooltip" href='#' title="Add File" style="float:right; margin:5px;" class="btn btn-success"> Tambah Biaya Perbaikan</a>

              <h4>Biaya Perbaikan</h4>

              <table class="table table-striped">
                <thead>
                  <tr style='text-align:center;'>
                    <th>Deskripsi</th>
                    <th>Qty</th>
                    <th>Biaya</th>
                    <th>Sub Total</th>
                    <th>Delete</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $no = 1;
                  $total_biaya = 0;

                  foreach ($biaya as $key => $b) { ?>

                    <td><?php echo $b->desk; ?> </td>
                    <td><?php echo  number_format($b->qty); ?> </td>
                    <td style='text-align:right;'><?php echo number_format($b->biaya); ?> </td>
                    <td style='text-align:right;'><?php echo number_format($b->subtotal); ?> </td>
                    <td style='text-align:center;'>

                      <a href="javascript:;" data-id="<?php echo $b->id; ?>" data-toggle="modal" data-target="#delete_biaya" data-rel="tooltip" title="Cancel"><i class="fas fa-times" style="color:red; margin:10px;"></i>
                      </a>

                    </td>

                    </tr>

                  <?php
                    $no++;

                    $total_biaya = $total_biaya + $b->subtotal;
                  } ?>

                  <tr>
                    <td colspan="3" style="text-align:right">
                      Total
                    </td>
                    <td style="text-align:right"><?php echo number_format($total_biaya); ?></td>
                    <td><input type="hidden" name="total_biaya_perbaikan" value="<?php echo $total_biaya; ?>"></td>
                  </tr>

                </tbody>
              </table>


            </div>
          </div>
        </div>
      </div>


      <script>
        $(document).ready(function() {
          // Untuk sunting
          $('#delete_file').on('show.bs.modal', function(e) {
            var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            modal.find('#id_file_delete').attr("value", div.data('id'));
            modal.find('#name_file_delete').attr("value", div.data('name'));
            modal.find('#desc_file_delete').attr("value", div.data('desc'));
            modal.find('#desc_teks').html(div.data('desc'));
          });
        });
      </script>




      <div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Approve Helpdesk</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>
            <form method="post" action="<?= base_url('Helpdesk/Approve') ?>" enctype="multipart/form-data" role="form">
              <div class="modal-body">
                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_approve" required hidden>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Apakah anda ingin approve helpdesk ?</label>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Approve</button>
              </div>
            </form>
          </div>
        </div>
      </div>















      <div class="modal fade" id="comment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New Comment</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>
            <form method="post" action="<?= base_url('Helpdesk/New_comment') ?>" enctype="multipart/form-data" role="form">
              <div class="modal-body">
                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_comment" required hidden>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Comment</label>
                  <textarea name="task_comment" rows="4" class='form-control' required="required"></textarea>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>



      <div class="modal fade" id="tambah_biaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Biaya</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>

            <form method="post" action="<?= base_url('Helpdesk/New_biaya') ?>" enctype="multipart/form-data" role="form">
              <div class="modal-body">

                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_biaya" required hidden>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Deskripsi</label>
                  <textarea name="desk_biaya" rows="4" class='form-control' required="required"></textarea>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Qty</label>
                  <input type="number" value="" class='form-control' name="qty_biaya" required>
                </div>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Biaya</label>


                  <input type="number" class="form-control" onkeyup="kalkulasi()" id="limit" class='form-control' name="biaya" required />


                  <h2>Rp.<span style="color:red" name="limit_2" id="limit_2"></span></h2>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>

          </div>
        </div>
      </div>

      <script>
        function kalkulasi() {
          var lim = $("#limit").val();
          $("#limit_2").text(number_format(lim, 0, '', '.'));

        }
      </script>

      <div class="modal fade" id="delete_biaya" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete Biaya</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>
            <div class="modal-body">Apakah anda yakin untuk menghapus biaya </span> ?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

              <form method="post" action="<?= base_url('Helpdesk/Delete_biaya') ?>" enctype="multipart/form-data" role="form">
                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_delete_biaya" required hidden>
                <input class='form-control' type='text' name='id_biaya_delete' id='id_biaya_delete' required hidden>
                <button class="btn btn-danger" type="submit">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          // Untuk sunting
          $('#delete_biaya').on('show.bs.modal', function(e) {
            var div = $(e.relatedTarget) // Tombol dimana modal di tampilkan
            var modal = $(this)
            modal.find('#id_biaya_delete').attr("value", div.data('id'));
          });
        });
      </script>



      <div class="modal fade" id="complete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Complete</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>
            <form method="post" action="<?= base_url('Helpdesk/Complete') ?>" enctype="multipart/form-data" role="form">
              <div class="modal-body">
                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_complete" required hidden>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Result</label>
                  <textarea name="task_result" rows="4" class='form-control' required="required"></textarea>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Solusi</label>
                  <textarea name="task_solusi" rows="4" class='form-control' required="required"></textarea>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>





      <div class="modal fade" id="progres" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Progres</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>
            <form method="post" action="<?= base_url('Helpdesk/Progres') ?>" enctype="multipart/form-data" role="form">
              <div class="modal-body">
                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_update" required hidden>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Value Progress %</label>
                  <input type="number" class='form-control' value="<?php echo encrypt_url($t->value_progres); ?>" name="value_progres" required>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlInput1">Progres Note</label>
                  <textarea name="task_progres" rows="4" class='form-control' required="required"><?php echo $t->last_update; ?></textarea>
                </div>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>


      <div class="modal fade" id="tambah_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah File</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>
            <form method="post" action="<?= base_url('Helpdesk/Document') ?>" enctype="multipart/form-data" role="form">
              <div class="modal-body">
                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_file" required hidden>
                <div class="form-group">
                  <label for="exampleFormControlInput1">Description File</label>
                  <textarea name="dok_desc" rows="4" class='form-control' required="required"></textarea>
                </div>


                <div class="form-group">
                  <label for="exampleFormControlInput1">File</label>
                  <input class='form-control' type='file' name='file' required>
                </div>
                <hr>
              </div>

              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"> </span>
              </button>
            </div>
            <div class="modal-body">Apakah anda yakin untuk menghapus file <span id='desc_teks'> </span> ?</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

              <form method="post" action="<?= base_url('Helpdesk/Delete_file') ?>" enctype="multipart/form-data" role="form">
                <input type="text" value="<?php echo encrypt_url($t->id); ?>" name="id_delete" required hidden>
                <input class='form-control' type='text' name='id_file_delete' id='id_file_delete' required hidden>
                <input class='form-control' type='text' name='name_file_delete' id='name_file_delete' hidden>
                <input class='form-control' type='text' name='desc_file_delete' id='desc_file_delete' hidden>
                <button class="btn btn-danger" type="submit">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>


    <?php

  }
    ?>
    </body>
    <script>
      $("a").click(function() {
        setInterval(function() {
          $(".pr").fadeOut("slow");
        }, 2000);
      });
    </script>


    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Image prev_img</h5>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
              <span class="sr-only">Close</span></button>
          </div>
          <div class="modal-body">
            <img src="" id="img01" style="width: 100%; height: auto;">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      function onClick(element) {
        document.getElementById("img01").src = element.src;
        document.getElementById("modal01").style.display = "block";
      }
    </script>

</html>