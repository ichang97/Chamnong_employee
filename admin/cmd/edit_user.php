<?php
include 'connect.php';
header("content-type:text/html;charset=utf-8");

$salutation = $_POST["edit_salutation"];
$firstname = $_POST["edit_firstname"];
  $lastname = $_POST["edit_lastname"];
$edit_id = $_POST['edit_id'];
$citizen_id = $_POST['edit_citizen-id'];
$dob = $_POST['edit_dob'];
$religion = $_POST['edit_religion'];
$nation = $_POST['edit_nation'];
$full_address = $_POST['edit_address'];
$edu_level = $_POST['edit_edu-level'];
$edu_cert = $_POST['edit_edu-cert'];
$edu_major = $_POST['edit_major'];
$edu_minor = $_POST['edit_minor'];
$assign_date = $_POST['edit_assign-date'];
$assign_cert = $_POST['edit_assign-cert'];
$work_date = $_POST['edit_work-date'];
$obec_id = $_POST['edit_obec-id'];
$obec_province = $_POST['edit_obec-province'];
$obec_id_18 = $_POST['edit_obec-id-18'];
$pro = $_POST['edit_pro'];
$teach_class = $_POST['edit_teach-class'];
$subject = $_POST['edit_subject'];
$teach_hour = $_POST['edit_teach-hour'];
$check_tcert = $_POST['edit_check-tcert'];
$salary = $_POST['edit_salary'];
$other_income = $_POST['edit_other-income'];
$bookbank_id = $_POST['edit_bookbank-id'];
$bank_id = $_POST['edit_bank-id'];
$branch = $_POST['edit_branch'];
$position = $_POST['edit_position'];
$rfid = $_POST['edit_rfid'];
$time_start = $_POST['edit_start-time'];
$time_end = $_POST['edit_end-time'];
$status = $_POST['status'];



//search img
$sql_img = "select img from users where id = '$edit_id'"; $qry_img = mysqli_query($con,$sql_img);
$show_img = mysqli_fetch_array($qry_img); $img = $show_img['img'];



$file_namedoc = $_FILES['fileimg']['name'];

if ($file_namedoc != ""){
  
$pathdoc="../profile/";

$filedoc = strtolower($_FILES['fileimg']['name']);
$path_copydoc = $pathdoc.$file_namedoc;
$path_linkdoc = "../profile/" . $file_namedoc;

move_uploaded_file($_FILES['fileimg']['tmp_name'],$path_copydoc);
}else{
    $file_namedoc = $img;
}


    $sql_edit = "UPDATE users SET t_salutation = '$salutation', t_name = '$firstname', t_surname = '$lastname',
                 citizen_id = '$citizen_id', dob = '$dob', religion = '$religion', nationality = '$nation', full_address = '$full_address',
                 edu_level = '$edu_level', edu_cert = '$edu_cert', edu_major = '$edu_major' , edu_minor = '$edu_minor', assign_date = '$assign_date',
                 assign_cert = '$assign_cert', work_date = '$work_date', obec_id = '$obec_id', obec_province = '$obec_province', obec_id_18 = '$obec_id_18',
                 pro = '$pro', teach_class = '$teach_class', teach_hour = '$teach_hour', subject = '$subject', check_t_cert = '$check_tcert', salary = '$salary',
                 other_income = '$other_income', bookbank_id = '$bookbank_id', bank_id = '$bank_id', branch = '$branch', position = '$position', 
                 img = '$file_namedoc', rfid = '$rfid', time_start = '$time_start', time_end = '$time_end', status = '$status' WHERE id = '$edit_id'";
    $result = mysqli_query($con, $sql_edit) or die ("Error in query: $sql_edit " . mysqli_error());

        if($result){
            echo "<script type='text/javascript'>";
            echo "alert('บันทึกข้อมูลสำเร็จ !');";
            echo "window.location = '../user_list'; ";
            echo "</script>";
                }
    else{
        echo "<script type='text/javascript' CHARSET='UTF-8'>";
        echo "alert('ไม่สามารถบันทึกข้อมูลได้ กรุณาตรวจสอบข้อมูลอีกครั้ง');";
        echo "</script>";
            }   


mysqli_close($con);




?>