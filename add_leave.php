<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

$title = "ส่งใบลา";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>
<br>

<script>
  $( function() {
    $( "#start_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  $( function() {
    $( "#end_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
  </script>
<?php
$sql_id = "SELECT * FROM users WHERE id = '".$_SESSION['userid']."' ";
$query_id = mysqli_query($con,$sql_id);
$result_id = mysqli_fetch_array($query_id);

$user_id = $result_id['id'] ;

?>
<form class="container-fluid" id="add_leave" name="add_leave" method="post" action="cmd/add_leave">
<div class="form-group row">
    <label class="col-sm-2 col-form-label">เรื่อง</label>
    <div class="col-sm-10">
      <input name="doc_title" class="form-control" id="doc_title" type="text" placeholder="ตัวอย่าง : ขอลากิจ" required>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">ครูประจำชั้น</label>
    <div class="col-sm-10">
      <input name="t_class" class="form-control" id="t_class" type="text" placeholder="ตัวอย่าง : ป.1/1">
    </div>
  </div>
  <div class="form-group row">
  <label class="col-sm-2 col-form-label">ครูพิเศษ</label>
  <div class="col-sm-10">
  <div class="input-group">  
  <div class="input-group-prepend">
      <input type="text" class="form-control" id="t_subject" name="t_subject" placeholder="สอนวิชา" >
      <input type="text" class="form-control" id="t_sclass" name="t_sclass" placeholder="ชั้นเรียนที่สอน">
    </div>
    </div>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label" for="edit_salutation">ประเภทการลา</label>
    <div class="col-sm-10">
      <select class="form-control" id="category" name="category" type="text">
      <option selected disabled>ระบุประเภทการลา</option>
      <?php
			$strSQL = "SELECT * FROM leave_category ORDER BY id ASC";
			$objQuery = mysqli_query($con,$strSQL);
			while($objResuut = mysqli_fetch_array($objQuery))
			{
			?>
      <option value="<?php echo $objResuut["id"];?>"><?php echo $objResuut["category_name"];?></option>
      <?php
      }
      ?>
      </select>
    </div> 
  </div>
  <div class="form-group row">
  <label class="col-sm-2 col-form-label">ตั้งแต่วันที่ / เต็มวัน-ครึ่งวัน</label>
  <div class="col-sm-10">
  <div class="input-group">  
  <div class="input-group-prepend">
      <input type="text" class="form-control" id="start_date" name="start_date" placeholder="ระบุวันที่" >
      <select class="form-control" id="s_time_range" name="s_time_range" type="text">
      <?
      $sql_rangename1 = "SELECT * FROM leave_timerange ORDER BY id ASC";
			$qry_rangename1 = mysqli_query($con,$sql_rangename1);
			while($result_range1 = mysqli_fetch_array($qry_rangename1))
			{
			?>
      <option value="<?php echo $result_range1["id"];?>"><?php echo $result_range1["range_name"];?></option>
        <?
      }
      ?>
      </select>
    </div>
    </div>
    </div>
    </div>
<div class="form-group row">
  <label class="col-sm-2 col-form-label">ถึงวันที่ / เต็มวัน-ครึ่งวัน</label>
  <div class="col-sm-10">
  <div class="input-group">  
  <div class="input-group-prepend">
      <input type="text" class="form-control" id="end_date" name="end_date" placeholder="ระบุวันที่" >
      <select class="form-control" id="e_time_range" name="e_time_range" type="text">
      <?
      $sql_rangename2 = "SELECT * FROM leave_timerange ORDER BY id ASC";
			$qry_rangename2 = mysqli_query($con,$sql_rangename2);
			while($result_range2 = mysqli_fetch_array($qry_rangename2))
			{
			?>
      <option value="<?php echo $result_range2["id"];?>"><?php echo $result_range2["range_name"];?></option>
        <?
      }
      ?>
      </select>
    </div>
    </div>
    </div>
    </div>
    <div class="form-group row">
    <label class="col-sm-2 col-form-label">เหตุผล</label>
    <div class="col-sm-10">
        <textarea class="form-control" id="reason" name="reason" rows="2"></textarea>
    </div>
  </div>
    <div class="form-group row">

        <label class="col-sm-2 col-form-label">ที่อยู่ที่สามารถติดต่อได้</label>

                <div class="col-sm-10">

                    <div class="input-group">  

                        <div class="input-group-prepend">
                            <input type="text" class="form-control" id="ad_home_no" name="ad_home_no" placeholder="บ้านเลขที่" >
                            <input type="text" class="form-control" id="ad_alley" name="ad_alley" placeholder="ตรอก/ซอย" >
                            <input type="text" class="form-control" id="ad_road" name="ad_road" placeholder="ถนน" >
                        </div>

                    </div>

                    <div class="input-group">  

                        <div class="input-group-prepend">
                            <input type="text" class="form-control" id="ad_sub_district" name="ad_sub_district" placeholder="ตำบล/แขวง" >
                            <input type="text" class="form-control" id="ad_district" name="ad_district" placeholder="อำเภอ/เขต" >
                            <input type="text" class="form-control" id="ad_province" name="ad_province" placeholder="จังหวัด" >
                        </div>

                    </div>

                    <div class="input-group">  

                        <div class="input-group-prepend">
                            <input type="text" class="form-control" id="ad_postcode" name="ad_postcode" placeholder="รหัสไปรษณีย์" >
                            <input type="text" class="form-control" id="tel" name="tel" placeholder="เบอร์โทรศัพท์" >
                        </div>

                    </div>

                </div>

    </div>
    <input name="user_id" class="form-control" id="user_id" type="hidden" value="<?php echo $user_id ?>">
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    </div>
  </div>

</form>


<?php include 'footer.php' ; ?>