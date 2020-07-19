<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

$title = "สถิติลางาน";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>

<?
//show name
$sql_name = "SELECT * FROM users WHERE id = '".$_SESSION['userid']."' ";
$qry_name = mysqli_query($con,$sql_name);
$result_name = mysqli_fetch_array($qry_name);
?>

<script type="text/javascript">
 $(function () {
 $("#btnSearch").click(function () {
 $.ajax({
 url: "search_me.php",
 type: "post",
 data: {txt_year: $("#txt_year").val() , txt_part: $("#txt_part").val()},
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

 </script>
<div class="jumbotron text-center">
  <h1 class="display-4">สรุปสถิติการลางานของครู<? echo $result_name['t_name'] ?></h1>
  <p class="lead">ระบุปีการศึกษา / ภาคเรียน ที่ต้องการดูข้อมูล</p>
  <hr class="my-4">
  <div class="container">
<form name="search" id="search">
  <div class="form-group row">
  <div class="input-group mb-3">
  <div class="input-group-append">
  <input type="text" name="txt_year" id="txt_year" class="form-control" placeholder="ปีการศึกษา" aria-label="ปีการศึกษา" aria-describedby="basic-addon2">
  <select class="form-control" id="txt_part" name="txt_part" type="text">
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

<?php include 'footer.php' ; ?>