@extends('Frontend.Layout.master')
	@section('meta_title', $seo->meta_title)
	@section('meta_keywords', $seo->meta_keyword)
	@section('meta_description', $seo->meta_description)
@section('content')
	<!-- Carousel Start -->
<section class="slidebg">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 p-0">
				<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" data-interval="3000">
					<div class="carousel-inner">
						@php
							$i=1;
						@endphp
						@foreach($slides as $slide)
							@if($i==1)
							<div class="carousel-item active">
							@else
							<div class="carousel-item">
							@endif
								<img src="{{ asset('public') }}/images/slide/{{ $slide->images }}" class="d-block w-100" alt="banner1">
							</div>
							@php
								$i++;
							@endphp
						@endforeach
					</div>
					<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
	<section class="banartopbg">
		<!-- Shop ... Decorative ..... -->
		<div class="container">
			<h3 class="text-center text-dark">Shope Decorative Designer Fans, Light, Home Decor</h3>
			<hr class="hr-line-dashed-2 bg-danger w-10" style="height: 2px;">
			<div class="row">
				<!-- product category -->
				@foreach($categories as $category)
					<div class="col-md-4">
						<a href="{{ url('category') }}/{{ $category->slug }}">
							<div class="card">
								<img class="card-img-top lazyload" data-src="{{ asset('public') }}/images/category/{{ $category->images }}" alt="{{ $category->title }}">
								<h4 class="card-title text-center"> {{ $category->title }}</h4>
							</div>
						</a>
					</div>
				@endforeach
			</div>
		</div>
		<!-- Featured End -->
	</section>

	<!-- Offer 3 Picture box Start -->
<section class="banarbg">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="product-offer mb-30 banar1">
					<img class="img-fluid lazyload " data-src="{{ asset('public/images/banners') }}/{{ $home1->images ?? 'N/A' }}" alt="">
					<div class="offer-text">
						<h6 class="text-white text-uppercase">Save 20%</h6>
						<h3 class="text-white mb-3">Special Offer</h3>
						<a href="{{ $home1->url ?? 'N/A' }}" class="btn btn-primary">Shop Now</a>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="product-offer mb-30 banar2">
					<img class="img-fluid lazyload " data-src="{{ asset('public/images/banners') }}/{{ $home2->images ?? 'N/A' }}" alt="">
					<div class="offer-text">
						<h6 class="text-white text-uppercase">Save 20%</h6>
						<h3 class="text-white mb-3">Special Offer</h3>
						<a href="{{ $home2->url ?? 'N/A' }}" class="btn btn-primary">Shop Now</a>
					</div>
				</div>
				<!-- image-3 -->
				<div class="product-offer mb-30 banar3">
					<img class="img-fluid lazyload " data-src="{{ asset('public/images/banners') }}/{{ $home3->images ?? 'N/A' }}" alt="">
					<div class="offer-text">
						<h6 class="text-white text-uppercase">Save 20%</h6>
						<h3 class="text-white mb-3">Special Offer</h3>
						<a href="{{ $home3->url ?? 'N/A' }}" class="btn btn-primary">Shop Now</a>
					</div>
				</div>

			</div>
		</div>
	</div>
	<!-- Offer End -->
</section>

	<!-- Products Start -->
	<section class="productbg">
		<div class="container">
			<!--  <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2> -->
			@foreach($categories as $categoriey)
			<div class="productsbg">
				<div class="row">
					<div class="col-md-3">
						<div class="product-item bg-light mb-4">
							<div class="product-img position-relative overflow-hidden">
								<img class="img-fluid lazyload  w-100" data-src="{{ asset('public') }}/images/category/{{ $categoriey->banner }}" alt="{{ $categoriey->title }}">
								<div class="cathome">
									<a href="#">{{ $categoriey->title }}</a>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="row">
							@php
							$products=\App\Models\Product::orderBy('id','ASC')->where('category_id',$categoriey->id)->where('featured','Yes')->limit(4)->get();
							@endphp
							@foreach($products as $product)
							<div class="col-lg-3 col-md-3 col-6">
								@include('Frontend.include.product')
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</section>
	<!-- Products End -->

	<!-- SHOP BY ROOM Start -->
	<section class="shoproom">
		<div class="container">
			<div class="row">
				<h2 class="section-title">Shop by Room</h2>
				<div class="shopbg">
					<ul>
						@foreach($spacials as $spacial)
						<li>
							<a href="">{{ $spacial->title ?? 'N/A' }}</a>
						</li>
						@endforeach
					</ul>

				</div>
			</div>
			<div class="row">
			@foreach($spproducts as $product)
				<div class="col-lg-2 col-md-2 col-6">
					@include('Frontend.include.product')
				</div>
				@endforeach
			</div>
		</div>
	</section>
	<!-- SHOP BY ROOM End -->

	<!-- Recent-Post start -->
	<section class="recnetpost">
		<div class="container">
			<h2>Recent Post</h2>
			<div class="row">
				@foreach($blogs as $blog)
				<div class="col-lg-4 col-md-4 col-sm-6">
					<a href="{{ url('blogs') }}/{{ $blog->slug }}">
						<div class="card">
							<img class="card-img-top lazyload" data-src="{{ asset('public/images/blogs') }}/{{ $blog->thumb }}" alt="{{ $blog->title ?? 'N/A' }}">
							<div class="card-body">
								<p class="card-text">{!! Str::limit($blog->title, 80, ' ...') !!}</p>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
	</section>


	<!-- Recent-Post End -->
@endsection