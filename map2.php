<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:signup.php");
}
else {
$name=$_SESSION['username'];
}
$servername = "localhost";
$username = "root";
$password = "";//enter mysql password
$dbname = "spider1";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$lats=array();
$lngs=array();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$i=0;
$sql = "SELECT lat,lng,name FROM JOURNAL";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($name==$row["name"])
      {$lats[$i]=$row["lat"];
      $lngs[$i]=$row["lng"];
        $i++;
      }
}
}
?>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href=map.css>
  <style>
     #map {
       height: 550px;
       width: 100%;
     }
  </style>
  </head>
  <body id="body">
    <ul>
      <h2>Your Journal</h2>
       <li>
           <a><?php echo $name?></a>
           <ul class="dropdown">
               <li><a href="signup.php">Log out</a></li>
               <li><a href="map1.php">HomePage</a></li>
               <li><a href="myentry.php">My Entries</a></li>
           </ul>
       </li>
       <li><a href="map2.php">update</a></li>
    </ul>
    <div id="map"></div>
    <script>
    var i=0;
    var uluru = {lat: -25.363, lng: 131.044};
    var lats= <?php echo json_encode($lats); ?>;
    var lngs= <?php echo json_encode($lngs); ?>;
    var allowedBounds;
    var x=[];
    function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 5,
      center: {lat: 20, lng: 80 },
    });
    while(i<lats.length)
    {
      uluru.lat=parseInt(lats[i]);
      uluru.lng=parseInt(lngs[i]);
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
    i++;
  }
    map.setOptions({ minZoom: 2, maxZoom: 10 });
    map.addListener('click', function(e) {
      x[0]=e.latLng.lat();
      x[1]=e.latLng.lng();
        window.location.href = 'entry.php?id='+x;
    });
    var allowedBounds = new google.maps.LatLngBounds(
       new google.maps.LatLng(-85,-180),
       new google.maps.LatLng(85, 180)
  );
  var lastValidCenter = map.getCenter();
  google.maps.event.addListener(map, 'center_changed', function() {
      if (allowedBounds.contains(map.getCenter())) {
          lastValidCenter = map.getCenter();
          return;
      }
      map.panTo(lastValidCenter);
  });
  }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLDFLlGHyprjAPmAXmgGSIrRCHxNieMxk&callback=initMap">
    </script>
  </body>
</html>
