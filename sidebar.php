<div class="sidebar">

<h2>Rig System</h2>

<a href="dashboard.php">Dashboard</a>
<a href="sites.php">Sites</a>
<a href="rigs.php">Rigs</a>
<a href="personnel.php">Personnel</a>
<a href="movement_entry.php">Movement</a>
<a href="logout.php">Logout</a>

</div>

.sidebar{
width:220px;
background:#111c2e;
height:100vh;
position:fixed;
left:0;
top:0;
padding:20px;
}

.sidebar a{
display:block;
color:white;
padding:10px;
text-decoration:none;
margin-bottom:10px;
}

.sidebar a:hover{
background:#ff7a00;
}

<body>

<?php include "sidebar.php"; ?>

<div class="main">

PAGE CONTENT HERE

</div>

</body>

.main{
margin-left:240px;
padding:20px;
}
