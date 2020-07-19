<?php
include 'connect.php';
header("content-type:text/html;charset=utf-8");

$delete_id = $_GET["id"];
$user_id = $_GET['user_id'];

$sql = "DELETE FROM t_cert WHERE id = '$delete_id'";
$result = mysqli_query($con,$sql);

if($result){
    header("Location: ../t_cert?id=". $user_id);
    }
    else{
    echo "<script type='text/javascript' charset='utf-8'>";
    echo "alert('ไม่สามารถลบข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
    echo "</script>";
}

?>