<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

    $stamp_date = $_REQUEST["txt_date"];
    
    $sql_delete = "DELETE FROM timesheet WHERE stamp_date = '$stamp_date' ";
    $run_delete = mysqli_query($con,$sql_delete);


	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($run_delete){
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ยกเลิกการลงเวลาเรียบร้อยแล้ว !');";
		echo "window.location = '../cta'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>