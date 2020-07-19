<?php
            
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

include '../connect.php' ;


$txt_remark = $_POST['txt_remark'];                                                                                                                                                                    
$remark_date = $_POST['remark_date'];

if($txt_remark == null){
  echo "<div class='alert alert-danger text-center' role='alert'><strong>กรุณาระบุหมายเหตุ</strong></div>";
}else{
  $sql = "INSERT INTO allstamp_log(ref_id, remark, remark_date) VALUES('11','$txt_remark','$remark_date') ";
  $qry = mysqli_query($con,$sql);

if($qry){
  echo "<div class='alert alert-success text-center' role='alert'><strong>บันทึกแล้ว !</strong></div>";
}else{
  echo "<div class='alert alert-danger text-center' role='alert'><strong>ERROR</strong></div>";
}
  
}



mysqli_close($con);

?>