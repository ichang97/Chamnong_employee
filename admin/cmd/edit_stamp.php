<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

    
  $user_id = $_POST['txt_id'];
  $stamp_date = $_POST['txt_stampdate'];
  $time_start = $_POST['txt_start'];
  $time_end = $_POST['txt_end'];

	//table1
    $sql = "UPDATE qry_timesheet SET time_start = '$time_start', time_end = '$time_end' WHERE id = '$user_id' AND stamp_date = '$stamp_date' ";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
        echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('บันทึกข้อมูลสำเร็จ !');";
		echo "window.location = '../cta_editstamp'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>