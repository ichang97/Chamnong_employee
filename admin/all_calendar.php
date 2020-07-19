<?php
session_start();
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

$title = "ปฏิทินรวม";
?>
<?php include 'header.php' ; ?>
<?php include 'main_menu.php' ; ?>
<br>

<script type="text/javascript">
$(function(){
  $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',  //  prevYear nextYea
            center: 'title',
            right: 'month,agendaWeek,agendaDay',
        },  
        buttonIcons:{
            prev: 'left-single-arrow',
            next: 'right-single-arrow',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow'         
        },       

        timezone: 'Asia/Bangkok',
        events: {
            url: 'asset/fullcalendar/data_events.php',
        },

        eventLimit:true,
        eventTextColor: '#ffffff',
        locale: 'th',
    });
  
  
    
});
</script>

<div class="container">
<div class="container">
<center><button type="button" class="btn btn-success">ลากิจ</button> <button type="button" class="btn btn-primary">ลาป่วย</button> <button type="button" class="btn btn-info">ลาคลอด</button> <button type="button" class="btn btn-danger">มาสาย</button></center><br>
<div id='calendar' ></div>
</div>
</div>

<?php include 'footer.php' ; ?>