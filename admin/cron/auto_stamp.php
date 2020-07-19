<?php
include 'connect.php';
header("content-type:text/html;charset=utf-8");

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

function datethaishort($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
  }

//search time
$sql_time = "SELECT id,time_start,time_end FROM users WHERE id = '1'";
$qry_time = mysqli_query($con,$sql_time);
$show_time = mysqli_fetch_array($qry_time);

$time_start = $show_time['time_start'];
$time_end = $show_time['time_end'];
$u_id = $show_time['id'];

date_default_timezone_set('Asia/Bangkok');
$current_date = date("Y-m-d");

$sql_semester = "SELECT * FROM semester ORDER BY id DESC LIMIT 0,1";
$qry_semester = mysqli_query($con,$sql_semester);
$row_semester = mysqli_fetch_array($qry_semester);

$s_year = $row_semester['semester_year'];
$s_part = $row_semester['semester_part'];

$sql_stamp = "INSERT INTO timesheet(id,stamp_date,time_start,time_end,chk_status,year,part) 
VALUES('$u_id','$current_date','$time_start','$time_end','1','$s_year','$s_part') ";
$qry_stamp = mysqli_query($con,$sql_stamp);

if($qry_stamp){
  $str = "ลงเวลาให้ผอ.แล้ว : " . datethaishort($current_date) . " / " . $time_start . " - " . $time_end;
  $line_api = 'https://notify-api.line.me/api/notify';
  $access_token = 'kDs4etsxeUMCFnj0Dfz6p52iB7rDO3m07ra8JkYayf0';
  
  //send msg
  $message_data = array('message' => $str); 
  $result = send_notify_message($line_api, $access_token, $message_data);
  //echo $msg;
}


?>