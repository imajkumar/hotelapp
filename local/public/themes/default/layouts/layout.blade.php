<!DOCTYPE html>
<html lang="en" >
    <!-- begin::Head -->
    <head>
        <meta charset="utf-8" />

        <title>HI TRAVEL</title>
        <meta name="description" content="Latest updates and statistic charts">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="BASE_URL" content="{{ url('/') }}" />

        <!--begin::Web font -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
        <script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
        </script>
        <!--end::Web font -->

        <!--begin::Global Theme Styles -->

                    <link href="{{ asset('local/public/themes/default/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
										<link href="{{ asset('local/public/themes/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
										<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" rel="stylesheet" type="text/css" />
                <!--end::Global Theme Styles -->




        <link rel="shortcut icon" href="http://boconnect.local/local/public/themes/admin/assets/corex/media/img/logo/favicon.ico" />
    </head>
    <!-- end::Head -->


    <!-- begin::Body -->
    <body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >



    	<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">


				<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
	<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
		<div class="m-stack m-stack--hor m-stack--desktop">
				<div class="m-stack__item m-stack__item--fluid">

					<div class="m-login__wrapper">

						<div class="m-login__logo">

						</div>

						<div class="m-login__signin">
							<div class="m-login__head">
								<h3 class="m-login__title"></h3>
							</div>
							<form class="m-login__form m-form" action="{{ route('login') }}" method="post">
                @csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Password" name="password">
									<span>	<i class="flaticon-eye"></i></span>
								</div>
								
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" style="background-color:#f79225" class="btn btn-primary m-btn">Log In</button>
								</div>
							</form>
						</div>



						<div class="m-login__signup">
							<div class="m-login__head">
								<h3 class="m-login__title">Sign Up</h3>
								<div class="m-login__desc">Enter your details to create your account:</div>
							</div>
							<form class="m-login__form m-form" action="{{ route('register') }}" method="post">
                @csrf
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="name" name="name">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" autocomplete="off">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="password" placeholder="Password" name="password">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="Confirm Password" name="password_confirmation">
								</div>
								<div class="row form-group m-form__group m-login__form-sub">
									<div class="col m--align-left">
										<label class="m-checkbox m-checkbox--focus">
										<input type="checkbox" name="agree"> I Agree the <a href="#" class="m-link m-link--focus">terms and conditions</a>.
										<span></span>
										</label>
										<span class="m-form__help"></span>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Sign Up</button>
									<button id="m_login_signup_cancel" class="btn btn-outline-focus  m-btn m-btn--pill m-btn--custom">Cancel</button>
								</div>
							</form>
						</div>

						<div class="m-login__forget-password">
							<div class="m-login__head">
								<h3 class="m-login__title">Forgotten Password ?</h3>
								<div class="m-login__desc">Enter your email to reset your password:</div>
							</div>
							<form class="m-login__form m-form" action="">
								<div class="form-group m-form__group">
									<input class="form-control m-input" type="text" placeholder="Email" name="email" id="m_email" autocomplete="off">
								</div>
								<div class="m-login__form-action">
									<button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air">Request</button>
									<button id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom">Cancel</button>
								</div>
							</form>
						</div>
					</div>

				</div>
				<div class="m-stack__item m-stack__item--center">

					<<div class="m-login__account">
						<span class="m-login__account-msg">
						Don't have an account yet ?
						</span>&nbsp;&nbsp;
						<a href="javascript:;" id="m_login_signup" class="m-link m-link--focus m-login__account-link">Sign Up</a>
					</div>

				</div>
		</div>
	</div>
	<div class="m-grid__item m-grid__item--fluid m-grid m-grid--center m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content m-grid-item--center" style="background:#f79225">
		<div class="m-grid__item">
			<h3 class="m-login__welcome">HI TRAVEL</h3>
			<p class="m-login__msg">

			</p>
		</div>
	</div>
</div>


</div>
<!-- end:: Page -->


        <!--begin::Global Theme Bundle -->
                    <script src="{{ asset('local/public/themes/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
										<script src="{{ asset('local/public/themes/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>
										<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" type="text/javascript"></script>
                <!--end::Global Theme Bundle -->


										<!--begin::Page Scripts -->
										<script src="{{ asset('local/public/themes/default/assets/snippets/custom/pages/user/sweetalert2.js') }} " type="text/javascript"></script>
                    <script src="{{ asset('local/public/themes/default/assets/snippets/custom/pages/user/login.js') }} " type="text/javascript"></script>
                        <!--end::Page Scripts -->
                        <script type="text/javascript">
                            	BASE_URL=$('meta[name="BASE_URL"]').attr('content');
                              CSRF_TOKEN=$('meta[name="csrf-token"]').attr('content');
															$('.flaticon-eye').click(function(){
        var type=$("input[name=password]").attr('type');      
        if(type=='password'){
          $("input[name=password]").attr('type','text');
        }else{
          $("input[name=password]").attr('type','password');
        }
      
      
    

      });


												</script>
												
                    </body>
    <!-- end::Body -->
</html>
