<? $title = "ระบบสารสนเทศครู จนว."; ?>
<?php include 'header.php' ;?>

<link rel="stylesheet" href="asset/signin.css">
<body class="text-center">
<form class="form-signin" name="login" id="login" method="post" action="cmd/cmd_login.php">

    <img class="mb-4" src="chamnong.png" width="200" height="200">
    <h2>เข้าสู่ระบบสารสนเทศครู จนว.</h2>

    <label for="inputUser" class="sr-only">ชื่อผู้ใช้งาน</label>
    <input id="inputUser" class="form-control" placeholder="ชื่อผู้ใช้งาน" required autofocus name="txtusername" id="txtusername">
    <label for="inputPassword" class="sr-only">รหัสผ่าน</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="รหัสผ่าน" required name="txtpass" id="txtpass">
    <button class="btn btn-lg btn-primary brn-block" type="submit">เข้าสู่ระบบ</button>

<?php include 'footer.php' ; ?>

