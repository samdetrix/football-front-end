<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>TechVannah Bet Space</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="MyraStudio" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico')}}">

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
                                                <a href="index.html">
                                                    <span><img src="assets/images/logo-dark.png" alt=""
                                                            height="26"></span>
                                                </a>
                                                <h2>Register User</h2>
                                                <div id="errorMessage"></div>
                                                <div id="successMessage"></div>
                                                
                                            </div>
                                            <form @submit.prevent="handleRegistration" id="registerForm" class="p-2">
                                                <div class="form-group">
                                                    <label for="username">Name</label>
                                                    <input v-model="registerData.username" class="form-control"
                                                        type="text" id="username" required placeholder="names">
                                                </div>
                                                <div class="form-group">
                                                    <label for="emailaddress">Email address</label>
                                                    <input v-model="registerData.email" class="form-control"
                                                        type="email" id="emailaddress" required placeholder="email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone">Phone</label>
                                                    <input v-model="registerData.phone" class="form-control"
                                                        type="tel" id="phone" placeholder="Phone Number">
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input v-model="registerData.password" class="form-control"
                                                        type="password" required id="password"
                                                        placeholder="Enter your password">
                                                </div>

                                                <div class="mb-3 text-center">
                                                    <button class="btn btn-primary btn-block" type="submit"> Sign Up
                                                        Free </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->

                                    <div class="row mt-4">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-white-50 mb-0">Already have an account? <a
                                                    href="pages-login.html" class="text-white-50 ml-1"><b>Sign
                                                        In</b></a></p>
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
    <!-- end page -->

    <!-- jQuery  -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const registerForm = document.getElementById('registerForm');
            const errorMessageContainer = document.getElementById('errorMessage');
            const successMessageContainer = document.getElementById('successMessage');

            registerForm.addEventListener('submit', function(event) {
                event.preventDefault();

                // Get form data
                const formData = {
                    name: document.getElementById('username').value,
                    email: document.getElementById('emailaddress').value,
                    phone: document.getElementById('phone').value,
                    password: document.getElementById('password').value,
                    role_id: 1
                };

                // Make a POST request to your registration endpoint
                fetch('http://127.0.0.1:8000/api/auth/register', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(formData),
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);

                        if (data.status === 'success') {
                            // Show success message and redirect to the login page
                            successMessageContainer.textContent = data.message;
                            errorMessageContainer.textContent = '';
                            window.location.href = '{{ route("sign.in") }}';

                        } else {
                            // Show error message and redirect to the sign-up page
                            errorMessageContainer.textContent = data.message;
                            successMessageContainer.textContent = '';
                            window.location.href = '{{ route("sign.up") }}';

                        }
                    })
                    .catch(error => {
                        console.error('Error registering user:', error);
                    });
            });
        });
    </script>

    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/waves.js') }}"></script>
    <script src="{{ asset('admin/assets/js/simplebar.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/theme.js') }}"></script>

</body>

</html>
