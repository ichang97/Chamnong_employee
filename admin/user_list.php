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

$title = "ผู้ใช้งาน";
?>

<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<?php include 'connect.php' ; ?>
<br>
<script>
$(document).ready( function () {
    $('#user_list').DataTable();
} );
</script>
<div class="container">
        <a class="btn btn-warning" href="add_user"><i class="fas fa-plus"></i> เพิ่มผู้ใช้งาน</a>
    </div><br>
    <?php
$sql = "SELECT * FROM users ORDER BY t_name asc";
$query = mysqli_query($con,$sql);
?>
<div class="container">
  <table class="table table-hover table-responsive" id="user_list">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ภาพ</th>
      <th scope="col">ชื่อ-สกุล</th>
      <th scope="col">ชื่อผู้ใช้งาน</th>
      <th scope="col">สิทธิ์การใช้งาน</th>
      <th scope="col">ใบประกอบวิชาชีพครู</th>
      <th scope="col">เปลี่ยนรหัสผ่าน</th>
      <th scope="col">แก้ไข/ลบ</th>
    </tr>
  </thead>
  <tbody>
<?php
while($result = mysqli_fetch_array($query))
{
?>
    <tr>
      <td><?php echo $result["id"]; ?></td>
      <td><img src="profile/<? echo $result['img'] ?>" class="img-rounded" width="50"></td>
      <td><?php echo $result["t_name"]; ?>  <?php echo $result["t_surname"]; ?></td>
      <td><?php echo $result["username"]; ?></td>
      <td><?php if ($result["permission"] == 1): ?>
      <i class="fas fa-check" style="color:#11AC15"></i> ผู้ดูแลระบบ
<?php else: ?>
  <i class="fas fa-minus" style="color:#AC1311"></i> ผู้ใช้งานทั่วไป
  <?php endif ?></td>
      <td>
          <a class="btn btn-info" href="t_cert?id=<? echo $result['id'] ?>"><i class="fas fa-certificate"></i> ดูใบประกอบวิชาชีพครู</a>
      </td>
      <td>
        <a class="btn btn-info" href="change_password?id=<? echo $result['id'] ?>"><i class="fas fa-key"></i></a>
      </td>
      <td>
      <a class="btn btn-warning" href="edit_user?edit_id=<? echo $result["id"]; ?>"><i class="fas fa-edit"></i></a>
      <a class="btn btn-danger" href="JavaScript:if(confirm('คุณต้องการลบหรือไม่ ?') == true){window.location='cmd/delete_user.php?id=<?php echo $result["id"]; ?>';}"><i class="fas fa-trash-alt"></i></a>
  </td>
    </tr>
<?php
        }
        ?>
  </tbody>
</table>
</div>


<?php mysqli_close($con); ?>


<?php include 'footer.php'; ?>