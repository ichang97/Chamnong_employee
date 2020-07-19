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

$title = "สรุปข้อมูลการลงเวลา";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect_cta.php' ; ?>

<script type="text/javascript">
 $(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "summary/cta_summary.php",
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

/*function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}*/

 </script>
 
<style>
.jumbotron{
  background-color: #FF5733;
  color: #ffffff;
}
</style>
<div class="jumbotron text-center">
  <h1><i class="fas fa-chart-bar"></i> สรุปข้อมูลการลงเวลา</h1><br>
<a href="cta" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container text-center">
  <a href="cta_summary_year" class="btn btn-success btn-lg"><i class="fas fa-chart-bar"></i> รายปี</a> <a href="cta_summary_semester" class="btn btn-success btn-lg"><i class="fas fa-chart-bar"></i> รายภาคเรียน</a> <a href="cta_summary_bydate" class="btn btn-success btn-lg"><i class="fas fa-chart-bar"></i> ตามช่วงเวลา</a>
</div>


</div>


<?php include 'footer.php' ; ?>