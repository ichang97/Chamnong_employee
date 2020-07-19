<?php
include 'connect.php';
header("content-type:text/html;charset=utf-8");

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
    return "$strDay $strMonthThai $strYear";
  }

function txttime($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
    return "$strHour:$strMinute:$strSeconds น.";
  }

$cur_date = date('Y-m-d');
$sql = "SELECT * FROM qry_latecount WHERE late_count = 1 And stamp_date = '$cur_date' ORDER BY t_name ASC";
$qry = mysqli_query($con,$sql);
$count_qry = mysqli_num_rows($qry);

// LINE Notify

$line_api = 'https://notify-api.line.me/api/notify';
$access_token = 'kDs4etsxeUMCFnj0Dfz6p52iB7rDO3m07ra8JkYayf0';

if ($count_qry == 0) {
  $str = DateThai($cur_date) . " : ไม่มีข้อมูลการมาสาย";
  $message_data = array('message' => $str); 
  $result = send_notify_message($line_api, $access_token, $message_data);
}else{
  $str.= 'รายงานครูที่มาสายประจำวันที่ ' . DateThai($cur_date) . "\n";
  while ($rpt = mysqli_fetch_array($qry)){
  $str.= $rpt['t_name'] . ' ' . $rpt['t_surname'] . ' ปกติเข้างานเวลา ' . txttime($rpt['time_start1']) . '(ลงเวลา : ' . txttime($rpt['time_start']) . ')' . "\n";
  }
  $message_data = array('message' => $str); 
  $result = send_notify_message($line_api, $access_token, $message_data);
}

mysqli_close($con);


//print_r($result);

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





?>
