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

$startDate = $_POST['startDate']; $endDate = $_POST['endDate'];

//หาจำนวนสาย - กราฟ
$sql = "SELECT id,year,part,concat(t_name,' ',t_surname) as fullname, sum(late_count) as late_total FROM qry_latecount 
WHERE stamp_date BETWEEN '$startDate' AND '$endDate' GROUP BY id HAVING sum(late_count) <> 0 
ORDER BY late_total DESC,t_name LIMIT 5";
$qry = mysqli_query($con,$sql);

while ($show_latetotal = mysqli_fetch_array($qry))
{
    $fullname = $show_latetotal['fullname'];$latetotal = $show_latetotal['late_total'];
    $chart.= "['$fullname', $latetotal],";
}

//หาจำนวนสาย - ตาราง
$sql_table = "SELECT id,year,part,concat(t_name,' ',t_surname) as fullname, sum(late_count) as late_total FROM qry_latecount 
WHERE stamp_date BETWEEN '$startDate' AND '$endDate' GROUP BY id HAVING sum(late_count) <> 0 
ORDER BY late_total DESC,t_name";
$qry_table = mysqli_query($con,$sql_table);

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
    return "$strDay $strMonthThai $strYear";
}

function datethaishort($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}

//Title Message
if($startDate == $endDate){
  $msg = "ในวันที่ " . DateThai($startDate);
}else{
  $msg = "<br>ระหว่างวันที่ " . DateThai($startDate) . " ถึงวันที่ " . DateThai($endDate);
}

?>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['ครู', 'จำนวนสาย'],
          <?php echo $chart; ?>
        ]);

        var chart = new google.charts.Bar(document.getElementById('ViewChart'));

        chart.draw(data, null);
      }
    </script>
<div class="container">
  <h3 class="text-center">สรุปรายงานการลงเวลาทำงาน<?php echo $msg; ?></h3><br>
  <h5>จำนวนสายมากที่สุด 5 อันดับแรก</h5><br>
  <div class="text-center">
    <div id="ViewChart" style="width: 100%; height: 500px;"></div>
  </div>
</div>
<br>
<div class="container">
  <div class="table-responsive">
<table class="table table-hover">
<tr>
    <th class="text-center">#</th>
    <th class="text-center">ชื่อ - สกุล</th>
    <th class="text-center">จำนวนสาย (ครั้ง)</th>
    <th class="text-center">ดูประวัติ</th>
</tr>
<? $i = 1;
while ($show_table = mysqli_fetch_array($qry_table)) { ?>
<tr>
    <td class="text-center"><? echo $i?></td>
  <td class="text-center"><? echo $show_table['fullname'] ?></td>
    <td class="text-center"><? echo $show_table['late_total'] ?></td>
  <td class="text-center">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ViewLate_<?php echo $i; ?>">
  <i class="fas fa-eye"></i>
    </button>
    <div class="modal fade" id="ViewLate_<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewLabel_<?php echo $i; ?>"><? echo $show_table['fullname'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        $txt_id = $show_table['id'];

        $sql_search = "SELECT stamp_date,time_start1,time_start FROM qry_latecount WHERE id = '$txt_id' AND stamp_date BETWEEN '$startDate' AND '$endDate' AND late_count = '1' 
        ORDER BY stamp_date DESC";
        $qry_search = mysqli_query($con,$sql_search);
        ?>
        
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
    <td class="text-center"><? echo datethaishort($show_search['stamp_date']) ?></td>
    <td class="text-center"><? echo $show_search['time_start1'] ?></td>
    <td class="text-center table-danger"><? echo $show_search['time_start'] ?></td>
</tr>
<?
}
?>
</table>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
  
  </td>
</tr>
<?
$i++;
}
?>
</table>
</div>
</div>

