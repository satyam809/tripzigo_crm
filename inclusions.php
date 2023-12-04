<?php 
$rs=GetPageRecord($select,'sys_userMaster','id=1 '); 
$editresult=mysqli_fetch_array($rs);

 ?>

<script src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
selector: "#packageInclusions",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<script type="text/javascript">
tinymce.init({
selector: "#packageImportantTips",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<script type="text/javascript">
tinymce.init({
selector: "#packageExclusions",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<script type="text/javascript">
tinymce.init({
selector: "#packageTravelInfo",
themes: "modern",
plugins: [
"advlist autolink lists link image charmap print preview anchor",
"searchreplace visualblocks code fullscreen"
],
toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
 
<style>
.table td, .table th {
    vertical-align: top;
}
label{width: 100% !important; margin-bottom: 2px !important;font-size: 12px; text-transform: uppercase;}
</style>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px; overflow:hidden;"><?php if($_REQUEST['id']!=''){ echo 'Edit'; } else { echo 'Add'; } ?> Inclusions 
                                       </h4> 
									        <div class=" "> 
									<div class=" "> 
									<form action="frmaction.html" method="post" enctype="multipart/form-data" name="addeditfrm" target="actoinfrm" id="addeditfrm" > 
                    
                        <div class="col-lg-12">
               
                                 
                                    <div class="row">
									 
                                            
										 
											
									
                                        <div class="col-lg-6">
										 
											<div class="row" style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px;">
											<div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Inclusions Title</label>
                                          <input type="text" class="form-control" id="inclusionsTitle" name="inclusionsTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['inclusionsTitle']); ?>"> 
                                        </div>
										</div>
											 <div class="col-lg-8">
											 <div class="form-group"> 
											 <label for="validationCustom02">Inclusions Image</label>
                                          <input type="file" class="form-control" id="inclusionsImg" name="inclusionsImg" style="padding: 4px;">
										  <input type="hidden" name="inclusionsImgOld" value="<?php echo stripslashes($editresult['inclusionsImg']); ?>" />
                                        </div>
										</div>
											<div class="col-lg-4">
												 <div class="form-group" style="text-align:center;">  
											  <img src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($editresult['inclusionsImg']); ?>" style="width: 60px;" />
											</div>
											</div>
											
											<div class="col-lg-12">
											 
											 <div class="form-group">
                                                 <label for="validationCustom02">Inclusions</label>
                                                <textarea name="packageInclusions" id="packageInclusions" style="height:120px;" ><?php echo stripslashes($editresult['packageInclusions']); ?></textarea>
                                            </div>
											 
											 </div>
											 <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Important Tips Title</label>
                                          <input type="text" class="form-control" id="importantTipsTitle" name="importantTipsTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['importantTipsTitle']); ?>"> 
                                        </div>
										</div>
											 <div class="col-lg-8">
											 <div class="form-group"> 
											 <label for="validationCustom02">Important Tips Image</label>
                                          <input type="file" class="form-control" id="impTipsImg" name="impTipsImg" style="padding: 4px;" >
										  <input type="hidden" name="impTipsImgOld" value="<?php echo stripslashes($editresult['impTipsImg']); ?>" />
                                        </div>
										</div>
											<div class="col-lg-4">
													 <div class="form-group" style="text-align:center;">  
												  <img src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($editresult['impTipsImg']); ?>" style="width: 60px;" />
												</div>
												</div>
											<div class="col-lg-12"> 
											 <div class="form-group">
                                                 <label for="validationCustom02">Important Tips</label> 
												<textarea name="packageImportantTips" id="packageImportantTips" style="height:120px;" ><?php echo stripslashes($editresult['packageImportantTips']); ?></textarea>
                                            </div>
											 
											 </div>
											
											
											 
											</div>
											                           
                                        </div>


										  <div class="col-lg-6">
										  
										  <div class="row"  style="padding: 5px; margin: 5px; border: 1px solid #ddd; padding-top: 12px; border-radius: 4px;">
												 <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">Exclusions Title</label>
                                          <input type="text" class="form-control" id="exclusionsTitle" name="exclusionsTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['exclusionsTitle']); ?>"> 
                                        </div>
										</div>
												 <div class="col-lg-8">
												 <div class="form-group"> 
												 <label for="validationCustom02">Exclusions Image</label>
											  <input type="file" class="form-control" id="exclusionsImg" name="exclusionsImg" style="padding: 4px;">
											  <input type="hidden" name="exclusionsImgOld" value="<?php echo stripslashes($editresult['exclusionsImg']); ?>" />
											</div>
											</div>
													<div class="col-lg-4">
													 <div class="form-group" style="text-align:center;">  
												  <img src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($editresult['exclusionsImg']); ?>" style="width: 60px;" />
												</div>
												</div>
											
											 <div class="col-lg-12"> 
											 <div class="form-group">
                                                 <label for="validationCustom02">Exclusions</label>
                                                <textarea name="packageExclusions" id="packageExclusions" style="height:120px;" ><?php echo stripslashes($editresult['packageExclusions']); ?></textarea>
                                            </div>
											 
											 </div>  
											 
											 
											 <div class="col-lg-12">
											 <div class="form-group"> 
											 <label for="validationCustom02">List of documents for traveling Title</label>
                                          <input type="text" class="form-control" id="travelInformationTitle" name="travelInformationTitle" style="padding: 4px;" value="<?php echo stripslashes($editresult['travelInformationTitle']); ?>"> 
                                        </div>
										</div>
											 <div class="col-lg-8">
											 <div class="form-group"> 
											 <label for="validationCustom02">List of documents for traveling Image</label>
                                          <input type="file" class="form-control" id="travelInfoImg" name="travelInfoImg" style="padding: 4px;" >
										  <input type="hidden" name="travelInformationImgOld" value="<?php echo stripslashes($editresult['travelInfoImg']); ?>" />
                                        </div>
										</div>
											<div class="col-lg-4">
													 <div class="form-group" style="text-align:center;">  
												  <img src="<?php echo $fullurl; ?>package_image/<?php echo stripslashes($editresult['travelInfoImg']); ?>" style="width: 60px;" />
												</div>
												</div>
											 <div class="col-lg-12"> 
											 <div class="form-group">
                                                 <label for="validationCustom02">List of documents for traveling</label>
                                                <textarea name="packageTravelInfo" id="packageTravelInfo" style="height:120px;" ><?php echo stripslashes($editresult['packageTravelInfo']); ?></textarea>
                                            </div>
											 
											 </div>
											 
										  </div>		  
                                             
											  
											 
										 
											                              
                                        </div>

                                         
                                    </div>  
									
									
									
									                                                                    
                        
								<div class="row">
								<div class="col-lg-12">
								
							  <div class="form-group mb-0" style="padding: 20px 0px;  border-top: 1px solid #e6e6e6; overflow:hidden; margin-top:20px;">
                                           
                                   
											
											 <button type="submit"  id="savingbutton" class="btn btn-primary" onclick="this.form.submit(); this.disabled=true; this.value='Saving...';"  style="float:right;"  >
                                                Save Inclusions
                                            </button>
                                             <input autocomplete="false" name="action" type="hidden" id="action" value="addInclusions" />  
								</div>
                           
								</div>
                           
							
                        </div>
						
						
						
                    </div>
					
					</form>
					 
						  </div>		  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>