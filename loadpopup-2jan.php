<?php
include "inc.php";


$a=GetPageRecord('*','sys_userMaster','  id="'.$_SESSION['userid'].'"'); 
$invoiceData=mysqli_fetch_array($a);

$abc=GetPageRecord('*','sys_userMaster','id=1'); 
$companynamedata=mysqli_fetch_array($abc); 
?> 


<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: ".editorclass",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>

<?php if($_REQUEST['action']=='addstaff' ){
  
$a=GetPageRecord('*','sys_userMaster','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
 
  ?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>




 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">First Name </label>
  <input type="text" class="form-control" required="" name="firstName" value="<?php echo stripslashes($result['firstName']); ?>" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Last Name </label>
  <input type="text" class="form-control" required="" name="lastName" value="<?php echo stripslashes($result['lastName']); ?>" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Email (Username)</label>
  <input type="text" class="form-control" required="" name="email" value="<?php echo stripslashes($result['email']); ?>" >
</div></div>
 
 
 
<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Role</label>
    <select name="userType" class="form-control">   
		<option value="1" <?php if($result["userType"]==1){ ?> selected="selected" <?php } ?>>Team</option> 
		<option value="2" <?php if($result["userType"]==2){ ?> selected="selected" <?php } ?>>Agent</option> 
		</select>
</div></div>

<div class="col-md-6"> 
<label for="example-text-input" class="col-md-1 col-form-label">Active</label>
<div class="col-md-10">
<input name="status" type="checkbox" id="switch3" value="1" switch="bool" <?php if($result['status']==1 || $result['status']==''){ ?>checked<?php } ?>/>
<label for="switch3" data-on-label="Yes" data-off-label="No" style="margin-top: 6px;"></label> 
</div>
</div>
  
</div>   
</div>
 
<?php if($_REQUEST['id']!=''){ ?>
<div class="form-group row">
<label for="example-text-input" class="col-md-12 col-form-label" style="padding-left: 30px;"><input name="sendpass" type="checkbox" id="sendpass" value="1" />&nbsp;&nbsp;Reset and send temporary password to mail</label>
 
</div>
<?php } ?>
<div class="modal-footer"> 
<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="addstaff" /> 
<input name="editId" type="hidden" id="" value="<?php echo $_REQUEST['id']; ?>" />
</form>
		 
<?php } ?>


<?php if($_REQUEST['action']=='setlogoandinclusion' ){
  
$a=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" order by id desc');  
$result=mysqli_fetch_array($a);
 
  ?>





 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
	<div class="modal-body">			
	<div class="row">
	<div class="col-md-12">
	<div class="form-group">
	<label>Itinerary logo </label>
	<div class="custom-file">
	<input name="changeprofilepic" type="file" class="custom-file-input" id="customFile">
	<input name="oldchangeprofilepic" type="hidden" value="<?php echo $result['invoiceLogo']; ?>" >
	<label class="custom-file-label" for="customFile">Choose file</label>
	</div>
	</div>
	</div>
<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Inclusion / Exclusion </label>
  <textarea name="inclusion" rows="5" class="form-control editorclass" required=""><?php echo stripslashes($result['inclusion']); ?></textarea>
</div></div>
 
  
</div>   
</div>
 
 >
<div class="modal-footer"> 
<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="setlogoandinclusion" />  
</form>
		 
<?php } ?>



<?php if($_REQUEST['action']=='organisationsettings' ){
  
$a=GetPageRecord('*','sys_userMaster','id="'.($_SESSION['userid']).'" order by id desc');  
$result=mysqli_fetch_array($a);
 
  ?> 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Organisation name </label>
  <input name="invoiceCompany" type="text" class="form-control" id="invoiceCompany" value="<?php echo stripslashes($result['invoiceCompany']); ?>" required="" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Email </label>
  <input type="text" class="form-control" required="" name="invoiceEmail" value="<?php echo stripslashes($result['invoiceEmail']); ?>" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Phone</label>
  <input type="text" class="form-control" required="" name="invoicePhone" value="<?php echo stripslashes($result['invoicePhone']); ?>" >
</div></div>

 
 <div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Address</label>
  <input type="text" class="form-control" required="" name="invoiceAddress" value="<?php echo stripslashes($result['invoiceAddress']); ?>" >
</div></div>
 
 <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">GSTN</label>
  <input type="text" class="form-control" required="" name="Invoicegstn" value="<?php echo stripslashes($result['Invoicegstn']); ?>" >
</div></div>
 

 
  
</div>   
</div>
 
<div class="modal-footer"> 
<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="organisationsettings" />  
</form>
		 
<?php } ?>










<?php if($_REQUEST['action']=='addtineraries' ){
  
$a=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Itinerary name*
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['name']); ?>" required="" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Start date* </label>   
  <input type="text" class="form-control" required="" name="startDate"  id="startDate" value="<?php if($result['startDate']!=''){ echo date('d-m-Y',strtotime($result['startDate'])); } else { echo date('d-m-Y'); } ?>" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">End date*</label>
  <input type="text" class="form-control" required="" name="endDate"  id="endDate" value="<?php if($result['endDate']!=''){  echo date('d-m-Y',strtotime($result['endDate'])); } else { echo date('d-m-Y'); } ?>" >
</div></div>



<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">Adult</label>
  <input type="number" min="1" class="form-control"  name="adult"   value="<?php if($result['adult']<1){ echo '1'; } else {  echo $result['adult']; }  ?>" >
</div></div>

<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">Child</label>
  <input type="number" min="0" class="form-control"  name="child"   value="<?php echo $result['child']; ?>" >
</div></div>


 
 <div class="col-md-8"> 
<div class="form-group">
<label for="validationCustom02">Destinations <Span style="font-size:11px; color:#999999;"> - Enter comma separated destinations</Span></label>
  <input type="text"   class="form-control"  name="destinations"   value="<?php echo stripslashes($result['destinations']); ?>" >
</div></div>
 
 

 <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Notes</label><div style="font-size:11px; color:#999999; margin-bottom:10px;">Notes will not appear in your itinerary; they can only be viewed by you,<br />
 your team and any contributors you invite</div>
  <textarea name="notes" rows="2" class="form-control" ><?php echo stripslashes($result['notes']); ?></textarea>
</div></div>
  
</div>   
</div>
 
<div class="modal-footer">  

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  />
</div>

<input name="action" type="hidden" id="action" value="addtineraries" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>


<script>

$( function() {

   $('#startDate').datepicker(
     { 
	  dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#endDate').val());
      }
   });
  $('#endDate').datepicker(
     {
	 dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#startDate').val());
        if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);                             
     }
   });

  } );

