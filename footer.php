 <iframe id="actoinfrm" name="actoinfrm" src="" style="display:none;"></iframe>

 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



 <script src="<?php echo $fullurl; ?>assets/js/bootstrap.bundle.min.js"></script>

 <script src="<?php echo $fullurl; ?>assets/js/modernizr.min.js"></script>

 <script src="<?php echo $fullurl; ?>assets/js/waves.js"></script>

 <script src="<?php echo $fullurl; ?>assets/js/jquery.slimscroll.js"></script>

 <script src="<?php echo $fullurl; ?>plugins/peity-chart/jquery.peity.min.js"></script>

 <!--Morris Chart-->

 <script src="<?php echo $fullurl; ?>plugins/raphael/raphael-min.js"></script>

 <!-- <script src="<?php //echo $fullurl; ?>assets/pages/dashboard.js"></script> -->

 <!-- App js -->

 <script src="<?php echo $fullurl; ?>assets/js/app.js"></script>

 <script>

 	function redirectpage(pages) {

 		window.location.href = pages;

 	}

 </script>

 <div id="ActionDiv" style="display:none;"></div>

 <script>
 
    
     function showLoading() {
    	$('#loading').html('saving...');
       
      }

 	function loadpop(pagetitle, obj, width) {

 		$('#popcontent').html('<div style="padding:10px; text-align:center;"><img src="<?php echo $fullurl; ?>images/loading.gif" width="32" ></div>');

 		var popaction = encodeURI($(obj).attr('popaction'));

 		//$('#poptitle').html(pagetitle);

 		$('.modal-dialog').css('max-width', width);

 		$('.modal-dialog').css('width', width);

 		$('#popcontent').load('<?php echo $fullurl; ?>loadpopup.php?' + popaction);

 	}



 	function loadpop2(pagetitle, obj, width) {

 		$('#popcontent2').html('<div style="padding:10px; text-align:center;"><img src="<?php echo $fullurl; ?>images/loading.gif" width="32" ></div>');

 		var popaction = encodeURI($(obj).attr('popaction'));

 		$('#poptitle2').html(pagetitle);

 		$('.modal-dialog').css('width', width);

 		$('.modal-dialog').css('max-width', width);

 		$('#popcontent2').load('<?php echo $fullurl; ?>loadpopup.php?' + popaction);

 	}



 	function hideModal() {

 		$("#myModal").removeClass("in");

 		$(".modal-backdrop").remove();

 		$('body').removeClass('modal-open');

 		$('body').css('padding-right', '');

 		$(".modal").hide();

 	}

 	setTimeout(function() {

 		$('.headersavealert').slideUp();

 	}, 3000);

 	// $('#loadnotificationscreate').load('loadnotificationscreate.php');

 	// $('#loadreminders').load('load_reminders.php');

 </script>

 <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="myModal" style="display: none;" aria-hidden="true">

 	<div class="modal-dialog modal-dialog-centered">

 		<div class="modal-content">

 			<div class="modal-header">

 				<h5 class="modal-title mt-0" id="poptitle">Total Working Time <span class="TotalWorkingTime"></span></h5>

 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

 					<span aria-hidden="true">&times;</span>

 				</button>

 			</div>

 			<div class="modal-body" id="popcontent">

 			</div>

 		</div>

 	</div>

 </div>

 <div class="modelnew modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">

 	<div class="modal-dialog" role="document">

 		<div class="modal-content">

 			<div class="modal-header">

 				<h4 class="modal-title" id="poptitle2">Right Sidebar</h4>

 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">

 					<span aria-hidden="true">&times;</span>

 				</button>

 			</div>

 			<div class="modal-body" id="popcontent2">

 			</div>

 		</div><!-- modal-content -->

 	</div><!-- modal-dialog -->

 </div><!-- modal -->

 <style>

 	.modelnew.show .modal-dialog {

 		right: 0px !important;

 		transform: translate(-100%, 0);

 	}



 	.modal.left .modal-dialog,

 	.modal.right .modal-dialog {

 		position: fixed;

 		margin: auto;

 		width: 320px;

 		height: 100%;

 		-webkit-transform: translate3d(0%, 0, 0);

 		-ms-transform: translate3d(0%, 0, 0);

 		-o-transform: translate3d(0%, 0, 0);

 		transform: translate3d(0%, 0, 0);

 	}



 	.modal.left .modal-content,

 	.modal.right .modal-content {

 		height: 100%;

 		overflow-y: auto;

 	}



 	.modal.left .modal-body,

 	.modal.right .modal-body {

 		padding: 15px 15px 80px;

 	}



 	/*Left*/

 	.modal.left.fade .modal-dialog {

 		left: -320px;

 		-webkit-transition: opacity 0.3s linear, left 0.3s ease-out;

 		-moz-transition: opacity 0.3s linear, left 0.3s ease-out;

 		-o-transition: opacity 0.3s linear, left 0.3s ease-out;

 		transition: opacity 0.3s linear, left 0.3s ease-out;

 	}



 	.modal.left.fade.in .modal-dialog {

 		left: 0;

 	}



 	/*Right*/

 	.modal.right.fade .modal-dialog {

 		right: -320px;

 		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;

 		-moz-transition: opacity 0.3s linear, right 0.3s ease-out;

 		-o-transition: opacity 0.3s linear, right 0.3s ease-out;

 		transition: opacity 0.3s linear, right 0.3s ease-out;

 	}



 	.modal.right.fade.in .modal-dialog {

 		right: 0;

 	}



 	.container-fluid {

 		max-width: 100%;

 		padding-left: 92px;

 		padding-right: 22px;

 		padding-top: 8px;

 	}



 	.wrapper {

 		margin-top: 56px;

 		padding-left: 20px;

 	}



 	.table>tbody>tr>td,

 	.table>tfoot>tr>td,

 	.table>thead>tr>td {

 		padding: 10px 12px;

 	}



 	.container-fluid .col-md-12 .card-body {

 		padding: 0px !important;

 	}



 	body,

 	html {

 		background-color: #fff;

 	}



 	.card {

 		-webkit-box-shadow: 0 0 1.25rem rgb(108 118 134 / 0%);

 		box-shadow: 0 0 1.25rem rgb(108 118 134 / 0%);

 	}



 	.topnavigation {

 		padding-top: 0px !important;

 	}



 	#ui-datepicker-div {

 		z-index: 99999999 !important;

 	}

 </style>

 <div class="rnblkquery">

 	<i class="fa fa-times" aria-hidden="true" style="position: absolute; right: 25px; top: 15px; color: #666666; font-size: 20px; cursor: pointer;" onclick="createqueryclose();"></i>

 	<div class="querywhitebox">

 		<h4 class="card-title" style="margin-top: 0px; margin-bottom:0px; padding: 15px; background-color: #f8f8f8; border-bottom: 1px solid #ddd; font-size: 20px; text-transform: uppercase;padding-left: 25px;">Add Query</h4>

 		<div id="loadqueryadd" style="padding:20px;">Loading...</div>

 	</div>

 </div>

 <script>

 	function createqueryfromclient(id) {

 		$('#loadqueryadd').html('Loading...');

 		$('.rnblkquery').show();

 		$('body').css('overflow', 'hidden');

 		$('html').css('overflow', 'hidden');

 		$('#loadqueryadd').load('add_query.php?cid=' + id);

 		if (id == '') {

 			$('.rnblkquery .card-title').html('Create Query');

 		} else {

 			$('.rnblkquery .card-title').html('Edit Query');

 		}

 	}



 	function createquery(id) {

 		$('#loadqueryadd').html('Loading...');

 		$('.rnblkquery').show();

 		$('body').css('overflow', 'hidden');

 		$('html').css('overflow', 'hidden');

 		$('#loadqueryadd').load('add_query.php?id=' + id);

 		if (id == '') {

 			$('.rnblkquery .card-title').html('Create Query');

 		} else {

 			$('.rnblkquery .card-title').html('Edit Query');

 		}

 	}



 	function createqueryclose() {

 		$('.rnblkquery').hide();

 		$('body').css('overflow', 'visible');

 		$('html').css('overflow', 'visible');

 		$('#loadqueryadd').html('Loading...');

 	}



 	function click_to_call_v2(query_id) {

 		$.ajax({

 			url: "callerdesk.php",

 			type: 'post',

 			dataType: "json",

 			data: {

 				flag: "callerdesk",

 				query_id: query_id

 			},

 			success: function(data) {

 				let caller_data = JSON.parse(data);

				console.log(caller_data);

 				alert(caller_data.message);

 			}

 		});



 	}



	 function delete_data(id,action,redirect) {

         Swal.fire({

             title: "Are you sure?",

             text: "Once deleted, you will not be able to recover this record",

             icon: "warning",

             showCancelButton: true,

             confirmButtonColor: '#d33',

             cancelButtonColor: '#3085d6',

             confirmButtonText: 'Yes'

         }).then((willDelete) => {

			if (willDelete.isConfirmed) {

				$.ajax({

					url: "actionpage.php",

					type: 'post',

					data: {

						action: action,

						id: id

					},

					success: function(data) {

						parent.redirectpage('display.html?ga='+redirect);

					}

				});

			} else {

				// swal("Your Record is safe!");

			}

		});



 	}



	function delete_single_photo(id) {

		$.ajax({

				url: "actionpage.php",

				type: 'post',

				data: {

					action: "delete_single_photo",

					id: id

				},

				success: function(data) {

					$("#collectionphoto100"+id).remove();

				}

		});

 	}



	 function delete_single_itinerary_photo(id) {

		$.ajax({

				url: "actionpage.php",

				type: 'post',

				data: {

					action: "delete_single_itinerary_photo",

					id: id

				},

				success: function(data) {

					$("#itineraryphoto100"+id).remove();

				}

		});

 	}

