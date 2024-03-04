<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
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
  margin-left: 68px;
    color: #000060;
}
.view-header .header-title h3 {
  margin-bottom: 2px;
    color: #000060;
}

.label-accent {
  background-color: #000060;
}

.label-default {
  background-color: #44464f;
}
.label-primary {
  background-color: #0f83c9;
}
.label-success {
  background-color: #1bbf89;
}
.label-info {
  background-color: #56c0e0;
}
.label-warning {
  background-color: #f7af3e;
}
.label-danger {
  background-color: #db524b;
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
  font-size: 83%;
}

a {  color: #000060;
  text-decoration: none;}
      </style>
</head>
<body>



   
    <!-- End navigation-->



        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <div class="view-header">
                       <!-- <div class="pull-right text-right" style="line-height: 14px">
                            <small>App Pages<br>Basic<br> <span class="c-white">Projects</span></small>
                        </div>-->
                        <div class="header-icon" >
                            <i class="pe page-header-icon pe-7s-box1"></i>
                        </div>
                        <div class="header-title">
                            <h3>Task</h3>
                            <small>
                                List of all Task
                            </small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">


                    <div>
                        <div>
                            <table class="table table-vertical-align-middle table-responsive-sm" id='data'>
                                <thead >
                                <tr>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Task name
                                    </th>
                                    <th>
                                        Participate
                                    </th>
                                    <th>
                                        Progress
                                    </th>
                                    <th class="text-right">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <span class="label label-accent">Active</span>
                                    </td>
                                    <td>
                                        <a href="#">Contract with Meltex Company</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 24.08.2017</div>
                                    </td>
                                    <td>
                                        vv
                                        RR, 
                                        Budi Susanto
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 35%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>35% compleated:</small>
                                    </td>
                                    <td>
                                        <div style='float:right;'>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-default">Waiting</span>
                                    </td>
                                    <td>
                                        <a href="#">Zentif case</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 12.04.2017</div>
                                    </td>
                                    <td>
                                        <a href=""><img alt="image" class="rounded image-md" src="images/a5.jpg"></a>
                                        <a href=""><img alt="image" class="rounded image-md" src="images/a4.jpg"></a>
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 13%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>13% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-default">Waiting</span>
                                    </td>
                                    <td>
                                        <a href="#">Hortex main case</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 12.04.2017</div>
                                    </td>
                                    <td>
                                        <a href=""><img alt="image" class="rounded image-md" src="images/profile.jpg"></a>
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 63%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>63% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-default">Completed</span>
                                    </td>
                                    <td>
                                        <a href="#">Tarnow INC contract</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 10.05.2017</div>
                                    </td>
                                    <td>
                                        Budi Susanto
                                        RR, 
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 100%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>100% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-default">Waiting</span>
                                    </td>
                                    <td>
                                        <a href="#">Comarch group contract</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 06.10.2017</div>
                                    </td>
                                    <td>
                                        vv
                                        <a href=""><img alt="image" class="rounded image-md" src="images/a5.jpg"></a>
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 12%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>12% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-accent">Active</span>
                                    </td>
                                    <td>
                                        <a href="#">Contract with Meltex Company</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 24.08.2017</div>
                                    </td>
                                    <td>
                                        vv
                                        RR, 
                                        Budi Susanto
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width:35%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>35% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-default">Waiting</span>
                                    </td>
                                    <td>
                                        <a href="#">Zentif case</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 12.04.2017</div>
                                    </td>
                                    <td>
                                        <a href=""><img alt="image" class="rounded image-md" src="images/a5.jpg"></a>
                                        <a href=""><img alt="image" class="rounded image-md" src="images/a4.jpg"></a>
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 13%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>13% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-default">Waiting</span>
                                    </td>
                                    <td>
                                        <a href="#">Hortex main case</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 12.04.2017</div>
                                    </td>
                                    <td>
                                        <a href=""><img alt="image" class="rounded image-md" src="images/profile.jpg"></a>
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 63%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>63% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="label label-default">Waiting</span>
                                    </td>
                                    <td>
                                        <a href="#">Comarch group contract</a>

                                        <div class="small"><i class="fa fa-clock-o"></i> Created 06.10.2017</div>
                                    </td>
                                    <td>
                                        vv
                                        <a href=""><img alt="image" class="rounded image-md" src="images/a5.jpg"></a>
                                    </td>
                                    <td>
                                        <div class="progress m-b-none full progress-small">
                                            <div style="width: 12%" class="progress-bar progress-bar-warning"></div>
                                        </div>
                                        <small>12% compleated:</small>
                                    </td>
                                    <td>
                                        <div>
                                            <button class="btn"><i class="fa fa-folder"></i> View</button>
                                            <button class="btn"><i class="fa fa-gear"></i> Edit</button>
                              
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pull-right">
     
            </div>

        </div>



  <script>
     $(document).ready(function() {
  $('#data').DataTable();

});
 </script>

</body>

</html>