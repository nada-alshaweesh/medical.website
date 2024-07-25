<?php

include_once("includes/dbconn.php");
error_reporting(0);
session_start();




  

  if(isset($_POST['submit'])){

      $email=$_POST['email'];
      $password=$_POST['password'];

      $query   ="select * from patient where PEmail='$email' AND PPassword='$password' ";
$result  =mysqli_query($conn , $query);
$row     =mysqli_fetch_assoc($result);

  if ($row['PID']) 
  {
      $_SESSION['PID']=$row['PID'];
      
      echo "<script> window.location.href='patient/index.php';</script>";
  }
    
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png">
  <link rel="icon" type="image/png" href="patient/img/favicon.png">
  <title>
بوابة المريض
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="patient/css/nucleo-icons.css" rel="stylesheet" />
  <link href="patient/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="patient/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
  <!-- Nepcha Analytics (nepcha.com) -->
  <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="bg-gray-200">
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
      
        <!-- End Navbar -->
      </div>
    </div>
  </div>
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image:url('img/bg01.jpg');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">  بوابة المريض</h4>

                  <div class="row mt-3">
                    <div class="col-2 text-center ms-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-facebook text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center px-1">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-github text-white text-lg"></i>
                      </a>
                    </div>
                    <div class="col-2 text-center me-auto">
                      <a class="btn btn-link px-3" href="javascript:;">
                        <i class="fa fa-google text-white text-lg"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start" method="post">

                  <div class="input-group input-group-outline my-3">
                    <input type="email" name="email" class="form-control" required placeholder="البريد الإكتروني">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <input type="password" name="password" class="form-control" required  placeholder="كلمة المرور">
                  </div>
                
                  <div class="text-center">
                    <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2" name="submit">تسجيل دخول</button>
                  </div>
                  
                </form>
                <div class="text-center">
                    <a href="signup.php">
                    <button type="btn" class="btn bg-gradient-primary w-100 my-4 mb-2" name=""> 
                    افتح حساب</button>
               </a>
               <a href='forgot-password.php'>هل نسيت كلمة السر ؟</a>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
   
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="patient/assets/js/core/popper.min.js"></script>
  <script src="patient/assets/js/core/bootstrap.min.js"></script>
  <script src="patient/assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="patient/assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="patient/assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>