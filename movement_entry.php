<?php
include "config.php";

if(isset($_POST['submit']))
{

$person=$_POST['person'];
$rig=$_POST['rig'];
$type=$_POST['type'];

mysqli_query($conn,"
INSERT INTO rig_movements
(person_id,rig_id,movement_type,movement_time)
VALUES
('$person','$rig','$type',NOW())
");

echo "Saved Successfully";

}

$persons=mysqli_query($conn,"SELECT * FROM personnel");
$rigs=mysqli_query($conn,"SELECT * FROM rigs");

?>

<!DOCTYPE html>
<html>

<head>

<title>Movement Entry</title>

<style>

body{
background:#0b1f3a;
font-family:Arial;
color:white;
}

.container{
margin-left:240px;
padding:20px;
}

input,select{
padding:10px;
width:200px;
margin-top:10px;
}

button{
padding:10px 20px;
background:#ff7a00;
border:none;
color:white;
margin-top:10px;
}

</style>

</head>

<body>

<?php include "sidebar.php"; ?>

<div class="container">

<h2>Movement Entry</h2>

<form method="POST">

<label>Person</label><br>

<select name="person">

<?php while($p=mysqli_fetch_assoc($persons)){ ?>

<option value="<?php echo $p['id']; ?>">
<?php echo $p['name']; ?>
</option>

<?php } ?>

</select>

<br><br>

<label>Rig</label><br>

<select name="rig">

<?php while($r=mysqli_fetch_assoc($rigs)){ ?>

<option value="<?php echo $r['id']; ?>">
<?php echo $r['rig_name']; ?>
</option>

<?php } ?>

</select>

<br><br>

<label>Movement</label><br>

<select name="type">

<option value="IN">IN</option>
<option value="OUT">OUT</option>

</select>

<br><br>

<button name="submit">Save Movement</button>

</form>

</div>

</body>
</html>