<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from coderthemes.com/adminto/layouts/auth-confirm-mail.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Sep 2022 18:44:29 GMT -->
<head>
        <meta charset="utf-8" />
        <title>Confirm Email | Adminto - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">

		<!-- App css -->

		<link href="{{asset('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" id="app-style" />

		<!-- icons -->
		<link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="loading authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="text-center">
                            <a href="index.html">
                                <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="22" class="mx-auto">
                            </a>
                            <p class="text-muted mt-2 mb-4">Responsive Admin Dashboard</p>
                        </div>
                        <div class="card text-center">

                            <div class="card-body p-4">
                                
                                <div class="mb-4">
                                    <h4 class="text-uppercase mt-0">Confirm Email</h4>
                                </div>
                                <img src="{{asset('assets/images/mail_confirm.png')}}" alt="img" width="86" class="mx-auto d-block" />

                                <p class="text-muted font-14 mt-2"> Your Email <b>{{$user->email}}</b>.
                                    has been verified. </p>

                                <a href="{{route('home')}}" class="btn d-block btn-pink waves-effect waves-light mt-3">Back to Home</a>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor -->
        <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{asset('assets/libs/waypoints/lib/jquery.waypoints.min.js')}}"></script>
        <script src="{{asset('assets/libs/jquery.counterup/jquery.counterup.min.js')}}"></script>
        <script src="{{asset('assets/libs/feather-icons/feather.min.js')}}"></script>

        <!-- App js -->
        <script src="{{asset('assets/js/app.min.js')}}"></script>
        
    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/auth-confirm-mail.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 08 Sep 2022 18:44:29 GMT -->
</html>