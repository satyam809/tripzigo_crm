
<?php

if(isset($_SESSION))
{
  
// session_start();
$uname=isset($_SESSION['uname']);

 $b=GetPageRecord('*', 'sys_userMaster', 'id=1');
 $getData = mysqli_fetch_assoc($b);
if($uname='info@tripzygo.in')
  {
       $number=GetPageRecord1('*', 'sys_userMaster', 'email="' . $uname . '" and password="'.$getData['password'].'"');
          if ($number == 0) {
            
              
              header('Location: login.html'); 
             exit; 
              
          }
  }
  
//   if($uname='info@tripzygo.in')
//   {
//         $number=GetPageRecord1('*', 'sys_userMaster', 'email="' . $uname . '" and password="f623468ec130849e08e0a6a5e758d1af"');
//           if ($number == 0) {
            
              
//               header('Location: login.html'); 
//              exit; 
              
//           }
      
//   }
  
  
  

 
  
  
}

?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge"> 	  
      <link href="<?php echo $fullurl; ?>images/favicon.png" rel="icon" /> 
      <link href="<?php echo $fullurl; ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $fullurl; ?>assets/css/icons.css" rel="stylesheet" type="text/css">
      <link href="<?php echo $fullurl; ?>assets/css/style.css?i=1" rel="stylesheet" type="text/css">
	  <link rel="stylesheet" href="<?php echo $fullurl; ?>plugins/summernote/summernote-bs4.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Fjalla+One&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
<link href="<?php echo $fullurl; ?>customstyle.css?i=1" rel="stylesheet" type="text/css">

<style>
.header-bg{background-color:<?php echo $LoginUserDetails['themeColor']; ?>;}

#topnav .navigation-menu>li .submenu li a:hover {
    color: <?php echo $LoginUserDetails['themeColor']; ?>;
}
.headerslideright .userinformationbox{background-image:url(images/gray-abstract-bg.png); background-repeat:repeat; padding:15px; position:relative; border-top:5px solid <?php echo $LoginUserDetails['themeColor']; ?>;}
#tograypanelmenu .rightmenu a:hover{color:<?php echo $LoginUserDetails['themeColor']; ?>;}

