<?php
session_start();
include 'connect.php' ;

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

$title = "แดชบอร์ด";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>

<br>

<?
$sql = "SELECT COUNT(id) as u_total FROM users";
$query = mysqli_query($con,$sql); 
$result = mysqli_fetch_array($query); 

$sql_name = "SELECT * FROM users WHERE id = '".$_SESSION['userid']."' ";
$qry_name = mysqli_query($con,$sql_name);
$result_name = mysqli_fetch_array($qry_name);

$sql_leavecount = "SELECT COUNT(id) as leavecount FROM leave_log WHERE userid = '".$_SESSION['userid']."' AND MONTH(start_date) = MONTH(CURDATE()) ";
$qry_leavecount = mysqli_query($con,$sql_leavecount);
$result_leavecount = mysqli_fetch_array($qry_leavecount);

//หาจำนวนวันที่ลาในแต่ละประเภทของ user ที่ค้นหา

//ลากิจ
$sql_show1 = "SELECT SUM(total_diff) as sum_diff FROM qry_sumdiff WHERE userid = '".$_SESSION['userid']."' AND category = 1 AND MONTH(start_date) = MONTH(CURDATE())";
$result_show1 = mysqli_query($con,$sql_show1) or die(mysqli_error());
$row_show1 = mysqli_fetch_array($result_show1);

//ลาป่วย
$sql_show2 = "SELECT SUM(total_diff) as sum_diff FROM qry_sumdiff WHERE userid = '".$_SESSION['userid']."' AND category = 2 AND MONTH(start_date) = MONTH(CURDATE())";
$result_show2 = mysqli_query($con,$sql_show2) or die(mysqli_error());
$row_show2 = mysqli_fetch_array($result_show2);

//ลาคลอด
$sql_show3 = "SELECT SUM(total_diff) as sum_diff FROM qry_sumdiff WHERE userid = '".$_SESSION['userid']."' AND category = 3 AND MONTH(start_date) = MONTH(CURDATE())";
$result_show3 = mysqli_query($con,$sql_show3) or die(mysqli_error());
$row_show3 = mysqli_fetch_array($result_show3);

//มาสาย
//ครั้งที่มาสาย
$sql_show5 = "SELECT COUNT(docid) as sum_late FROM qry_sumdiff WHERE userid = '".$_SESSION['userid']."' AND category = 4 AND MONTH(start_date) = MONTH(CURDATE())";
$result_show5 = mysqli_query($con,$sql_show5) or die(mysqli_error());
$row_show5 = mysqli_fetch_array($result_show5);

$late = $row_show5['sum_late'];

if ($late % 5 == 0)
{
    $show_late = $late / 5;
}
else
{
    $show_late = 0;
}


//ดูใบลาประจำวัน
$cur_date = date("Y-m-d");
$sql_leavetoday = "SELECT COUNT(id) as leave_count FROM leave_log WHERE start_date = '$cur_date' ";
$qry_leavetoday = mysqli_query($con,$sql_leavetoday);
$show_leavetoday = mysqli_fetch_array($qry_leavetoday);
?>

<div class="container">
<div class="alert alert-success text-center">
  <img src="profile/<? echo $result_name['img'] ?>" class="img-rounded" width="120"><br><br>
  <? echo $result_name['t_name'] ?> <? echo $result_name['t_surname'] ?> ได้เข้าสู่ระบบแล้ว
</div>
  <div class="row">
    <div class="col-sm">
    <div class="card bg-info text-white">
    <div class="card-body">
        <center><a href="user_list" class="text-white"><h2><i class="fas fa-users"></i> จำนวนครูทั้งหมด <? echo $result['u_total'] ?> คน</h2></a></center>
    </div>
  </div>
    </div>
    <div class="col-sm">
    <div class="card bg-info text-white">
    <div class="card-body">
    <center><h2><? if ($show_leavetoday['leave_count'] == 0) : ?><i class="fas fa-times"></i> วันนี้ไม่มีใบลา<? else : ?><a href="leave_table" class="text-white"><i class="far fa-file-alt"></i> วันนี้มีใบลา <? echo $show_leavetoday['leave_count'] ?> ใบ</a><? endif ?></h2></center>
    </div>
  </div>
 </div>
</div>
</div><br><br>

<div class="container">
  <div class="row">
    <div class="col-sm">
    <div class="card bg-primary text-white">
    <div class="card-body">
    <center><h2><i class="far fa-file-alt"></i> เดือนนี้ลาไปแล้ว <? echo $row_show1['sum_diff'] + $row_show2['sum_diff'] + $row_show3['sum_diff'] + $row_show4['sum_diff'] + $row_show5['sum_diff'] ?> วัน</h2></center>
    </div>
  </div>
</div>
</div>
<br>

<div class="row">
      <div class="col-sm">
          <div class="card bg-success text-white">
          <div class="card-body">
          <center><h4>ลากิจ <?php if ($row_show1['sum_diff'] != 0): ?><? echo $row_show1['sum_diff'] ?><?php else: ?>-<?php endif ?> วัน</h4></center>
          </div>
          </div>
      </div>
      <div class="col-sm">
          <div class="card bg-warning text-white">
          <div class="card-body">
          <center><h4>ลาป่วย <?php if ($row_show2['sum_diff'] != 0): ?><? echo $row_show2['sum_diff'] ?><?php else: ?>-<?php endif ?> วัน</h4></center>
          </div>
          </div>
      </div>
      <div class="col-sm">
          <div class="card bg-info text-white">
          <div class="card-body">
          <center><h4>ลาคลอด <?php if ($row_show3['sum_diff'] != 0): ?><? echo $row_show3['sum_diff'] ?><?php else: ?>-<?php endif ?> วัน</h4></center>
          </div>
          </div>
      </div><br>
      <div class="col-sm">
          <div class="card bg-danger text-white">
          <div class="card-body">
          <center><h4>สาย <?php if ($row_show5['sum_late'] != 0): ?><? echo $row_show5['sum_late'] ?><?php else: ?>-<?php endif ?> ครั้ง = ลา <?php if ($show_late != 0): ?><? echo $show_late ?><?php else: ?>-<?php endif ?> วัน</h4></center>
          </div>
          </div>
      </div>
    </div>
      </div>
    </div>


<?php include 'footer.php' ; ?>