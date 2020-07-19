<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

$title = "ข่าวสาร";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>
<br>
<?
// แสดงข่าวสารต่าง ๆ จากผู้ดูแลระบบ
$sql_news = "SELECT * FROM news WHERE status = 1" ;
$qry_news = mysqli_query($con,$sql_news);

//จำนวนโพสต์
$news_count = mysqli_num_rows($qry_news);

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

?>
<br>

<? if ($news_count == 0): ?>
<div class="container">
<div class="alert alert-danger text-center" role="alert">
  ไม่มีข่าวสาร
</div>
</div>
<? else: ?>
<div class="container">
<?
        $numcol = 3;
        $rowcount = 0;
    ?>
<div class="row">
    <? while ($show_news = mysqli_fetch_array($qry_news)) { ?>
    <div class="col-sm text-center">
    <div class="card bg-warning">
            <div class="card-header">
                <h5 class="card-title"><? echo $show_news['title'] ?></h5>
            </div>
            <div class="card-body text-center">
            <p>
            <? if ($show_news['status'] == 1): ?>
            <i class="fas fa-check" style="color:#28a745"></i> เผยแพร่แล้ว<br>
            <? else: ?>
            <i class="fas fa-times" style="color:#dc3545"></i> ยังไม่เผยแพร่<br>
            <? endif ?>
            <?
              
              // แสดงชื่อแอดมินที่โพสต์ข่าว
              $admin_id = $show_news['admin_id'];
              $sql_admin = "SELECT t_name , t_surname FROM users WHERE id = '$admin_id'";
              $qry_admin = mysqli_query($con,$sql_admin);
              $show_admin = mysqli_fetch_array($qry_admin); 
            ?>
            <i class="fas fa-bullhorn" style="color:#ffffff"></i> <? echo datethai($show_news['timestamp']); ?><br>
            <i class="fas fa-user" style="color:#ffffff"></i> <? echo $show_admin['t_name'] ?> <? echo $show_admin['t_surname'] ?><br>
            </p>
            <a href="view_news?id=<? echo $show_news['news_id'] ?>" class="btn btn-success">ดูรายละเอียด</a>
            </div>
    </div>
    </div>
    <?
        $rowcount++;
        if($rowcount % $numcol == 0) echo '</div><br><div class="row">';
        }
    ?>
  </div>
</div>
<? endif ?>

</div>





<?php include 'footer.php'; ?>