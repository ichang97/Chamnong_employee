<?php
$intRejectTime = 20; // Minute
$sql = "UPDATE users SET SET login_status = '0', LastUpdate = '0000-00-00 00:00:00'  WHERE 1 AND DATE_ADD(LastUpdate, INTERVAL $intRejectTime MINUTE) <= NOW() ";
$query = mysqli_query($con,$sql);

?>