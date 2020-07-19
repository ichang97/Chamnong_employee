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

$title = "ตารางลางาน";

function datethailong($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthThai=$strMonthCut[$strMonth];
return "$strDay $strMonthThai $strYear";
}

function datethaishort($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute:$strSeconds น.";
	}

//ตารางลางาน
$cur_date = date("Y-m-d");
$sql_leavetable = "SELECT * FROM qry_leavedoc WHERE start_date = '$cur_date' ORDER BY docid";
$qry_leavetable = mysqli_query($con,$sql_leavetable);
$show_leavetable = mysqli_fetch_array($qry_leavetable);
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>

<br>
<div class="container">
  <button class="btn btn-info" type="button" id="btnprint" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> พิมพ์</button>
</div>

<br>
<div id="printableArea">
<div class="container">
  <h4 class="text-center">ตารางลางานประจำวันที่ <? echo datethailong($cur_date) ?></h4>
  
  <table class="table table-hover">
    <tr>
      <th scope="col">ชื่อ-สกุล</th>
      <th scope="col">ประเภท</th>
      <th scopt="col">วันที่ส่งใบลา</th>
      <th scope="col">เหตุผล</th>
    </tr>
    <tr>
      <td>
        <? echo $show_leavetable['t_salutation'] ?><? echo $show_leavetable['t_name'] ?> <? echo $show_leavetable['t_surname'] ?>
         (<? if ($show_leavetable['t_class'] == "") : ?><? echo $show_leavetable['t_subject'] ?> <? echo $show_leavetable['t_sclass'] ?><? else : ?><? echo $show_leavetable['t_class'] ?><? endif ?>)
      </td>
      <td>
      <?php if ($show_leavetable["category"] == 1): ?>
      ลากิจ
        <?php elseif ($show_leavetable["category"] == 2): ?>
        ลาป่วย
        <?php elseif ($show_leavetable["category"] == 3): ?>
        ลาคลอด
        <?php else: ?>
        สาย
        <?php endif ?>
      </td>
      <td><? echo datethaishort($show_leavetable['timestamp']) ?></td>
      <td><? echo $show_leavetable['reason'] ?></td>
    </tr>
  </table>
  
</div>
</div>

<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>





<?php include 'footer.php' ; ?>