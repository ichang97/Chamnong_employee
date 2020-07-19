<?php
session_start();
header("Content-type:application/json; charset=UTF-8");          

header("Cache-Control: no-store, no-cache, must-revalidate");         

header("Cache-Control: post-check=0, pre-check=0", false);



include("connect.php"); 


    $sql="SELECT * FROM qry_leavedoc ";  
    $sql.="WHERE userid = '".$_SESSION["userid"]."'";    



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

          'title' => $row['reason'],

          'start' => $row['start_date'],

          'end' => date('Y-m-d', strtotime($row['end_date']. ' + 1 days')),

          'color' => $color,

          'allDay'=>true

      );    

  }  



$json= json_encode($json_data);  



if(isset($_GET['callback']) && $_GET['callback']!=""){  

echo $_GET['callback']."(".$json.");";      

}else{  

echo $json;  

}  



?>