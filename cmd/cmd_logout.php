<?php
    include 'connect.php';

    session_start();

    $u_id = $_SESSION['userid'];
    
    //update login status to default
    $sql_updateLogin = "UPDATE users SET login_status = '0' WHERE id = '$u_id'";
    $qry_updateLogin = mysqli_query($con,$sql_updateLogin);

    session_destroy();

    header("location:https://employee.dekcom-chamnong.com");
?>