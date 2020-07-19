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

$title = "สถิติลางานรายปี";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>

<script type="text/javascript">
 $(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "summary/search_stat.php",
 type: "post",
 data: {txt_year: $("#txt_year").val()},
 success: function (data) {
 $("#list-data").html(data);
 }
 });
 });
 $("#search").on("keyup keypress",function(e){
 var code = e.keycode || e.which;
 if(code==13){
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

 </script>
<div class="jumbotron text-center">
  <h1 class="display-4">สรุปสถิติการลางานทั้งโรงเรียน (สรุปรายปี)</h1>
  <p class="lead">ระบุปีการศึกษา</p>
  <hr class="my-4">
  <div class="container">
<form name="search" id="search">
  <div class="form-group row">
  <div class="input-group mb-3">
  <div class="input-group-append">
  <input type="text" name="txt_year" id="txt_year" class="form-control" placeholder="ปีการศึกษา" aria-label="ปีการศึกษา" aria-describedby="basic-addon2">
    <button class="btn btn-primary" type="button" id="btnSearch"><i class="fas fa-search"></i> ค้นหาข้อมูล</button>
    </div>
    </div>
  </div>
</form>
</div>
</div>


<div class="container" id="list-data">

</div>

<?php include 'footer.php' ; ?>