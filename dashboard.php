<?php
session_start();
include "config.php";
include "sidebar.php";

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

body{
background:#0b1f3a;
font-family:Arial;
color:white;
margin:0;
}

.container{
margin-left:240px;
padding:20px;
}

.header{
font-size:28px;
text-align:center;
margin-bottom:30px;
}

.grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

.site-title{
grid-column:1/-1;
font-size:22px;
margin-top:30px;
border-bottom:2px solid #ff7a00;
padding-bottom:5px;
}

.card{
background:#1f2d3d;
padding:25px;
border-radius:12px;
text-align:center;
box-shadow:0 5px 15px rgba(0,0,0,0.4);
}

.rig{
font-size:22px;
font-weight:bold;
}

.site{
color:#aaa;
}

.pob{
font-size:40px;
color:#ff7a00;
margin-top:10px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container">

<div class="header">
RIG OPERATIONS DASHBOARD
</div>

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