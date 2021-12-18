<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>{{ $title }}</title>
    <meta name="description" content="{{ $description }}" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ serverName }}/bitnameagencyframework/admin/themes/default/favicon.ico">
    <link rel="icon" href="{{ serverName }}/bitnameagencyframework/admin/themes/default/favicon.ico" type="image/x-icon">

    <!-- Custom CSS -->
    <link href="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/css/style.css" rel="stylesheet" type="text/css">
</head>
<body><!-- Preloader -->
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->   
	<!-- HK Wrapper -->
	<div class="hk-wrapper">
        <!-- Main Content -->
        <div class="hk-pg-wrapper hk-auth-wrapper">
            <header class="d-flex justify-content-between align-items-center">
                <a class="d-flex auth-brand" href="#">
                    <img style="width:250px;" class="brand-img" src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/img/logo-dark.png" alt="brand" />
                </a>
                <div class="btn-group btn-group-sm">
                    <a href="{{ $helptexthref }}" class="btn btn-outline-secondary">{{ $helptext }}</a>
                    <a href="{{ $aboutustexthref }}" class="btn btn-outline-secondary">{{ $aboutustext }}</a>
                </div>
            </header>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-5 pa-0">
                        <div id="owl_demo_1" class="owl-carousel dots-on-item owl-theme">

							
						@forelse($slider as $data)

 <div class="fadeOut item auth-cover-img overlay-wrap" style="background-image:url({{ $data['imageurl'] }});">
                                <div class="auth-cover-info py-xl-0 pt-100 pb-50">
                                    <div class="auth-cover-content text-center w-xxl-75 w-sm-90 w-xs-100">
                                        <h1 class="display-3 text-white mb-20">{{ $data['title'] }}</h1>
                                        <p class="text-white">{{ $data['description'] }}</p>
                                    </div>
                                </div>
                                <div class="bg-overlay bg-trans-dark-50"></div>
                            </div>

					@empty           
					@endforelse
                        
                        </div>
                    </div>
                    <div class="col-xl-7 pa-0">
                        <div class="auth-form-wrap py-xl-0 py-50">
                            <div class="auth-form w-xxl-55 w-xl-75 w-sm-90 w-xs-100">
                                <form method="POST">
                                    <h1 class="display-4 mb-10">{{ $welcome['title'] }}</h1>
                                    <p class="mb-30">{{ $welcome['sub'] }}</p>
                                    <div class="form-group">
                                        <input name="username" id="username" class="form-control" placeholder="{{ $usernameplaceholder }}">
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input name="password" id="password" class="form-control" placeholder="{{ $passwordplaceholder }}" type="password">
                                         </div>
									</div>
									
          
									  
									@captcha
                                         	
											
                                    <div class="custom-control custom-checkbox mb-25">
                                        <input class="custom-control-input" name="rememberMe" value="1" id="same-address" type="checkbox" checked>
                                        <label class="custom-control-label font-14" for="same-address">{{ $rememberme }}</label>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">{{ $logintext }}</button>                    
							   </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Main Content -->

    </div>
	<!-- /HK Wrapper -->

    <!-- jQuery -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- Owl JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/vendors/owl.carousel/dist/owl.carousel.min.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/feather.min.js"></script>

    <!-- Init JavaScript -->
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/init.js"></script>
    <script src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/js/login-data.js"></script>
</body>

</html>