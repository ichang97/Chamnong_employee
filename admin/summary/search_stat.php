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
    return "$strMonthThai $strYear";
}

$txt_year = $_POST['txt_year'];

$sql_leave1_month = "SELECT SUM(total_diff) as leave_total,start_date FROM qry_sumdiff WHERE s_year = '$txt_year' AND category = 1 GROUP BY MONTH(start_date)";
$query_leave1_month = mysqli_query($con,$sql_leave1_month);


while ($sum_leave1_month = mysqli_fetch_array($query_leave1_month))
{
    $labels[] = Datethai($sum_leave1_month['start_date']);
    $data[] = $sum_leave1_month['leave_total'];
}


$sql_leave2_month = "SELECT SUM(total_diff) as leave_total,start_date FROM qry_sumdiff WHERE s_year = '$txt_year' AND category = 2 GROUP BY MONTH(start_date)";
$query_leave2_month = mysqli_query($con,$sql_leave2_month);

while ($sum_leave2_month = mysqli_fetch_array($query_leave2_month))
{
    $labels2[] = Datethai($sum_leave2_month['start_date']);
    $data2[] = $sum_leave2_month['leave_total'];
}

$sql_leave3_month = "SELECT SUM(total_diff) as leave_total,start_date FROM qry_sumdiff WHERE s_year = '$txt_year' AND category = 3 GROUP BY MONTH(start_date)";
$query_leave3_month = mysqli_query($con,$sql_leave3_month);

while ($sum_leave3_month = mysqli_fetch_array($query_leave3_month))
{
    $labels3[] = Datethai($sum_leave3_month['start_date']);
    $data3[] = $sum_leave3_month['leave_total'];
}

$sql_leave5_month = "SELECT COUNT(docid) as late_total ,start_date FROM qry_sumdiff WHERE s_year = '$txt_year' AND category = 4 GROUP BY MONTH(start_date)";
$query_leave5_month = mysqli_query($con,$sql_leave5_month);

while ($sum_leave5_month = mysqli_fetch_array($query_leave5_month))
{
    $labels5[] = Datethai($sum_leave5_month['start_date']);
    $data5[] = $sum_leave5_month['late_total'];
}

//แสดงยอดรวมทั้งปีของครูแต่ละคน เรียงตามอักษรไทย
$sql_net1 = "SELECT *,SUM(total_diff) as sum_net1 FROM qry_sumcate1 WHERE s_year = '$txt_year' GROUP BY userid ORDER BY sum_net1 DESC";
$qry_net1 = mysqli_query($con,$sql_net1);

$num_net1 = mysqli_num_rows($qry_net1);

$sql_net2 = "SELECT *,SUM(total_diff) as sum_net1 FROM qry_sumcate2 WHERE s_year = '$txt_year' GROUP BY userid ORDER BY sum_net1 DESC";
$qry_net2 = mysqli_query($con,$sql_net2);

$num_net2 = mysqli_num_rows($qry_net2);

$sql_net3 = "SELECT *,SUM(total_diff) as sum_net1 FROM qry_sumcate3 WHERE s_year = '$txt_year' GROUP BY userid ORDER BY sum_net1 DESC";
$qry_net3 = mysqli_query($con,$sql_net3);

$num_net3 = mysqli_num_rows($qry_net3);

$sql_net4 = "SELECT *,COUNT(userid) as sum_net1 FROM qry_sumcate4 WHERE s_year = '$txt_year' GROUP BY userid ORDER BY sum_net1 DESC";
$qry_net4 = mysqli_query($con,$sql_net4);

$num_net4 = mysqli_num_rows($qry_net4);

$late = $row_net4['sum_net1'];

if ($late % 5 == 0)
{
    $show_late = $late / 5;
}
else
{
    $show_late = 0;
}

?><br>
<h3 class="text-center">สรุปสถิติการลางานทั้งโรงเรียนในปีการศึกษา <? echo $txt_year ?></h3>
<!--canvas id="leave_month_chart"></canvas!-->
<script>
    var ctx = document.getElementById("leave_month_chart");
    Chart.defaults.global.defaultFontFamily = 'Itim';
    var leave_month_chart = new Chart(ctx, {
        //type: 'bar',
        //type: 'line',
        type: 'bar',
        data: {
            datasets: [{
                label: "ลากิจ (วัน)",
                data: <? echo json_encode($data, JSON_NUMERIC_CHECK);?>,
                backgroundColor: 'rgba(40, 167, 69,1.0)',
            },
            {
            label: "ลาป่วย (วัน)",
            backgroundColor: 'rgba(255, 193, 7,1.0)',
            data: <? echo json_encode($data2, JSON_NUMERIC_CHECK);?>
            },
            {
            label: "ลาคลอด (วัน)",
            backgroundColor: 'rgba(23, 162, 184,1.0)',
            data: <? echo json_encode($data3, JSON_NUMERIC_CHECK);?>
            },
            {
            label: "สาย (ครั้ง)",
            backgroundColor: 'rgba(220, 53, 69,1.0)',
            data: <? echo json_encode($data5, JSON_NUMERIC_CHECK);?>
            }
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                    }
                }]
            },
             responsive: true,

        }
    });
    </script>
