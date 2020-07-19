<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

$title = "ประวัติการลางาน";
?>

<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>
<?php
date_default_timezone_set('Asia/Bangkok');

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute น.";
  }
  
  function DateThainottime($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
	}
?>
<br>


<?php
$sql = "SELECT * FROM leave_log WHERE userid = '".$_SESSION['userid']."'  ORDER BY id ASC ";
$query = mysqli_query($con,$sql);

$count_row = mysqli_num_rows($query);
?>

<? if ($count_row == 0) : ?>
<div class="container">
  <div class="alert alert-danger text-center" role="alert">
    ไม่พบข้อมูลการลางาน
</div>
</div>
<? else : ?>
<div class="container">
<h3>ประวัติการลางาน</h3>
<table class="container-fluid table table-hover">

  <thead>
    <tr>
      <th scope="col">ประเภทการลา</th>
      <th scope="col">วันที่ลา</th>
      <th scope="col">สาเหตุ</th>
      <th scope="col">วันที่ส่งใบลา</th>
      <th scope="col">พิมพ์ใบลา</th>
    </tr>
  </thead>
  <tbody>
<?php
while($result = mysqli_fetch_array($query))
{
?>
    <tr>
      <td>
      <?php if ($result["category"] == 1): ?>
      ลากิจ
        <?php elseif ($result["category"] == 2): ?>
        ลาป่วย
        <?php elseif ($result["category"] == 3): ?>
        ลาคลอด
        <?php else: ?>
        สาย
        <?php endif ?>
      </td>
      <td>
      <? $str_s_date = $result["start_date"];
      echo DateThainottime($str_s_date);
      ?> (<? if ($result["s_time_range"]==1) echo เต็มวัน ;elseif ($result["s_time_range"]==2) echo ครึ่งวันเช้า ;else echo ครึ่งวันบ่าย?>) 
      - 
      <? $str_e_date = $result["end_date"];
      echo DateThainottime($str_e_date);
      ?> (<? if ($result["e_time_range"]==1) echo เต็มวัน ;elseif ($result["e_time_range"]==2) echo ครึ่งวันเช้า ;else echo ครึ่งวันบ่าย?>) 
      </td>
      <td><?php echo $result["reason"]; ?></td>
      <td>
      <?php 
       $str_timestamp = $result["timestamp"];
      echo DateThai($str_timestamp);
      ?>
      </td>
      <td>
      <a class="btn btn-success" target="blank" href="print_leave?printid=<? echo $result['id']; ?>"><i class="fas fa-print"></i> พิมพ์ใบลา</a>
      </td>
    </tr>
<?php
        }
        ?>
  </tbody>
</table>
</div>
<? endif ?>

<?php mysqli_close($con); ?>


<?php include 'footer.php'; ?>