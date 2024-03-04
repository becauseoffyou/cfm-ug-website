<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">

  
 	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2aydOihJBxeEEqpkBSTZzHAOvZ9ZqRWk&callback=initMap"></script>
<script>
function initialize() {
  var propertiPeta = {
    center:new google.maps.LatLng(<?php echo "$lat,$long"; ?>),
    zoom:9,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  
  var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
  
  // membuat Marker
  var marker=new google.maps.Marker({
      position: new google.maps.LatLng(<?php echo "$lat,$long"; ?>),
      map: peta
  });

}

// event jendela di-load  
google.maps.event.addDomListener(window, 'load', initialize);
</script>
  
</head>
<body>
<div><?php echo "$lat,$long"; ?></div>
  <div id="googleMap" style="width:100%;height:800px;"></div>
  
</body>