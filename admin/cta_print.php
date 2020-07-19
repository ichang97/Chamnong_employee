<?
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}
include '../connect_cta.php' ;

header("Content-type:text/html; charset=UTF-8");                
header("Cache-Control: no-store, no-cache, must-revalidate");               
header("Cache-Control: post-check=0, pre-check=0", false); 
// Include the main TCPDF library (search for installation path).
require_once('asset/pdf/tcpdf.php');
include("asset/pdf/class/class_curl.php");
include("connect.php");
 
// เริ่มสร้างไฟล์ pdf
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
 
// กำหนดรายละเอียดของไฟล์ pdf
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('ninenik');
$pdf->SetTitle('TCPDF table report');
$pdf->SetSubject('TCPDF ทดสอบ');
$pdf->SetKeywords('TCPDF, PDF, ทดสอบ,ninenik, guide');
 
// กำหนดข้อความส่วนแสดง header
$pdf->SetHeaderData(
    PDF_HEADER_LOGO, // โลโก้ กำหนดค่าในไฟล์  tcpdf_config.php 
    PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001',
    PDF_HEADER_STRING, // กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
    array(0,0,0),  // กำหนดสีของข้อความใน header rgb 
    array(0,0,0)   // กำหนดสีของเส้นคั่นใน header rgb 
);
 
$pdf->setFooterData(
    array(0,64,0),  // กำหนดสีของข้อความใน footer rgb 
    array(220,44,44)   // กำหนดสีของเส้นคั่นใน footer rgb 
);
 
// กำหนดฟอนท์ของ header และ footer  กำหนดเพิ่มเติมในไฟล์  tcpdf_config.php 
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
 
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
$pdf->SetFont('thsarabun', '', 14, '', true);
 
// เพิ่มหน้า 
$pdf->AddPage();
 
 
$path_info = pathinfo($_SERVER['REQUEST_URI']);
$http = ($_SERVER['REQUEST_SCHEME'])?$_SERVER['REQUEST_SCHEME']."://":"https://";
$host = $_SERVER['SERVER_NAME'];
$pathDir = $path_info['dirname']."/";
$url = $http.$host.$pathDir;
 
 
// เรียกใช้งาน ฟังก์ชั่นดึงข้อมูลไฟล์มาใช้งาน
$html = curl_get($url."summary/search_cta.php"); // path ไฟล์ 
// ถ้าทดสอบบน server ใช้เป็น http://www.example.com/data_html.php
// ภ้าทดสอบที่เครื่องก็ใช้ http://localhost/data_html.php
 
 
// สร้าง pdf ด้วยคำสั่ง writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
 
// แสดงไฟล์ pdf
$pdf->Output('timetable_report.pdf', 'I');
?>

?>

