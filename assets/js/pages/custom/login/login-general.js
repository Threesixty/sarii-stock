"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: 'L‘identifiant est requis'
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: 'Le mot de passe est requis'
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();
            var currentForm = $(this).closest('form');

            validation.validate().then(function(status) {
		        if (status != 'Valid') {
					swal.fire({
		                text: "Attention ! Il semblerait que certains champs requis n'aient pas été renseignés.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "C'est compris",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				} else {
					currentForm.submit();
				}
		    });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					firstname: {
						validators: {
							notEmpty: {
								message: 'Votre prénom est requis'
							}
						}
					},
					lastname: {
						validators: {
							notEmpty: {
								message: 'Votre nom est requis'
							}
						}
					},
					username: {
						validators: {
							notEmpty: {
								message: 'Veuillez choisir un identifiant'
							}
						}
					},
					email: {
                        validators: {
							notEmpty: {
								message: 'Votre adresse email est requise'
							},
                            emailAddress: {
								message: 'L‘adresse email saisie n‘est pas valide'
							}
						}
					},
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Veuillez choisir un mot de passe'
                            }
                        }
                    },
                    cpassword: {
                        validators: {
                            notEmpty: {
                                message: 'La confirmation du mot de passe est requise'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'Les mots de passe saisis ne sont pas identiques'
                            }
                        }
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'Vous devez accepter les conditions générales d‘utilisation'
                            }
                        }
                    },
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signup_submit').on('click', function (e) {
            e.preventDefault();
            var currentForm = $(this).closest('form');

            validation.validate().then(function(status) {
		        if (status != 'Valid') {
					swal.fire({
		                text: "Attention ! Il semblerait que certains champs requis n'aient pas été renseignés.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "C'est compris",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				} else {
					currentForm.submit();
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Votre adresse email est requise'
							},
                            emailAddress: {
								message: 'L‘adresse email saisie n‘est pas valide'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();
            var currentForm = $(this).closest('form');

            validation.validate().then(function(status) {
		        if (status != 'Valid') {
					swal.fire({
		                text: "Attention ! Il semblerait que certains champs requis n'aient pas été renseignés.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "C'est compris",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				} else {
					currentForm.submit();
				}
		    });
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');

            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