</script> 
<?php } ?> 





<?php if($_REQUEST['action']=='confirmitineararies' && $_REQUEST['id']!=''){ 
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12" style="text-align:center;"> 
<h4>You are about to confirm an itinerary</h4> 

This action cannot be undone.
 </div> 

  
  
</div>   
</div>
 
<div class="modal-footer">  
<button type="submit" class="btn btn-success waves-effect waves-light">Confirm itinerary</button>
</div>

<input name="action" type="hidden" id="action" value="confirmitineararies" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
</form>


  
<?php } ?> 







<?php if($_REQUEST['action']=='addAccommodation' && $_REQUEST['pid']!='' && $_REQUEST['d']!=''){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Hotel Name
</label>
  <input name="hotelName" type="text" class="form-control" value="<?php echo stripslashes($result['name']); ?>" required="" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Category
</label>
<select name="hotelCategory" class="form-control">
  <option value="3" <?php if($result['hotelCategory']==3){ ?>selected="selected"<?php } ?>>3 Star</option>
  <option value="4" <?php if($result['hotelCategory']==4){ ?>selected="selected"<?php } ?>>4 Star</option>
  <option value="5" <?php if($result['hotelCategory']==5){ ?>selected="selected"<?php } ?>>5 Star</option>
</select> 
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Room Name
</label>
  <input name="hotelRoom" type="text" class="form-control" value="<?php echo stripslashes($result['hotelRoom']); ?>" required="" >
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Meal Plan
</label>
  <input name="mealPlan" type="text" class="form-control" value="<?php echo stripslashes($result['mealPlan']); ?>"   >
</div></div>

<div class="row" style="background:#f7f7f7;  padding: 10px; width: 100%; margin: auto; border: 1px solid #cccccc; margin: 10px 10px; border-radius: 4px;">
<div style="margin-bottom:10px; width:100%;    padding-left: 10px;"><strong>Enter Number of Rooms</strong></div>
<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">Single 
</label>
  <input name="singleRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['singleRoom']); ?>"   >
</div></div>

<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">Double 
</label>
  <input name="doubleRoom" type="Number" min="0" class="form-control" value="<?php if($result['doubleRoom']==''){ echo '1'; }  echo stripslashes($result['doubleRoom']); ?>"   >
</div></div>

<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">Triple 
</label>
  <input name="tripleRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['tripleRoom']); ?>"   >
</div></div>



<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">Quad
</label>
  <input name="quadRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['quadRoom']); ?>"   >
</div></div>

<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">CWB
</label>
  <input name="cwbRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['cwbRoom']); ?>"   >
</div></div>

<div class="col-md-2"> 
<div class="form-group">
<label for="validationCustom02">CNB
</label>
  <input name="cnbRoom" type="Number" min="0" class="form-control" value="<?php echo stripslashes($result['cnbRoom']); ?>"   >
</div></div>
</div>


<div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Check-in date* </label>
  <input type="text" class="form-control" required="" name="startDate"  id="startDate" value="<?php echo date('d-m-Y',strtotime($_REQUEST['d']));  ?>" >
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Check-in time</label>
    <input name="checkIn" type="text" class="form-control" value="<?php if($result['checkIn']!=''){ echo stripslashes($result['checkIn']);  } else { echo '12 PM'; }?>"   >
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Check-out date*</label>
  <input type="text" class="form-control" required="" name="endDate"  id="endDate" value="<?php if($result['endDate']!=''){  echo date('d-m-Y',strtotime($result['endDate'])); } else { echo date('d-m-Y',strtotime($_REQUEST['d'])); } ?>" >
</div></div>

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Check-out time</label>
    <input name="checkOut" type="text" class="form-control" value="<?php if($result['checkOut']!=''){ echo stripslashes($result['checkOut']); } else { echo '10 AM'; } ?>"   >
</div></div>

</div> 



<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Description
</label>
  <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
</div></div>
  
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
<?php if($_REQUEST['id']!=''){ ?> 
<button  type="button" class="btn btn-danger waves-effect waves-light"  style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
<?php } ?>

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="addAccommodation" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
<input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
</form>


<script>

function dlt(id,pid){
if(confirm('Are you sure your want to delete?')){ 
$('#ActionDiv').load('actionpage.php?did='+id+'&action=delteevent&pid='+pid);
}

}


$( function() {

   $('#startDate').datepicker(
     { 
	  dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#endDate').val());
      }
   });
  $('#endDate').datepicker(
     {
	 dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#startDate').val());
        if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);                             
     }
   });

  } );

