<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<title>Admin - Enregistrement</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

		<!-- Favicon -->
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">

		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{ asset('assets1/plugins/fontawesome/css/fontawesome.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets1/plugins/fontawesome/css/all.min.css') }}">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{ asset('assets1/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets1/css/admin.css') }}">

	</head>
	<body class="account-page">

		<!-- Main Wrapper -->
		<div class="main-wrapper">


			<!-- Page Content -->
			<div class="bg-pattern-style bg-pattern-style-register">
				<div class="content">

					<!-- Register Content -->
					<div class="account-content">
						<div class="account-box">
							<div class="login-right">
								<div class="login-header">
                                    <a href="/" class="home-icon"><i class="fas fa-arrow-circle-left"></i></a>

									<h3><span>Admin</span> Enregistrement</h3>
									<p class="text-muted"><br></p>
								</div>

								<!-- Register Form -->
								<form method="post" action="{{ route('admin.register.create') }}">
								@csrf
								<div class="form-group">
									<label class="form-control-label">Nom du admin</label>
									<input type="text" class="form-control" name="name" autofocus="">
								</div>
								<div class="form-group">
									<label class="form-control-label">Adresse e-mail</label>
									<input type="email" name="email" class="form-control">
								</div>
								<div class="row">
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label">Mot de passe</label>
											<input type="password" class="form-control" name="password">
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label class="form-control-label">Confirmez le mot de passe</label>
											<input type="password" class="form-control" name="password_confirmation">
										</div>
									</div>
								</div>
								<button class="btn btn-primary login-btn" type="submit">Créer un compte</button>
								<div class="account-footer text-center mt-3">
									Vous avez déjà un compte? <a class="forgot-link mb-0" href="{{ route('admin_login_form') }}">Login</a>
								</div>
							</form>

								<!-- /Register Form -->

							</div>
						</div>
					</div>
					<!-- /Register Content -->

				</div>

			</div>
			<!-- /Page Content -->

		</div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
		<script src="{{ asset('assets1/js/jquery-3.6.0.min.js') }}"></script>

		<!-- Bootstrap Core JS -->
		<script src="{{ asset('assets1/js/bootstrap.bundle.min.js') }}"></script>

		<!-- Custom JS -->
		<script src="{{ asset('assets1/js/script.js') }}"></script>

	</body>
</html>
