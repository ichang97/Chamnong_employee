<?php
include 'connect.php';

/*Flag Description
1 = ตั้งค่าเวลาเข้าออกเริ่มต้น

*/

$default_start = $_POST['default_start'];
$default_end = $_POST['default_end'];
$flag = $_POST['flag'];

if($flag == 1){
  $sql = "update settings set default_start = '$default_start', default_end = '$default_end'";
  $qry = mysqli_query($con,$sql);
  
  if($qry){
    echo '<div class="alert alert-success text-center" role="alert">ตั้งค่าสำเร็จ</div>';
  }else{
    echo '<div class="alert alert-danger text-center" role="alert">ตั้งค่าสำเร็จ</div>';
  }
}









?>