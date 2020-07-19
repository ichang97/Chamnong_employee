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

$title = "ระบบลงเวลาทำงาน";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect_cta.php' ; ?>

<script type="text/javascript">
 $(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "summary/search_cta.php",
 type: "post",
 data: {txt_start: $("#txt_start").val()},
 success: function (data) {
 $("#result").html(data);
 }
 });
 });


 $('#txt_end').keypress(function(event){
    if (event.keycode == 13 || event.which == 13){
        $("#btnSearch").click();
        return false;
    }
});

 });

 $( function() {
    $( "#txt_start" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  $( function() {
    $( "#txt_end" ).datepicker({
        dateFormat: "yy-mm-dd"
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
  background-color: #6610f2;
  color: #ffffff;
}
</style>
<div class="jumbotron text-center">
  <h1><i class="far fa-clock"></i> ระบบลงเวลาทำงานครู</h1><br>

  
  <div class="container">
    <div class="row">
    <div class="col">
      <div class="card bg-warning">
  <div class="card-body">
   
      <a class="btn btn-warning" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
     <h5><i class="fas fa-bars"></i> Menu</h5>
  </a>
    
  </div>
</div>
    </div>
  </div>
    <br>
  <div class="collapse" id="collapseExample">
  <div class="card card-body border-primary">
    <div class="row">
    <div class="col">
      <div class="card bg-success">
  <div class="card-body">
    <a href="cta_allstamp" class="btn btn-success"><i class="fas fa-plus-circle"></i> ลงเวลาแทนทุกคน</a>
  </div>
</div>
    </div>
    <div class="col">
      <div class="card bg-success">
  <div class="card-body">
    <a href="cta_onestamp" class="btn btn-success"><i class="fas fa-plus-circle"></i> ลงเวลาแทนรายบุคคล</a>
  </div>
</div>
    </div>
  </div>
    <br>
    <div class="row">
    <div class="col">
      <div class="card bg-danger">
  <div class="card-body">
    <a href="cta_cancelstamp" class="btn btn-danger"><i class="fas fa-times"></i> ยกเลิกการลงเวลา</a>
  </div>
</div>
    </div>
    <div class="col">
      <div class="card bg-info">
  <div class="card-body">
    <a href="cta_editstamp" class="btn btn-info"><i class="fas fa-pencil-alt"></i> แก้ไขการลงเวลา</a>
  </div>
</div>
    </div>
  </div>
    <br>
    <div class="row">
    <div class="col">
      <div class="card bg-primary">
  <div class="card-body">
    <a href="cta_print_allremark" class="btn btn-primary"><i class="fas fa-file-alt"></i> หมายเหตุการลงเวลาแทนทุกคน</a>
  </div>
</div>
    </div>
    <div class="col">
      <div class="card bg-primary">
  <div class="card-body">
    <a href="cta_print_oneremark" class="btn btn-primary"><i class="fas fa-file-alt"></i> หมายเหตุลงเวลาแทนรายบุคคล</a>
  </div>
</div>
    </div>
      <div class="col">
      <div class="card bg-primary">
  <div class="card-body">
    <a href="cta_print_dailyremark" class="btn btn-primary"><i class="fas fa-file-alt"></i> หมายเหตุประจำวัน</a>
  </div>
</div>
    </div>
  </div>
   <br>
    <div class="row">
    <div class="col">
      <div class="card bg-warning">
  <div class="card-body">
    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#menuReport">
  <i class="fas fa-chart-bar"></i> สรุปข้อมูลการลงเวลา
</button>
    <div class="modal fade" id="menuReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="menuReportLabel" style="color: black;">เลือกประเภทรายงาน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container text-center">
  <a href="cta_summary_year" class="btn btn-success btn-lg"><i class="fas fa-chart-bar"></i> รายปี</a> <a href="cta_summary_semester" class="btn btn-success btn-lg"><i class="fas fa-chart-bar"></i> รายภาคเรียน</a> <a href="cta_summary_bydate" class="btn btn-success btn-lg"><i class="fas fa-chart-bar"></i> ตามช่วงเวลา</a>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
  </div>
</div>
    </div>
  </div>
    
  </div>
  </div>
</div>
    
  
</div>

<div class="container">
  <div class="alert alert-primary text-center" role="alert">
  <h6><i class="fas fa-chart-bar"></i> เลือกวันที่ที่ต้องการดูรายงาน</h6>
</div>
  <br>
<form name="search" id="search">
  <div class="form-group row">
  <div class="input-group mb-3">
  <div class="input-group-append">
  <input type="text" name="txt_start" id="txt_start" class="form-control" placeholder="ตั้งแต่วันที่">
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