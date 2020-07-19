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

$title = "ตั้งค่าระบบ";
?>

<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>
<br>

<?
//แสดงปีการศึกษาปัจจุบัน
$sql = "SELECT * FROM semester ORDER BY id DESC LIMIT 0,1";
$query = mysqli_query($con,$sql);
$show = mysqli_fetch_array($query);

//current setting
$sql_set = "select * from settings"; $qry_set = mysqli_query($con,$sql_set);
$show_set = mysqli_fetch_array($qry_set);
?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

<div class="container">
  <div class="card text-white bg-primary mb-3">
  <div class="card-header"><h5>ภาคเรียน / ปีการศึกษาปัจจุบัน</h5></div>
  <div class="card-body text-center">
    <h5 class="card-title">ภาคเรียนที่ <? echo $show['semester_part'] ?> ปีการศึกษา <?php echo $show['semester_year'] ?></h5>
    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#semestersetting">
  ตั้งค่า
</button>
  </div>
</div>
  <br>
  <div class="card text-white bg-primary mb-3">
  <div class="card-header"><h5>เวลาเข้า-ออกงานเริ่มต้น</h5></div>
  <div class="card-body text-center">
    <h5 class="card-title"><?php echo $show_set['default_start'] . " - " . $show_set['default_end']; ?></h5>
    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#timesetting">
  ตั้งค่า
</button>
  </div>
</div>
  

<!-- Modal -->
<div class="modal fade" id="timesetting" tabindex="-1" role="dialog" aria-labelledby="timesettingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="timesettingLabel">เปลี่ยนแปลงเวลาเข้า-ออกเริ่มต้น</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="result"></div>
        <form>
          <div class="form-group">
            <label>เวลาเข้า</label>
            <input class="form-control" id="default_start" type="text" required value="<?php echo $show_set['default_start'] ?>">
          </div>
          <div class="form-group">
            <label>เวลาออก</label>
            <input class="form-control" id="default_end" type="text" required value="<?php echo $show_set['default_end'] ?>">
            <input hidden id="flag" value="1" placeholder="flag ตั้งค่าเวลาเข้าออกเริ่มต้น">
          </div>
          <div class="form-group">
            <button class="btn btn-success btn-block" id="btnSet" type="button">บันทึกการตั้งค่า</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>
  
  <div class="modal fade" id="semestersetting" tabindex="-1" role="dialog" aria-labelledby="semestersettingLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="semestersettingLabel">ภาคเรียน / ปีการศึกษาปัจจุบัน</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="container-fluid" id="add" name="add" method="post" action="cmd/add_semester.php">
        <div class="form-group">
           <input type="text" class="form-control" id="semester_year" name="semester_year" placeholder="ปีการศึกษา" required>
          </div>
          <div class="form-group">
          <input type="text" class="form-control" id="semester_part" name="semester_part" placeholder="ภาคเรียน" required>
          </div>
          <div class="form-group">
          <input type="text" class="form-control" id="semester_start" name="semester_start" placeholder="ตั้งแต่วันที่" required>
          </div>
          <div class="form-group">
          <input type="text" class="form-control" id="semester_end" name="semester_end" placeholder="ถึงวันที่" required>
          </div>
          <div class="form-group">
            
      <button type="submit" name="submit" id="submit" class="btn btn-success btn-block"><i class="fas fa-save"></i> บันทึกการตั้งค่า</button>
      </div>
    </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
      </div>
    </div>
  </div>
</div>

  <script>
  $(function () {
 $("#btnSet").click(function () {
 $.ajax({
 url: "cmd/setting.php",
 type: "post",
 data: {default_start: $("#default_start").val(),default_end: $("#default_end").val(), flag: $("#flag").val()},
 success: function (data) {
 $("#result").html(data);
   
   window.setTimeout(function(){location.reload();}, 1500);
   
 }
 });
 });


 });
    
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



</div>












<?php mysqli_close($con); ?>

<?php include 'footer.php'; ?>