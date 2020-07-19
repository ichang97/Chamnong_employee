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

$title = "แก้ไขการลงเวลา - ระบบลงเวลาทำงาน";

function datethai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}

?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>

<script>
$(document).ready(function(){
    $('#txt_start').timepicker({
    timeFormat: 'HH:mm:ss',
    interval: 30,
    minTime: '00',
    maxTime: '23',
    startTime: '00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
});
$(document).ready(function(){
    $('#txt_end').timepicker({
    timeFormat: 'HH:mm:ss',
    interval: 30,
    minTime: '00',
    maxTime: '23',
    startTime: '00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
});

 </script>

<style>
.jumbotron{
  background-color: #FFAA00;
}
</style>
<?
  $stamp_date = $_REQUEST['stamp_date'];
  $id = $_REQUEST['id'];

  $sql_data = "SELECT t_name,t_surname,time_start,time_end,id,stamp_date FROM qry_timesheet WHERE stamp_date = '$stamp_date' AND id = '$id'";
  $qry_data = mysqli_query($con,$sql_data);
  $show_data = mysqli_fetch_array($qry_data);

?>
<div class="jumbotron text-center">
  <h1><i class="fas fa-pencil-alt"></i> แก้ไขการลงเวลา วันที่ <? echo datethai($show_data["stamp_date"]) ?></h1><br>
   <h2><? echo $show_data["t_name"] ?>  <? echo $show_data["t_surname"] ?></h2>
  </div>

<div class="container">
<form name="edit" id="edit" method="post" action="cmd/edit_stamp">
<div class="form-group">
    <label>เวลาเข้า</label>
    <input type="text" class="form-control" id="txt_start" name="txt_start" value="<? echo $show_data["time_start"] ?>">
  </div>
  <div class="form-group">
    <label>เวลาออก</label>
    <input type="text" class="form-control" id="txt_end" name="txt_end" value="<? echo $show_data["time_end"] ?>">
  </div>
  <input type="hidden" class="form-control" id="txt_id" name="txt_id" value="<? echo $show_data["id"] ?>">
  <input type="hidden" class="form-control" id="txt_stampdate" name="txt_stampdate" value="<? echo $show_data["stamp_date"] ?>">
<button type="submit" class="btn btn-success"><i class="fas fa-save"></i> แก้ไขข้อมูล</button>
</form>
</div>

<?php include 'footer.php' ; ?>