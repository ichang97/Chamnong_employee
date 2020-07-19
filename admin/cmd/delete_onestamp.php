<?php
include 'connect.php';
header("content-type:text/html;charset=utf-8");

$delete_id = $_GET["id"];
$stamp_date = $_GET["stamp_date"];

$sql_timetable = "DELETE FROM timesheet WHERE id = '$delete_id' AND stamp_date = '$stamp_date' ";
$result_time = mysqli_query($con,$sql_timetable);

if(result_time){
    echo "<script type='text/javascript'>";
    echo "alert('ลบข้อมูลสำเร็จ !');";
    echo "window.location = '../cta'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript' charset='utf-8'>";
    echo "alert('ไม่สามารถลบข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
    echo "</script>";
}

?>