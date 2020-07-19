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

$title = "เพิ่มใบประกอบวิชาชีพ";

$user_id = $_REQUEST['id'];

?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<br>
<script>
  $( function() {
    $( "#valid_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  $( function() {
    $( "#exp_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  </script>

<div class="container">
  <form method="post" action="cmd/add_t-cert">
    <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="edit_salutation">ประเภทใบประกอบวิชาชีพ</label>
    <div class="col-sm-10">
      <select class="form-control" id="t_cert_cate" name="t_cert_cate" type="text">
      <option selected disabled>ระบุประเภทประกอบวิชาชีพ</option>
      <?php
			$strSQL = "SELECT * FROM t_cert_cate ORDER BY id ASC";
			$objQuery = mysqli_query($con,$strSQL);
			while($objResuut = mysqli_fetch_array($objQuery))
			{
			?>
      <option value="<?php echo $objResuut["id"];?>"><?php echo $objResuut["cate_name"];?></option>
      <?php
      }
      ?>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">เลขที่ใบอนุญาต</label>
    <div class="col-sm-10">
      <input name="cert_id" class="form-control" id="cert_id" type="text" required autofocus>
    </div>
  </div>
    <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">วันที่ออกให้</label>
    <div class="col-sm-10">
      <input name="valid_date" class="form-control" id="valid_date" type="text" required>
    </div>
  </div>
    <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">วันที่หมดอายุ</label>
    <div class="col-sm-10">
      <input name="exp_date" class="form-control" id="exp_date" type="text" required>
    </div>
  </div>
    <input name="user_id" class="form-control" id="user_id" type="hidden" value="<? echo $user_id ?>">
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    </div>
  </div>

</form>
</div>






<?php include 'footer.php' ; ?>