<?php
session_start();
include 'connect.php';
header("content-type:text/html;charset=utf-8");

$cur_pass = $_POST['current_pass'];
$new_pass = $_POST['new_pass'];
$auth_pass = $_POST['auth_new_pass'];

$user_id = $_SESSION['userid'];


$check_password = md5(md5(md5(mysqli_real_escape_string($con,$cur_pass))));
$new_password = md5(md5(md5(mysqli_real_escape_string($con,$new_pass))));

//ตรวจสอบรหัสผ่านเดิมว่าถูกต้องหรือไม่
$sql_checkpass = "SELECT * FROM users WHERE id = '" . $user_id . "' AND password = '" . $check_password . "' ";
$qry_checkpass = mysqli_query($con,$sql_checkpass);
$chk_result = mysqli_fetch_array($qry_checkpass);

if ($chk_result){
    if ($new_pass != $auth_pass){
      echo "<script type='text/javascript' CHARSET='UTF-8'>";
      echo "alert('รหัสผ่านไม่ตรงกัน กรุณากรอกใหม่อีกครั้ง');";
      echo "window.location.replace('../change_password');";
      echo "</script>";
    }
    else{
      $sql_uppass = "UPDATE users SET password = '$new_password' WHERE id = '$user_id'";
      $qry_uppass = mysqli_query($con,$sql_uppass);
      
      echo "<script type='text/javascript' CHARSET='UTF-8'>";
      echo "alert('บันทึกข้อมูลสำเร็จ !');";
      echo "window.location.replace('../dashboard');";
      echo "</script>";
    }
  
    }
else{
  echo "<script type='text/javascript' CHARSET='UTF-8'>";
  echo "alert('รหัสผ่านเดิมไม่ถูกต้อง กรุณากรอกใหม่อีกครั้ง');";
  echo "window.location.replace('../change_password');";
  echo "</script>";
}





?>