<br>

<? if ($num_net1 == 0) : ?>
  
<? else : ?>
<div class="container">
<h3>สรุปยอดลากิจทั้งโรงเรียน</h3>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ชื่อ-สกุล</th>
      <th scope="col">จำนวนวัน</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $i = 0;
while($row_net1 = mysqli_fetch_array($qry_net1))
{
?>
    <tr>
      <td><? echo $row_net1['t_salutation'] ?><? echo $row_net1['t_name'] ?> <? echo $row_net1['t_surname'] ?></td>
      <td><?php if ($row_net1['sum_net1'] != 0): ?><?php echo $row_net1['sum_net1'] ?><?php else: ?>-<?php endif ?></td>
    </tr>
<?
$i++;
}
?>
  </tbody>
</table>
<strong>รวมลากิจทั้งสิ้น <?php echo $i . " คน"; ?></strong>
</div>
<? endif ?>
<br>

<? if ($num_net2 == 0) : ?>
  
<? else : ?>
<div class="container">
<h3>สรุปยอดลาป่วยทั้งโรงเรียน</h3>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ชื่อ-สกุล</th>
      <th scope="col">จำนวนวัน</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $i = 0;
while($row_net2 = mysqli_fetch_array($qry_net2))
{
?>
    <tr>
      <td><? echo $row_net2['t_salutation'] ?><? echo $row_net2['t_name'] ?> <? echo $row_net2['t_surname'] ?></td>
      <td><?php if ($row_net2['sum_net1'] != 0): ?><?php echo $row_net2['sum_net1'] ?><?php else: ?>-<?php endif ?></td>
    </tr>
<?
$i++;
}
?>
  </tbody>
</table>
<strong>รวมลาป่วยทั้งสิ้น <?php echo $i . " คน"; ?></strong>
</div>
<? endif ?>
<br>

<? if ($num_net3 == 0) : ?>

<? else : ?>
<div class="container">
<h3>สรุปยอดลาคลอดทั้งโรงเรียน</h3>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ชื่อ-สกุล</th>
      <th scope="col">จำนวนวัน</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $i = 0;
while($row_net3 = mysqli_fetch_array($qry_net3))
{
?>
    <tr>
      <td><? echo $row_net3['t_salutation'] ?><? echo $row_net3['t_name'] ?> <? echo $row_net3['t_surname'] ?></td>
      <td><?php if ($row_net3['sum_net1'] != 0): ?><? echo $row_net3['sum_net1'] ?><?php else: ?>-<?php endif ?></td>
    </tr>
<?
$i++;
}
?>
  </tbody>
</table>
<strong>รวมลาคลอดทั้งสิ้น <?php echo $i . " คน"; ?></strong>
</div>
<? endif ?>
<br>

<? if ($num_net4 == 0) : ?>

<? else : ?>
<div class="container">
<h3>สรุปยอดมาสายทั้งโรงเรียน</h3>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ชื่อ-สกุล</th>
      <th scope="col">จำนวนครั้ง / คิดเป็นวันลา</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $i = 0;
while($row_net4 = mysqli_fetch_array($qry_net4))
{
?>
    <tr>
      <td><? echo $row_net4['t_salutation'] ?><? echo $row_net4['t_name'] ?> <? echo $row_net4['t_surname'] ?></td>
      <td><?php if ($row_net4['sum_net1'] != 0): ?><? echo $row_net4['sum_net1'] ?><?php else: ?>-<?php endif ?> ครั้ง = ลา <?php if ($show_late != 0): ?><? echo $show_late ?><?php else: ?>-<?php endif ?> วัน</td>
    </tr>
<?
$i++;
}
?>
  </tbody>
</table>
<strong>รวมมาสายทั้งสิ้น <?php echo $i . " คน"; ?></strong>
</div>
<? endif ?>

 <br>