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

$title = "ลงเวลารายบุคคล - ระบบลงเวลาทำงาน";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>

<script type="text/javascript">
 $( function() {
    $( "#txt_date" ).datepicker({
        dateFormat: "yy-mm-dd"
    });
  });
$(document).ready(function(){
    $('#txt_start').timepicker({
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
    $('#txt_end').timepicker({
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


function resulttime(time)
	{
		switch(time)
		{
			<?php
			$strSQL = "SELECT * FROM users";
			$objQuery = mysqli_query($con,$strSQL);
			while($objResult = mysqli_fetch_array($objQuery))
			{
			?>
				case "<?php echo $objResult["id"];?>":
				add_onestamp.txt_start.value = "<?php echo $objResult["time_start"];?>";
        add_onestamp.txt_end.value = "<?php echo $objResult["time_end"];?>";
				break;
			<?php
			}
			?>
			default:
			 add_onestamp.txt_start.value = "";
       add_onestamp.txt_end.value = "";
		}
	}
 </script>
 
<style>
.jumbotron{
  background-color: #28a745;
  color: #ffffff;
}
</style>
<div class="jumbotron text-center">
  <h1><i class="fas fa-plus-circle"></i> ลงเวลารายบุคคล</a></h1><br>
  <a href="cta" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container">

<form method="post" action="cmd/cta_onestamp" id="add_onestamp" name="add_onestamp">
<div class="form-group">
    <label>เลือกบุคลากร</label>
    <select class="form-control" required name="txt_id" id="txt_id" type="text" OnChange="resulttime(this.value);">
    <option selected disabled>เลือกบุคลากร</option>
    <? 
      $sql_list = "SELECT * FROM users ORDER BY t_name ASC";
      $qry_list = mysqli_query($con,$sql_list);
      while ($show_list = mysqli_fetch_array($qry_list)) { 
    ?>
    <option value="<? echo $show_list['id'] ?>"><? echo $show_list['id'] ?> : <? echo $show_list['t_name'] ?>  <? echo $show_list['t_surname'] ?></option>
    <? } ?>
    </select>
  </div>
<div class="form-group">
    <label>วันที่ต้องการลงเวลา</label>
    <input type="text" class="form-control" id="txt_date" name="txt_date" placeholder="ระบุวันที่" required>
  </div>
  <?
    $user_id = $show_list['id'];
    $sql_time = "SELECT time_start,time_end FROM users WHERE id = '$user_id' ";
    $qry_time = mysqli_query($con,$sql_time);
    $show_time = mysqli_fetch_array($con,$qry_time);
  
  ?>
    <div class="form-group">
    <label>เวลาเข้างาน</label>
    <input type="text" class="form-control" id="txt_start" name="txt_start" placeholder="ระบุเวลา" required value="">
  </div>
  <div class="form-group">
    <label>เวลาออกงาน</label>
    <input type="text" class="form-control" id="txt_end" name="txt_end" placeholder="ระบุเวลา" required value="">
  </div>
  <div class="form-group">
    <label>สาเหตุการลงเวลาแทน</label>
    <textarea type="text" class="form-control" id="txt_remark" name="txt_remark" required></textarea>
  </div>
<button type="submit" class="btn btn-success btn-lg"><i class="fas fa-plus-circle"></i> กดปุ่มเพื่อประมวลผล</button>
</form>

</div>

<?php include 'footer.php' ; ?>