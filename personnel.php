<?php
session_start();
include "config.php";

if(!isset($_SESSION['user'])){
header("Location: login.php");
exit;
}

if(isset($_POST['submit']))
{

$name=$_POST['name'];
$company=$_POST['company'];
$designation=$_POST['designation'];
$category=$_POST['category'];

mysqli_query($conn,"
INSERT INTO personnel(name,company,designation,category)
VALUES('$name','$company','$designation','$category')
");

}

$persons=mysqli_query($conn,"SELECT * FROM personnel");

?>

<!DOCTYPE html>
<html>

<head>

<title>Personnel</title>

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

.topbar{
position:fixed;
left:220px;
top:0;
right:0;
height:60px;
background:#111c2e;
display:flex;
align-items:center;
padding:0 20px;
}

.container{
margin-left:240px;
margin-top:80px;
padding:20px;
}

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

</div>

<div class="container">

<h2>Personnel</h2>

<form method="POST">

Name
<input type="text" name="name" required>

Company
<input type="text" name="company">

Designation
<input type="text" name="designation">

Category

<select name="category">

<option>Drilling Crew</option>
<option>Company Man</option>
<option>Service Engineer</option>
<option>Mud Engineer</option>
<option>Catering</option>
<option>Visitor</option>

</select>

<button name="submit">Add Person</button>

</form>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Company</th>
<th>Designation</th>
<th>Category</th>
</tr>

<?php while($p=mysqli_fetch_assoc($persons)){ ?>

<tr>
<td><?php echo $p['id']; ?></td>
<td><?php echo $p['name']; ?></td>
<td><?php echo $p['company']; ?></td>
<td><?php echo $p['designation']; ?></td>
<td><?php echo $p['category']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>