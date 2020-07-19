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

$title = "เพิ่มผู้ใช้งาน";
?>
<?php include 'header.php'; ?>
<?php include 'main_menu.php'; ?>
<script type="text/javascript">

$(document).ready(function(){
    $('#timestart').timepicker({
    timeFormat: 'HH:mm:ss',
    interval: 30,
    minTime: '00',
    maxTime: '23',
    startTime: '00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
});
$(document).ready(function(){
    $('#timeend').timepicker({
    timeFormat: 'HH:mm:ss',
    interval: 30,
    minTime: '00',
    maxTime: '23',
    startTime: '00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
});
  
 </script>

<br>
<form class="container-fluid" id="frmadduser" name="frmadduser" method="post" action="cmd/add_user.php">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน</label>
    <div class="col-sm-10">
      <input name="username" class="form-control" id="username" type="text" placeholder="ชื่อผู้ใช้งาน" required autofocus>
    </div>
  </div>
  <div class="form-group row">
    <label for="pass" class="col-sm-2 col-form-label">รหัสผ่าน</label>
    <div class="col-sm-10">
      <div class="input-group mb-3" id="show_hide_password">
        <input name="pass" type="password" class="form-control" id="pass" placeholder="รหัสผ่าน" required>
          <div class="input-group-append">
            <a href="" class="btn btn-primary"><i class="fa fa-eye-slash" aria-hidden="true"></i> แสดงรหัสผ่าน</a>
          </div>
      </div>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="salutation">คำนำหน้าชื่อ</label>
    <div class="col-sm-10">
      <select class="form-control" id="salutation" name="salutation" type="text">
      <option selected disabled>ระบุคำนำหน้าชื่อ</option>
      <option>นาย</option>
      <option>นาง</option>
      <option>นางสาว</option>
      <option>ว่าที่ร้อยตรี</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
  <label class="col-sm-2 col-form-label">ชื่อ-สกุล</label>
  <div class="col-sm-10">
  <div class="input-group">  
  <div class="input-group-prepend">
      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ">
      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="สกุล">
    </div>
    </div>
    </div>
    </div>
    <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">RFID</label>
    <div class="col-sm-10">
      <input name="rfid" class="form-control" id="rfid" type="text" required autofocus>
    </div>
  </div>
    <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">เวลาเข้างาน</label>
    <div class="col-sm-10">
      <input name="timestart" class="form-control" id="timestart" type="text" required autofocus>
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">เวลาออกงาน</label>
    <div class="col-sm-10">
      <input name="timeend" class="form-control" id="timeend" type="text" required autofocus>
    </div>
  </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="permission">สิทธิ์การใช้งาน</label>
    <div class="col-sm-10">
      <select class="form-control" id="permission" name="permission" type="text">
      <option selected disabled>เลือกสิทธิ์การใช้งาน</option>
      <option value="1">ผู้ดูแลระบบ</option>
      <option value="2">ผู้ใช้งาน</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success">เพิ่มผู้ใช้งาน</button>
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