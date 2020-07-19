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

$title = "ยกเลิกการลงเวลา - ระบบลงเวลาทำงาน";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect_cta.php' ; ?>

<script type="text/javascript">
 $( function() {
    $( "#txt_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  
 </script>
 
<style>
.jumbotron{
  background-color: #dc3545;
  color: #ffffff;
}
</style>
<div class="jumbotron text-center">
  <h1><i class="fas fa-times"></i> ยกเลิกการลงเวลา</a></h1><br>
<a href="cta" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container">
  <div class="alert alert-danger text-center" role="alert">
   <strong>การดำเนินการนี้จะไม่สามารถยกเลิกได้ในภายหลัง โปรดระมัดระวัง</strong>
</div>
</div>
<div class="container">
<form method="post" action="cmd/cta_canclestamp" id="cancel_allstamp" name="cancel_allstamp">
<div class="form-group">
    <label>วันที่ต้องการยกเลิกการลงเวลา</label>
    <input type="text" class="form-control" id="txt_date" name="txt_date" placeholder="ระบุวันที่" required>
  </div>
  <button type="submit" class="btn btn-danger btn-lg"><i class="fas fa-trash-alt"></i> ยกเลิกการลงเวลา</button>
</form>

</div>

<?php include 'footer.php' ; ?>