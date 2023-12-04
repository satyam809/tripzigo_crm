<?php

include "inc.php";

/*
$scheduled_data = GetPageRecord('*', 'useractivities', 'status="scheduled"');

while ($scheduled_result = mysqli_fetch_array($scheduled_data)) {
    $break_end_time = date('Y-m-d H:i', strtotime($scheduled_result['break_end_time']));
    $current_time = date('Y-m-d H:i');
    if ($current_time >= $break_end_time){
        updatelisting('useractivities', 'status="processed"', 'id="'.$scheduled_result['id'].'"');
        $namevalue = 'onlineStatus=2,is_scheduled="no"';
        $where = 'id="' . $scheduled_result['user_id'] . '"';
        updatelisting('sys_userMaster', $namevalue, $where);
        echo "yes";
    }else{
        echo "no";
    }
}
*/
exit;