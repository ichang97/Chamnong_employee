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

$title = "สรุปข้อมูลการลงเวลา - รายปี";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect_cta.php' ; ?>

<script type="text/javascript">
 $(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "summary/cta_summary_year.php",
 type: "post",
 data: {txt_year: $("#txt_year").val()},
 success: function (data) {
 $("#result").html(data);
 }
 });
 });


 $('#txt_year').keypress(function(event){
    if (event.keycode == 13 || event.which == 13){
        $("#btnSearch").click();
        return false;
    }
});

 });

 </script>
 
<style>
.jumbotron{
  background-color: #FF5733;
  color: #ffffff;
}
  
  @media print {
  body * {
    visibility: hidden;
  }
  #section-to-print, #section-to-print * {
    visibility: visible;
  }
  #section-to-print {
    position: absolute;
    left: 0;
    top: 0;
  }
}
</style>
<div class="jumbotron text-center">
  <h1><i class="fas fa-chart-bar"></i> สรุปข้อมูลการลงเวลา - รายปี</h1><br>
<a href="cta" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container">
<form name="search" id="search">
  <div class="form-group row">
  <div class="input-group mb-3">
  <div class="input-group-append">
  <input type="text" name="txt_year" id="txt_year" class="form-control" placeholder="ปีการศึกษา">
    <button class="btn btn-primary" type="button" id="btnSearch"><i class="fas fa-search"></i> ค้นหาข้อมูล</button>
    </div>
    </div>
  </div>
</form>
<div id="section-to-print"> 
<div class="container" id="result">
</div>
</div>

</div>



</div>

<?php include 'footer.php' ; ?>