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

$title = "สถิติลางานรายคน";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>

<script type="text/javascript">
 $(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "summary/search_all_employee.php",
 type: "post",
 data: {txt_userid: $("#txt_userid").val() ,txt_s_part: $("#txt_s_part").val() , txt_s_year: $("#txt_s_year").val()},
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
  <h1 class="display-4">สรุปสถิติการลางานรายคน</h1>
  <p class="lead">ระบุวันที่ที่ต้องการดูข้อมูล</p>
  <hr class="my-4">
  <div class="container">
<form name="search" id="search">
  <div class="form-group row">
  <div class="input-group mb-3">
  <div class="input-group-append">
  <select class="form-control" id="txt_userid" name="txt_userid" type="text">
      <option selected disabled>เลือกชื่อ-นามสกุลครู</option>
      <?php
			$strSQL = "SELECT * FROM users ORDER BY t_name ASC";
			$objQuery = mysqli_query($con,$strSQL);
			while($objResuut = mysqli_fetch_array($objQuery))
			{
			?>
      <option value="<?php echo $objResuut["id"];?>"><?php echo $objResuut["t_name"];?> <?php echo $objResuut["t_surname"];?></option>
      <?php
      }
      ?>
      </select>
  <input type="text" name="txt_s_year" id="txt_s_year" class="form-control" placeholder="ระบุปีการศึกษา" aria-describedby="basic-addon2">
  <select class="form-control" id="txt_s_part" name="txt_s_part" type="text">
      <option selected disabled>ระบุภาคเรียน</option>
      <?php
			$strSQL = "SELECT * FROM semester_part ORDER BY id ASC";
			$objQuery = mysqli_query($con,$strSQL);
			while($objResuut = mysqli_fetch_array($objQuery))
			{
			?>
      <option value="<?php echo $objResuut["id"];?>"><?php echo $objResuut["semester_name"];?></option>
      <?php
      }
      ?>
      </select>
    <button class="btn btn-primary" type="button" id="btnSearch"><i class="fas fa-search"></i> ค้นหาข้อมูล</button>
    </div>
    </div>
  </div>
</form>
</div>
</div>


<div class="container" id="list-data">

</div>

<?php include '../footer.php' ; ?>