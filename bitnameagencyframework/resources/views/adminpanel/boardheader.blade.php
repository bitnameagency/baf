<body>
    <!-- Preloader 
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    <!-- /Preloader -->
	
	<!-- HK Wrapper -->
	<div class="hk-wrapper hk-alt-nav">

        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar hk-navbar-alt">
            <a class="navbar-toggle-btn nav-link-hover navbar-toggler" href="javascript:void(0);" data-toggle="collapse" data-target="#navbarCollapseAlt" aria-controls="navbarCollapseAlt" aria-expanded="false" aria-label="Toggle navigation"><span class="feather-icon"><i data-feather="menu"></i></span></a>
            <a class="navbar-brand" href="dashboard1.html">
                <img style="height:40px;" class="brand-img d-inline-block align-top" src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/img/logo-light.png" alt="brand" />
            </a>
		
			@yield('headermenu')

            <ul class="navbar-nav hk-navbar-content">
    
                <li class="nav-item dropdown dropdown-authentication">
                    <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media">
                            <div class="media-img-wrap">
                                <div class="avatar">
                                    <img src="{{ serverName }}/bitnameagencyframework/admin/themes/default/dist/img/avatar5.jpg" alt="user" class="avatar-img rounded-circle">
                                </div>
                                <span class="badge badge-success badge-indicator"></span>
                            </div>
                            <div class="media-body">
							@php
							$User = new User;
							@endphp
                                <span>{{ $User->login()['loginInput'] }}<i class="zmdi zmdi-chevron-down"></i></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
          
                        <a class="dropdown-item" href="/adminPanel/logout"><i class="dropdown-icon zmdi zmdi-power"></i><span>{{ $logout_text }}</span></a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /Top Navbar -->