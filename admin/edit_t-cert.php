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

$cert_id = $_REQUEST['id'];
$user_id = $_REQUEST['user_id'];

//แสดงใบประกอบวิชาชีพ
$sql_cert = "SELECT * FROM t_cert WHERE id = '$cert_id'";
$qry_cert = mysqli_query($con,$sql_cert);
$show_cert = mysqli_fetch_array($qry_cert);

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
  <form method="post" action="cmd/edit_t-cert">
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
        
        if ($show_cert['cert_cate'] == $objResuut['id']) {
          echo "<option value=" . $objResuut["id"] . " selected='selected'>" . $objResuut["cate_name"] . "</option>";
        }
        else {
          echo "<option value=" . $objResuut["id"] . ">" . $objResuut["cate_name"] . "</option>";
        }
			?>
      
      <?php
      }
      ?>
      </select>
    </div> 
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">เลขที่ใบอนุญาต</label>
    <div class="col-sm-10">
      <input name="cert_id" class="form-control" id="cert_id" type="text" required value="<? echo $show_cert['cert_id'] ?>">
    </div>
  </div>
    <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">วันที่ออกให้</label>
    <div class="col-sm-10">
      <input name="valid_date" class="form-control" id="valid_date" type="text" required value="<? echo $show_cert['valid_date'] ?>">
    </div>
  </div>
    <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">วันที่หมดอายุ</label>
    <div class="col-sm-10">
      <input name="exp_date" class="form-control" id="exp_date" type="text" required value="<? echo $show_cert['exp_date'] ?>">
    </div>
  </div>
  <input name="id" class="form-control" id="id" type="hidden" value="<? echo $cert_id ?>">
    <input name="user_id" class="form-control" id="user_id" type="hidden" value="<? echo $user_id ?>">
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึกข้อมูล</button>
    </div>
  </div>

</form>
</div>






<?php include 'footer.php' ; ?>