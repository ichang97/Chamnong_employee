<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

$title = "แดชบอร์ด";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>
<br>

<?

$sql_name = "SELECT * FROM users WHERE id = '".$_SESSION['userid']."' ";
$qry_name = mysqli_query($con,$sql_name);
$result_name = mysqli_fetch_array($qry_name);

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

//สถานะใบประกอบวิชาชีพ
$user_id = $_SESSION['userid'];

$sql_cert = "SELECT * FROM t_cert WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 0,1";
$qry_cert = mysqli_query($con,$sql_cert);
$show_cert = mysqli_fetch_array($qry_cert);

 function DateDiff($strDate1,$strDate2)
	 {
				return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
	 }

function datedifflong($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}

  $cur_date = date("Y-m-d");
  $exp_date = $show_cert['exp_date'];
                                                      
  $diff = DateDiff($cur_date,$exp_date);

?>

<div class="container">
<div class="alert alert-success text-center">
  <img src="admin/profile/<? echo $result_name['img'] ?>" class="img-rounded" width="130"><br><br>
  <? echo $result_name['t_name'] ?> <? echo $result_name['t_surname'] ?> ได้เข้าสู่ระบบแล้ว<br><br>
  <a href="my_detail" class="btn btn-primary"><i class="fas fa-user"></i> ข้อมูลส่วนตัว</a>
</div>
  <div class="row">
    <div class="col-sm">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <center><h2><i class="far fa-file-alt"></i> เดือนนี้ลาไปแล้ว <? echo $row_show1['sum_diff'] + $row_show2['sum_diff'] + $row_show3['sum_diff'] + $row_show4['sum_diff'] + $row_show5['sum_diff'] ?> วัน</h2></center>
        </div>
      </div><br>
      
      <div class="container">
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
      
    </div><br>
  <div class="container">
<div class="row">
      <div class="col-sm">
          <? if ($diff <= 180) : ?>
          <div class="card bg-danger text-white text-center">
          <div class="card-body">
          <center>
            <h5><a href="t_cert" class="text-white"><i class="fas fa-times" style="color: white"></i> ใบประกอบวิชาชีพใกล้หมดอายุหรือหมดอายุแล้ว กรุณาต่ออายุใบประกอบวิชาชีพ<br>
            เหลืออีก <? echo datedifflong($show_cert['exp_date'],date("Y-m-d"),"%y ปี %m เดือน %d วัน") ?>
              </a></h5></center>
          </div>
          </div>
          <? else : ?>
          <div class="card bg-success text-white text-center">
          <div class="card-body">
          <center><h5><a href="t_cert" class="text-white"><i class="fas fa-check" style="color: white"></i> ใบประกอบวิชาชีพปกติ</a></h5></center>
          </div>
          </div>
          <? endif ?>
  </div>
      </div>
    </div>
      </div>
</div>
<br>
<?php include 'footer.php' ; ?>