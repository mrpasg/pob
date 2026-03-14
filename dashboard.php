<?php
session_start();
include "config.php";

/* Protect page */
if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

/* Query for POB per rig */

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

<meta http-equiv="refresh" content="30">

<style>

body{
background:#0b1f3a;
font-family:Arial;
color:white;
margin:0;
}

.header{

background:#111c2e;
padding:20px;
text-align:center;
font-size:28px;
font-weight:bold;

}

.container{

max-width:1200px;
margin:auto;
padding:20px;

}

.grid{

display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;

}

.site-title{

grid-column:1/-1;
font-size:24px;
margin-top:30px;
border-bottom:2px solid #ff7a00;
padding-bottom:5px;

}

.card{

background:#1f2d3d;
padding:25px;
border-radius:12px;
text-align:center;

box-shadow:0 5px 15px rgba(0,0,0,0.5);

transition:0.2s;

}

.card:hover{
transform:translateY(-5px);
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

.footer{

text-align:center;
margin-top:40px;
font-size:12px;
color:#888;

}

</style>

</head>

<body>

<div class="header">
RIG OPERATIONS DASHBOARD
</div>

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

<div class="footer">

Rig Operations Monitoring System

</div>

</div>

</body>

</html>