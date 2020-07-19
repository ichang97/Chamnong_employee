<?
session_start();
if($_SESSION['userid']=="")
{
  echo "Access Denied !!";
  exit();
}


header("Content-type:text/html; charset=UTF-8");                
include '../connect.php' ;
?>

<?php

$txt_year = $_POST['txt_year'];

//หาจำนวนสาย - กราฟ
$sql = "SELECT id,year,part,concat(t_name,' ',t_surname) as fullname, sum(late_count) as late_total FROM qry_latecount WHERE year = '$txt_year' 
GROUP BY id HAVING sum(late_count) <> 0 
ORDER BY late_total DESC,t_name LIMIT 5";
$qry = mysqli_query($con,$sql);

while ($show_latetotal = mysqli_fetch_array($qry))
{
    $labels[] = $show_latetotal['fullname'];
    $data[] = $show_latetotal['late_total'];
}

//หาจำนวนสาย - ตาราง
$sql_table = "SELECT id,year,part,concat(t_name,' ',t_surname) as fullname, sum(late_count) as late_total FROM qry_latecount WHERE year = '$txt_year' 
GROUP BY id HAVING sum(late_count) <> 0 
ORDER BY late_total DESC,t_name";
$qry_table = mysqli_query($con,$sql_table);

?>
<script>
    var ctx = document.getElementById("latetotal_chart");
    Chart.defaults.global.defaultFontFamily = 'Itim';
    Chart.helpers.merge(Chart.defaults.global.plugins.datalabels, {color: '#000000'});
  
    var latetotal_chart = new Chart(ctx, {
        //type: 'bar',
        //type: 'line',
        plugins: [ChartDataLabels],
        type: 'bar',
        data: {
          labels: <? echo json_encode($labels);?>,
            datasets: [{
                label: "จำนวนสาย",
                data: <? echo json_encode($data);?>,
                backgroundColor: 'rgba(255, 87, 51,1.0)',
            },
            ]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true,
                    }
                }]
            },
             responsive: true,
              plugins: {
                  datalabels: {
                      color: '#ffffff'
                  }
              }

        }
    });
    </script>

<div class="container">
  <h3 class="text-center">สรุปรายงานการลงเวลาทำงานในปีการศึกษา <? echo $txt_year ?></h3><br>
  <h5>จำนวนสายมากที่สุด 5 อันดับแรก</h5><br>
  <canvas id="latetotal_chart"></canvas>
</div>
<br>
<div class="container">
  <div class="table-responsive">
<table class="table table-hover">
<tr>
    <th class="text-center">#</th>
    <th class="text-center">ชื่อ - สกุล</th>
    <th class="text-center">จำนวนสาย (ครั้ง)</th>
</tr>
<? $i = 1;
while ($show_table = mysqli_fetch_array($qry_table)) { ?>
<tr>
    <td class="text-center"><? echo $i?></td>
  <td class="text-center"><a href="summary/cta_summary_detail_year?id=<? echo $show_table['id'] ?>&year=<? echo $show_table['year'] ?>" target="_blank"><? echo $show_table['fullname'] ?></a></td>
    <td class="text-center"><? echo $show_table['late_total'] ?></td>
</tr>
<?
$i++;
}
?>
</table>
</div>
</div>
