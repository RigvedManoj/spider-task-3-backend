<?php
session_start();
if(empty($_SESSION['username']))
{
header("Location:signup.php");
}
else {
$name=$_SESSION['username'];
}
if (isset($_GET['id']))
{
  $id=$_GET['id'];
}
$id1=(int)$id;
for($i=0;;$i++)
{
  if($id[$i]==",")
  {$a=$i;
    break;}
}
$id12= substr ($id,$a+1,strlen($id));
$id2=(int)$id12;
if (!empty($_POST['note'])) {
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
    $p1=$_POST['privacy'];
    $note=$_POST['note'];
    $title=$_POST['title'];
  $stmt = $conn->prepare("INSERT INTO JOURNAL (lat,lng,name,privacy,title,entry) VALUES (?,?,?,?,?,?)");
  $stmt->bind_param("ssssss", $lat,$lng,$nam,$p,$head,$info);
 // set parameters and execute
  $lat=$id1;
  $lng=$id2;
  $nam=$name;
  $p=$p1;
  $head=$title;
  $info=$note;
  $stmt->execute();
  $stmt->close();
$conn->close();
header("Location:map1.php");
}
?>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href=map.css>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    text-align: center;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
textarea
{ margin: 0px;
  width: 1357px;
  height: 416px;
  outline: none;
  resize: none;
  overflow: auto;
  white-space: nowrap;
}
</style>
</head>
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
  <form method="post" action='entry.php?id=<?php echo $id;?>'>
    <select id="privacy" name="privacy">
        <option value="a1">private</option>
        <option value="a2">public</option>
    </select>
  <input type="text" name="title" placeholder="TITLE">
  <p><textarea id ="note"  name="note" placeholder="click here to write note"rows="4" cols="190"></textarea></p>
  <p><input type="submit" value="Submit"></p>
  </form>
</body>
