<?
$sql_news = "SELECT * FROM news";
$qry_news = mysqli_query($con,$sql_news);

$num_news = mysqli_num_rows($qry_news);
?>
<nav class="navbar navbar-expand-md bg-primary navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="dashboard">
    <img src="chamnong.png" width="30" height="30"> ระบบสารสนเทศครู จนว.
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <i class="fas fa-bars"></i>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
      <a class="btn btn-warning" href="add_leave"><i class="fas fa-plus"></i> ส่งใบลา</a>
      </li>
      <li class="nav-item active">
      <a class="btn btn-outline-warning" href="view_leave"><i class="far fa-list-alt"></i> ประวัติการลางาน</a>
      </li>
      <li class="nav-item active">
      <a class="btn btn-outline-warning" href="my_summary"><i class="fas fa-chart-bar"></i> สรุปข้อมูลการลางาน</a>
      </li>
      <li class="nav-item active">
      <a class="btn btn-outline-warning" href="my_calendar"><i class="far fa-calendar-alt"></i> ปฏิทินส่วนตัว</a>
      </li>
      <li class="nav-item active">
      <a class="btn btn-outline-warning" href="news"><i class="far fa-newspaper"></i> ข่าวสาร  
      <? if ($num_news == 0) : ?><? else : ?><span class="badge badge-pill badge-danger"><? echo $num_news ?></span><? endif ?></a>
      </li>
      <li class="nav-item active">
      <a class="btn btn-outline-warning" href="t_cert"><i class="fas fa-certificate"></i> ใบประกอบวิชาชีพ</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
        <a class="btn btn-info" href="change_password"><i class="fas fa-key"></i> เปลี่ยนรหัสผ่าน</a>
        <a class="btn btn-danger" href="cmd/cmd_logout.php"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
    </div>
  </div> 
</nav>