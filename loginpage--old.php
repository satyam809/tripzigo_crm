<?php 
error_reporting(0);
ob_start();
include "config/database.php"; 
include "config/function.php";  
include "config/setting.php";  
 

if($_POST['username']!='' && $_POST['userpass']!=''){   
$username = clean($_POST['username']); 
$password = clean($_POST['userpass']); 


$ftoken = '';   
$loginreturn = login($username,$password,$ftoken);
if($loginreturn=='yes'){ 
 

header("Location: ".$fullurl.""); 
exit(); 
} else {  
$errormsg='Invalid username or password';
}
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0,minimal-ui">
  <title>Login - <?php echo $clientnameglobal; ?></title>
      <meta content="Admin Dashboard" name="description">
      <meta content="Themesbrand" name="author">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- App Icons -->
    <link href="images/favicon.png" rel="icon" />
      <!-- App css -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="assets/css/icons.css" rel="stylesheet" type="text/css">
      <link href="assets/css/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <!-- Loader -->
      <div id="preloader">
         <div id="status">
            <div class="spinner"></div>
         </div>
      </div>
      <!-- Begin page -->
      <div class="accountbg"></div>
      <div class="wrapper-page">
         <div class="card">
            <div class="card-body">
               <div class="p-3">
                  <div class="float-right text-right">
                     <h4 class="font-18 mt-3 m-b-5">Welcome Back !</h4>
                     <p class="text-muted">Sign in to continue.</p>
                  </div>
                  <a href="index.html" class="logo-admin"><img src="images/logo.png" height="26" alt="logo"></a>
               </div>
               <div class="p-3">
			    <form id="loginForm" method="post" class="form-horizontal m-t-10" > 
                     <div class="form-group"><label for="username">Email</label> <input type="email" class="form-control" id="username" name="username" placeholder="Enter Email"></div>
                     <div class="form-group"><label for="userpassword">Password</label> <input type="password" class="form-control" id="password" name="userpass" placeholder="Enter password"></div>
                     <div class="form-group row m-t-30">
                        <div class="col-sm-6">
                           <div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customControlInline"> <label class="custom-control-label" for="customControlInline">Remember me</label></div>
                        </div>
                        <div class="col-sm-6 text-right"><button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button></div>
                     </div>
                     <div class="form-group m-t-30 mb-0 row">
                        <div class="col-12 text-center"><a href="pages-recoverpw.html" class="text-muted"><i class="mdi mdi-lock"></i> Forgot your password?</a></div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="m-t-40 text-center text-white-50"> 
            <p>© 2021 travBizz</p>
         </div>
      </div>
      <!-- jQuery  --><script src="assets/js/jquery.min.js"></script><script src="assets/js/bootstrap.bundle.min.js"></script><script src="assets/js/modernizr.min.js"></script><script src="assets/js/waves.js"></script><script src="assets/js/jquery.slimscroll.js"></script><!-- App js --><script src="assets/js/app.js"></script>
   </body>
 </html>