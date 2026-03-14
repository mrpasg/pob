<?php
include "config.php";

$query = "
SELECT 
sites.site_name,
rigs.rig_name,

SUM(CASE WHEN movement_type='IN' THEN 1 ELSE 0 END) -
SUM(CASE WHEN movement_type='OUT' THEN 1 ELSE 0 END) AS pob

FROM rigs

LEFT JOIN sites ON rigs.site_id = sites.id
LEFT JOIN rig_movements ON rigs.id = rig_movements.rig_id

GROUP BY rigs.id
ORDER BY sites.id
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>

<head>

<title>Rig Operations Dashboard</title>

<style>

body{
background:#0b1f3a;
font-family:Arial;
color:white;
}

.container{
width:1200px;
margin:auto;
}

.header{
text-align:center;
font-size:30px;
padding:20px;
}

.grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:20px;
}

.card{

background:#1f2d3d;
padding:20px;
border-radius:10px;
text-align:center;

box-shadow:0 0 10px rgba(0,0,0,0.5);
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
while($row = mysqli_fetch_assoc($result))
{
?>

<div class="card">

<div class="rig">
<?php echo $row['rig_name']; ?>
</div>

<div class="site">
<?php echo $row['site_name']; ?>
</div>

<div class="pob">
<?php echo $row['pob'] ?? 0; ?>
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

