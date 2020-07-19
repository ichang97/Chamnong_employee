<nav class="navbar navbar-expand-md bg-primary navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="https://employee.dekcom-chamnong.com/admin/dashboard">
    <img src="chamnong.png" width="30" height="30"> ระบบสารสนเทศครู จนว.
  </a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <i class="fas fa-bars"></i>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
      <a class="nav-link btn btn-warning" style="color: black;" href="add_leave"><i class="fas fa-plus"></i> ส่งใบลา</a>
      </li>
      <li class="nav-item">
      <a class="nav-link btn btn-warning" style="color: black;" href="view_leave"><i class="far fa-list-alt"></i> ประวัติการลางาน</a>
      </li>
      <li class="nav-item">
      <a class="nav-link btn btn-warning" style="color: black;" href="my_summary"><i class="fas fa-chart-bar"></i> สรุปข้อมูลการลางาน</a>
      </li>
      <li class="nav-item">
      <a class="nav-link btn btn-warning" style="color: black;" href="my_calendar"><i class="far fa-calendar-alt"></i> ปฏิทินส่วนตัว</a>
      </li>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item">
      <a class="nav-link btn btn-light" style="color: black;" href="user_list"><i class="fas fa-users"></i> ผู้ใช้งาน</a>
      </li>
      <li class="nav-item">
      <a class="nav-link btn btn-light" style="color: black;" href="newsboard"><i class="far fa-newspaper"></i> ข่าวสาร</a>
      </li>
      <li class="nav-item">
      <a class="nav-link btn btn-light" style="color: black;" href="setting"><i class="fas fa-cog"></i> ตั้งค่าระบบ</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link btn btn-light dropdown-toggle" style="color: black;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chart-bar"></i> สรุปรายงาน</a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="sum_stat">ภาพรวมการลาทั้งโรงเรียน</a>
        <a class="dropdown-item" href="sum_all_employee">ภาพรวมการลารายคน</a>
        <a class="dropdown-item" href="all_calendar">ปฏิทินการลางานทั้งโรงเรียน</a>
        <a class="dropdown-item" href="cta">ระบบลงเวลาทำงาน</a>
      </div>
      </li>
      <li class="nav-item">
      <a class="nav-link btn btn-danger" style="color: white;" href="cmd/cmd_logout.php"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
      </li>
    </ul>
  </div> 
</nav>