<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

	  $time_start = $_REQUEST["txt_start"];
    $time_end = $_REQUEST["txt_end"];
    $stamp_date = $_REQUEST["txt_date"];
    $remark = $_REQUEST["txt_remark"];
    $id = $_REQUEST["txt_id"];
    $status = 1;

//check current year and semester
$sql_semester = "SELECT * FROM semester ORDER BY id DESC LIMIT 0,1";
$qry_semester = mysqli_query($con,$sql_semester);
$row_semester = mysqli_fetch_array($qry_semester);

$s_year = $row_semester['semester_year'];
$s_part = $row_semester['semester_part'];

//check current default time
$sql_set = "select default_start,default_end from settings"; $qry_set = mysqli_query($con,$sql_set);
$show_set = mysqli_fetch_array($qry_set);

$default_start = $show_set['default_start']; $default_end = $show_set['default_end'];


	//table1
	$sql = "INSERT INTO timesheet(id,default_start,default_end,stamp_date,time_start,time_end,chk_status,year,part) 
  VALUES('$id','$default_start','$default_end','$stamp_date','$time_start','$time_end','1','$s_year','$s_part') ";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

    $sql_remark = "INSERT INTO allstamp_log(ref_id,remark,remark_date)
    VALUES('$id', '$remark','$stamp_date')";
    $result_remark = mysqli_query($con,$sql_remark) or die ("Error in query: $sql_remark " . mysqli_error());


    if ($result_remark == true)
        $result = true;
    else
        $result = false;


	//ปิดการเชื่อมต่อ database
	mysqli_close($con);
	//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม
	
	if($result){
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('บันทึกข้อมูลสำเร็จ !');";
		echo "window.location = '../cta'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>