</script> 
<?php } ?> 




<?php if($_REQUEST['action']=='addActivity' && $_REQUEST['pid']!='' && $_REQUEST['d']!=''){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Name
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['name']); ?>" required="" >
</div></div>
 

<div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Date* </label>
  <input type="text" class="form-control" required="" name="startDate"  id="startDate" value="<?php echo date('d-m-Y',strtotime($_REQUEST['d']));  ?>" >
</div></div>


<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Start time</label>
    <input name="checkIn" id="checkIn" type="text" class="form-control" value="<?php if($result['checkIn']!=''){ echo stripslashes($result['checkIn']);  } else { echo '1:00pm'; }?>"   >
</div></div>
 
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">End time</label>
    <input name="checkOut" id="checkOut" type="text" class="form-control" value="<?php if($result['checkOut']!=''){ echo stripslashes($result['checkOut']); } else { echo '2:00pm'; } ?>"   >
</div></div>

</div> 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Description
</label>
  <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
</div></div>
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
<?php if($_REQUEST['id']!=''){ ?> 
<button  type="button" class="btn btn-danger waves-effect waves-light"  style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
<?php } ?>

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="addActivity" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
<input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" /></form>


<script>

function dlt(id,pid){
if(confirm('Are you sure your want to delete?')){ 
$('#ActionDiv').load('actionpage.php?did='+id+'&action=delteevent&pid='+pid);
}

}


$( function() {

   $('#startDate').datepicker(
     { 
	  dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#endDate').val());
      }
   });
  $('#endDate').datepicker(
     {
	 dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#startDate').val());
        if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);                             
     }
   });

  } );

