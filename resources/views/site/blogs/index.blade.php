@extends('site.layouts.app')

@section('title','blogs Page')
@section('content')

		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('index')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="{{route('site.blogs.index')}}">Blogs & Posts</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
			
		<!-- Start Blog Single -->
		<section class="blog-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-12">
						<div class="blog-single-main">
							<div class="row">
								<div class="col-12">
									<div class="image">
										<img src="https://placehold.co/950x460" alt="#">
									</div>
                                    @foreach($blogs as $blog)
									<div class="blog-detail">
                                        <a href="{{ route('site.blogs.show', $blog->id) }}"class="blog-title">{{ $blog->title }}</a>
										<div class="blog-meta">
											<span class="author"><a href="#"><i class="fa fa-user"></i>By {{$blog->user->name}}</a><a href="#">
                                                <i class="fa fa-calendar"></i>{{ $blog->created_at->format('F j, Y') }}</a>
                                                <a href="#"><i class="fa fa-comments"></i>Comment (15)</a>
                                            </span>
										</div>
										<div class="content">
											<p>{{ $blog->description }}</p>
											<blockquote> <i class="fa fa-quote-left"></i> {{ $blog->quote }}</blockquote>
											<p>{{ $blog->description }}</p>
										</div>
									</div>  
                                    @endforeach
									<div class="share-social">
										<div class="row">
											<div class="col-12">
												<div class="content-tags">
													<h4>Tags:</h4>
													<ul class="tag-inner">
														<li><a href="#">Glass</a></li>
														<li><a href="#">Pant</a></li>
														<li><a href="#">t-shirt</a></li>
														<li><a href="#">swater</a></li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>

							</div>
						</div>
					</div>

                <!-- Single side bar Slugs & Tags - category -search-->
					<div class="col-lg-4 col-12">
						<div class="main-sidebar">
							<!-- Single side Widget Search Here... -->
							<div class="single-widget search">
								<div class="form">
									<input type="email" placeholder="Search Here...">
									<a class="button" href="#"><i class="fa fa-search"></i></a>
								</div>
							</div>
							<!--/ End Single side Widget Search Here... -->
							<!-- Single side Widget Category -->
							<div class="single-widget category">
								<h3 class="title">Blog Categories</h3>
								<ul class="categor-list">
									@foreach ($categories as $category)
									<li><a href="{{ route('site.blogs.index', $category->slug) }}">{{ $category->name }}</a></li>
									@endforeach
								</ul>
							</div>
							<!--/ End Single side Widget Category -->

							<!-- Single side Widget Recent Post -->
							<div class="single-widget recent-post">
								<h3 class="title">Recent blogs</h3>
								<!-- Single Post -->
								<div class="single-post">
									<div class="image">
										<img src="https://placehold.co/100x100" alt="#">
									</div>
                                    @foreach($blogs as $blog)
									<div class="content">
										<h5><a href="#">{{ $blog->title }}</a></h5>
										<ul class="comment">
											<li><i class="fa fa-calendar" aria-hidden="true"></i>{{ $blog->created_at->format('F j, Y') }}</li>
										</ul>
									</div>
                                    @endforeach
								</div>
								<!-- End Single Post -->
							</div>
							<!--/ End Single side Widget -->

                            <!-- Single side Widget -->
							<div class="single-widget side-tags">
								<h3 class="title">Slugs & Tags </h3>
								<ul class="tag">
									@foreach ($blogs as $blog)
									<li><a href="#">{{ $blog->slug }}</a></li>
									@endforeach
								</ul>
							</div>
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							<div class="single-widget newsletter">
								<h3 class="title">Newslatter</h3>
								<div class="letter-inner">
									<h4>Subscribe & get news <br> latest updates.</h4>
									<div class="form-inner">
										<input type="email" placeholder="Enter your email">
										<a href="#">Submit</a>
									</div>
								</div>
							</div>
							<!--/ End Single Widget -->
						</div>
					</div>
                <!-- Single side bar Slugs & Tags - category -search-->
				</div>
			</div>
		</section>
		<!--/ End Blog Single -->
			



@endsection

    