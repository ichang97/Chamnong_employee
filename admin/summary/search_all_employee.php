<?
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}
include '../connect.php'
?>

<?php

$txt_userid = $_POST['txt_userid'];
$txt_s_part = $_POST['txt_s_part'];
$txt_s_year = $_POST['txt_s_year'];


//หาจำนวนวันที่ลาในแต่ละประเภทของ user ที่ค้นหา

//ลากิจ
$sql_show1 = "SELECT SUM(total_diff) as sum_diff FROM qry_sumdiff WHERE s_year = '$txt_s_year' AND s_part = '$txt_s_part' AND userid = '$txt_userid' AND category = 1";
$result_show1 = mysqli_query($con,$sql_show1) or die(mysqli_error());
$row_show1 = mysqli_fetch_array($result_show1);

//ลาป่วย
$sql_show2 = "SELECT SUM(total_diff) as sum_diff FROM qry_sumdiff WHERE s_year = '$txt_s_year' AND s_part = '$txt_s_part' AND userid = '$txt_userid' AND category = 2";
$result_show2 = mysqli_query($con,$sql_show2) or die(mysqli_error());
$row_show2 = mysqli_fetch_array($result_show2);

//ลาคลอด
$sql_show3 = "SELECT SUM(total_diff) as sum_diff FROM qry_sumdiff WHERE s_year = '$txt_s_year' AND s_part = '$txt_s_part' AND userid = '$txt_userid' AND category = 3";
$result_show3 = mysqli_query($con,$sql_show3) or die(mysqli_error());
$row_show3 = mysqli_fetch_array($result_show3);


//มาสาย
//ครั้งที่มาสาย
$sql_show5 = "SELECT COUNT(docid) as sum_late FROM qry_sumdiff WHERE s_year = '$txt_s_year' AND s_part = '$txt_s_part' AND userid = '$txt_userid' AND category = 4";
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
?>
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
      </div>
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
    </div><br>

</div>
