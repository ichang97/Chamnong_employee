<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

header("Content-type:text/html; charset=UTF-8");                
header("Cache-Control: no-store, no-cache, must-revalidate");               
header("Cache-Control: post-check=0, pre-check=0", false); 
// Include the main TCPDF library (search for installation path).
require_once('asset/pdf/tcpdf.php');
include("asset/pdf/class/class_curl.php");
include("connect.php");
 
// การตั้งค่าข้อความ ที่เกี่ยวข้องให้ดูในไฟล์ 
// tcpdf / config /  tcpdf_config.php 
 
// เริ่มสร้างไฟล์ pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// กำหนดรายละเอียดของไฟล์ pdf
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('โรงเรียนจำนงค์วิทยา');
$pdf->SetTitle('พิมพ์ใบลา');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// ำหนดฟอนท์ของ monospaced  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
 
// กำหนดขอบเขตความห่างจากขอบ  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
 
// กำหนดแบ่่งหน้าอัตโนมัติ
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
 
// กำหนดสัดส่วนของรูปภาพ  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
 
// อนุญาตให้สามารถกำหนดรุปแบบ ฟอนท์ย่อยเพิมเติมในหน้าใช้งานได้
$pdf->setFontSubsetting(true);
 
// กำหนด ฟอนท์
$pdf->SetFont('thsarabun', '', 16, '', true);
 
// เพิ่มหน้า 
$pdf->AddPage();

$pdf->Image('logo.jpg', 90, 5, 13,20, '','','',true,300,'C');
 
function DateThai($strDate)
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

$printid = $_REQUEST['printid'];
$sql_show = "SELECT * FROM qry_leavedoc WHERE docid = '$printid'";
$result_show = mysqli_query($con,$sql_show) or die(mysqli_error());
$row_show = mysqli_fetch_array($result_show);

//หาจำนวนวันที่หยุด

$end_datediff = date('Y-m-d', strtotime($row_show["end_date"]. ' + 1 days'));
$sql_datediff = "SELECT DATEDIFF('$end_datediff',start_date) as date_diff FROM qry_leavedoc WHERE docid = '$printid'";
$result_diff = mysqli_query($con,$sql_datediff);
$show_diff = mysqli_fetch_array($result_diff);

if ($row_show['s_time_range'] == 2 && $row_show['e_time_range']==2 && $row_show['start_date']==$row_show['end_date'])
{
  $range_diff = $show_diff['date_diff'] * 0;
}
elseif ($row_show['s_time_range'] == 3 && $row_show['e_time_range']==3 && $row_show['start_date']==$row_show['end_date'])
{
  $range_diff = $show_diff['date_diff'] * 0;
}
elseif ($row_show['s_time_range'] == 1 && $row_show['e_time_range'] == 2 && $row_show['end_date']>$row_show['start_date']) 
{
 $range_diff = --$show_diff['date_diff'] + 0.5;
}
else
{
  $range_diff = $show_diff['date_diff'] + 0;
}
$sum_diff = $range_diff;

//หาการลาครั้งล่าสุด
$sql_latest = "SELECT * FROM qry_leavedoc WHERE userid = '".$_SESSION['userid']."' ORDER BY docid DESC LIMIT 1,1";
$result_latest = mysqli_query($con,$sql_latest);
$show_latest = mysqli_fetch_array($result_latest);


ob_start();
?>

<br>
<font style="font-size:20px; text-align:center"><b>ใบลาป่วย ลาคลอดบุตร ลากิจส่วนตัว</b></font>

<p style="font-size:18px;text-align: right">โรงเรียนจำนงค์วิทยา</p><br>
<p style="font-size:18px;text-align: center">วันที่ <? echo DateThai(date("Y-m-d")); ?></p><br>

<font style="font-size:18px">เรื่อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $row_show['doc_title']; ?></font><br>
<font style="font-size:18px">เรียน&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ท่านผู้อำนวยการ</font>

