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

$title = "เปลี่ยนรหัสผ่าน";

$user_id = $_REQUEST['id'];

?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>
<br>
<div class="container">
  <form method="post" action="cmd/change_pass">
    <div class="form-group row">
    <div class="col-sm-10">
      <input name="user_id" class="form-control" id="user_id" type="hidden" value="<? echo $user_id ?>">
    </div>
  </div>
    <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">รหัสผ่านเดิม</label>
    <div class="col-sm-10">
      <input name="current_pass" class="form-control" id="current_pass" type="password" required autofocus>
    </div>
  </div>
    <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">รหัสผ่านใหม่</label>
    <div class="col-sm-10">
      <input name="new_pass" class="form-control" id="new_pass" type="password" required autofocus>
    </div>
  </div>
    <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">ยืนยันรหัสผ่านใหม่</label>
    <div class="col-sm-10">
      <input name="auth_new_pass" class="form-control" id="auth_new_pass" type="password" required autofocus>
    </div>
  </div>
   <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    </div>
  </div>
  </form>
</div>