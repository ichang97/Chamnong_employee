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

$title = "เพิ่มข่าวสาร";
?>
<?php include 'header.php'; ?>
<?php include 'main_menu.php'; ?>


<br>
<form class="container-fluid" id="frmadduser" name="frmadduser" method="post" action="cmd/add_news">
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">หัวข้อข่าว</label>
    <div class="col-sm-10">
      <input name="txt_title" class="form-control" id="txt_title" type="text" required autofocus>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">รายละเอียด</label>
    <div class="col-sm-10">
      <textarea name="txt_detail" class="form-control" id="news_detail" type="text"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">สถานะ</label>
    <div class="col-sm-10">
    <select class="form-control" id="txt_status" name="txt_status">
      <option value="1">เผยแพร่</option>
      <option value="0">ไม่เผยแพร่</option>
    </select>
    </div>
  </div>
      <input name="txt_admin" class="form-control" id="txt_admin" type="hidden" value="<? echo $_SESSION['userid'] ; ?>">
  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" id="submit" class="btn btn-success"><i class="fas fa-save"></i> เพิ่มข่าวสาร</button>
    </div>
  </div>

</form>


<?php include 'footer.php'; ?>