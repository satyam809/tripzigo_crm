<?php //echo 'test' . $_SERVER['REMOTE_PORT'];
//die; ?>
<div>
    <select name="activityType" id="activityType" onchange="openModal(this.value)">
        <option selected>Working</option>
        <option value="1">Break</option>
        <option value="2">Meeting</option>
        <option value="3">Feedback</option>
        <option value="4">Training</option>
    </select>



    <span id="currentworkinghours">
        <span class="badge badge-primary">Working Hours:</span>
        <span id="startWorkingHours"></span>
        <!-- <strong class="showcurrentworkinghours">0</strong> -->
    </span>
    <!-- <span class="badge badge-primary activeactivitytype"></span>
    <strong class="showcurrentactivitytime" style="padding: 5px;"></strong> -->
</div>
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <p id="activityText"></p>
                    <p id="displayTime">00:00:00</p>
                    <button class="btn btn-success" style="display: inline;" onClick="startActivity()" id="startButton">Start</button>
                    <button class="btn btn-danger" style="display: inline;" onClick="stopActivity()" id="stopButton">Stop</button>
                </div>

            </div>

        </div>

    </div>
</div>
<script>
    let activityType;
    let dataSent = false;
    let insertedId;
    let intervalID;

    function openModal(selectElement) {
        document.getElementById('startButton').disabled = false;
        document.getElementById('stopButton').disabled = true;
        $("#displayTime").text("00:00:00");
        clearInterval(intervalID);
        activityType = selectElement;
        if (selectElement == '1') {
            $("#activityText").text("Click on start button to start break and stop button to stop break");
            $("#myModal1").modal();
        } else if (selectElement == '2') {
            $("#activityText").text("Click on start button to start meeting and stop button to stop meeting");
            $("#myModal1").modal();
        } else if (selectElement == '3') {
            $("#activityText").text("Click on start button to start feedback and stop button to stop feedback");
            $("#myModal1").modal();
        } else if (selectElement == '4') {
            $("#activityText").text("Click on start button to start training and stop button to stop training");
            $("#myModal1").modal();
        }
    }

    function startActivity() {
        document.getElementById('startButton').disabled = true;
        document.getElementById('stopButton').disabled = false;
        $.ajax({
            url: 'working-hrs.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
                'activity': 'start',
                'activityType': parseInt(activityType)
            },
            success: function(response) {
                // Handle success if needed
                //console.log(response.data);
                insertedId = response.data.id;
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error if needed
                console.error(xhr.responseText);
            }
        });
        intervalID = setInterval(updateTime, 1000);
        updateTime();
    }

    function updateTime() {
        const now = new Date();
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const seconds = now.getSeconds();
        const formattedMinutes = minutes < 10 ? `0${minutes}` : minutes;
        const formattedSeconds = seconds < 10 ? `0${seconds}` : seconds;
        const currentTime = `${hours}:${formattedMinutes}:${formattedSeconds}`;
        document.getElementById("displayTime").textContent = currentTime;
    }

    function stopActivity() {
        document.getElementById('stopButton').disabled = true;
        $.ajax({
            url: 'working-hrs.php',
            method: 'POST',
            dataType: 'JSON',
            data: {
                'activity': 'stop',
                'activityType': parseInt(activityType),
                'insertedId': insertedId
            },
            success: function(response) {
                if (response.status == true) {
                    $("#myModal1").modal('hide');
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle error if needed
                console.error(xhr.responseText);
            }
        });
    }
</script>


<script>
    function setTimerFromSeconds(totalSeconds) {
        const hours = Math.floor(totalSeconds / 3600);
        const minutes = Math.floor((totalSeconds % 3600) / 60);
        const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}`;
        document.getElementById("startWorkingHours").innerText = formattedTime;
    }

    function updateWorkingHour() {
        $.ajax({
            url: `working-hrs.php`,
            method: 'POST',
            dataType: 'JSON',
            data: {
                working_hour: 1
            },
            success: function(result) {
                //console.log(result);
                if (result.status === true) {
                    const totalSeconds = parseInt(result.data) * 60;
                    setTimerFromSeconds(totalSeconds);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error occurred:", error);
            }
        });
    }
    updateWorkingHour();
    setInterval(updateWorkingHour, 1000);
</script>