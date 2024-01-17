<?php 
include "inc.php"; 

$namevalue ='checkoutTime="'.date('Y-m-d H:i:s').'"';  
$where='uSession="'.$_SESSION['uSession'].'" and userId='.$_SESSION['userid'].'';   
updatelisting('userLogs',$namevalue,$where);  
 
$totaltimecount='0';
$totaltimecountfinal='0';

$rs=GetPageRecord('cLogin,checkoutTime','userLogs',' checkoutTime is not null and  userId="'.$_SESSION['userid'].'" and date(cLogin)="'.date('Y-m-d').'"');
while($rest=mysqli_fetch_array($rs)){ 

 

$to_time = strtotime($rest['checkoutTime']);
$from_time = strtotime($rest['cLogin']);
$totaltimecountfinal+=$totaltimecount=round(abs($to_time - $from_time) / 60,2);
$hours = intdiv($totaltimecount, 60).':'. ($totaltimecount % 60);  

$namevalue ='checkoutTime="'.date('Y-m-d H:i:s').'",totalMinutes="'.$totaltimecount.'"';
$where='uSession="'.$_SESSION['uSession'].'" and userId='.$_SESSION['userid'].'';   
updatelisting('userLogs',$namevalue,$where);  
}

$where = ' user_id="'.$_SESSION['userid'].'" and date(break_start_time)="'.date('Y-m-d').'" and status="scheduled"';

$rs=GetPageRecord('break_end_time,activity_type','userBreaks', $where);
$breaksfound=mysqli_num_rows($rs);
$actual_link = $_REQUEST['page'];

?>
<script>
    function canelSchedule(){
        $('#addBreakScheduleButton').replaceWith('<a style="color: orange;" id="cancelScheduleButton" onclick="cancelSchedule(\'<?php echo $rest['id']; ?>\')" href="javascript:void(0);"><i class="fa fa-clock-o" aria-hidden="true"></i></a>');

        $('#addBreakSchedule').replaceWith('<a style="color: orange;" href="javascript:void(0);" id="cancelSchedule" onclick="cancelSchedule(\'<?php echo $rest['id']; ?>\')"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;Schedule Break</a>');

        $('.status-circle').css({"background-color": "#ff6a00"});
    }

    function addBreakSchedule() {
        $('#cancelScheduleButton').replaceWith('<a href="javascript:void(0);" id="addBreakScheduleButton" onclick="loadpop(\'Schedule Break\',this,\'400px\')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=schedulebreak&userid=<?php echo $_SESSION['userid']; ?>&url=<?php echo $actual_link; ?>"><i class="fa fa-clock-o" aria-hidden="true"></i></a>');

        $('#cancelSchedule').replaceWith('<a href="javascript:void(0);" id="addBreakSchedule" onclick="loadpop(\'Schedule Break\',this,\'400px\')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=schedulebreak&userid=<?php echo $_SESSION['userid']; ?>&url=<?php echo $actual_link; ?>"><i class="fa fa-clock-o" aria-hidden="true"></i> &nbsp;Schedule Break</a>');

        $('.status-circle').css({"background-color": "#009900"});
    }
</script>
<?php

while($rest=mysqli_fetch_array($rs)){
    $break_end = strtotime($rest['break_end_time']);
    $scheduledminutes = (int)(($break_end - time())/60);
    $hours = sprintf("%02d",intdiv($scheduledminutes, 60)).':'. sprintf("%02d",($scheduledminutes % 60));
    if($break_end < time() || $scheduledminutes == 0){
        updatelisting('userBreaks', 'status="processed"', ' user_id="'.$_SESSION['userid'].'" and date(break_start_time)="'.date('Y-m-d').'" and status="scheduled"');
        ?>
        <script>
            addBreakSchedule();
        </script>
        <?php
    } else {
            ?>
            <script>
                var activitytype = '<?php echo $rest['activity_type']; ?>'
                var activitytype = activitytype[0].toUpperCase() + activitytype.slice(1)
                $('.activeactivitytype').html(activitytype)
                $('.showcurrentactivitytime').html('<?php  echo $hours; ?>')
            </script>
            <?php
    }

}

if($breaksfound==0){
    ?> <script>
        if(document.getElementById("cancelSchedule")){
            addBreakSchedule();
            $('.activeactivitytype').html('');
            $('.showcurrentactivitytime').html('');
        }
    </script> <?php
}

if($breaksfound){
    ?> <script>
        if(document.getElementById("addBreakSchedule")){
            canelSchedule();
        }
    </script> <?php
}

$a=GetPageRecord('SUM(totalMinutes) as totalMinutes','userLogs',' checkoutTime is not null and  userId="'.$_SESSION['userid'].'" and date(cLogin)="'.date('Y-m-d').'"');
$rest=mysqli_fetch_array($a);

$break_time = GetPageRecord('break_end_time', 'userBreaks', 'activity_type="break" and user_id="' . $_SESSION['userid'] . '" and date(userDate)="' . date('Y-m-d') . '"');
$break_rest=mysqli_fetch_array($break_time);

$breakmins=0;
if($break_rest && $break_rest['break_end_time']){
    $breaktimeseconds = strtotime($break_rest['break_end_time']) - strtotime('00:00:00');
    $breakmins =  round($breaktimeseconds/ 60);
}

$total_minutes = $rest['totalMinutes'] - $breakmins;

echo $hours = sprintf("%02d",intdiv($total_minutes, 60)).' Hrs : '. sprintf("%02d",($total_minutes % 60)).' Mins';

?> 