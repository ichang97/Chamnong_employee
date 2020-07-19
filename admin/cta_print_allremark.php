<?php
session_start();
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

$title = "หมายเหตุการลงเวลาแทนทุกคน - ระบบลงเวลาทำงาน";

function datethai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect_cta.php' ; ?>

<script>
$( function() {
    $( "#txt_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });

$(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "summary/cta_print_allremark.php",
 type: "post",
 data: {txt_date: $("#txt_date").val()},
 success: function (data) {
 $("#result").html(data);
 }
 });
 });
});
  
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
  
 </script>

<style>
.jumbotron{
  background-color: #007bff;
  color: #ffffff;
}
</style>

<div class="jumbotron text-center">
  <h1><i class="fas fa-file-alt"></i> หมายเหตุการลงเวลาแทนทุกคน</h1><br>
  <a href="cta" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container">
<form name="search" id="search">
<div class="form-group">
    <label>ระบุวันที่</label>
    <input type="text" class="form-control" id="txt_date" name="txt_date" placeholder="ระบุวันที่">
  </div>
<button type="button" class="btn btn-success" id="btnSearch"><i class="fas fa-search"></i> ค้นหา</button> <button class="btn btn-info" type="button" id="btnprint" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> พิมพ์รายงาน</button>
</form>
</div>

<div id="printableArea">
<div class="container" id="result">
</div>
</div>



<?php include 'footer.php' ; ?>