</script> 
<?php } ?> 




<?php if($_REQUEST['action']=='addTransportation' && $_REQUEST['pid']!='' && $_REQUEST['d']!=''){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Name
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['name']); ?>" required="" >
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Transfer Type
</label>
<select name="transferCategory" class="form-control">
  <option value="Private" <?php if($result['transferCategory']=='Private'){ ?>selected="selected"<?php } ?>>Private</option>
  <option value="SIC" <?php if($result['transferCategory']=='SIC'){ ?>selected="selected"<?php } ?>>SIC</option> 
</select> 
</div></div>
 

<div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Date* </label>
  <input type="text" class="form-control" required="" name="startDate"  id="startDate" value="<?php echo date('d-m-Y',strtotime($_REQUEST['d']));  ?>" >
</div></div>


<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Start time</label>
    <input name="checkIn" id="checkIn" type="text" class="form-control" value="<?php if($result['checkIn']!=''){ echo stripslashes($result['checkIn']);  } else { echo '1:00pm'; }?>"   >
</div></div>
 
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">End time</label>
    <input name="checkOut" id="checkOut" type="text" class="form-control" value="<?php if($result['checkOut']!=''){ echo stripslashes($result['checkOut']); } else { echo '2:00pm'; } ?>"   >
</div></div>

</div> 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Description
</label>
  <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
</div></div>
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
<?php if($_REQUEST['id']!=''){ ?> 
<button  type="button" class="btn btn-danger waves-effect waves-light"  style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
<?php } ?>

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="addTransportation" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" /><input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
</form>


<script>

function dlt(id,pid){
if(confirm('Are you sure your want to delete?')){ 
$('#ActionDiv').load('actionpage.php?did='+id+'&action=delteevent&pid='+pid);
}

}


$( function() {

   $('#startDate').datepicker(
     { 
	  dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#endDate').val());
      }
   });
  $('#endDate').datepicker(
     {
	 dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#startDate').val());
        if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);                             
     }
   });

  } );

</script> 
<?php } ?> 



 <?php if($_REQUEST['action']=='addFeesInsurance' && $_REQUEST['pid']!='' && $_REQUEST['d']!=''){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Name
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['name']); ?>" required="" >
</div></div>
 

<div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Date* </label>
  <input type="text" class="form-control" required="" name="startDate"  id="startDate" value="<?php echo date('d-m-Y',strtotime($_REQUEST['d']));  ?>" >
</div></div>


 
 
 

</div> 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Description
</label>
  <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
</div></div>
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
<?php if($_REQUEST['id']!=''){ ?> 
<button  type="button" class="btn btn-danger waves-effect waves-light"  style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
<?php } ?>

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="addFeesInsurance" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
<input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" /></form>


<script>

function dlt(id,pid){
if(confirm('Are you sure your want to delete?')){ 
$('#ActionDiv').load('actionpage.php?did='+id+'&action=delteevent&pid='+pid);
}

}


$( function() {

   $('#startDate').datepicker(
     { 
	  dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#endDate').val());
      }
   });
  $('#endDate').datepicker(
     {
	 dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#startDate').val());
        if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);                             
     }
   });

  } );

</script> 
<?php } ?> 


<?php if($_REQUEST['action']=='addMeal' && $_REQUEST['pid']!='' && $_REQUEST['d']!=''){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Name
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['name']); ?>" required="" >
</div></div>


<div class="col-md-6"> 
<div class="form-group">
<label for="validationCustom02">Meal Type
</label>
<select name="mealCategory" class="form-control">
  <option value="Breakfast" <?php if($result['mealCategory']=='Breakfast'){ ?>selected="selected"<?php } ?>>Breakfast</option>
  <option value="Lunch" <?php if($result['mealCategory']=='Lunch'){ ?>selected="selected"<?php } ?>>Lunch</option> 
  <option value="Dinner" <?php if($result['mealCategory']=='Dinner'){ ?>selected="selected"<?php } ?>>Dinner</option> 
</select> 
</div></div>
 

<div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Date* </label>
  <input type="text" class="form-control" required="" name="startDate"  id="startDate" value="<?php echo date('d-m-Y',strtotime($_REQUEST['d']));  ?>" >
