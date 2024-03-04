<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style>
   .page-item.active .page-link {
      color:#fff;
    }
    </style>
  <body>
 
    

        <table border="1" cellpadding="10">
        <tr>
              <?php foreach($head as $key => $s) { ?>
  <th><?php echo  $s->username; ?></th>
            <?php }?>  
        </tr>
        <tr bgcolor="#00ff80">
            <td>Baris 2 kolom 1</td>
            <td>baris 2 kolom 2</td>
        </tr>
    </table>
  
   
<script src="<?=base_url('assets/');?>js/jquery-3.3.1.min.js"></script>
  <script>
     $(document).ready(function() {
  $('#User').DataTable();

});
 </script>

 <script src="<?=base_url('assets/');?>vendor/chart.js/Chart.min.js"></script>
 <script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
      labels: ["Tidak Absen", "Absen masuk di kantor", "Absen masuk di luar kantor", "Absen pulang di kantor", "Absen pulang di luar kantor",],
      datasets: [{
          label: '',
          data: [
           <?php echo $bar1;?>, 
           <?php echo $bar2;?>, 
           <?php echo $bar3;?>, 
           <?php echo $bar4;?>,
          <?php echo $bar5;?>
          ],
          backgroundColor: [
              'rgba(255, 99, 132)',
              'rgba(54, 162, 235)',
              'rgba(255, 206, 86)',
              'rgba(75, 192, 192)',
              'rgba(153, 102, 255)',
              
          ],
          borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)'
          ],
          borderWidth: 2
      }]
  },
  options: {
      legend: {
        display: false
    },
      scales: {
          yAxes: [{
              ticks: {
                  beginAtZero:true
              }
          }]
      }
  }
});
</script>

    </body>
</html>