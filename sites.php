<?php
include "config.php";

if(isset($_POST['submit']))
{
$site=$_POST['site'];

mysqli_query($conn,"
INSERT INTO sites(site_name)
VALUES('$site')
");
}

$result=mysqli_query($conn,"SELECT * FROM sites");
?>

<!DOCTYPE html>
<html>
<head>
<title>Sites</title>

<style>

body{
font-family:Arial;
background:#0b1f3a;
color:white;
}

.container{
width:800px;
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

<h2>Sites</h2>

<form method="POST">

Site Name
<input type="text" name="site" required>

<button name="submit">Add Site</button>

</form>

<br>

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