</div></div>


<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Start time</label>
    <input name="checkIn" id="checkIn" type="text" class="form-control" value="<?php if($result['checkIn']!=''){ echo stripslashes($result['checkIn']);  } else { echo '1:00pm'; }?>"   >
</div></div>
 
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">End time</label>
    <input name="checkOut" id="checkOut" type="text" class="form-control" value="<?php if($result['checkOut']!=''){ echo stripslashes($result['checkOut']); } else { echo '2:00pm'; } ?>"   >
</div></div>

</div> 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Description
</label>
  <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
</div></div>
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
<?php if($_REQUEST['id']!=''){ ?> 
<button  type="button" class="btn btn-danger waves-effect waves-light"  style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
<?php } ?>

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="addMeal" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" /><input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
</form>


<script>

function dlt(id,pid){
if(confirm('Are you sure your want to delete?')){ 
$('#ActionDiv').load('actionpage.php?did='+id+'&action=delteevent&pid='+pid);
}

}


$( function() {

   $('#startDate').datepicker(
     { 
	  dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#endDate').val());
      }
   });
  $('#endDate').datepicker(
     {
	 dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#startDate').val());
        if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);                             
     }
   });

  } );

</script> 
<?php } ?> 



<?php if($_REQUEST['action']=='addOther' && $_REQUEST['pid']!='' && $_REQUEST['d']!=''){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Name
</label>
  <input name="name" type="text" class="form-control" id="name" value="<?php echo stripslashes($result['name']); ?>" required="" >
</div></div>


 
 

<div class="row" style="background: rgb(254, 250, 235); border-color: #f7d038; padding: 10px; width: 100%; margin: auto; border: 1px solid #ffd17e; margin: 10px 10px; border-radius: 4px;">
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Date* </label>
  <input type="text" class="form-control" required="" name="startDate"  id="startDate" value="<?php echo date('d-m-Y',strtotime($_REQUEST['d']));  ?>" >
</div></div>


<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">Start time</label>
    <input name="checkIn" id="checkIn" type="text" class="form-control" value="<?php if($result['checkIn']!=''){ echo stripslashes($result['checkIn']);  } else { echo '1:00pm'; }?>"   >
</div></div>
 
<div class="col-md-4"> 
<div class="form-group">
<label for="validationCustom02">End time</label>
    <input name="checkOut" id="checkOut" type="text" class="form-control" value="<?php if($result['checkOut']!=''){ echo stripslashes($result['checkOut']); } else { echo '2:00pm'; } ?>"   >
</div></div>

</div> 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Description
</label>
  <textarea name="description" rows="5" class="editorclass"><?php echo stripslashes($result['description']); ?></textarea>
</div></div>
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
<?php if($_REQUEST['id']!=''){ ?> 
<button  type="button" class="btn btn-danger waves-effect waves-light"  style="position: absolute; left: 10px;" onclick=" dlt('<?php echo $_REQUEST['id']; ?>','<?php echo $_REQUEST['pid']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
<?php } ?>

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="addOther" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" /><input name="packageDays" type="hidden" id="packageDays" value="<?php echo $_REQUEST['packageDays']; ?>" />
</form>


<script>

function dlt(id,pid){
if(confirm('Are you sure your want to delete?')){ 
$('#ActionDiv').load('actionpage.php?did='+id+'&action=delteevent&pid='+pid);
}

}


$( function() {

   $('#startDate').datepicker(
     { 
	  dateFormat: 'dd-mm-yy',
        minDate: 0,
        beforeShow: function() {
        $(this).datepicker('option', 'maxDate', $('#endDate').val());
      }
   });
  $('#endDate').datepicker(
     {
	 dateFormat: 'dd-mm-yy',
        defaultDate: "+1w",
        beforeShow: function() {
        $(this).datepicker('option', 'minDate', $('#startDate').val());
        if ($('#startDate').val() === '') $(this).datepicker('option', 'minDate', 0);                             
     }
   });

  } );

</script> 
<?php } ?> 




<!---------------------Pricing--------------->




