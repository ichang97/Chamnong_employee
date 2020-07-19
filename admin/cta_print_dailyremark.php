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

$title = "หมายเหตุประจำวัน";

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
<?php include 'connect.php' ; ?>

<script>
$( function() {
    $( "#txt_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });

$(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "summary/cta_print_dailyremark.php",
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
  <h1><i class="fas fa-file-alt"></i> หมายเหตุประจำวัน</h1><br>
  <a href="cta" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container">
<form name="search" id="search">
  <div class="form-group row">
  <div class="input-group mb-3">
  <div class="input-group-append">
  <input type="text" name="txt_date" id="txt_date" class="form-control" placeholder="ระบุวันที่">
    <button class="btn btn-primary" type="button" id="btnSearch"><i class="fas fa-search"></i> ค้นหาข้อมูล</button> <button class="btn btn-info" type="button" id="btnprint" onclick="printDiv('printableArea')"><i class="fas fa-print"></i> พิมพ์รายงาน</button>
    </div>
    </div>
  </div>
</form>
<div id="printableArea">
<div class="container" id="result">
</div>
</div>

</div>



<?php include 'footer.php' ; ?>