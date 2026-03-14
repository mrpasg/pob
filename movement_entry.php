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

}

?>

<form method="POST">

Person ID
<input type="text" name="person">

Rig
<select name="rig">
<option value="1">PPE1</option>
<option value="2">PPE2</option>
<option value="3">PPE3</option>
<option value="4">PPE4</option>
<option value="5">PPE5</option>
<option value="6">PPE6</option>
<option value="7">PPE7</option>
<option value="8">PPE8</option>
</select>

Movement
<select name="type">
<option value="IN">IN</option>
<option value="OUT">OUT</option>
</select>

<button name="submit">Save</button>

</form>


