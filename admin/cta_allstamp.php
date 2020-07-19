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

$title = "ลงเวลาแทนทุกคน - ระบบลงเวลาทำงาน";
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
  background-color: #28a745;
  color: #ffffff;
}
</style>
<div class="jumbotron text-center">
  <h1><i class="fas fa-plus-circle"></i> ลงเวลาแทนทุกคน</a></h1><br>
<a href="cta" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container">

<form method="post" action="cmd/cta_allstamp" id="add_allstamp" name="add_allstamp">
<div class="form-group">
    <label>วันที่ต้องการลงเวลา</label>
    <input type="text" class="form-control" id="txt_date" name="txt_date" placeholder="ระบุวันที่" required>
  </div>
  <div class="form-group">
    <label>สาเหตุการลงเวลาแทน</label>
    <textarea type="text" class="form-control" id="txt_remark" name="txt_remark" required></textarea>
  </div>
<button type="submit" class="btn btn-success btn-lg"><i class="fas fa-plus-circle"></i> กดปุ่มเพื่อประมวลผล</button>
</form>

</div>

<?php include 'footer.php' ; ?>