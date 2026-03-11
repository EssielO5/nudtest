<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<title>Nùdutin - Restaurant Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

		<!-- Favicon -->
		{{-- <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets-login/img/favicon.png') }}"> --}}

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('assets-login/css/bootstrap.min.css') }}">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{ asset('assets-login/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets-login/plugins/fontawesome/css/all.min.css') }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('assets-login/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets-login/css/restaurant.css') }}">

	</head>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">


			<!-- Page Content -->
			<div class="bg-pattern-style">
				<div class="content">

					<!-- Login Tab Content -->
					<div class="account-content">
						<div class="account-box">
							<div class="login-right">
								<div class="login-header">
                                    <a href="/" class="home-icon"><i class="fas fa-arrow-circle-left"></i></a>

									<h3>Login <span>Restaurant</span></h3>
									<p class="text-muted">Accéder à votre tableau de bord</p>
								</div>
                                {{-- @if (Session::has('error'))
                                <div class="alert alert-warning" role="alert">
                                    {{ session::get('error') }}
                                  </div>

                                @endif

                                @if (Session::has('logout'))
                                <div class="alert alert-dark" role="alert">
                                    {{ session::get('logout') }}
                                  </div>

                                @endif --}}

								<form action="{{ route('restaurant.login') }}" method="post">
                                    @csrf
									<div class="form-group">
										<label class="form-control-label">Email Addresse</label>
										<input type="email" class="form-control" name="email">
									</div>
									<div class="form-group">
										<label class="form-control-label">Mot de passe</label>
										<div class="pass-group">
											<input type="password" class="form-control pass-input" name="password">
											{{-- <span class="fas fa-eye toggle-password"></span> --}}
										</div>
									</div>

									{{-- <div class="text-end">
										<a class="forgot-link" href="forgot-password.html">Forgot Password ?</a>
									</div> --}}
									<button class="btn btn-primary login-btn" type="submit">Login</button>
									<div class="text-center dont-have">Vous n'avez pas de compte ?<a href="{{ route('restaurant.registers') }}">Enrégistrez-vous ?</a></div>
								</form>
							</div>
						</div>
					</div>
					<!-- /Login Tab Content -->

				</div>

			</div>
			<!-- /Page Content -->

		</div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
		<script src="{{ asset('assets-login/js/jquery-3.6.0.min.js') }}"></script>

		<!-- Bootstrap Core JS -->
		<script src="{{ asset('assets-login/js/bootstrap.bundle.min.js') }}"></script>

		<!-- Custom JS -->
		<script src="{{ asset('assets-login/js/script.js') }}"></script>

	</body>
</html>
