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

$news_id = $_REQUEST['id'];

//แสดงข้อมูลข่าว
$sql_news = "SELECT * FROM news WHERE news_id = '$news_id' ";
$qry_news = mysqli_query($con,$sql_news);
$show_news = mysqli_fetch_array($qry_news);

$title = "แก้ไขข่าว" ;
?>
<?php include 'header.php'; ?>
<?php include 'main_menu.php'; ?>

<br>
<form class="container-fluid" id="edit_news" name="edit_news" method="post" action="cmd/edit_news">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">หัวข้อข่าว</label>
    <div class="col-sm-10">
      <input name="txt_title" class="form-control" id="txt_title" type="text" value="<? echo $show_news['title'] ?>" required autofocus>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">รายละเอียด</label>
    <div class="col-sm-10">
      <textarea name="txt_detail" class="form-control" id="news_detail" type="text"><? echo $show_news['detail'] ?></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">สถานะ</label>
    <div class="col-sm-10">
    <select class="form-control" id="txt_status" name="txt_status">
      <option value="1" <? if ($show_news['status']==1) echo 'selected' ?>>เผยแพร่</option>
      <option value="0" <? if ($show_news['status']==0) echo 'selected' ?>>ไม่เผยแพร่</option>
    </select>
    </div>
  </div>
      <input name="txt_newsid" class="form-control" id="txt_newsid" type="hidden" value="<? echo $show_news['news_id'] ; ?>">
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> บันทึกข้อมูล</button> <a href="view_news?id=<? echo $show_news['news_id'] ?>" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
    </div>
  </div>

</form>


<?php include 'footer.php'; ?>