<?php if($LoginUserDetails['theme']==2){ ?>
html{filter: invert(1);}
.badge{filter: invert(1);}
.btn{filter: invert(1);}
.statusbox{filter: invert(1);}
.outeritibox{filter: invert(1); background-color:#f0f0f0;}
.rightmenu{filter: invert(1);  }
.welcomename{filter: invert(1);  }
.logonavitop{filter: invert(1);  } 
.querylistbox img{filter: invert(1);  }
table img{filter: invert(1); }
#chartdiv{filter: invert(1); }
 
.headerslideright .userinformationbox .nameboxxx{filter: invert(1);  }
.footerpopboxs .usernotesouter .usernotes .noteareawrite{ color:#fff;}
.header-bg{background-color: #e2e2e2 !important;}
#topnav .navigation-menu>li>a{color: #00000080 !important;}
#topnav .navigation-menu>li>a:hover{color: #00000080 !important;}
#topnav .navigation-menu>li>a:hover i{color: #00000080 !important;}
#topnav .has-submenu.active a{filter: invert(1);}
<?php } ?>

#topnav .navigation-menu>li>a { 
    padding-top: 8px !important;
    padding-bottom: 8px !important;
	
}
.topmainlogomain{display:block;}
.topmainlogomainmobile{display:none;}
#navigation{display: block;}
.hideinmobile{display:block;}
.showinmobile{display:none;}
.inquerytabsmain{margin-bottom: 20px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px 0px;}
.sectabnew{margin-bottom: 20px; float: left; width: 100%; border-top: 1px solid #dee2e6; border-bottom: 2px solid #dee2e6; background-color: #f3f3f3; padding: 8px;}
.float-right button{float:left; margin-left:5px;}
.float-right a{float:left; margin-left:5px;}
.searchquerymain{display:none;}

@media only screen and (max-width: 900px) {
#topnav .navigation-menu>li .submenu { position: absolute; top: -220%; left: 80px; z-index: 1000; padding: 4px 0; list-style: none; min-width: 200px; text-align: left; visibility: hidden; opacity: 0; margin-top: 20px; -webkit-transition: all .2s ease; transition: all .2s ease; background-color: #fff; -webkit-box-shadow: 0 1px 12px rgb(0 0 0 / 10%); box-shadow: 0 0px 0px rgb(0 0 0 / 34%); border-radius: 4px; border-left: 3px solid #46cd93; background-color: #00000038 !important; }
#navigation{display: none; position: fixed; left: 0px; top: 0px; width: 70%; background-color: #313949; height: 100%;}
#topnav .navigation-menu>li { width: 100% !important; text-align: center; text-align: left; padding: 5px; }
#topnav .navigation-menu>li .submenu { position: relative; display: block !IMPORTANT; top: 0px !important; left: 0px !important; z-index: 1000; padding: 4px 0; list-style: none; min-width: 200px; text-align: left; visibility: visible !important; opacity: 1; margin-top: 20px; -webkit-transition: all .2s ease; transition: all .2s ease; background-color: #fff; }
#topnav .navigation-menu>li>a i {   position: absolute;left: 16px; margin-top: 0px !IMPORTANT;}
#topnav .navigation-menu>li>a { padding-top: 8px !important; padding-bottom: 8px !important; padding-left: 37px !important; font-size: 15px !important;    }
#topnav .navigation-menu>li .submenu{margin-top:0px; margin-top: 16px !important;}
#topnav .navigation-menu>li .submenu li a {  color: #ffffff; }
#topnav .has-submenu.active a { color: #fff !important; background-color: #23ae73 !important; padding: 10px 38px !important; }
.headersearchbarouter{display:none;}
.footerstripboxouter{display:none;}
#loadnotificationscreate { overflow: auto; height: 80% !important; position: fixed; }
.mailopened{display:none !important;}
.topmainlogomain{display:none;}
.topmainlogomainmobile{display:block;}
.topmainlogomainmobile .fa{color:#fff;}
.topmainlogomainmobile { display: block; background-color: #23ae73; padding: 0px 10px; margin-left: -6px; margin-top: -7px; font-size: 24px; border-radius: 3px; }
.header-bg { background-color: #ffffff; width: 0px !important; }
.dashboardleft { background-color: #FFFFFF; width: 100%; position: relative; left: 0px; top: 0px; height: 100%; box-sizing: border-box; }
.wrapper {  padding-left: 10px !important;  padding-right: 10px !important;  }
.container-fluid {  padding-right: 5px !important;  padding-top: 8px !important;  padding-left: 4px !important; }
.dashboardleft .dashboardleftinnter{padding-top:14px; overflow:hidden;}
.dashboardleft { background-color: #FFFFFF; width: 100%; position: relative; left: 0px; top: 0px; height: 100%; box-sizing: border-box; border-radius: 5px; margin-bottom: 10px; }
.dashboardleft .listbox { padding: 10px 18px; background-color: #e5e4ff; font-size: 20px; margin-bottom: 10px; border-radius: 12px; border-left: 4px solid #00000024; width: 46%; text-align: center; float: left; height: 73px; margin: 6px; }
.createquerybtnmaindash{margin-top:10px !important;}
.invitememberboxbutton{margin-bottom:20px !important;}
.topmainlogomainmobile { display: block; background-color: #23ae73; padding: 0px 10px; margin-left: -4px; margin-top: -4px; font-size: 24px; border-radius: 3px; }
#tograypanelmenu .rightmenu a {  color: #ffffff94;}
#tograypanelmenu .rightmenu a {margin-left: 10px;margin-right: 10px;}
#tograypanelmenu { background-color: #313949; border-bottom: 3px solid #46cd93; padding: 2px; height: 56px; }
#tograypanelmenu .navirightlink{padding:12px;}
#topnav .navigation-menu { padding-top: 60px; }
.rnblkquery .querywhitebox{width:100% !important;}
.modal-dialog{width:100% !important;}
.rnblkquery .modal-footer{ position:relative !important; padding-right:0px;}
.headerslideright {overflow:auto;}
.float-right { float: right!important; width: 100%; margin: 12px 0px; }
.querytabslead{overflow:auto; width:100%;}
.querytabslead .statusbox {   width: 130px; }
.querytabsleadsearch table tr td{display:block!important; width:100% !important; padding:0px !important; padding-bottom:5px !important;}
.querytabsleadsearch table tr td input{width:100% !important;}
.querytabsleadsearch table tr td select{width:100% !important;}
.querytabsleadsearch table tr td button{width:100% !important;}
.querytabsleadsearch table {width:100% !important;}
.querylistbox{width:100%; overflow:auto;} 
.querylistbox table{width:1000px !important;}
.hideinmobile{display:none;}
.showinmobile{display:block;}
.searchquerymain{padding:0px !important; padding:10px 0px !important;border-radius:10px;}
.d-none {  display: block !important; }
.d-block {  display: none !important; }
.inquerytabsmain{width:100%; overflow:auto; margin-bottom:10px;}
.inquerytabsmain .nav-tabs-custom{width:1150px !important;}
.querystatustabmain{width:97% !important; overflow:auto !important;}
.querystatustabmain .breadcrumb{width:1082px !important;margin-bottom:10px;}
.whatsappsharequerymain { position: fixed; right: 218px; top: 7px; z-index: 99999; }
.whatsappsharequerymain img{height:36px !important;}
.mobilemargianbottomzero{margin-bottom:0px !important;}
.sectabnew .float-right{width:auto !important;}
.overflowautomobiletable{overflow:auto; width:100%;}
.overflowautomobiletable table{min-width:800px !important;}
.message-list li .col-mail-2{display:none;}
}

.ui-datepicker{box-shadow: 0px 0px 10px #00000045 !important; border: 1px solid #e5e5e5 !important; padding: 0px !important; width:auto !important;}
.ui-datepicker .ui-widget-header { border: 1px solid #ffffff; background: #ffffff; color: #333333; font-weight: bold; font-size: 18px; }
.ui-datepicker .ui-state-default { border: 0px; text-align: center; font-size: 14px; padding: 14px 12px !important; background-color: #fff !important; border: 0px !important; }
.ui-datepicker .ui-state-default:hover{background-color: #f0f0f0 !important;border-radius: 4px; color:#000 !important;}

.ui-datepicker table{margin-bottom:0px !important;}
.ui-datepicker table th{color:#8B9898 !important;}
.ui-datepicker .ui-state-highlight{ background-color:#d6fff1!important; color:#3a8e71!important;border-radius: 4px;}
.ui-datepicker .ui-state-active{background-color:#008cff !important; color:#fff !important;border-radius: 4px;}
.ui-datepicker .ui-datepicker-header{box-shadow: 0px 0px 10px #0000004d;}
.ui-datepicker .ui-datepicker-title{font-size:17px !important; }
.ui-datepicker .ui-datepicker-prev{background-color:#fff !important; border:0px !important; cursor:pointer;}
.ui-datepicker .ui-datepicker-next{background-color:#fff !important; border:0px !important; cursor:pointer;}
.ui-datepicker .ui-datepicker-calendar tr td:first-child{padding-left:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr td:last-child{padding-right:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr th:first-child{padding-left:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr th:last-child{padding-right:15px !important;}
.ui-datepicker .ui-datepicker-calendar tr th{padding-top:25px!important;}
.ui-datepicker .ui-datepicker-calendar{margin-bottom:15px!important;}
.ui-datepicker select.ui-datepicker-month, .ui-datepicker select.ui-datepicker-year { border: 1px solid #ddd!important; padding: 5px 4px!important; font-size: 13px!important; margin: 0px 2px!important; border-radius: 4px;}
.btn-group .btn-secondary { border-radius: 0px !important; border: 1px solid #ddd !important; border-right:0px !important; background-color: transparent !important; background-image: none; color: #000; padding: 5px 10px; background: rgb(255,255,255); background: linear-gradient(180deg, rgba(255,255,255,1) 47%, rgba(244,244,244,1) 100%); color:#000000 !important;}
.btn-group .btn-secondary:hover{background: rgb(244,244,244); background: linear-gradient(180deg, rgba(244,244,244,1) 0%, rgba(255,255,255,1) 47%);}

.btn-group {border-radius: 4px !important; overflow:hidden; border-right:1px solid #cfd7df; margin-right:3px; }
.workinghoursstrip{background-color: #d9fffb; color: #000; padding: 10px; font-size: 12px; font-weight: 700; padding-left: 35px;}
.width480{ width:400px !important;}
.mastericons{text-align:center; overflow:hidden;}
.mastericons a{padding:10px 0px !important;  font-size:30px !important; text-align:center; cursor:pointer; width:32% !important;display: inline-block !important; margin:1px 0px; border: 1px solid #e6f4ff;  }
.mastericons a .titilemaster{margin-top:2px; font-size:13px !important; color:#6d6d6d; font-weight:400;}
.mastericons a:hover{background-color:#e6f4ff !important;border-radius: 4px !important;}
.mastericons a img{width:32px !important;}
.querylistbox .viewpackageheader { padding: 6px 8px; font-size: 11px; background-color: #ebebeb; color: #0a0a0a; text-transform: uppercase; font-weight: 600; line-height: 12px; cursor:pointer; }
.querylistbox:hover .viewpackageheader { background-color:#35beff; color:#fff;}
.querylistbox .proposallistouter{background-color:#FFFFFF; padding:0px 0px;}
.querylistbox .proposallistouter a{ padding:4px 8px; display:block; border-bottom:1px solid #ddd; font-size:12px; font-weight:600; color:#000000;}
.querylistbox .proposallistouter a:hover{background-color:#FFFFCC;}

.roleouter{ border-left:2px dashed #c5c5c5; margin-left:50px;}
.roleouter .headrole { margin-top:30px; padding: 5px 10px; font-weight: 600; margin-left: 30px; background-color: #dff0ff; border-radius: 4px; line-height: 25px; position:relative; }
.roleouter .hyrouter { border-left: 2px dashed #ddd; padding: 13px 30px; margin-left: 50px; position: relative; }
.roleouter .rolebox { background-color: #EFEFEF; width: fit-content; padding: 4px 10px; text-align: center; color: #000000; border-radius: 4px; font-weight: 600; line-height: 22px; }
.roleouter .linerole { position: absolute; left: 0px; width: 31px; background-color: #EFEFEF; height: 4px; left: -30px; top: 15px; }
.roleouter .hyrouter .linerole { position: absolute; left: 0px; width: 31px; background-color: #EFEFEF; height: 4px; left: 0px; top: 30px; }
.roleouter .hyrouter .ingry{ background-color: #EFEFEF; width: fit-content; padding: 4px 30px; text-align: center; color: #000000; border-radius: 4px; font-weight: 600; line-height: 22px; }
.roleouter a { display: block; position: absolute; top: 18px; left: 14px; background-color: #000 !important; padding: 2px; height: 20px; width: 20px; font-size: 12px; color: #fff !important; line-height: 15px; } 
option:disabled { color: red; background-color:#FFFFCC; font-weight:600; padding:4px;}
.modal-content { border: 0px; box-shadow: 2px 2px 9px #00000045; }

.listtypehome {
    overflow: hidden;
}

.listtypehome a { float: left; display: block; margin-right: 10px; padding: 10px; border: 1px solid #fff; margin-bottom: 10px; }
.listtypehome a img { width: 148px; }
.listtypehome a div { font-weight: 600; color: #333333; text-align: center; padding-top: 10px; }
.listtypehome a:hover { border: 1px solid #03acea3d; box-shadow: 2px 2px 5px #00000042; margin-bottom: 10px; border-radius: 10px; }
</style>



<script>
function openloadsection(page,id){
$('#'+id).html('<div style="padding:10px; text-align:center;"><img src="<?php echo $fullurl; ?>images/loading.gif" width="32" ></div>');
$('#'+id).load(page);
}

function getSearchCIty(citysearchfield,cityresultfield,listsearch){
var citysearchfieldval = encodeURI($('#'+citysearchfield).val());  
var citysearchfield = citysearchfield;

if(citysearchfieldval!=''){  
$('#'+listsearch).show();
$('#'+listsearch).load('searchcitylists.php?keyword='+citysearchfieldval+'&searchcitylists='+listsearch+'&cityresultfield='+cityresultfield+'&citysearchfield='+citysearchfield);
}
}




function selectcity(){
	var stateId = $('#state').val();
	$('#city').load('loadcity.php?id='+stateId+'&selectId=<?php echo $editresult['city']; ?>');
	}
	
	function selectstate(){
	var countryId = $('#country').val(); 
	$('#state').load('loadstate.php?id='+countryId+'&selectId=<?php echo $editresult['state']; ?>'); 
	}
	
			function markDoneTask(queryTaskId) {
                             $.ajax({
                                    type: 'post',
                                    url: 'index.php',
                                    data: {
                                           queryTaskId: queryTaskId,
                                          },
                                     });
                                   }
	 
</script>
