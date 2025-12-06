<!DOCTYPE html>
<html lang="zxx">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  f-->
    <title>@yield('title')</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{asset('site/images/favicon.png')}}">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	<!-- StyleSheet -->

	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{asset('site/css/bootstrap.css')}}">
	<!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('site/css/magnific-popup.min.css')}}">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('site/css/font-awesome.css')}}">
	<!-- Fancybox -->
	<link rel="stylesheet" href="{{asset('site/css/jquery.fancybox.min.css')}}">
	<!-- Themify Icons -->
    <link rel="stylesheet" href="{{asset('site/css/themify-icons.css')}}">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('site/css/niceselect.css')}}">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('site/css/animate.css')}}">
	<!-- Flex Slider CSS -->
    <link rel="stylesheet" href="{{asset('site/css/flex-slider.min.css')}}">
	<!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('site/css/owl-carousel.css')}}">
	<!-- Slicknav -->
    <link rel="stylesheet" href="{{asset('site/css/slicknav.min.css')}}">

	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="{{asset('site/css/reset.css')}}">
	<link rel="stylesheet" href="{{asset('site/style.css')}}">
    <link rel="stylesheet" href="{{asset('site/css/responsive.css')}}">



</head>
<body class="js">

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->


	<!-- Header -->
        <header class="header shop">
            <!-- Topbar -->
            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-12">
                            <!-- Top Left -->
                            <div class="top-left">
                                <ul class="list-main">
                                    <li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
                                    <li><i class="ti-email"></i> support@shophub.com</li>
                                </ul>
                            </div>
                            <!--/ End Top Left -->
                        </div>
                        <div class="col-lg-7 col-md-12 col-12">
                            <!-- Top Right -->
                            <div class="right-content">
                                <ul class="list-main">
                                    <li><i class="ti-location-pin"></i> Store location</li>
                                    <li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>
                                    @auth
                                        @if (Auth::user()->role_id == 2)
                                            <li><i class="ti-user"></i> <a href="{{ route('merchant.dashboard') }}">Merchant Dashboard</a></li>
                                        @elseif (Auth::user()->role_id == 3)
                                            <li><i class="ti-user"></i> <a href="{{ route('dashboard') }}">Customer Dashboard</a></li>
                                        @elseif (Auth::user()->role_id == 1)
                                            <li><i class="ti-user"></i> <a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                        @endif

                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                    <i class="ti-power-off"></i> Logout
                                                </a>
                                            </form>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}" class="inline-block px-3 py-1 text-sm border border-transparent hover:border-gray-300 rounded-sm">
                                            <i class="ti-user"></i> Log in
                                        </a></li>
                                        @if (Route::has('register'))
                                            <li><a href="{{ route('register') }}" class="inline-block px-3 py-1 text-sm border border-transparent hover:border-gray-300 rounded-sm">
                                                <i class="fa-solid fa-plus"></i> Register
                                            </a></li>
                                        @endif
                                    @endauth
                                </ul>
                            </div>
                            <!-- End Top Right -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Topbar  search -->
            <div class="middle-inner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-12">
                            <!-- Logo -->
                            <div class="logo">
                                <a href="{{ route('index') }}"><img src="{{ asset('site/images/logo.png') }}" alt="logo"></a>
                            </div>
                            <!--/ End Logo -->


                            <!-- Search Form -->
                            <div class="search-top">
                                <div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
                                <!-- Search Form -->
                                <div class="search-top">
                                    <form class="search-form">
                                        <input type="text" placeholder="Search here..." name="search">
                                        <button value="search" type="submit"><i class="ti-search"></i></button>
                                    </form>
                                </div>
                                <!--/ End Search Form -->

                            </div>
                            <!--/ End Search Form -->
                            <div class="mobile-nav"></div>
                        </div>
                        <div class="col-lg-8 col-md-7 col-12">
                            <div class="search-bar-top">
                                <div class="search-bar">
                                    <form action="{{ url('search') }}" method="GET">
                                        <div class="search-bar">
                                            <select>
                                                <option selected="selected">All Categories</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" name="query" placeholder="Search products here..." value="{{ request('query') }}">
                                            <button class="btnn"><i class="ti-search"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-12">
                            <div class="right-bar">
                                <!-- Search Form -->
                                <div class="sinlge-bar">
                                    <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div>
                                <div class="sinlge-bar">
                                    <a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
                                </div>
                                <div class="sinlge-bar shopping">
                                    <a href="#" class="single-icon"><i class="ti-bag"></i> 
                                        <span class="total-count">
                                            @if($cartCount > 0){{ $cartCount }}@endif
                                        </span>
                                    </a>
                                    <!-- Shopping Item -->
                                    <div class="shopping-item">
                                        <div class="dropdown-cart-header">
                                            <span>{{ $cartCount }} Items</span>
                                            <a href="{{ route('cart.index') }}">View Cart</a>
                                        </div>
                                        <ul class="shopping-list">
                                            @foreach($cart as $id => $details)
                                            <li>
                                                <a href="#" onclick="event.preventDefault(); document.getElementById('cart-item-{{ $id }}').submit()" class="remove" title="Remove this item"><i class="fa fa-remove"></i></a>
                                                <form id="cart-item-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a class="cart-img" href="#"><img src="https://placehold.co/70x70" alt="#"></a>
                                                <h4><a href="{{ route('site.product', $id) }}">{{ $details['name'] }}</a></h4>
                                                <p class="quantity">{{ $details['qty'] }}x - <span class="amount">{{ $details['price'] }}</span></p>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="bottom">
                                            <div class="total">
                                                <span>Total</span>
                                                <span class="total-amount">{{ $total }}</span>
                                            </div>
                                            <a href="{{ route('checkout.index') }}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                    <!--/ End Shopping Item -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Inner -->
            <div class="header-inner">
                <div class="container">
                    <div class="cat-nav-head">
                        <div class="row">
                            <div class="col-lg-3">
                                
            <!--side bar -->
                                <div class="all-category">
                                    <h3 class="cat-heading"><a href="{{ route('index') }}">HOME PAGE</a></h3>
                                </div>
                            </div>
            <!-- end side bar-->

            <!-- Main Menu bar -->
                                    <nav class="navbar navbar-expand-lg">
                                        <div class="navbar-collapse">
                                            <div class="nav-inner">
                                                <ul class="nav main-menu menu navbar-nav">
                                                        <li class="active"><a href="{{ route('site.products') }}">Categories<i class="ti-angle-down"></i></a>
                                                            <ul class="dropdown">
                                                                <li><a href="{{ route('site.products') }}" class="active"> All Products</a></li>
                                                                @foreach($categories as $category)
                                                                <li><a href="{{ route('site.category', $category->id) }}">{{ $category->name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        <li><a href="#">Blogs & Posts<i class="ti-angle-down"></i></a>
                                                            <ul class="dropdown">
                                                                <li><a href="{{ route('site.blogs.index') }}">All blogs</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">Shop<i class="ti-angle-down"></i><span class="new">New</span></a>
                                                            <ul class="dropdown">
                                                                <li><a href="#">Cart</a></li>
                                                                <li><a href="#">Checkout</a></li>
                                                            </ul>
                                                        </li>
                                                        <li><a href="#">Contact Us</a></li>
                                                    </ul>
                                            </div>
                                        </div>
                                    </nav>
            <!--/ End Main Menu bar -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ End Header Inner -->

        </header>
	<!--/ End Header -->

    <main>
        @yield('content')
    </main>

	<!-- Start Footer Area -->
	<footer class="footer">
		<!-- Footer Top -->
		<div class="footer-top section">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer about">
							<div class="logo">
								<a href="{{ route('index') }}"><img src="{{ asset('site/images/logo2.png') }}" alt="#"></a>
							</div>
							<p class="text">Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue,  magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.</p>
							<p class="call">Got Question? Call us 24/7<span><a href="tel:123456789">+0123 456 789</a></span></p>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Information</h4>
							<ul>
								<li><a href="{{ route('index')}}">Home</a></li>
								<li><a href="{{ route('site.products')}}">products</a></li>
								<li><a href="{{route('site.about')}}">About Us</a></li>
								<li><a href="{{route('site.products')}}">Our Products</a></li>
								<li><a href="{{route('site.contact')}}">Contact Us</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer links">
							<h4>Customer Service</h4>
							<ul>
								<li><a href="#">Payment Methods</a></li>
								<li><a href="#">Money-back</a></li>
								<li><a href="#">Returns</a></li>
								<li><a href="#">Shipping</a></li>
								<li><a href="#">Privacy Policy</a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Single Widget -->
						<div class="single-footer social">
							<h4>Get In Tuch</h4>
							<!-- Single Widget -->
							<div class="contact">
								<ul>
									<li>NO. 342 - London Oxford Street.</li>
									<li>012 United Kingdom.</li>
									<li>info@eshop.com</li>
									<li>+032 3456 7890</li>
								</ul>
							</div>
							<!-- End Single Widget -->
							<ul>
								<li><a href="#"><i class="ti-facebook"></i></a></li>
								<li><a href="#"><i class="ti-twitter"></i></a></li>
								<li><a href="#"><i class="ti-flickr"></i></a></li>
								<li><a href="#"><i class="ti-instagram"></i></a></li>
							</ul>
						</div>
						<!-- End Single Widget -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Footer Top -->
		<div class="copyright">
			<div class="container">
				<div class="inner">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="left">
								<p>Copyright © 2020 <a href="http://www.wpthemesgrid.com" target="_blank">Wpthemesgrid</a>  -  All Rights Reserved.</p>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="right">
								<img src="{{ asset('site/images/payments.png') }}" alt="#">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- /End Footer Area -->

	<!-- Jquery -->
    <script src="{{ asset('site/js/jquery.min.js')}}"></script>
    <script src="{{ asset('site/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{ asset('site/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{ asset('site/js/popper.min.js') }}"></script>
	<!-- Bootstrap JS -->
	<script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
	<!-- Color JS -->
	<script src="{{ asset('site/js/colors.js') }}"></script>
	<!-- Slicknav JS -->
	<script src="{{ asset('site/js/slicknav.min.js') }}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{ asset('site/js/owl-carousel.js') }}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{ asset('site/js/magnific-popup.js') }}"></script>
	<!-- Waypoints JS -->
	<script src="{{ asset('site/js/waypoints.min.js') }}"></script>
	<!-- Countdown JS -->
	<script src="{{ asset('site/js/finalcountdown.min.js') }}"></script>
	<!-- Nice Select JS -->
	<script src="{{ asset('site/js/nicesellect.js') }}"></script>
	<!-- Flex Slider JS -->
	<script src="{{ asset('site/js/flex-slider.js') }}"></script>
	<!-- ScrollUp JS -->
	<script src="{{ asset('site/js/scrollup.js') }}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{ asset('site/js/onepage-nav.min.js') }}"></script>
	<!-- Easing JS -->
	<script src="{{ asset('site/js/easing.js') }}"></script>
	<!-- Active JS -->
	<script src="{{ asset('site/js/active.js') }}"></script>
</body>
</html>`

