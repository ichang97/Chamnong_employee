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

    $search = $_POST['txt_date'];


    $sql = "SELECT * FROM qry_timesheet WHERE stamp_date = '$search' ORDER BY t_name ASC"; 
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
<div class="container table-responsive">
<table class="table table-hover" id="timesheet">
<tr>
    <th class="text-center">ID</th>
    <th>ชื่อ-สกุล</th>
    <th class="text-center">เวลาเข้า - ออก</th>
    <th class="text-center">วันที่</th>
    <th class="text-center">แก้ไข</th>
  <th class="text-center">ยกเลิก</th>
</tr>
<?
while ($result = mysqli_fetch_array($qry))
{
?>
<tr>
    <td class="text-center"><? echo $result["id"] ?></td>
    <td><? echo $result["t_name"] ?> <? echo $result["t_surname"] ?></td>
    <td class="text-center"><? echo $result["time_start"] ?> - <? echo $result["time_end"] ?></td>
    <td class="text-center"><? echo datethai($result["stamp_date"]) ?></td>
    <td class="text-center"><a href="edit_stamp?id=<? echo $result["id"]?>&stamp_date=<? echo $result["stamp_date"] ?>" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a></td>
  <td class="text-center"><a class="btn btn-danger" href="JavaScript:if(confirm('คุณต้องการลบหรือไม่ ?') == true){window.location='cmd/delete_onestamp.php?id=<?php echo $result["id"]; ?>&stamp_date=<? echo $result["stamp_date"] ?>';}"><i class="fas fa-trash-alt"></i></a></td>
</tr>
<?
}
mysqli_close($con);
?>
</table>
</div>
<? endif ?>

<br>
