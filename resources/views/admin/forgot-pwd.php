<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TechVanna Bet Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
    

</head>

<body class="bg-primary">

    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block my-5">
                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center mb-4 mt-3">
                                                <h2>Forgot Password</h2>
                                            </div>
                                            <form id="loginForm" class="p-2">
                                                <div class="form-group">
                                                    <label for="emailaddress">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress"
                                                        required placeholder="john@deo.com">
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <button class="btn btn-primary btn-block" type="submit">Sign
                                                        In</button>
                                                </div>
                                            </form>

                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->

                                    <div class="row mt-4">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-white-50 mb-0">Create an account? <a
                                                    href="{{ route('sign.up') }}" class="text-white-50 ml-1"><b>Sign
                                                        Up</b></a></p>
                                        </div>
                                    </div>

                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>


    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/waves.js') }}"></script>
    <script src="{{ asset('admin/assets/js/simplebar.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/theme.js') }}"></script>
</body>

</html>
