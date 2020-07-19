<?php
session_start();
include 'connect.php';
header("content-type:text/html;charset=utf-8");


$hashed_password = md5(md5(md5(mysqli_real_escape_string($con,$_POST['txtpass']))));


$sql = "SELECT * FROM users WHERE username = '".mysqli_real_escape_string($con,$_POST['txtusername'])."' AND password = '".$hashed_password."' ";

$query = mysqli_query($con,$sql) or die ("Error in query: $sql " . mysqli_error());
$result = mysqli_fetch_array($query);

$u_id = $result['id'];

date_default_timezone_set('Asia/Bangkok');
$last_login = date("Y-m-d H:i:s");

if ($result)
{
  if ($result['login_status'] == 1){
        echo "<script type='text/javascript' CHARSET='UTF-8'>";
        echo "alert('คุณได้เข้าสู่ระบบแล้ว --> " . $result['last_login'] ."');";
        echo "</script>";
        if($result["permission"]==1){header("location:/admin/dashboard");}
        else{header("location:../dashboard");}
  }else{
    $sql_updateLogin = "UPDATE users SET login_status = '1', last_login = '$last_login' WHERE id = '$u_id'";
    $qry_updateLogin = mysqli_query($con,$sql_updateLogin);
    
    $_SESSION["userid"] = $result["id"];
    $_SESSION["permission"] = $result["permission"];

    $log_username = $result["username"];
    $log_tname = $result["t_name"];

    date_default_timezone_set('Asia/Bangkok');
    $log_timestamp = date("Y-m-d H:i:s");

    $sql_log = "INSERT INTO login_log(username, t_name, timestamp)
    VALUES('$log_username', '$log_tname', '$log_timestamp')";

    $result_log = mysqli_query($con, $sql_log) or die ("Error in query: $sql " . mysqli_error());

    session_write_close();

    if($result["permission"]==1)
    {
        header("location:/admin/dashboard");
    }
    else
    {
        header("location:../dashboard");
    }
  }
  
}
else
{
        echo "<script type='text/javascript' CHARSET='UTF-8'>";
        echo "alert('ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ัง');";
        echo "window.location.replace('https://employee.dekcom-chamnong.com');";
        echo "</script>";
}
mysqli_close($con);

?>