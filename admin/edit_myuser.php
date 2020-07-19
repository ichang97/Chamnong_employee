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

$title = "แก้ไขผู้ใช้งาน";
?>

<?php include 'header.php'; ?>
<?php include 'main_menu.php'; ?>
<?php include 'connect.php' ; ?>

<?php

if($_REQUEST['edit_id'] != "")
{
$id = $_REQUEST['edit_id'];
$sql_show = "select * from users where id = '$id'";
$result_show = mysqli_query($con,$sql_show) or die(mysqli_error());
$row_show = mysqli_fetch_array($result_show);
}

?>


<br>
<form class="container-fluid" id="edit" name="edit" method="post" action="cmd/edit_myuser.php">
<div class="form-group row">
    <label for="edit_id" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-10">
      <input name="edit_id" class="form-control" id="edit_id" type="text" placeholder="ID" value="<?php echo $row_show['id']; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน</label>
    <div class="col-sm-10">
      <input name="edit_username" class="form-control" id="edit_username" type="text" placeholder="ชื่อผู้ใช้งาน" required autofocus value="<?php echo $row_show['username']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_pass" class="col-sm-2 col-form-label">รหัสผ่านใหม่</label>
    <div class="col-sm-10">
      <div class="input-group mb-3" id="show_hide_password">
        <input name="edit_pass" type="password" class="form-control" id="edit_pass" placeholder="รหัสผ่าน" required data-toggle="edit_pass">
          <div class="input-group-append">
            <a href="" class="btn btn-primary"><i class="fa fa-eye-slash" aria-hidden="true"></i> แสดงรหัสผ่าน</a>
          </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="edit_salutation">คำนำหน้าชื่อ</label>
    <div class="col-sm-10">
      <select class="form-control" id="edit_salutation" name="edit_salutation" type="text">
      <option disabled>ระบุคำนำหน้าชื่อ</option>
      <option value="นาย" <?php if($row_show['t_salutation']=="นาย") echo 'selected' ?>>นาย</option>
      <option value="นาง" <?php if($row_show['t_salutation']=="นาง") echo 'selected' ?>>นาง</option>
      <option value="นางสาว" <?php if($row_show['t_salutation']=="นางสาว") echo 'selected' ?>>นางสาว</option>
      <option value="ว่าที่ร้อยตรี" <?php if($row_show['t_salutation']=="ว่าที่ร้อยตรี") echo 'selected' ?>>ว่าที่ร้อยตรี</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
  <label class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
  <div class="col-sm-10">
  <div class="input-group">  
  <div class="input-group-prepend">
      <input type="text" class="form-control" id="edit_firstname" name="edit_firstname" placeholder="ชื่อ" value="<?php echo $row_show['t_name']; ?>">
      <input type="text" class="form-control" id="edit_lastname" name="edit_lastname" placeholder="สกุล" value="<?php echo $row_show['t_surname']; ?>">
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
<script type="text/javascript">
	$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>


<?php include 'footer.php'; ?>