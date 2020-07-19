<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

header('Content-Type: application/json');            
include '../connect.php' ;

function datethai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}

function datethailong($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}

$txt_year = $_POST['txt_year'];

//หาจำนวนสาย
$sql = "SELECT concat(t_name,' ',t_surname) as fullname, sum(late_count) as late_total FROM qry_latecount WHERE year = '$txt_year' GROUP BY id 
ORDER BY late_total DESC LIMIT 5";
$qry = mysqli_query($con,$sql);

$show_latetotal = mysqli_fetch_array($qry);

//loop through the returned data
$data = array();
foreach ($show_latetotal as $row) {
  $data[] = $row;
}

//free memory associated with result
$result->close();

//close connection
$mysqli->close();

//now print the data
print json_encode($data);
?>