@extends('site.layouts.app')

@section('title', 'Home Page')
@section('content')


	<!-- Slider Area -->
	<section class="hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>{{ __('home.hero_title') }}</span></h1>
										<p>{{ __('home.hero_description') }}</p>
										<div class="button">
											<a href="{{ route('site.products') }}" class="btn">{{ __('home.shop_now') }}</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->

	<!-- Start Midium Banner  -->
	<section class="midium-banner">
		<div class="col-12">
			<div class="section-title">
				<h2>{{ __('home.special_offer') }}</h2>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<!-- Single Banner  -->
				@foreach($products as $product)
					<div class="col-lg-6 col-md-6 col-12">
						<div class="single-banner">
							<img src="https://placehold.co/600x370" alt="{{ $product->name }}">
							<div class="content">
								<p>{{ $product->name }}</p>
								<h3>{{ $product->slug }} <br> {{ __('home.up_to') }} <span> 50%</span></h3>
								<a href="{{ route('site.product', $product->id) }}">{{ __('home.shop_now_small') }}</a>
							</div>
						</div>
					</div>
				@endforeach
				<!-- /End Single Banner  -->
			</div>
		</div>

	</section>
	<!-- End Midium Banner -->

	<!-- Start Shop Blog  -->

	<!-- End Shop Blog  -->

	<!-- Start Shop Services Area -->
	<section class="shop-services section home">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>{{ __('home.free_shipping') }}</h4>
						<p>{{ __('home.orders_over') }}</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>{{ __('home.free_return') }}</h4>
						<p>{{ __('home.within_days') }}</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>{{ __('home.secure_payment') }}</h4>
						<p>{{ __('home.secure_payment_desc') }}</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>{{ __('home.best_price') }}</h4>
						<p>{{ __('home.guaranteed_price') }}</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Services Area -->

	<!-- Start Shop Newsletter  -->
	<section class="shop-newsletter section">
		<div class="container">
			<div class="inner-top">
				<div class="row">
					<div class="col-lg-8 offset-lg-2 col-12">
						<!-- Start Newsletter Inner -->
						<div class="inner">
							<h4>{{ __('home.newsletter') }}</h4>
							<p>{{ __('home.newsletter_desc') }}</p>
							<form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
								<input name="EMAIL" placeholder="{{ __('home.email_placeholder') }}" required=""
									type="email">
								<button class="btn">{{ __('home.subscribe') }}</button>
							</form>
						</div>
						<!-- End Newsletter Inner -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->

	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="ti-close"
							aria-hidden="true"></span></button>
				</div>
				<div class="modal-body">
					<div class="row no-gutters">
						<div class="col-lg-6 offset-lg-3 col-12">
							<h4
								style="margin-top:100px;font-size:14px; font-weight:500; color:#F7941D; display:block; margin-bottom:5px;">
								Eshop Free Lite</h4>
							<h3 style="font-size:30px;color:#333;">Currently You are using free lite Version of Eshop.<h3>
									<p style="display:block; margin-top:20px; color:#888; font-size:14px; font-weight:400;">
										Please, purchase full version of the template to get all pages, features and
										commercial license</p>
									<div class="button" style="margin-top:30px;">
										<a href="https://wpthemesgrid.com/downloads/eshop-ecommerce-html5-template/"
											target="_blank" class="btn" style="color:#fff;">Buy Now!</a>
									</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal end -->


@endsection