<?php
session_start();
include "config.php";

/* Protect page */
if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

/* Insert site */

if(isset($_POST['submit']))
{

$site=$_POST['site'];

mysqli_query($conn,"
INSERT INTO sites(site_name)
VALUES('$site')
");

}

/* Fetch sites */

$result=mysqli_query($conn,"SELECT * FROM sites");

?>

<!DOCTYPE html>
<html>

<head>

<title>Sites</title>

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

.sidebar h2{
color:white;
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

.topbar a{
color:white;
text-decoration:none;
margin-left:20px;
}

.topbar a:hover{
color:#ff7a00;
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
text-align:left;
}

input{
padding:8px;
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

<!-- SIDEBAR -->

<div class="sidebar">

<h2>Rig Control</h2>

<a href="dashboard.php">Dashboard</a>
<a href="sites.php">Sites</a>
<a href="rigs.php">Rigs</a>
<a href="personnel.php">Personnel</a>
<a href="movement_entry.php">Movement Entry</a>
<a href="logout.php">Logout</a>

</div>

<!-- HEADER -->

<div class="topbar">

<div>Rig Operations System</div>

<div>
<a href="dashboard.php">Home</a>
<a href="logout.php">Logout</a>
</div>

</div>

<!-- CONTENT -->

<div class="container">

<h2>Sites</h2>

<form method="POST">

<label>Site Name</label>

<input type="text" name="site" required>

<button name="submit">Add Site</button>

</form>

<table>

<tr>
<th>ID</th>
<th>Site Name</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['site_name']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>