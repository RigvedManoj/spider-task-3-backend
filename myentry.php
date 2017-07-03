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
$titles=array();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$i=0;
$sql = "SELECT name,title FROM JOURNAL";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($name==$row["name"])
      {$titles[$i]=$row["title"];
        $i++;
      }
}
}
 ?>
 <html>
 <head>
 <meta charset="UTF-8">
 <link rel="stylesheet" type="text/css" href=map.css>
 <body id="body">
   <ul>
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
 </body>
 <script>
 var i=0;
 var title= <?php echo json_encode($titles); ?>;
 var body = document.getElementById("body");
 while(i<title.length)
 {
 var link=document.createElement("p");
   link.setAttribute("id",i);
 var t1 = document.createTextNode(title[i]);
 link.appendChild(t1);
 body.appendChild(link);
 var f1 = document.getElementById(i);
 f1.addEventListener("click",modify);
 i++;
 }
 function modify(e)
 {
   rem=e.target.id;
   window.location.href = 'show.php?id='+rem;
 }
 </script>
