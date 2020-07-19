<?php
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}
include 'connect.php';
header("content-type:text/html;charset=utf-8");

    $username = $_POST["edit_username"];
    $password = $_POST["edit_pass"];
    $hashed_password = md5(md5(md5($password)));
    $salutation = $_POST["edit_salutation"];
    $firstname = $_POST["edit_firstname"];
	$lastname = $_POST["edit_lastname"];
    $edit_id = $_POST['edit_id'];

    $sql_edit = "UPDATE users SET username = '$username', password = '$hashed_password', t_salutation = '$salutation', t_name = '$firstname', t_surname = '$lastname' WHERE id = '$edit_id'";
    $result = mysqli_query($con, $sql_edit) or die ("Error in query: $sql_edit " . mysqli_error());

        if($result){
            echo "<script type='text/javascript' charset='utf-8'>";
            echo "alert('บันทึกข้อมูลสำเร็จ !');";
            echo "window.location = '../my_detail'; ";
            echo "</script>";
                }
    else{
        echo "<script type='text/javascript' charset='utf-8'>";
        echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
        echo "</script>";
            }   


mysqli_close($con);




?>