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


    $search = $_POST['txt_date'];


    $sql = "SELECT * FROM allstamp_log WHERE remark_date = '$search' AND ref_id = '999' ORDER BY id ASC"; 
    $qry = mysqli_query($con,$sql);
  
    $count = mysqli_num_rows($qry);
?>
<? if ($count == 0): ?>
<div class="container">
  <div class="alert alert-danger text-center" role="alert">
   ไม่พบข้อมูล
</div>
</div>
<? else : ?>
<div class="container">
<h4 class="text-center">หมายเหตุการลงเวลาประจำวันที่ <? echo datethailong($search) ?></h4>
</div>
<div class="container table-responsive">
สาเหตุการลงเวลาแทน : <br>
<?
while ($result = mysqli_fetch_array($qry))
{
?>
  <p>      <? echo $result["remark"] ?></p>
    
<?
}
mysqli_close($con);
?>
</div>
<? endif ?>

<br>
