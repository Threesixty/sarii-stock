
<!DOCTYPE html>
<!--
Template Name: Metronic - Bootstrap 4 HTML, React, Angular 11 & VueJS Admin Dashboard Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: https://1.envato.market/EA4JP
Renew Support: https://1.envato.market/EA4JP
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="fr">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<title>Connexion | SARII-Stock</title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Shadows+Into+Light&display=swap"> 
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="assets/css/pages/login/classic/login-5.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />

		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

		<?php
		if (!empty($notifications)) { ?>
			<span class="notification" data-status="<?= $notifications['status'] ?>" data-msg="<?= $notifications['msg'] ?>"></span>
		<?php } ?>
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-5 d-flex flex-row-fluid login-<?= $formAction ?>-on" id="kt_login">
				<div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid bg-mobile" style="background-image: url(assets/media/bg/bg-2.jpg);">
					<div class="login-form text-center text-white p-7 position-relative overflow-hidden">
						<!--begin::Login Sign in form-->
						<div class="login-signin">
							<form class="form" id="kt_login_signin_form" method="post">
								<!--begin::Login Header-->
								<div class="d-flex flex-center mb-5">
									<img src="assets/media/logos/sarii-stock.png" class="max-h-150px" alt="" />
								</div>
								<div class="d-flex flex-center mb-15">
									<span class="logo logo-big">{SARII-Stock}</span>
								</div>
								<!--end::Login Header-->
								<input type="hidden" name="action" value="signin">
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="text" placeholder="Identifiant" name="username" autocomplete="off" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="password" placeholder="Mot de passe" name="password" />
								</div>
								<div class="form-group d-flex flex-wrap justify-content-between align-items-center px-8 opacity-60">
									<a href="javascript:;" id="kt_login_forgot" class="text-white font-weight-bold">Mot de passe oublié ?</a>
								</div>
								<div class="form-group text-center mt-10">
									<button type="submit" id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Connexion</button>
								</div>
								<div class="mt-10">
									<span class="opacity-40 mr-4">Pas de compte ?</span>
									<a href="javascript:;" id="kt_login_signup" class="text-white opacity-30 font-weight-normal">Demandez un accès</a>
								</div>
							</form>
						</div>
						<!--end::Login Sign in form-->
						<!--begin::Login Sign up form-->
						<div class="login-signup">
							<form class="form" id="kt_login_signup_form" method="post">
								<div class="d-flex flex-center mb-5">
									<img src="assets/media/logos/sarii-stock.png" class="max-h-150px" alt="" />
								</div>
								<div class="d-flex flex-center mb-15">
									<span class="logo logo-big">{SARII-Stock}</span>
								</div>
								<!--end::Login Header-->
								<input type="hidden" name="action" value="signup">
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="text" placeholder="Prénom *" name="firstname" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="text" placeholder="Nom *" name="lastname" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="text" placeholder="Identifiant *" name="username" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email *" name="email" autocomplete="off" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="password" placeholder="Mot de passe *" name="password" />
								</div>
								<div class="form-group">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="password" placeholder="Confirmez le mot de passe *" name="cpassword" />
								</div>
								<div class="form-group text-left px-8">
									<div class="checkbox-inline">
										<label class="checkbox checkbox-outline checkbox-white opacity-60 text-white m-0">
											<input type="checkbox" name="agree" />
											<span></span>J'accepte les <a href="#" class="text-white font-weight-bold ml-1">conditons générales d'utilisation *</a>.
										</label>
									</div>
									<div class="form-text text-muted text-center"></div>
								</div>
								<div class="form-group">
									<button type="submit" id="kt_login_signup_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Demander mon accès</button>
									<button id="kt_login_signup_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Annuler</button>
								</div>
							</form>
						</div>
						<!--end::Login Sign up form-->
						<!--begin::Login forgot password form-->
						<div class="login-forgot">
							<form class="form" id="kt_login_forgot_form" method="post">
								<div class="d-flex flex-center mb-5">
									<img src="assets/media/logos/sarii-stock.png" class="max-h-150px" alt="" />
								</div>
								<div class="d-flex flex-center mb-15">
									<span class="logo logo-big">{SARII-Stock}</span>
								</div>
								<div class="mb-5">
									<p class="opacity-40">Veuillez saisir votre adresse email</p>
								</div>
								<!--end::Login Header-->
								<input type="hidden" name="action" value="forgot">
								<div class="form-group mb-10">
									<input class="form-control h-auto text-white bg-white-o-10 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off" />
								</div>
								<div class="form-group">
									<button type="submit" id="kt_login_forgot_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3 m-2">Recevoir un nouveau mot de passe</button>
									<button id="kt_login_forgot_cancel" class="btn btn-pill btn-outline-white opacity-70 px-15 py-3 m-2">Annuler</button>
								</div>
							</form>
						</div>
						<!--end::Login forgot password form-->
					</div>
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<script src="assets/js/pages/custom/login/login-general.js"></script>
	</body>
	<!--end::Body-->
</html>