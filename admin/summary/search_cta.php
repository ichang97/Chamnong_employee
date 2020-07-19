<?
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}


header("Content-type:text/html; charset=UTF-8");                
include '../connect.php' ;
?>

<?php
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

$txt_start = $_POST['txt_start'];


// search timetable
//$sql_timetable = "SELECT * FROM qry_timesheet WHERE stamp_date = '$txt_start' ORDER BY t_name ASC";
//$qry_timetable = mysqli_query($con,$sql_timetable);

//$num_row = mysqli_num_rows($qry_timetable);

$sql_timetable = "SELECT * FROM qry_stampChk WHERE stamp_date = '$txt_start' ORDER BY t_name ASC";
$qry_timetable = mysqli_query($con,$sql_timetable);

$num_row = mysqli_num_rows($qry_timetable);



// แสดงครูที่ไม่ได้ลงเวลาทำงาน
//$sql_notstamp = "SELECT t_name,t_surname FROM users WHERE id NOT IN (SELECT id FROM qry_timesheet WHERE stamp_date = '$txt_start') ORDER BY t_name ASC";
$sql_notstamp = "SELECT u.t_name as t_name,u.t_surname as t_surname,
if(u.id IN (select l.userid from leave_log l where l.userid = u.id and start_date = '$txt_start'),'1','0') as leave_chk,
if(u.id IN (select l.userid from leave_log l where l.userid = u.id and start_date = '$txt_start' and s_time_range = '1'),'1',
  if(u.id IN (select l.userid from leave_log l where l.userid = u.id and start_date = '$txt_start' and s_time_range = '2'),'2',
  if(u.id IN (select l.userid from leave_log l where l.userid = u.id and start_date = '$txt_start' and s_time_range = '3'),'3','0'))) 
   as leave_type  
FROM users u

WHERE u.id NOT IN (SELECT id FROM qry_timesheet WHERE stamp_date = '$txt_start') AND u.status = 1 ORDER BY t_name ASC";
$qry_notstamp = mysqli_query($con,$sql_notstamp);

$count_notstamp = mysqli_num_rows($qry_notstamp);

?>

<? if ($num_row == 0) : ?>
<div class="container">
  <div class="alert alert-danger text-center" role="alert">
   ไม่พบข้อมูล
</div>
</div>
<? else : ?>
<div class="container text-center">
    <h2>รายงานการลงเวลาทำงานในวันที่ <? echo datethailong($txt_start) ?></h2>
</div>
<br>
<div class="table-responsive">
<table class="table table-hover">
<tr>
    <th class="text-center">ชื่อ-สกุล</th>
    <th class="table-success text-center">เวลาเข้า</th>
    <th class="table-danger text-center">เวลาออก</th>
    <th class="text-center">ลงเวลาเมื่อ</th>
    <th class="text-center">ตรวจสอบเวลาเข้างาน</th>
</tr>
<? while ($show_timetable = mysqli_fetch_array($qry_timetable)) { ?>
<tr>
    <td><? echo $show_timetable['t_name'] ?> <? echo $show_timetable['t_surname'] ?></td>
    <td class="table-success text-center"><? echo $show_timetable['time_in'] ?></td>
    <td class="table-danger text-center"><? echo $show_timetable['time_out'] ?></td>
    <td class="text-center"><? echo datethai($show_timetable['stamp_date']) ?></td>
    <td class="text-center">
    <? if ($show_timetable['time_in'] > $show_timetable['time_start']) : ?>
      <? if ($show_timetable['time_in'] > "10:00:00") : ?>
       <i class="fas fa-check" style="color: yellow"></i> ลาครึ่งวัน
      <? else : ?>
     <i class="fas fa-times" style="color: red"></i> สาย
      <? endif ?>
    <? else : ?>
    <i class="fas fa-check" style="color: green"></i> ปกติ
    <? endif ?>
    </td>
</tr>
<? 
}
?>
</table>
<strong>รวมครูที่ลงเวลาทำงานทั้งสิ้น <? echo $num_row ?> คน</strong>
</div>
<br>

<? if ($count_notstamp == 0) : ?>

<? else : ?>
<h5>รายชื่อครูที่ไม่ได้ลงเวลาทำงาน</h5>
<? $i = 1; ?>
<? while ($show_notstamp = mysqli_fetch_array($qry_notstamp)) {
    $leave_chk = $show_notstamp['leave_chk'];
    $leave_type = $show_notstamp['leave_type'];
  
    if($leave_chk == 1){$output = "ลา";}else{$output = "";}
  
    if($leave_type == 1){$l_type = "เต็มวัน";}elseif($leave_type == 2){$l_type = "ครึ่งวันเช้า";}
    elseif($leave_type == 3){$l_type = "ครึ่งวันบ่าย";}else{$l_type = "";}
  
    if($leave_chk == 0 && $leave_type == 0){$l_msg = "";}else{$l_msg = "(" . $output . $l_type . ")";}
  
    echo $i . ". " . $show_notstamp['t_name'] . " " . $show_notstamp['t_surname'] . " " . $l_msg ."<br>"; 
    $i++;
}
?>
<? endif ?>
<?php
$sql_dailyremark = "SELECT remark FROM allstamp_log WHERE remark_date = '$txt_start' AND ref_id = '11' ORDER BY id ASC";
$qry_dailyremark = mysqli_query($con,$sql_dailyremark);
$show_dailyremark = mysqli_fetch_array($qry_dailyremark);

$num_dailyremark = mysqli_num_rows($qry_dailyremark);
  
?>
<h5><u>บันทึก</u></h5>
<?php
if($num_dailyremark == 0):
?>
<p>
          -
</p>
<?php else: ?>
<p>
          <?php echo $show_dailyremark['remark']; ?>
</p>
<?php endif?>

<? endif ?>

<br>
