<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Nùdutin - Admin dashboard</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('assets-admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Main styles -->
    <link href="{{ asset('assets-admin/css/admin.css') }}" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="{{ asset('assets-admin/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <head>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-TzYZF5rZ09nwRGdjQkb8MdHCSgxhJcIzL9+h7xsYgouS8eON17pYOwHxr/hD/iSq" crossorigin="anonymous">
      </head>

    <!-- Plugin styles -->
    <link href="{{ asset('assets-admin/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Your custom styles -->
    <link href="{{ asset('assets-admin/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/solid.css') }}">

</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets-home/img/resto2.png') }}" alt="" width="110" height="37"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('admin.profile') }}">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Mon profil</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('Admin.restaurants') }}">
                        <i class="fa fa-fw fa-pencil"></i>
                        <span class="nav-link-text"> Restaurants
                        </span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('Admin.clients') }}">
                        <i class="fa fa-fw fa-users"></i>
                        <span class="nav-link-text"> Clients</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="{{ route('admin.payment_environment') }}">
                        <i class="fa fa-key"></i>
                        <span class="nav-link-text"> FedaPay</span>
                    </a>
                </li>

            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                @if (Auth::guard('admin')->user()->unreadnotifications->count() > 0)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route ('admin.notifications') }}"> <i class="fa-solid fa-bell text-white"></i> <span class="badge badge-danger">{{ Auth::guard('admin')->user()->unreadnotifications->count() }}</span></a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link" href="{{ route ('admin.profile') }}">    {{  Auth::guard('admin')->user()->name }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-fw fa-sign-out"></i>SE DÉCONNECTER</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- /Navigation-->
    {{-- <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>
    </div> --}}
			<!-- Page Wrapper -->
            <div class="page-wrapper">


                @yield('admin')

            </div>
            <!-- /Page Wrapper -->


    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Nùdutin 2024</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Prêt à partir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Sélectionnez "SE DÉCONNECTER" ci-dessous si vous êtes prêt à mettre fin à votre session en cours.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ANNULER</button>
                    <a class="btn btn-primary" href="{{ route('admin.logout') }} ">SE DÉCONNECTER</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('assets-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('assets-admin/vendor/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('assets-admin/vendor/jquery.magnific-popup.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets-admin/js/admin.js') }}"></script>
    <!-- Custom scripts for this page-->
    <script src="{{ asset('assets-admin/js/admin-charts.js') }}"></script>
</body>

</html>
