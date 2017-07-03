
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
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$notes="";
if (isset($_GET['id'])) {
  $sql = "SELECT id,entry FROM JOURNAL";
  $id=$_GET['id'];
  $id++;
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        if($id==$row["id"])
        $notes=$row["entry"];
  }
}
}
  $conn->close();
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
  <pre><code><?php echo $notes;?>;</code></pre>
</body>
