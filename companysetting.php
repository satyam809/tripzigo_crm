<?php if($LoginUserDetails['userType']!=0){ exit(); } ?>
<div class="wrapper">
<div class="container-fluid">
<div class="main-content">

                <div class="page-content">

      
                    
                    <!-- start page title -->
                     
              
                        <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card" style="min-height:500px;">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Organisation settings<div class="float-right">
									<button type="button" class="btn btn-secondary btn-lg waves-effect waves-light"  onclick="loadpop('Edit organisation settings',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=organisationsettings">Edit setting</button>
									</div></h4>
                                    <p class="card-title-desc" >&nbsp;</p>
							 
                                        <table width="100%" class="table table-hover mb-0">

                                            <thead>
                                            </thead>
                                            <tbody>
											
											<tr>
  <td>
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">Organisation name</div>
  <div style="font-size:15px; color:#000; "><?php echo stripslashes($LoginUserDetails['invoiceCompany']); ?></div>
  
  </td>
</tr>
											<tr>
  <td>
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">Email (Invoicing use)</div>
  <div style="font-size:15px; color:#000; "><?php echo stripslashes($LoginUserDetails['invoiceEmail']); ?></div>
  
  </td>
</tr>
											<tr>
  <td>
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">Phone (Invoicing use)</div>
  <div style="font-size:15px; color:#000; "><?php echo stripslashes($LoginUserDetails['invoicePhone']); ?></div>
  
  </td>
</tr>
											<tr>
  <td>
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">Address</div>
  <div style="font-size:15px; color:#000; "><?php echo stripslashes($LoginUserDetails['invoiceAddress']); ?></div>
  
  </td>
</tr>
											<tr>
  <td>
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">GSTIN</div>
  <div style="font-size:15px; color:#000; "><?php echo stripslashes($LoginUserDetails['Invoicegstn']); ?></div>
  
  </td>
</tr>

							<tr>
  <td>
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">STATE</div>
  <div style="font-size:15px; color:#000; "><?php echo stripslashes($LoginUserDetails['invoiceState']); ?></div>
  
  </td>
</tr>

							<tr>
  <td>
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">STATE CODE </div>
  <div style="font-size:15px; color:#000; "><?php echo stripslashes($LoginUserDetails['invoiceStateCode']); ?></div>
  
  </td>
</tr>


                                            </tbody>
                                        </table>
                           
									
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div><!--end col-->
			 
			 
			 
			 
			 
			 
			 <div class="row">
                        <div class="col-md-12 col-xl-12">
						<div class="card">
                            <div class="card-body"> 
                                    <h4 class="card-title" style=" margin-top:0px;">Default settings<div class="float-right">
									 
									</div></h4> 
                                        <table width="100%" class="table table-hover mb-0">

                                            <thead>
                                            </thead>
                                            <tbody>
											
											<tr>
											  <td width="5%"><img src="profilepic/<?php echo stripslashes($LoginUserDetails['invoiceLogo']); ?>" style="max-width:200px; height:auto;"/></td>
  <td width="90%">
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">Itinerary logo</div>
  <div style="font-size:15px; color:#000; ">For the best results a .png file with a transparent background at least 125x140 pixels is recommended</div>  </td>
  <td width="5%"><div align="right">
    <button type="button" class="btn btn-secondary btn-sm waves-effect" onclick="loadpop('Update default settings',this,'600px')" data-toggle="modal" data-target=".bs-example-modal-center" popaction="action=setlogoandinclusion"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</button>
  </div></td>
											</tr>
											<tr>
											  <td colspan="2">
  <div style="font-size:12px; color:#737373; margin-bottom:2px;">&nbsp;</div>  <div style="font-size:15px; color:#000; "> &nbsp;</div></td>
                                              <td> </td>
											</tr>
                                            </tbody>
                                        </table>
                           
									
						  </div>
								 
                             
</div>
                             

                        </div>

                         
						
						
						
						 
                     

             </div>

            <!-- end row -->

    </div>

        <!-- End Page-content -->

         
    </div>
	</div>	</div>