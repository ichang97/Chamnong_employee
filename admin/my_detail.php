<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}

$title = "ข้อมูลส่วนตัว";
?>

<?php include 'header.php'; ?>
<?php include 'main_menu.php'; ?>
<?php include 'connect.php' ; ?>

<?
$sql = "SELECT * FROM users WHERE id ='".$_SESSION['userid']."'";
$query = mysqli_query($con,$sql);
$result = mysqli_fetch_array($query);
?>
<br>

<div class="container">
<h3>ข้อมูลส่วนตัว</h3>
<table class="table">
<tbody>
    <tr>
      <th scope="row">ID</th>
      <td><? echo $result['id'] ?></td>
    </tr>
    <tr>
      <th scope="row">ชื่อ-สกุล</th>
      <td><? echo $result['t_salutation'] ?><? echo $result['t_name'] ?> <? echo $result['t_surname'] ?></td>
    </tr>
    <tr>
      <th scope="row">ชื่อผู้ใช้งาน</th>
      <td><? echo $result['username'] ?></td>
    </tr>
    <tr>
      <th scope="row">สิทธิ์การใช้งาน</th>
      <td>
      <?php if ($result["permission"] == 1): ?>
      <i class="fas fa-check" style="color:#11AC15"></i> ผู้ดูแลระบบ
        <?php else: ?>
            <i class="fas fa-minus" style="color:#AC1311"></i> ผู้ใช้งานทั่วไป
        <?php endif ?>
    </td>
    </tr>
</table><br>
<a class="btn btn-warning" href="edit_myuser?edit_id=<? echo $result["id"]; ?>"><i class="fas fa-edit"></i> แก้ไขข้อมูล</a>

</div>

<?php include 'footer.php'; ?>