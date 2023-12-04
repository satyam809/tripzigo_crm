<style>
.activity img.icon-info, .activity i.icon-info {
    color: #9ba7ca;
    background-color: #eef0f6;
}
.activity img.icon-info, .activity i.icon-info {
    color: #9ba7ca;
    background-color: #eef0f6;
}
.activity img, .activity i {
    width: 36px;
    height: 36px;
    text-align: center;
    line-height: 36px;
    border-radius: 12%;
    position: absolute;
    left: -19px;
    color: #4d79f6;
    background-color: #f3f6f7;
    font-size: 20px;
    margin-top: -10px;
    -webkit-box-shadow: 0px 0px 0px 0.5px #f3f6f7;
    box-shadow: 0px 0px 0px 0.5px #f3f6f7;
    -webkit-transform: rotate(45deg);
    transform: rotate(0deg);
}

.activity {
    position: relative;
    border-left: 3px dotted #eff2f9;
    margin: 20px 20px 0 22px;
}
.activity .item-info {
    margin-left: 40px;
    margin-bottom:15px;
}
</style>

<div class="row">
<div  style="position: relative; overflow: auto; width: 100%; padding-left: 10px; ">
<div class="activity">

<?php   
$rs=GetPageRecord('*','queryLogs',' queryId="'.$editresult['id'].'" order by id desc');
while($updatesdata=mysqli_fetch_array($rs)){ 

$b=GetPageRecord('*','sys_userMaster','id="'.$updatesdata['addedBy'].'"'); 
$prifiledata=mysqli_fetch_array($b);

if($prifiledata['userId']!='0'){ 
$c=GetPageRecord('*','sys_userMaster','id="'.$updatesdata['userId'].'"'); 
$assignTodata=mysqli_fetch_array($c);
}  



if($updatesdata['details']=='Query Created'){
$iconclass='mdi mdi-thumb-up icon-info';
}

if($updatesdata['details']=='Note Created'){
$iconclass='mdi mdi-note icon-info';
}

if($updatesdata['details']=='Task Created'){
$iconclass='mdi mdi-clock icon-info';
}

if($updatesdata['details']=='Query Update'){
$iconclass='mdi mdi-clipboard-alert icon-warning';
}

if($updatesdata['details']=='Assign Query'){
$iconclass='mdi mdi-account icon-purple';
}


if($updatesdata['logType']=='create_package'){
$iconclass='mdi mdi-checkbox-marked-circle-outline icon-success';
}

if($updatesdata['logType']=='create_quotation'){
$iconclass='mdi mdi-checkbox-marked-circle-outline icon-success';
}


if($updatesdata['logType']=='share_package' || $updatesdata['logType']=='share_invoice' || $updatesdata['logType']=='share_quotation'){
$iconclass='mdi mdi-email-check-outline icon-warning';
}

if($updatesdata['logType']=='status_change'){
$iconclass='mdi mdi-alert-decagram icon-purple';
}

if($updatesdata['logType']=='status_change'){
$iconclass='mdi mdi-alert-decagram icon-purple';
}


if($updatesdata['logType']=='supplier_payment'){
$iconclass='mdi mdi-tab-minus icon-warning';
}


if($updatesdata['logType']=='client_payment'){
$iconclass='mdi mdi-credit-card-plus icon-success';
}


if($updatesdata['logType']=='invoice_update'){
$iconclass='mdi mdi-check-box-multiple-outline icon-warning';
}

?> 

<i class="<?php echo $iconclass; ?>"></i>
<div class="time-item">
<div class="item-info" style="    border-bottom: 1px solid #f1eded;">
<div class="d-flex justify-content-between align-items-center">
<h6 class="m-0"><?php echo $updatesdata['details']; if($assignTodata['firstName']!=''){ ?> - to <?php echo $assignTodata['firstName']; } ?></h6>
<span class="text-muted"><?php echo date('j F Y h:i A',strtotime($updatesdata['dateAdded'])); ?></span>
</div>
<p class="text-muted mt-3" style="      margin-bottom: 5px;  margin-top: 0px !important; font-size:12px;">By: <?php echo $prifiledata['firstName']; ?></p>
<?php if($updatesdata['statusComment']!=''){ ?>
<p class="text-muted mt-3" style="      margin-bottom: 5px;  margin-top: 0px !important; font-size: 13px; font-weight: 600; color:#000 !important;"><?php echo stripslashes($updatesdata['statusComment']); ?></p>
<?php } ?>
<div>

</div>
</div>
</div>
<?php } ?>

																													 
</div> 
</div><div class="slimScrollBar" style="background: rgb(224, 229, 241); width: 7px; position: absolute; top: 0px; opacity: 1; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 511.17px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
</div>