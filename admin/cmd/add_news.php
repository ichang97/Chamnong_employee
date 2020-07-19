<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

	$title = $_REQUEST["txt_title"];
    $detail = $_REQUEST["txt_detail"];
    $admin_id = $_REQUEST["txt_admin"];
    $status = $_REQUEST["txt_status"];

    date_default_timezone_set('Asia/Bangkok');
    $log_timestamp = date("Y-m-d H:i:s");

	//table1
	$sql = "INSERT INTO news(title,detail,timestamp,admin_id,status)
			 VALUES('$title', '$detail', '$log_timestamp','$admin_id','$status')";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('บันทึกข้อมูลสำเร็จ !');";
		echo "window.location = '../newsboard'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>