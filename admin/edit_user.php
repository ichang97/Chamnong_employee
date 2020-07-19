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

$title = "แก้ไขข้อมูลส่วนตัว";
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
<script>
  $( function() {
    $( "#edit_dob" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  $( function() {
    $( "#edit_assign-date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  $( function() {
    $( "#edit_work-date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  
  $(document).ready(function() {
    $('#edit_religion').select2();
});
  
  $(document).ready(function() {
    $('#edit_nation').select2();
});
  
  $(document).ready(function() {
    $('#edit_obec-province').select2();
});
  
  $(document).ready(function() {
    $('#edit_bank-id').select2();
});
  
  
$(document).ready(function(){
    $('#edit_start-time').timepicker({
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
    $('#edit_end-time').timepicker({
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
<div class="container">
<form class="container-fluid" id="edit" name="edit" method="post" action="cmd/edit_user.php" enctype="multipart/form-data">
<div class="form-group row">
    <div class="col-sm-10">
      <input name="edit_id" class="form-control" id="edit_id" type="hidden" placeholder="ID" value="<?php echo $row_show['id']; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน</label>
    <div class="col-sm-10">
      <input name="edit_username" class="form-control" id="edit_username" type="text" placeholder="ชื่อผู้ใช้งาน" required autofocus value="<?php echo $row_show['username']; ?>" readonly>
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">รหัสประจำตัวประชาชน</label>
    <div class="col-sm-10">
      <input name="edit_citizen-id" class="form-control" id="edit_citizen-id" type="text" placeholder="รหัสประจำตัวประชาชน" required autofocus value="<?php echo $row_show['citizen_id']; ?>" maxlength="13">
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
  <label class="col-sm-2 col-form-label">อัพโหลดภาพ .jpg .jpeg .png เท่านั้น</label>
    <div class="col-sm-10">
        <input type="file" name="fileimg" id="fileimg">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">วันเกิด</label>
    <div class="col-sm-10">
      <input name="edit_dob" class="form-control" id="edit_dob" type="text" placeholder="วันเกิด" required autofocus value="<?php echo $row_show['dob']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">ศาสนา</label>
    <div class="col-sm-10">
      <select id="edit_religion" name="edit_religion" class="form-control" data-live-search="true" title="กรุณาเลือก">
        <?
        //แสดงศาสนา
         $sql_religion = "SELECT * FROM religion";
         $qry_religion = mysqli_query($con,$sql_religion);
        
           while ($show_religion = mysqli_fetch_array($qry_religion)) {
             
             if ($row_show['religion'] == $show_religion['id']){
               echo "<option value=" . $show_religion['id']. " selected='selected'>" . $show_religion['religion'] . "</option>";
             } else{
               echo "<option value=" . $show_religion['id'] . ">" . $show_religion['religion']. "</option>";
             }
        ?>
            
        <? } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">สัญชาติ</label>
    <div class="col-sm-10">
      <select id="edit_nation" name="edit_nation" class="form-control" data-live-search="true" title="กรุณาเลือก">
        <?
        //แสดงศาสนา
         $sql_nation = "SELECT * FROM nationality";
         $qry_nation = mysqli_query($con,$sql_nation);
        
           while ($show_nation = mysqli_fetch_array($qry_nation)) {
             
             if ($row_show['nationality'] == $show_nation['id']){
               echo "<option value=" . $show_nation['id'] ." selected='selected'>" . $show_nation['nationality'] . "</option>";
             } else {
               echo "<option value=" . $show_nation['id'] .">" . $show_nation['nationality'] . "</option>";
             }
        ?>
        <? } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="edit_salutation">ตำแหน่ง</label>
    <div class="col-sm-10">
      <select class="form-control" id="edit_position" name="edit_position" type="text">
      <option disabled>กรุณาเลือก</option>
      <option value="1" <?php if($row_show['position']=="1") echo 'selected' ?>>ผู้อำนวยการ</option>
      <option value="2" <?php if($row_show['position']=="2") echo 'selected' ?>>รองผู้อำนวยการ</option>
      <option value="3" <?php if($row_show['position']=="3") echo 'selected' ?>>ครู</option>
      <option value="4" <?php if($row_show['position']=="4") echo 'selected' ?>>เจ้าหน้าที่</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">ที่อยู่ปัจจุบัน</label>
    <div class="col-sm-10">
      <textarea name="edit_address" class="form-control" id="edit_address" type="text" placeholder="ที่อยู่ปัจจุบัน" required><?php echo $row_show['full_address']; ?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="edit_salutation">ระดับการศึกษา</label>
    <div class="col-sm-10">
      <select class="form-control" id="edit_edu-level" name="edit_edu-level" type="text">
      <option disabled>กรุณาเลือก</option>
      <option value="1" <?php if($row_show['edu_level']=="1") echo 'selected' ?>>-</option>
      <option value="2" <?php if($row_show['edu_level']=="2") echo 'selected' ?>>ต่ำกว่าประถม</option>
      <option value="3" <?php if($row_show['edu_level']=="3") echo 'selected' ?>>ป.6</option>
      <option value="4" <?php if($row_show['edu_level']=="4") echo 'selected' ?>>ม.3</option>
      <option value="5" <?php if($row_show['edu_level']=="5") echo 'selected' ?>>ม.6</option>
      <option value="6" <?php if($row_show['edu_level']=="6") echo 'selected' ?>>ปวช.</option>
      <option value="7" <?php if($row_show['edu_level']=="7") echo 'selected' ?>>ปวท.</option>
      <option value="8" <?php if($row_show['edu_level']=="8") echo 'selected' ?>>ปวส.</option>
      <option value="9" <?php if($row_show['edu_level']=="9") echo 'selected' ?>>ปริญญาตรี</option>
      <option value="10" <?php if($row_show['edu_level']=="10") echo 'selected' ?>>ปริญญาโท</option>
      <option value="11" <?php if($row_show['edu_level']=="11") echo 'selected' ?>>ปริญญาเอก</option>
      <option value="12" <?php if($row_show['edu_level']=="12") echo 'selected' ?>>ม.ศ.3</option>
      <option value="13" <?php if($row_show['edu_level']=="13") echo 'selected' ?>>ม.ศ.5</option>
      <option value="14" <?php if($row_show['edu_level']=="14") echo 'selected' ?>>ประกาศนียบัตรครู (ปก.ศ ต้น)</option>
      <option value="15" <?php if($row_show['edu_level']=="15") echo 'selected' ?>>อนุปริญญาการศึกษา (ปก.ศ สูง)</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">วุฒิการศึกษา</label>
    <div class="col-sm-10">
      <input name="edit_edu-cert" class="form-control" id="edit_edu-cert" type="text" placeholder="วุฒิการศึกษา" required autofocus value="<?php echo $row_show['edu_cert']; ?>">
    </div>
  </div>
  <div class="form-group row">
  <label class="col-sm-2 col-form-label">วิชาเอก - วิชาโท</label>
  <div class="col-sm-10">
  <div class="input-group">  
  <div class="input-group-prepend">
      <input type="text" class="form-control" id="edit_major" name="edit_major" placeholder="วิชาเอก" value="<?php echo $row_show['edu_major']; ?>">
      <input type="text" class="form-control" id="edit_minor" name="edit_minor" placeholder="วิชาโท" value="<?php echo $row_show['edu_minor']; ?>">
    </div>
    </div>
    </div>
    </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">วันที่บรรจุ</label>
    <div class="col-sm-10">
      <input name="edit_assign-date" class="form-control" id="edit_assign-date" type="text" placeholder="วันที่บรรจุ" required autofocus value="<?php echo $row_show['assign_date']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">วุฒิที่ได้รับการบรรจุ</label>
    <div class="col-sm-10">
      <input name="edit_assign-cert" class="form-control" id="edit_assign-cert" type="text" placeholder="วุฒิที่ได้รับการบรรจุ" autofocus value="<?php echo $row_show['assign_cert']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">วันที่เข้าทำงาน</label>
    <div class="col-sm-10">
      <input name="edit_work-date" class="form-control" id="edit_work-date" type="text" placeholder="วันที่เข้าทำงาน" required autofocus value="<?php echo $row_show['work_date']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">เลขที่ สช.11</label>
    <div class="col-sm-10">
      <input name="edit_obec-id" class="form-control" id="edit_obec-id" type="text" placeholder="เลขที่ สช.11" autofocus value="<?php echo $row_show['obec_id']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">จังหวัดที่ออก สช.11</label>
    <div class="col-sm-10">
      <select id="edit_obec-province" name="edit_obec-province" class="form-control" data-live-search="true" title="กรุณาเลือก">
        <?
        //แสดงศาสนา
         $sql_province = "SELECT * FROM province";
         $qry_province = mysqli_query($con,$sql_province);
        
           while ($show_province = mysqli_fetch_array($qry_province)) {
             
             if ($row_show['obec_province'] == $show_province['id']){
               echo "<option value=" . $show_province['id'] . " selected='selected'>" . $show_province['province_name'] . "</option>";
             } else {
               echo "<option value=" . $show_province['id'] . ">" . $show_province['province_name'] . "</option>";
             }
        ?>
        <? } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">เลขที่ สช.18 หรือ 19</label>
    <div class="col-sm-10">
      <input name="edit_obec-id-18" class="form-control" id="edit_obec-id-18" type="text" placeholder="เลขที่ สช.18 หรือ 19" autofocus value="<?php echo $row_show['obec_id_18']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">ความเชี่ยวชาญ</label>
    <div class="col-sm-10">
      <input name="edit_pro" class="form-control" id="edit_pro" type="text" placeholder="ความเชียวชาญ" autofocus value="<?php echo $row_show['pro']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="edit_salutation">ระดับชั้นที่สอน</label>
    <div class="col-sm-10">
      <select class="form-control" id="edit_teach-class" name="edit_teach-class" type="text">
      <option disabled>กรุณาเลือก</option>
      <option value="1" <?php if($row_show['teach_class']=="1") echo 'selected' ?>>-</option>
      <option value="2" <?php if($row_show['teach_class']=="2") echo 'selected' ?>>ประถมศึกษา</option>
      <option value="3" <?php if($row_show['teach_class']=="3") echo 'selected' ?>>มัธยมศึกษา</option>
      <option value="4" <?php if($row_show['teach_class']=="4") echo 'selected' ?>>ประถมศึกษา, มัธยมศึกษา</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">วิชาที่สอน</label>
    <div class="col-sm-10">
      <input name="edit_subject" class="form-control" id="edit_subject" type="text" placeholder="วิชาที่สอน" autofocus value="<?php echo $row_show['subject']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">จำนวนชม.ที่สอน/สัปดาห์</label>
    <div class="col-sm-10">
      <input name="edit_teach-hour" class="form-control" id="edit_teach-hour" type="text" placeholder="" autofocus value="<?php echo $row_show['teach_hour']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="edit_salutation">วุฒิครู ?</label>
    <div class="col-sm-10">
      <select class="form-control" id="edit_check-tcert" name="edit_check-tcert" type="text">
      <option disabled>กรุณาเลือก</option>
      <option value="1" <?php if($row_show['check_t_cert']=="1") echo 'selected' ?>>มี</option>
      <option value="2" <?php if($row_show['check_t_cert']=="2") echo 'selected' ?>>ไม่มี</option>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">อัตราเงินเดือน</label>
    <div class="col-sm-10">
      <input name="edit_salary" class="form-control" id="edit_salary" type="text" placeholder="อัตราเงินเดือน" required autofocus value="<?php echo $row_show['salary']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">รายได้อื่น</label>
    <div class="col-sm-10">
      <input name="edit_other-income" class="form-control" id="edit_other-income" type="text" placeholder="รายได้อื่น" autofocus value="<?php echo $row_show['other_income']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">เลขที่บัญชีเงินฝาก</label>
    <div class="col-sm-10">
      <input name="edit_bookbank-id" class="form-control" id="edit_bookbank-id" type="text" placeholder="เลขที่บัญชีเงินฝาก" autofocus value="<?php echo $row_show['bookbank_id']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">ธนาคาร</label>
    <div class="col-sm-10">
      <select id="edit_bank-id" name="edit_bank-id" class="form-control" data-live-search="true" title="กรุณาเลือก">
        <?
        //แสดงศาสนา
         $sql_bank = "SELECT * FROM bank";
         $qry_bank = mysqli_query($con,$sql_bank);
        
           while ($show_bank = mysqli_fetch_array($qry_bank)) {
             
             if ($row_show['bank_id'] == $show_bank['id']){
               echo "<option value=" . $show_bank['id'] . " selected='selected'>" . $show_bank['bank_name'] . "</option>";
             } else {
               echo "<option value=" . $show_bank['id'] . ">" . $show_bank['bank_name'] . "</option>";
             }
        ?>
        <? } ?>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_citizen-id" class="col-sm-2 col-form-label">สาขา</label>
    <div class="col-sm-10">
      <input name="edit_branch" class="form-control" id="edit_branch" type="text" placeholder="สาขา" autofocus value="<?php echo $row_show['branch']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">RFID</label>
    <div class="col-sm-10">
      <input name="edit_rfid" class="form-control" id="edit_rfid" type="text" placeholder="RFID" required autofocus value="<?php echo $row_show['rfid']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">เวลาเริ่มงาน</label>
    <div class="col-sm-10">
      <input name="edit_start-time" class="form-control" id="edit_start-time" type="text" placeholder="เริ่มงาน" required autofocus value="<?php echo $row_show['time_start']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="edit_username" class="col-sm-2 col-form-label">เวลาเลิกงาน</label>
    <div class="col-sm-10">
      <input name="edit_end-time" class="form-control" id="edit_end-time" type="text" placeholder="เลิกงาน" required autofocus value="<?php echo $row_show['time_end']; ?>">
    </div>
  </div>
  <div class="form-group row">
  <label for="edit_username" class="col-sm-2 col-form-label">สถานะ</label>
    <div class="col-sm-10">
      <select class="form-control" id="status" name="status" title="กรุณาเลือก">
             <option value="1" <?php if($row_show['status'] == 1){echo 'selected';} ?>>ปกติ</option>
             <option value="0" <?php if($row_show['status'] == 0){echo 'selected';} ?>>ลาออก</option>
      </select>
    </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    </div>
  </div>

</form>
</div>

<?php include 'footer.php'; ?>