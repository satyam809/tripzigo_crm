<?php  
//echo 'test';die;
include "config/database.php"; 
include "config/function.php";  
include "config/setting.php";  
 

if(isset($_POST['username']) && $_POST['username']!='' && $_POST['userpass']!=''){   
$username = clean($_POST['username']); 
$password = clean($_POST['userpass']); 


$ftoken = '';   
$loginreturn = login($username,$password,$ftoken);
//echo $loginreturn; exit;
if($loginreturn=='yes'){ 
 
 
$rs=GetPageRecord('*','sys_userMaster','id="'.$_SESSION['userid'].'" and email="'.$_SESSION['username'].'"'); 
$LoginUserDetails=mysqli_fetch_array($rs);

if($LoginUserDetails['stepVerification']==0){

$rendnumber=mt_rand(100000, 999999);

$namevalue ='qrCode="'.$rendnumber.'",verifyQrCode="'.$rendnumber.'"';  
$where='id="'.$_SESSION['userid'].'"';    
updatelisting('sys_userMaster',$namevalue,$where);  

$_SESSION['sesQRCode']=$namevalue;
$_SESSION["login_time_stamp"] = time();

//echo $fullurl;exit;
header("Location: ".$fullurl.""); 
exit(); 

}



if($LoginUserDetails['stepVerification']==1){
$rendnumber=mt_rand(100000, 999999);
 $namevalue ='qrCode="'.$rendnumber.'",verifyQrCode=0';  
$where='id="'.$_SESSION['userid'].'"';    
updatelisting('sys_userMaster',$namevalue,$where);  

}
 


} else {  
$errormsg='Invalid username or password';

}
}




 
$rsa=GetPageRecord('*','sys_userMaster','id=1'); 
$logincolor=mysqli_fetch_array($rsa);
?>

<!DOCTYPE html>
<html lang="zxx">
 
<head>
    <title>Login - <?php echo $clientnameglobal; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="login/assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="login/assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="login/assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
  <link href="images/favicon.png" rel="icon" />

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="login/assets/css/style.css">
	
	<style>

 
.login-15 .btn-primary {
    background: <?php echo $logincolor['themeColor']; ?>;
}

.login-15 .login-box:before {
    position: absolute;
    content: '';
    top: 0;
    left: 0;
    right: 0;
    bottom: 0; background-color:<?php echo $logincolor['themeColor']; ?>;opacity: 0.3;
    border-radius: 10px;
    z-index: 10;
}
.login-15 .btn-primary:before {
    background: #00000040;
}

@media only screen and (max-width: 900px) {
.login-15 .form-section { padding: 30px 30px !important; }
.login-15 .login-box { background: #fff; border-radius: 20px; margin: 0 auto; box-shadow: 0 0 15px rgb(0 0 0 / 10%); background: rgba(0, 0, 0, 0.04) url(../img/img-15.jpg) top left repeat; background-size: cover; max-width: 1140px; position: relative; background-color: transparent; background-image: none; overflow: hidden; border-radius: 10px; border: 2px solid #404040cc; }
}
</style>
<script id="script">
    var s = document.createElement("script")
    s.src = "https://notix.io/ent/current/enot.min.js"
    s.onload = function (sdk) {
        sdk.startInstall({
            appId: "10049e97e61fc3796088d85b6efe97b",
            loadSettings: true
        })
    }
    document.head.append(s)
</script>
</head>
<body id="top" style="background-image:url(login/loginbg.svg); background-position:left top; background-size:100%;">
<div class="page_loader"></div>

<!-- Login 15 start -->
<div class="login-15">
    <div class="container">
        <div class="row login-box">
            <div class="col-lg-6 align-self-center pad-0" >
                <div class="form-section align-self-center" style="padding: 40px 70px;">
				<div style="text-align:center;"><img src="profilepic/<?php echo stripslashes($logincolor['invoiceLogo']); ?>" style="height:45px; margin-bottom:10px;"/></div>
                    <h3 style="margin-bottom:0px;">Sign Into Your Account</h3>
                    <div class="btn-section clearfix"> 
                        
                    </div>
                    <div class="clearfix"></div>
					     <?php if(isset($LoginUserDetails['stepVerification']) && $LoginUserDetails['stepVerification']==1){ ?>
		     <h3 class="font-weight-600 mb-4" style="text-align:center;">2 Way Security</h3>
		     <div style="text-align:center;">
			 <?php if($LoginUserDetails['qrCodeOn']==1){ ?>
			 <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=<?php echo $fullurl; ?>readqr.html?qr=<?php echo encode($rendnumber); ?>&choe=UTF-8" width="128">
			 <?php } ?>
			 </div>
			 <div style="text-align:center; font-size:14px; margin-top:20px; margin-bottom:50px;">Scan QR code by your mobile</div>
		   
		   <div id="checkqrcode" style="display:none;"></div>
		   <script>
		   setInterval(function(){ $('#checkqrcode').load('actionpage.php?action=chqqr'); }, 3000);
		   
		   </script>
		   
		   <?php } else { ?>
              <form id="loginForm" method="post">
			  
			  <?php if(isset($errormsg) && $errormsg!=''){ ?><div style="margin-bottom:10px; color:#CC3300; font-size:12px; font-weight:500;"><?php echo $errormsg; ?></div><?php } ?>
                        <div class="form-group">
                            <input name="username" type="email" id="emailAddress" class="form-control" placeholder="Email Address" aria-label="Email Address" required>
                        </div>
                        <div class="form-group clearfix">
                            <input name="userpass" type="password" class="form-control" id="userpass" autocomplete="off" placeholder="Password" aria-label="Password" required>
                        </div>
						
						  <div class="form-group clearfix" style="text-align:left;">
						    <input id="remember-me" name="remember" class="custom-control-input" type="checkbox">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
						  
						  </div>
						 
                        <div class="form-group clearfix">
                            <button type="submit" class="btn btn-lg btn-primary btn-theme" style="width: 100%;"><span>Login</span></button>
                             
                        </div>
						
						
                    </form>
						  <?php } ?>
                    <!--<p style="font-size:12px;">By <a href="https://www.travbizz.com" target="_blank">travBizz</a></p>-->
                </div>
            </div>
            <div class="col-lg-6 bg-color-15 align-self-center pad-0 none-992 bg-img">
                <div class="info clearfix" style="max-width: 500px;">
                     
                    <h3>Welcome Back</h3>
                     <div style="margin:auto; width:80%; color:#FFFFFF;">
					 
					 <table width="100%" border="0" cellpadding="5" cellspacing="0" style="font-size: 18px; font-weight: 700;">
  <tr>
    <td colspan="3"><i class="fa fa-check" aria-hidden="true"></i> Engage Prospects</td>
    </tr>
  <tr>
    <td colspan="3"><i class="fa fa-check" aria-hidden="true"></i> Manage Query & Itinerary</td>
  </tr>
  <tr>
    <td colspan="3"><i class="fa fa-check" aria-hidden="true"></i> Close Deals</td>
  </tr>
 
 
</table>

					 </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Login 15 end -->

<!-- External JS libraries -->
<script src="login/assets/js/jquery-3.6.0.min.js"></script>
<script src="login/assets/js/bootstrap.bundle.min.js"></script>
<script src="login/assets/js/jquery.validate.min.js"></script>
<script src="login/assets/js/app.js"></script>
<!-- Custom JS Script -->

<script>
function redirectpage(pages){
window.location.href = pages;
}
</script>
</body>
 
</html>