<p style="font-size:18px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้าพเจ้า <?echo $row_show['t_salutation']; ?><?echo $row_show['t_name']; ?> <?echo $row_show['t_surname']; ?><?php if ($row_show["t_class"] != ""): ?>  ครูประจำชั้น <?echo $row_show['t_class']; ?><?php endif ?>
<?php if ($row_show["t_subject"] != ""): ?> ครูพิเศษสอนวิชา <?echo $row_show['t_subject']; ?> ชั้น <?echo $row_show['t_sclass']; ?><?php endif ?> ขอ<?php if ($row_show["category"] == 1): ?>ลากิจ<?php elseif ($row_show["category"] == 2): ?>ลาป่วย<?php elseif ($row_show["category"] == 3): ?>ลาคลอด<?php else: ?>สาย<?php endif ?> เนื่องจาก <?echo $row_show['reason']; ?>
 จึงขออนุญาตลาหยุด มีกำหนด <? echo $range_diff ?> วัน ตั้งแต่วันที่ <? echo DateThai($row_show["start_date"]) ?> (<? if($row_show["s_time_range"] == 1):?>เต็มวัน<? elseif($row_show["s_time_range"] == 2):?>ครึ่งวันเช้า<?php else: ?>ครึ่งวันบ่าย<? endif ?>) ถึงวันที่ <? echo DateThai($row_show["end_date"]) ?> (<? if($row_show["e_time_range"] == 1):?>เต็มวัน<? elseif($row_show["e_time_range"] == 2):?>ครึ่งวันเช้า<?php else: ?>ครึ่งวันบ่าย<? endif ?>) 
 ครั้งสุดท้ายข้าพเจ้าได้<?php if ($show_latest["category"] == 1): ?>ลากิจ<?php elseif ($show_latest["category"] == 2): ?>ลาป่วย<?php elseif ($show_latest["category"] == 3): ?>ลาคลอด<?php else: ?>มาสาย<?php endif ?> 
 ตั้งแต่วันที่ <? echo DateThai($show_latest["start_date"]); ?> (<? if($show_latest["s_time_range"] == 1):?>เต็มวัน<? elseif($show_latest["s_time_range"] == 2):?>ครึ่งวันเช้า<?php else: ?>ครึ่งวันบ่าย<? endif ?>) ถึงวันที่ <? echo DateThai($show_latest["end_date"]); ?> (<? if($show_latest["e_time_range"] == 1):?>เต็มวัน<? elseif($show_latest["e_time_range"] == 2):?>ครึ่งวันเช้า<?php else: ?>ครึ่งวันบ่าย<? endif ?>)
</p>

<p style="font-size:18px;">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในระหว่างลาหยุดครั้งนี้ ข้าพเจ้าพักอยู่บ้านเลขที่ <? echo $row_show["ad_home_no"] ?> ตรอก/ซอย<? echo $row_show["ad_alley"] ?> ถนน<? echo $row_show["ad_road"] ?> ตำบล/แขวง<? echo $row_show["ad_sub_district"] ?> อำเภอ/เขต<? echo $row_show["ad_district"] ?> จังหวัด<? echo $row_show["ad_province"] ?> รหัสไปรษณีย์ <? echo $row_show["ad_postcode"] ?> เบอร์โทรศัพท์ <? echo $row_show["tel"] ?>
</p>

<p style="font-size:18px;text-align: center">ขอแสดงความนับถือ</p><p></p>
<p style="font-size:18px;text-align: center">(<?echo $row_show['t_salutation']; ?><?echo $row_show['t_name']; ?> <?echo $row_show['t_surname']; ?>)</p><br>
<p></p><p></p><p></p>

<p style="font-size:18px;text-align: right">.................................................................. ผู้อนุมัติ<br>
(นายพัชรโรจน์  สุขสว่าง)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
ผู้อำนวยการโรงเรียนจำนงค์วิทยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
.............../.............../...............&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</p>
<?php
$html=ob_get_clean();
ob_end_clean();
// เรียกใช้งาน ฟังก์ชั่นดึงข้อมูลไฟล์มาใช้งาน
//$html = curl_get("data2.php"); // path ไฟล์ 
// ภ้าทดสอบที่เครื่องก็ใช้ http://localhost/data_html.php
 
// สร้าง pdf ด้วยคำสั่ง writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
// แสดงไฟล์ pdf
$pdf->Output('leave_doc.pdf', 'I');
?>