<?php if($_REQUEST['action']=='editpricing' && $_REQUEST['sectionType']!='' && $_REQUEST['id']!='' && $_REQUEST['pid']!=''  && trim($_REQUEST['sectionType'])!='Accommodation'){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row"> 
 
<?php if($result['transferCategory']=='Private'){ ?>

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">No. of Vehicle</label>
      <input name="vehicle" type="number" min="1" class="form-control"   value="<?php if($result['vehicle']!=''){ echo stripslashes($result['vehicle']);  } else { echo '1'; }?>"   >
</div></div>


<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Per Vehicle Cost</label>
    <input name="adultCost" type="number" min="0" class="form-control"   value="<?php if($result['adultCost']!=''){ echo stripslashes($result['adultCost']);  } else { echo '0'; }?>"   >
</div></div>
 


<?php } else { ?>
<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Per Adult Cost</label>
    <input name="adultCost" type="number" min="0" class="form-control" id="adultCost" value="<?php if($result['adultCost']!=''){ echo stripslashes($result['adultCost']);  } else { echo '0'; }?>"   >
</div></div>
 
<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Per Child Cost</label>
      <input name="childCost" type="number" min="0" class="form-control" id="childCost" value="<?php if($result['childCost']!=''){ echo stripslashes($result['childCost']);  } else { echo '0'; }?>"   >
</div></div>
 <?php } ?>


<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Markup %</label>
      <input name="markupPercent" type="number" min="0" class="form-control" id="markupPercent" value="<?php if($result['markupPercent']!=''){ echo stripslashes($result['markupPercent']);  } else { echo '0'; }?>"   >
</div></div>


</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
 

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="editpricing" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden"  value="<?php echo $_REQUEST['pid']; ?>" />
</form>


 
<?php } ?> 





