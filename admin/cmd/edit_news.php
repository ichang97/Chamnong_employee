<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

	$title = $_REQUEST["txt_title"];
    $detail = $_REQUEST["txt_detail"];
    $news_id = $_REQUEST["txt_newsid"];
    $status = $_REQUEST["txt_status"];


	//table1
	$sql = "UPDATE news SET title = '$title' , detail = '$detail' ,status = '$status' WHERE news_id = '$news_id'";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
		header("Location: ../view_news?id=". $news_id);
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>