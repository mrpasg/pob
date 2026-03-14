<?php
session_start();
include "config.php";

/* Protect page */
if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

/* POB Query */

$query = "
SELECT 
sites.site_name,
rigs.rig_name,

COALESCE(
SUM(CASE WHEN movement_type='IN' THEN 1 ELSE 0 END) -
SUM(CASE WHEN movement_type='OUT' THEN 1 ELSE 0 END)
,0) AS pob

FROM rigs

LEFT JOIN sites ON rigs.site_id = sites.id
LEFT JOIN rig_movements ON rigs.id = rig_movements.rig_id

GROUP BY rigs.id
ORDER BY sites.id, rigs.rig_name
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>

<head>

<title>Rig Operations Dashboard</title>

<meta http-equiv="refresh" content="20">

<style>

/* PAGE */

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

/* TOP BAR */

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

/* MAIN CONTENT */

.container{
margin-left:240px;
margin-top:80px;
padding:20px;
}

/* GRID */

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

/* SITE TITLE */

.site-title{
grid-column:1/-1;
font-size:24px;
margin-top:30px;
border-bottom:2px solid #ff7a00;
padding-bottom:5px;
}

/* RIG CARD */

.card{
background:#1f2d3d;
padding:25px;
border-radius:12px;
text-align:center;
box-shadow:0 5px 15px rgba(0,0,0,0.5);
}

.rig{
font-size:22px;
font-weight:bold;
}

.site{
color:#aaa;
margin-top:5px;
}

.pob{
font-size:42px;
color:#ff7a00;
margin-top:15px;
font-weight:bold;
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

<!-- MAIN CONTENT -->

<div class="container">

<div class="grid">

<?php

$currentSite="";

while($row = mysqli_fetch_assoc($result))
{

if($currentSite != $row['site_name']){

$currentSite = $row['site_name'];

echo "<div class='site-title'>".$currentSite." Site</div>";

}

?>

<div class="card">

<div class="rig">
<?php echo $row['rig_name']; ?>
</div>

<div class="site">
<?php echo $row['site_name']; ?>
</div>

<div class="pob">
<?php echo $row['pob']; ?>
</div>

<div>
Person On Board
</div>

</div>

<?php
}
?>

</div>

</div>

</body>

</html>