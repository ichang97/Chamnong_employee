<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

	$s_year = $_REQUEST["semester_year"];
    $s_part = $_REQUEST["semester_part"];
    $start = $_REQUEST["semester_start"];
    $end = $_REQUEST["semester_end"];

	//table1
	$sql = "INSERT INTO semester(semester_year,semester_part,semester_start,semester_end)
			 VALUES('$s_year', '$s_part', '$start','$end')";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('บันทึกข้อมูลสำเร็จ !');";
		echo "window.location = '../setting'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>