<?php if($_REQUEST['action']=='editpricing' && $_REQUEST['sectionType']!='' && $_REQUEST['id']!='' && $_REQUEST['pid']!=''  && trim($_REQUEST['sectionType'])=='Accommodation'){

if($_REQUEST['id']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','id="'.decode($_REQUEST['id']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row"> 
 
 
 
 <?php if($result['singleRoom']>0){ ?>
 
<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Per Single Room Cost</label>
    <input name="singleRoomCost" type="number" min="0" class="form-control"  value="<?php if($result['singleRoomCost']!=''){ echo stripslashes($result['singleRoomCost']);  } else { echo '0'; }?>"   >
</div></div>
 
 <?php } ?>
 
  <?php if($result['doubleRoom']>0){ ?>
 
 <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Per Double Room Cost</label>
    <input name="doubleRoomCost" type="number" min="0" class="form-control"   value="<?php if($result['doubleRoomCost']!=''){ echo stripslashes($result['doubleRoomCost']);  } else { echo '0'; }?>"   >
</div></div>
 <?php } ?>


<?php if($result['tripleRoom']>0){ ?>
 <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Per Triple Room Cost</label>
    <input name="tripleRoomCost" type="number" min="0" class="form-control"  value="<?php if($result['tripleRoomCost']!=''){ echo stripslashes($result['tripleRoomCost']);  } else { echo '0'; }?>"   >
</div></div>
<?php } ?>



<?php if($result['quadRoom']>0){ ?>
 <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Per Quad Room Cost</label>
    <input name="quadRoomCost" type="number" min="0" class="form-control"  value="<?php if($result['quadRoomCost']!=''){ echo stripslashes($result['quadRoomCost']);  } else { echo '0'; }?>"   >
</div></div>
<?php } ?>


<?php if($result['cwbRoom']>0){ ?> 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">CWB  Room Cost</label>
    <input name="cwbRoomCost" type="number" min="0" class="form-control"   value="<?php if($result['cwbRoomCost']!=''){ echo stripslashes($result['cwbRoomCost']);  } else { echo '0'; }?>"   >
</div></div>
<?php } ?>

<?php if($result['cnbRoom']>0){ ?> 
  <div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">CNB Room Cost</label>
    <input name="cnbRoomCost" type="number" min="0" class="form-control"   value="<?php if($result['cnbRoomCost']!=''){ echo stripslashes($result['cnbRoomCost']);  } else { echo '0'; }?>"   >
</div></div>
<?php } ?>
 


<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Markup %</label>
      <input name="markupPercent" type="number" min="0" class="form-control" id="markupPercent" value="<?php if($result['markupPercent']!=''){ echo stripslashes($result['markupPercent']);  } else { echo '0'; }?>"   >
</div></div>


</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
 

<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="editpricingAccommodation" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['id']; ?>" />
<input name="pid" type="hidden"  value="<?php echo $_REQUEST['pid']; ?>" />
</form>


 
<?php } ?> 




<?php if($_REQUEST['action']=='medialibrary' && $_REQUEST['pid']!='' && $_REQUEST['afunctin']!=''){  ?>


<div class="row" style="padding: 0px 10px;">
<div class="col-md-9 col-xl-9" >
<div class="form-group"> 
    <input  id="keywordsearch" onkeyup="funloaduploadedphotos(12);" name="keywordsearch" type="search" min="0" class="form-control" placeholder="Search" value="">
</div>

</div>

<div class="col-md-3 col-xl-3" >
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" id="uploadmediafrm" method="post" enctype="multipart/form-data">	
<input name="Upload" type="button" value="Upload Photo" id="savingphtobutton" onclick="$('#changeprofilepic').click();" class="btn btn-secondary btn-lg waves-effect waves-light"  >
<input name="image" multiple id="changeprofilepic" onchange="this.form.submit(); $('#savingphtobutton').attr('disabled','true');$('#savingphtobutton').val('Uploading...');" type="file" style="display:none;" /> <input name="action" type="hidden" id="action" value="uploadphototmedia" /> 
</form>

</div>
</div>

  <div class="row" style="padding: 0px 10px;" id="loaduploadedphotos">
  
  </div>
  
 <script>
 function funloaduploadedphotos(totalnumbercount){
 var keyword = encodeURI($('#keywordsearch').val());
 $('#loaduploadedphotos').load('loaduploadedphotos.php?keyword='+keyword+'&afunctin=<?php echo $_REQUEST['afunctin']; ?>&totalnumbercount='+totalnumbercount);
 }
 funloaduploadedphotos(12);
 </script>
<?php } ?> 



<?php if($_REQUEST['action']=='editDayDetails' && $_REQUEST['pid']!='' && $_REQUEST['d']!=''){

if($_REQUEST['pid']!=''){
$a=GetPageRecord('*','sys_packageBuilderEvent','packageId="'.decode($_REQUEST['pid']).'" and  packageDays="'.($_REQUEST['d']).'" order by id desc');  
$result=mysqli_fetch_array($a);
}
 
  ?>

 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Subject
</label>
  <input name="daySubject" type="text" class="form-control" id="daySubject" value="<?php echo stripslashes($result['daySubject']); ?>"   >
</div></div>

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Details
</label>
  <textarea name="dayDetails" rows="5" class="editorclass"><?php echo stripslashes($result['dayDetails']); ?></textarea>
</div></div>
 
 

  
  
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
 
<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="editDayDetails" /> 
<input name="editId" type="hidden" id="editId" value="<?php echo $_REQUEST['d']; ?>" />
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
</form>


  
<?php } ?> 






<?php if($_REQUEST['action']=='editinclusionExclusionDetails' && $_REQUEST['pid']!=''){

if($_REQUEST['pid']!=''){
$a=GetPageRecord('*','sys_packageBuilder','id="'.decode($_REQUEST['pid']).'"  ');  
$result=mysqli_fetch_array($a);
}
 
  ?>
 
 
 <form class="custom-validation" action="frmaction.html" target="actoinfrm" novalidate="" method="post" enctype="multipart/form-data">	
 
 <div class="modal-body">			
<div class="row">

 

<div class="col-md-12"> 
<div class="form-group">
<label for="validationCustom02">Inclusion Exclusion
</label>
  <textarea name="inclusionExclusion" id="inclusionExclusion" rows="5" class="editorclass"><?php echo stripslashes($result['inclusionExclusion']); ?></textarea>
</div></div>
 
 

  
  
</div>   
</div>
 
<div class="modal-footer" style=" position:relative;"> 
 
<input name="Save" type="submit" value="Save"   id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  />
</div>

<input name="action" type="hidden" id="action" value="editinclusionExclusionDetails" />  
<input name="pid" type="hidden" id="editId" value="<?php echo $_REQUEST['pid']; ?>" />
</form>


  
<?php } ?> 



<script>
$('#checkIn').timepicker();
$('#checkOut').timepicker();
</script>

