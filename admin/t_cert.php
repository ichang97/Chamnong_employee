<?php
session_start();
include 'connect.php' ;

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

$title = "ใบประกอบวิชาชีพ";

$user_id = $_REQUEST['id'];

//แสดงชื่อ
$sql_name = "SELECT t_name FROM users WHERE id = '$user_id'";
$qry_name = mysqli_query($con,$sql_name);
$show_name = mysqli_fetch_array($qry_name);

//รายการใบประกอบวิชาชีพ
$sql_cert = "SELECT * FROM t_cert WHERE user_id = '$user_id' ORDER BY id ASC";
$qry_cert = mysqli_query($con,$sql_cert);

$num_cert = mysqli_num_rows($qry_cert);

function thaishortdate($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
	}

 function DateDiff($strDate1,$strDate2)
	 {
				return (strtotime($strDate2) - strtotime($strDate1))/  ( 60 * 60 * 24 );  // 1 day = 60*60*24
	 }

function datedifflong($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    
    $interval = date_diff($datetime1, $datetime2);
    
    return $interval->format($differenceFormat);
    
}

?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>

<div class="jumbotron bg-info text-white text-center">
  <h1><i class="fas fa-certificate"></i> รายการใบประกอบวิชาชีพ</h1><br>
  <a href="user_list" class="btn btn-primary"><i class="fas fa-arrow-left"></i> กลับ</a>
</div>

<div class="container">
  <a href="add_t-cert?id=<? echo $user_id ?>" class="btn btn-warning"><i class="fas fa-plus"></i> เพิ่มใบประกอบวิชาชีพ</a>
</div>
<br>

<div class="container">
  <? if ($num_cert == 0) : ?>
  <div class="alert alert-danger text-center" role="alert">
    ไม่มีข้อมูลใบประกอบวิชาชีพ
  </div>
  <? else : ?>
  <table class="table table-hover text-center">
    <tr>
      <th scope="col">#</th>
      <th scope="col">ประเภทใบอนุญาต</th>
      <th scope="col">เลขที่ใบอนุญาต</th>
      <th scope="col">วันที่ออกให้</th>
      <th scope="col">วันที่หมดอายุ</th>
      <th scope="col">สถานะ</th>
      <th scope="col">แก้ไข / ลบ</th>
    </tr>
     <?
  $i = 1;
  while ($show_cert = mysqli_fetch_array($qry_cert)) { ?>
    <tr>
      <td><? echo $i ?></td>
      <td>
      <?php
			$strSQL = "SELECT * FROM t_cert_cate WHERE id = '" . $show_cert['cert_cate'] . "' ORDER BY id ASC";
			$objQuery = mysqli_query($con,$strSQL);
      $show_cert_cate = mysqli_fetch_array($objQuery);
     
      echo $show_cert_cate['cate_name'];
			?>
      </td>
      <td><? echo $show_cert['cert_id'] ?></td>
      <td><? echo thaishortdate($show_cert['valid_date']) ?></td>
      <td><? echo thaishortdate($show_cert['exp_date']) ?></td>
      <td>
      <?
        $cur_date = date("Y-m-d");
        $exp_date = $show_cert['exp_date'];
                                                      
        $diff = DateDiff($cur_date,$exp_date);                                  
      ?>
      <? if ($diff <= 180) : ?>
        <i class="fas fa-times" style="color: red"></i> ใกล้หมดอายุหรือหมดอายุแล้ว กรุณาต่ออายุใบประกอบวิชาชีพ
        <br>
        เหลืออีก <? echo datedifflong($show_cert['exp_date'],date("Y-m-d"),"%y ปี %m เดือน %d วัน") ?>
      <? else : ?>
        <i class="fas fa-check" style="color: green"></i> ปกติ
      <? endif ?>
      </td>
      <td>
      <a class="btn btn-warning" href="edit_t-cert?id=<? echo $show_cert['id'] ?>&user_id=<? echo $user_id ?>"><i class="fas fa-edit"></i></a>
      <a class="btn btn-danger" href="JavaScript:if(confirm('คุณต้องการลบหรือไม่ ?') == true){window.location='cmd/delete_t-cert.php?id=<?php echo $show_cert['id']; ?>&user_id=<? echo $user_id ?>';}"><i class="fas fa-trash-alt"></i></a>
      </td>
    </tr>
    <? 
    $i++;
    } 
    ?>
  </table>
  <? endif ?>
</div>






<?php include 'footer.php' ; ?>