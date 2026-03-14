<?php
include "config.php";

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
font-family:Arial;
background:#0b1f3a;
color:white;
}

.container{
width:900px;
margin:auto;
}

table{
width:100%;
background:#1f2d3d;
border-collapse:collapse;
}

td,th{
padding:10px;
border:1px solid #333;
}

</style>

</head>

<body>

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

<br>

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
