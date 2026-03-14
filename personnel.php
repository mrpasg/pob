<?php
include "config.php";

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
<option>Security</option>

</select>

<button name="submit">Add Person</button>

</form>

<br>

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
