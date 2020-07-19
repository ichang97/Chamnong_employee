<?php
header("Content-type:application/json; charset=UTF-8");          
header("Cache-Control: no-store, no-cache, must-revalidate");         
header("Cache-Control: post-check=0, pre-check=0", false);

include("connect.php"); 


    $sql="SELECT * FROM qry_leave WHERE date(start_date)>='".$_GET['start']."'  ";  
    $sql.=" AND date(end_date)<='".$_GET['end']."' ";  

    $query = mysqli_query($con,$sql);
    $results = array();
  
  while($row = mysqli_fetch_array($query)){

    if($row['category'] == 1){
        $color = "#28a745";
    }
    if($row['category'] == 2){
        $color = "#007bff";
    }
    if($row['category'] == 3){
        $color = "#17a2b8";
    }
    if($row['category'] == 4){
        $color = "#dc3545";
    }

      $json_data[]=array(  
          'title' => $row['t_name'] . ' (' . $row['reason'] . ')',
          'description' => $row['reason'],
          'start' => $row['start_date'],
          'end' => date('Y-m-d', strtotime($row['end_date']. ' + 1 days')),
          'color' => $color,
      );    
  }  

$json= json_encode($json_data);  

if(isset($_GET['callback']) && $_GET['callback']!=""){  
echo $_GET['callback']."(".$json.");";      
}else{  
echo $json;  
}  

?>