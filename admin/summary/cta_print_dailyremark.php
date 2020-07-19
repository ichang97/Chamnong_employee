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
    //REF ID
    // 999 : หมายเหตุการลงเวลาแทนทั้งรร.
    // [รหัส id] : หมายเหตุการลงเวลาแทนเฉพาะ id นั้น
    // 11 : หมายเหตุประจำวัน

    $sql = "SELECT * FROM allstamp_log WHERE remark_date = '$search' AND ref_id = '11' ORDER BY id ASC"; 
    $qry = mysqli_query($con,$sql);
  
    $count = mysqli_num_rows($qry);
?>
<? if ($count == 0): ?>
<div class="container">
  <div class="alert alert-danger text-center" role="alert">
   ไม่พบข้อมูล
</div>
  <br>
  <h5 class="text-center">กรุณาระบุหมายเหตุ</h5>
  <form name="add_remark" id="add_remark">
    <div class="form-group">
      <textarea class="form-control" placeholder="กรุณาระบุหมายเหตุประจำวัน" name="txt_remark" id="txt_remark" required></textarea>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" value="<?php echo $search; ?>" hidden name="remark_date" id="remark_date">
    </div>
    <div class="form-group">
      <button class="btn btn-success" type="button" id="btnSave"><i class="fas fa-save"></i> บันทึกหมายเหตุ</button>
    </div>
  </form>
  <br>
  <div class="container" id="result">
</div>
</div>
<? else : ?>
<div class="container">
<h4 class="text-center">หมายเหตุประจำวันที่ <? echo datethailong($search) ?></h4>
</div>
<div class="container table-responsive">
รายงานประจำวัน : <br>
<?
while ($result = mysqli_fetch_array($qry))
{
?>
  <p>      <? echo $result["remark"]; ?></p>
    
<?
}
mysqli_close($con);
?>
</div>
<? endif ?>
<script>
  $(function () {
 $("#btnSave").click(function () {
 $.ajax({
 url: "summary/save_dailyremark.php",
 type: "post",
 data: {txt_remark: $("#txt_remark").val(),remark_date: $("#remark_date").val()},
 success: function (data) {
 $("#result").html(data);
   
 window.setTimeout(function(){
window.location.href = "https://employee.dekcom-chamnong.com/admin/cta_print_dailyremark";
}, 1500);
   
 }
 });
 });
});
  
</script>

<br>
