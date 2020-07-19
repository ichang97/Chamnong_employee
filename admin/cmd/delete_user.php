<?php
include 'connect.php';
header("content-type:text/html;charset=utf-8");

$delete_id = $_GET["id"];

$sql_timetable = "DELETE FROM timesheet WHERE id = '$delete_id' ";
$result_time = mysqli_query($con,$sql_timetable);

$sql = "DELETE FROM users WHERE id = '$delete_id'";
$result = mysqli_query($con,$sql);


if($result){
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลสำเร็จ !');";
    echo "window.location = '../user_list'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript' charset='utf-8'>";
    echo "alert('ไม่สามารถลบข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
    echo "</script>";
}

?>