</script>

 <style>

 	.footerstripboxouter {

 		box-shadow: 0 0 6px rgb(0 0 0 / 20%);

 		background-color: #FFFFFF;

 		position: fixed;

 		left: 0px;

 		bottom: 0px;

 		width: 100%;

 		min-height: 28px;

 		z-index: 99999;

 	}



 	.footerstripboxouter .leftar {

 		float: left;

 	}



 	.footerstripboxouter .righar {

 		float: right;

 	}



 	.activefootertab {

 		color: #CC3300 !important;

 		background-color: #F9F9F9;

 	}



 	.footerstripboxouter .righar a {

 		display: block;

 		float: right;

 		border-left: 1px solid #ddd;

 		color: #000;

 		padding: 4px 10px;

 		font-size: 11px;

 		line-height: 20px;

 	}



 	.footerstripboxouter .righar a span {

 		font-weight: 600;

 		text-transform: uppercase;

 		line-height: 14px;

 	}



 	.footerstripboxouter .righar a:hover {

 		background-color: #F9F9F9;

 	}



 	.footerpopboxs {

 		position: fixed;

 		right: 0px;

 		bottom: 0px;

 		width: 374px;

 		background-color: #fff;

 		box-shadow: 0 0 6px rgb(0 0 0 / 20%);

 		min-height: 488px;

 		border-top-left-radius: 10px;

 		border-top-right-radius: 10px;

 		overflow: hidden;

 	}



 	.footerpopboxsheader {

 		height: 40px;

 		border-bottom: 1px solid #e3e8ee;

 		align-items: center;

 		display: flex;

 		padding: 0 12px;

 		cursor: default;

 		position: relative;

 		font-weight: 700;

 		width: 100%;

 	}



 	.footerpopboxsheader .fa-times {

 		position: absolute;

 		right: 12px;

 		font-size: 16px;

 		color: #8a8a8a;

 		cursor: pointer;

 	}



 	.footerpopboxs .popcontentbodybox {

 		height: 418px;

 		overflow: auto;

 	}



 	.footerpopboxs .popcontentbodybox .loadingboxin {

 		padding: 20px;

 		text-align: center;

 		color: #999999;

 		font-size: 13px;

 	}



 	.footerpopboxs .usernotesouter {

 		padding: 10px;

 	}



 	.footerpopboxs .usernotesouter .usernotes {

 		padding: 15px;

 		background-color: #FFED7D;

 		color: #000000;

 		font-size: 14px;

 		line-height: 24px;

 		border-radius: 2px;

 		box-shadow: 1px 2px 2px #00000029;

 		margin-bottom: 10px;

 		padding-bottom: 0px;

 	}



 	.footerpopboxs .usernotesouter .usernotes .noteareawrite {

 		background-color: transparent;

 		border: 0px;

 		outline: 0px;

 		min-height: 50px;

 		overflow: hidden;

 		padding: 0px;

 		color: #000000;

 		font-size: 14px;

 		width: 100%;

 	}



 	.footerpopboxs .usernotesouter .usernotes .toolbarfoo {

 		border-top: 1px solid #fff;

 		overflow: hidden;

 		padding-bottom: 10px;

 	}



 	.footerpopboxs .usernotesouter .usernotes .toolbarfoo a {

 		padding: 5px 10px 0px;

 		color: #000000 !important;

 		font-size: 14px;

 		cursor: pointer;

 		display: block;

 		float: left;

 	}



 	.addnotebookouter {

 		overflow: hidden;

 	}



 	.addnotebookouter .notebookadd {

 		display: block;

 		color: #000000 !important;

 		float: right;

 		font-size: 22px;

 		padding: 0px 12px;

 		position: absolute;

 		top: 3px;

 		right: 30px;

 		cursor: pointer;

 	}

 </style>

 <div style="height:30px;"></div>

 <div class="footerstripboxouter">

 	<div class="leftar"></div>

 	<div class="righar"><a style="cursor:pointer;" onclick="openfooterpop('footernotebook','Notebook',this,'user_notebook','374px','488px','0px','531px');" title="Notebook"><i class="fa fa-sticky-note-o" aria-hidden="true"></i> &nbsp;<span>Notebook</span></a>

 		<a style="cursor:pointer;" onclick="openfooterpop('footernotebook','Updates',this,'user_news_updates','500px','600px','96px','531px');" title="Notebook"><i class="fa fa-bullhorn" aria-hidden="true"></i> &nbsp;<span>Updates</span></a>

 		<?php if ($LoginUserDetails['theme'] == 2) { ?>

 			<a style="cursor:pointer;" href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&nighttheme=1" title="Night Theme"><i class="fa fa-moon-o" aria-hidden="true"></i> &nbsp;<span>Night Theme On</span></a>

 		<?php } else { ?>

 			<a style="cursor:pointer;" href="display.html?ga=<?php echo $_REQUEST['ga']; ?>&nighttheme=2" title="Night Theme"><i class="fa fa-moon-o" aria-hidden="true"></i> &nbsp;<span>Night Theme Off</span></a>

 		<?php } ?>

 	</div>

 </div>

 <div class="footerpopboxs" id="footernotebook" style="display:none;">

 	<div class="footerpopboxsheader"><span></span> <i class="fa fa-times" aria-hidden="true" onclick="clasefooterpop();"></i></div>

 	<div class="popcontentbodybox"></div>

 </div>

 <script>

 	function openfooterpop(id, name, obj, openfile, width, height, right, bodybox) {

 		$('.footerstripboxouter a').removeClass('activefootertab');

 		$('#' + id).show();

 		$('#' + id).css('width', width);

 		$('#' + id).css('min-height', height);

 		$('.popcontentbodybox').css('height', bodybox);

 		$('#' + id).css('right', right);

 		$(obj).addClass('activefootertab');

 		$('#' + id + ' .footerpopboxsheader span').html(name);

 		$('.popcontentbodybox').html('<div class="loadingboxin">Wait Please...</div>');

 		$('.popcontentbodybox').load(openfile + '.php');

 	}



 	function clasefooterpop() {

 		$('.footerpopboxs').hide();

 		$('.footerstripboxouter a').removeClass('activefootertab');

 	}

 </script>

 