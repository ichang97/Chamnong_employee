<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}
if($_SESSION['permission']!="1")
{
  echo "Access Denied !!";
  exit();
}

$title = "สรุปข้อมูลการลงเวลา - รายภาคเรียน";
?>
<?php include '../header.php' ; ?>
<?php include '../main_menu.php' ; ?>
<?php include '../connect.php' ; ?>

<style>
.jumbotron{
  background-color: #FF5733;
  color: #ffffff;
}
  
  @media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
<?
function datethai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}

$txt_year = $_REQUEST['year'];
$txt_id = $_REQUEST['id'];

$sql_name = "SELECT t_name,t_surname FROM users WHERE id = '$txt_id'";
$qry_name = mysqli_query($con,$sql_name);
$show_name = mysqli_fetch_array($qry_name);

$sql_search = "SELECT stamp_date,time_start1,time_start FROM qry_latecount WHERE id = '$txt_id' AND year='$txt_year' AND late_count = '1' 
ORDER BY stamp_date DESC";
$qry_search = mysqli_query($con,$sql_search);

?>
<div class="jumbotron text-center">
  <h1><i class="fas fa-chart-bar"></i> สรุปข้อมูลการลงเวลา - รายปี</h1><br>
</div>

<div class="container">
<div id="section-to-print"> 
  <h3><? echo $show_name['t_name'] ?> <? echo $show_name['t_surname'] ?> - ประวัติการมาสาย</h3><br>
 <div class="table-responsive">
<table class="table table-hover">
<tr>
    <th class="text-center">วันที่ลงเวลา</th>
    <th class="text-center">เวลาเข้าทำงาน</th>
    <th class="text-center table-danger">เวลาที่บันทึก</th>
</tr>
<?
while ($show_search = mysqli_fetch_array($qry_search)) { ?>
<tr>
    <td class="text-center"><? echo datethai($show_search['stamp_date']) ?></td>
    <td class="text-center"><? echo $show_search['time_start1'] ?></td>
    <td class="text-center table-danger"><? echo $show_search['time_start'] ?></td>
</tr>
<?
}
?>
</table>
</div>
</div>
</div>



<?php include 'footer.php' ; ?>