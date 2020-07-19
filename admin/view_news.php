<?php
session_start();
include 'connect.php';

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

if($_REQUEST['id'] != "")
{
$id = $_REQUEST['id'];
$sql_show = "select * from news where news_id = '$id'";
$result_show = mysqli_query($con,$sql_show) or die(mysqli_error());
$row_show = mysqli_fetch_array($result_show);
}

// แสดงชื่อแอดมินที่โพสต์ข่าว
$admin_id = $row_show['admin_id'];
$sql_admin = "SELECT t_name , t_surname FROM users WHERE id = '$admin_id'";
$qry_admin = mysqli_query($con,$sql_admin);
$show_admin = mysqli_fetch_array($qry_admin);

date_default_timezone_set('Asia/Bangkok');

function datethai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute น.";
  }

	$title = $row_show['title'];
?>

<?php include 'header.php'; ?>
<?php include 'main_menu.php'; ?>

<br>
<div class="container">
<a class="btn btn-danger" href="JavaScript:if(confirm('คุณต้องการลบหรือไม่ ?') == true){window.location='cmd/delete_news.php?id=<?php echo $id; ?>';}"><i class="fas fa-trash-alt"></i> ลบข่าวนี้</a>
</div><br>
<div class="container">
<h3><? echo $row_show['title'] ?></h3>
<i class="fas fa-bullhorn" style="color:#007bff"></i> <? echo datethai($row_show['timestamp']); ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-user" style="color:#007bff"></i> <? echo $show_admin['t_name'] ?> <? echo $show_admin['t_surname'] ?><br><br>
<? echo $row_show['detail'] ?>
</div>

<div class="container">
  <a href="edit_news?id=<? echo $row_show['news_id'] ?>" class="btn btn-warning"><i class="fas fa-edit"></i> แก้ไขข่าว</a> <a href="newsboard" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>
<br>


<?php include 'footer.php'; ?>