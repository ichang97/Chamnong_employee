<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

	$cert_cate = $_POST['t_cert_cate'];
  $cert_id = $_POST['cert_id'];
  $valid_date = $_POST['valid_date'];
  $exp_date = $_POST['exp_date'];
  $id = $_POST['id'];

  $user_id = $_POST['user_id'];

	//table1
	$sql = "UPDATE t_cert SET cert_id = '$cert_id', cert_cate = '$cert_cate', valid_date = '$valid_date', exp_date = '$exp_date' WHERE id = '$id' ";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
		header("Location: ../t_cert?id=". $user_id);
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>