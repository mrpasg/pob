<?php
session_start();
include "config.php";

if(isset($_POST['login']))
{

$user=$_POST['username'];
$pass=md5($_POST['password']);

$q=mysqli_query($conn,"
SELECT * FROM users 
WHERE username='$user' 
AND password='$pass'
");

if(mysqli_num_rows($q)>0)
{
$_SESSION['user']=$user;
header("Location: dashboard.php");
}
else
{
$error="Invalid login";
}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Rig Dashboard Login</title>

<style>

body{
background:#0b1f3a;
font-family:Arial;
color:white;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:#1f2d3d;
padding:40px;
border-radius:10px;
}

input{
width:100%;
padding:10px;
margin:10px 0;
}

button{
background:#ff7a00;
color:white;
border:none;
padding:10px 20px;
}

</style>

</head>

<body>

<div class="box">

<h2>Rig Operations Login</h2>

<form method="POST">

<input name="username" placeholder="Username">

<input name="password" type="password" placeholder="Password">

<button name="login">Login</button>

</form>

<?php if(isset($error)) echo $error; ?>

</div>

</body>
</html>
