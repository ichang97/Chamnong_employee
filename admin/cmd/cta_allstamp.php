<?php
include 'connect.php';   
header("content-type:text/html;charset=utf-8");

    $stamp_date = $_REQUEST["txt_date"];
    $txt_remark = $_REQUEST["txt_remark"];
    $remark_date = $stamp_date;
    
    //id 999 อ้างอิงการลงเวลาแทนทั้งหมด
    $ref_id = 999;
  
    
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

    $sql = "SELECT * FROM users";
    $qry = mysqli_query($con,$sql);

    while($show_t = mysqli_fetch_array($qry))
    {
        
        $user_id = $show_t["id"];
        $time_start = $show_t["time_start"];
        $time_end = $show_t["time_end"];
        $chk_status = 1;

	$sql_write = "INSERT INTO timesheet(id,default_start,default_end,stamp_date,time_start,time_end,chk_status,year,part) 
      VALUES('$user_id','$default_start','$default_end','$stamp_date','$default_start','$default_end','1','$s_year','$s_part') ";
	$result_write = mysqli_query($con, $sql_write) or die ("Error in query: $sql_write " . mysqli_error());
    }

    $sql_remark = "INSERT INTO allstamp_log(ref_id,remark,remark_date)
    VALUES('$ref_id', '$txt_remark','$remark_date')";
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
		echo "alert('ลงเวลาแทนเรียบร้อยแล้ว !');";
		echo "window.location = '../cta'; ";
		echo "</script>";
		}
		else{
		echo "<script type='text/javascript' charset='utf-8'>";
		echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
		echo "</script>";
	}
	?>