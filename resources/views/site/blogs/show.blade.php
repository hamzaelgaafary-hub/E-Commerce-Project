@extends('site.layouts.app')

@section('title','Single Blog')
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
                                <li class="active"><a href="#">{{$blogs->title}}</a></li>
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
                                @foreach($blogs as $blog)
								<div class="col-12">
									<div class="image">
										<img src="https://placehold.co/950x460" alt="#">
									</div>
									<div class="blog-detail">
										<h2 class="blog-title">{{$blogs->title}}</h2>
										<div class="blog-meta">
											<span class="author"><a href="#"><i class="fa fa-user"></i>By Admin</a><a href="#"><i class="fa fa-calendar"></i>Dec 24, 2018</a><a href="#"><i class="fa fa-comments"></i>Comment (15)</a></span>
										</div>
										<div class="content">
											<blockquote> <i class="fa fa-quote-left"></i> {{$blogs->quote}}</blockquote>
											<p>{{$blogs->description}}</p>
										</div>
									</div>
									<div class="share-social">
										<div class="row">
											<div class="col-12">
												<div class="content-tags">
													<h4>Tags:</h4>
													<ul class="tag-inner">
														<li><a href="#">{{$blogs->category->slug}}</a></li>
													</ul>
												</div>
											</div>
										</div>
                                @endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Blog Single -->

    <!-- Comments section  under coding yet -->

        <div class="col-12">
            <div class="comments">
                <h3 class="comment-title">Comments (3)</h3>

                <!-- Single Comment -->
                <div class="single-comment">
                    <img src="https://placehold.co/80x80" alt="#">
                    <div class="content">
                        <h4>{{$blogs->user->name}} <span>{{ $blogs->created_at->format('F j, Y') }}</span></h4>
                        <p>{{ $blogs->quote }}</p>
                        <div class="button">
                            <a href="#" class="btn"><i class="fa fa-reply" aria-hidden="true"></i>Reply</a>
                        </div>
                    </div>
                </div>
                <!-- End Single Comment -->
            </div>									
        </div>		
        <!-- Form to Leave a Comment -->								
        <div class="col-12">			
            <div class="reply">
                <div class="reply-head">
                    <h2 class="reply-title">Leave a Comment</h2>
                    <!-- Comment Form -->
                    <form class="form" action="#">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Your Name<span>*</span></label>
                                    <input type="text" name="name" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Your Email<span>*</span></label>
                                    <input type="email" name="email" placeholder="" required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Message<span>*</span></label>
                                    <textarea name="message" placeholder=""></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group button">
                                    <button type="submit" class="btn">Post comment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- End Comment Form -->
                </div>
            </div>			
        </div>
        <!-- End Form to Leave a Comment -->	
        
    <!--End Comments section -->

@endsection