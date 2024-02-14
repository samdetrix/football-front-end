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

    <!-- App css -->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-bt09YkEX+3FfEXeLx0dA5VGyBPI0IRHBR3m6YGo5DW2pTlq8c+Qqo8va1DZO2owW" crossorigin="anonymous">
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">

                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="dropdown d-none d-sm-inline-block">

                        <div class="dropdown-menu">


                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center">





                    <div class="dropdown d-inline-block">


                    </div>
                </div>

                <div class="dropdown d-inline-block ml-2">
                    <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle header-profile-user"
                            src="{{ asset('admin/assets/images/users/avatar-3.jpg') }}" alt="Header Avatar">
                        <!-- Assuming you have an element with an ID 'userNameElement' where you want to display the userName -->
                        <span id="userNameElement" class="d-none d-sm-inline-block ml-1">Jamie D.</span>


                        <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="javascript:void(0)">
                            <span>Profile</span>
                            <span>
                                <span class="badge badge-pill badge-warning">1</span>
                            </span>
                        </a>

                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="javascript:void(0)">
                            <span>Log Out</span>
                        </a>
                    </div>
                </div>

            </div>
    </div>
    </header>

    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">

        <div data-simplebar class="h-100">

            <div class="navbar-brand-box">
                <a href="{{route('dashboard')}}" class="logo">
                </a>
            </div>

            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title">TechVanna Bet Space</li>

                    <li>
                        <a href="{{route('dashboard')}}" class="waves-effect"><i class='bx bx-home-smile'></i><span
                                class="badge badge-pill badge-primary float-right"></span><span>Dashboard</span></a>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="bx bx-file"></i><span>My
                                Games</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('featured.games') }}">featured games</a></li>
                        </ul>
                    </li>


                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                class="bx bx-cookie"></i><span>System Settings</span></a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('profile') }}">My Profile</a></li>
                            <li><a href="{{ route('change-password') }}">Change Password</a></li>

                        </ul>
                    </li>



                </ul>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    @yield('content')
    <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    @yield('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const userName = localStorage.getItem('userName');

            if (userName) {
                document.getElementById('userNameElement').textContent = userName;
            }
        });
    </script>
     <script src="{{ asset('admin/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/metismenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/waves.js') }}"></script>
    <script src="{{ asset('admin/assets/js/simplebar.min.js') }}"></script>

    <!-- Morris Js-->
    <script src="{{ asset('plugins/morris-js/morris.min.js') }}"></script>
    <!-- Raphael Js-->
    <script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>

    <!-- Morris Custom Js-->
    <script src="{{ asset('admin/assets/pages/dashboard-demo.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src="{{ asset('admin/assets/pages/datatables-demo.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('admin/assets/js/theme.js') }}"></script>

</body>

</html>
