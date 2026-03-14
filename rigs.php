<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

if(isset($_POST['submit']))
{

$rig=$_POST['rig'];
$site=$_POST['site'];

mysqli_query($conn,"
INSERT INTO rigs(rig_name,site_id)
VALUES('$rig','$site')
");

}

$sites=mysqli_query($conn,"SELECT * FROM sites");

$rigs=mysqli_query($conn,"
SELECT rigs.*,sites.site_name
FROM rigs
LEFT JOIN sites ON rigs.site_id=sites.id
");

?>

<!DOCTYPE html>
<html>

<head>

<title>Rigs</title>

<style>

body{
margin:0;
font-family:Arial;
background:#0b1f3a;
color:white;
}

/* SIDEBAR */

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
text-decoration:none;
padding:10px;
margin-top:10px;
}

.sidebar a:hover{
background:#ff7a00;
border-radius:5px;
}

/* HEADER */

.topbar{
position:fixed;
left:220px;
top:0;
right:0;
height:60px;
background:#111c2e;
display:flex;
align-items:center;
justify-content:space-between;
padding:0 20px;
}

/* CONTENT */

.container{
margin-left:240px;
margin-top:80px;
padding:20px;
}

/* TABLE */

table{
width:100%;
background:#1f2d3d;
border-collapse:collapse;
margin-top:20px;
}

th,td{
padding:12px;
border:1px solid #333;
}

button{
padding:8px 15px;
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

<div class="topbar">

<div>Rig Operations System</div>

<div>
<a href="dashboard.php">Home</a>
</div>

</div>

<div class="container">

<h2>Rigs</h2>

<form method="POST">

Rig Name
<input type="text" name="rig" required>

Site

<select name="site">

<?php while($s=mysqli_fetch_assoc($sites)){ ?>

<option value="<?php echo $s['id']; ?>">
<?php echo $s['site_name']; ?>
</option>

<?php } ?>

</select>

<button name="submit">Add Rig</button>

</form>

<table>

<tr>
<th>ID</th>
<th>Rig</th>
<th>Site</th>
</tr>

<?php while($r=mysqli_fetch_assoc($rigs)){ ?>

<tr>
<td><?php echo $r['id']; ?></td>
<td><?php echo $r['rig_name']; ?></td>
<td><?php echo $r['site_name']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>