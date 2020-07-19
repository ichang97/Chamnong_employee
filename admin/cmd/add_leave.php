<?php
include 'connect.php';
header("content-type:text/html;charset=utf-8");  

$doc_title = $_REQUEST["doc_title"];
$t_class = $_REQUEST["t_class"];
$t_subject = $_REQUEST["t_subject"];
$t_sclass = $_REQUEST["t_sclass"];
$category = $_REQUEST["category"];
$start_date = $_REQUEST["start_date"];
$s_time_range = $_REQUEST["s_time_range"];
$end_date = $_REQUEST["end_date"];
$e_time_range = $_REQUEST["e_time_range"];
$reason = $_REQUEST["reason"];
$ad_home_no = $_REQUEST["ad_home_no"];
$ad_alley = $_REQUEST["ad_alley"];
$ad_road = $_REQUEST["ad_road"];
$ad_sub_district = $_REQUEST["ad_sub_district"];
$ad_district = $_REQUEST["ad_district"];
$ad_province = $_REQUEST["ad_province"];
$ad_postcode = $_REQUEST["ad_postcode"];
$tel = $_REQUEST["tel"];
$user_id = $_REQUEST["txt_id"];

//วันที่ภาษาไทย
function DatefullThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute น.";
  }


date_default_timezone_set('Asia/Bangkok');
$log_timestamp = date("Y-m-d H:i:s");

//teacher name
$sql_name = "SELECT t_name,t_surname FROM users WHERE id = '$user_id'";
$qry_name = mysqli_query($con,$sql_name);
$show_name = mysqli_fetch_array($qry_name);

//ปีการศึกษาและภาคเรียนปัจจุบัน
$sql_semester = "SELECT * FROM semester ORDER BY id DESC LIMIT 0,1";
$qry_semester = mysqli_query($con,$sql_semester);
$row_semester = mysqli_fetch_array($qry_semester);

$s_year = $row_semester['semester_year'];
$s_part = $row_semester['semester_part'];

//table1
$sql = "INSERT INTO leave_log(userid,doc_title,t_class,t_subject,t_sclass,category,reason,start_date,
        s_time_range,end_date,e_time_range,ad_home_no,ad_road,ad_alley,ad_sub_district,ad_district,
        ad_province,ad_postcode,tel,timestamp,s_year,s_part)
        VALUES('$user_id','$doc_title','$t_class','$t_subject','$t_sclass','$category','$reason','$start_date',
        '$s_time_range','$end_date','$e_time_range','$ad_home_no','$ad_road','$ad_alley','$ad_sub_district','$ad_district',
        '$ad_province','$ad_postcode','$tel','$log_timestamp','$s_year','$s_part')";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

//check to show class
if ($t_class != "")
{
    $show_class =  'ครูประจำชั้น ' . $t_class;
}

if ($t_subject != "")
{
    $show_class = 'ครูพิเศษวิชา' . $t_subject . ' ชั้น ' . $t_sclass;
}

//check category
if ($category == 1)
{
    $show_category = 'ขอลากิจ';
}
elseif ($category == 2)
{
    $show_category = 'ขอลาป่วย';
}
elseif ($category == 3)
{
    $show_category = 'ขอลาคลอด';
}
else
{
    $show_category = 'ได้มาสาย';
}

//check start time range
if ($s_time_range == 1)
{
    $show_srange = '(เต็มวัน)';
}
elseif ($s_time_range == 2)
{
    $show_srange = '(ครึ่งวันเช้า)';
}
else
{
    $show_srange = '(ครึ่งวันบ่าย)';
}

//check end time range
if ($e_time_range == 1)
{
    $show_erange = '(เต็มวัน)';
}
elseif ($e_time_range == 2)
{
    $show_erange = '(ครึ่งวันเช้า)';
}
else
{
    $show_erange = '(ครึ่งวันบ่าย)';
}

//message for each category
if ($category == 1)
{
    $cate_msg = ' ถึงวันที่ ' . DatefullThai($end_date) . ' ' . $show_erange;
}
elseif ($category == 2)
{
    $cate_msg = ' ถึงวันที่ ' . DatefullThai($end_date) . ' ' . $show_erange;
}
elseif ($category == 3)
{
    $cate_msg = ' ถึงวันที่ ' . DatefullThai($end_date) . ' ' . $show_erange;
}
else
{
    $cate_msg = '';
}

$teacher_name = $show_name['t_name'];

// LINE Notify

$line_api = 'https://notify-api.line.me/api/notify';
$access_token = 'kDs4etsxeUMCFnj0Dfz6p52iB7rDO3m07ra8JkYayf0';

$str = $show_name['t_name'] . '  ' . $show_name['t_surname'] . ' ' . $show_class . ' ' . $show_category . ' ในวันที่ ' . DatefullThai($start_date) . ' ' . $show_srange . $cate_msg . ' ' . 'ส่งใบลาเมื่อ ' . DateThai($log_timestamp);    //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร

$message_data = array(
 'message' => $str
);

$result = send_notify_message($line_api, $access_token, $message_data);
print_r($result);

function send_notify_message($line_api, $access_token, $message_data)
{
 $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$access_token );

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $line_api);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 $result = curl_exec($ch);
 // Check Error
 if(curl_error($ch))
 {
  $return_array = array( 'status' => '000: send fail', 'message' => curl_error($ch) ); 
 }
 else
 {
  $return_array = json_decode($result, true);
 }
 curl_close($ch);
 return $return_array;
}

//ปิดการเชื่อมต่อ database
mysqli_close($con);
//จาวาสคริปแสดงข้อความเมื่อบันทึกเสร็จและกระโดดกลับไปหน้าฟอร์ม

if($result){
    echo "<script type='text/javascript' charset='utf-8'>";
    echo "alert('บันทึกข้อมูลสำเร็จ !');";
    echo "window.location = '../view_leave'; ";
    echo "</script>";
    }
    else{
    echo "<script type='text/javascript' charset='utf-8'>";
    echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
    echo "</script>";
}

?>