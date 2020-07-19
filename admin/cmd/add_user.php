<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

	$username = $_REQUEST["username"];
	$password = $_REQUEST["pass"];
	$hashed_password = md5(md5(md5($password)));
	$salutation = $_REQUEST["salutation"];
    $firstname = $_REQUEST["firstname"];
	$lastname = $_REQUEST["lastname"];
	$permission = $_REQUEST["permission"];
	$time_start = $_REQUEST["timestart"];
	$time_end = $_REQUEST["timeend"];
	$rfid = $_REQUEST["rfid"];

	//table1
	$sql = "INSERT INTO users(username, password, t_salutation, t_name, t_surname, permission,time_start,time_end,rfid,status)
			 VALUES('$username', '$hashed_password', '$salutation','$firstname','$lastname','$permission','$time_start','$time_end','$rfid',1)";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error($con));


	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('บันทึกข้อมูลสำเร็จ !');";
		echo "window.location = '../user_list'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
      
	}
	?>