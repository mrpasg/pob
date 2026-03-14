<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

if(isset($_POST['submit']))
{

$person=$_POST['person'];
$rig=$_POST['rig'];
$type=$_POST['type'];

mysqli_query($conn,"
INSERT INTO rig_movements
(person_id,rig_id,movement_type,movement_time)
VALUES
('$person','$rig','$type',NOW())
");

echo "Saved Successfully";

}

$persons=mysqli_query($conn,"SELECT * FROM personnel");
$rigs=mysqli_query($conn,"SELECT * FROM rigs");

?>

<!DOCTYPE html>
<html>

<head>

<title>Movement Entry</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0b1f3a;
color:white;
}

.sidebar{
position:fixed;
left:0;
top:0;
width:220px;
height:100%;
background:#111c2e;
padding:20px;
}

.sidebar a{
display:block;
color:white;
padding:10px;
text-decoration:none;
}

.sidebar a:hover{
background:#ff7a00;
}

.container{
margin-left:240px;
margin-top:80px;
padding:20px;
}

select{
padding:8px;
margin-top:10px;
}

button{
padding:10px 20px;
background:#ff7a00;
border:none;
color:white;
}

</style>

</head>

<body>

<div class="sidebar">

<h2>Rig Control</h2>

<a href="dashboard.php">Dashboard</a>
<a href="sites.php">Sites</a>
<a href="rigs.php">Rigs</a>
<a href="personnel.php">Personnel</a>
<a href="movement_entry.php">Movement Entry</a>
<a href="logout.php">Logout</a>

</div>

<div class="container">

<h2>Movement Entry</h2>

<form method="POST">

Person

<select name="person">

<?php while($p=mysqli_fetch_assoc($persons)){ ?>

<option value="<?php echo $p['id']; ?>">
<?php echo $p['name']; ?>
</option>

<?php } ?>

</select>

<br><br>

Rig

<select name="rig">

<?php while($r=mysqli_fetch_assoc($rigs)){ ?>

<option value="<?php echo $r['id']; ?>">
<?php echo $r['rig_name']; ?>
</option>

<?php } ?>

</select>

<br><br>

Movement

<select name="type">

<option value="IN">IN</option>
<option value="OUT">OUT</option>

</select>

<br><br>

<button name="submit">Save Movement</button>

</form>

</div>

</body>
</html>