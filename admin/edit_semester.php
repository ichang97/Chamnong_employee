<?php
session_start();
include 'connect.php' ;

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

$title = "แก้ไขปี/ภาคเรียน";
?>

<?php include 'header.php'; ?>
<?php include 'main_menu.php'; ?>
<?php ; ?>
<br>
<script>
  $( function() {
    $( "#semester_start" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  $( function() {
    $( "#semester_end" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  </script>

<form class="container-fluid" id="add" name="add" method="post" action="cmd/add_semester.php">
  <div class="form-group row">
  <label class="col-sm-2 col-form-label">ปีการศึกษา / ภาคเรียน / ระยะเวลาของภาคเรียน</label>
  <div class="col-sm-10">
  <div class="input-group">  
  <div class="input-group-prepend">
      <input type="text" class="form-control" id="semester_year" name="semester_year" placeholder="ปีการศึกษา">
      <input type="text" class="form-control" id="semester_part" name="semester_part" placeholder="ภาคเรียน">
      <input type="text" class="form-control" id="semester_start" name="semester_start" placeholder="ตั้งแต่วันที่">
      <input type="text" class="form-control" id="semester_end" name="semester_end" placeholder="ถึงวันที่">
    </div>
    </div>
    </div>
    </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    </div>
  </div>

</form>



<?php include 'footer.php'; ?>