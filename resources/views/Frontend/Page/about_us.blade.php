@extends('../Frontend.Layout.master')

@section('content')
	<!-- Breadcrumb Start -->
	<div class="breadcrumbbg" style="background: linear-gradient(
      rgb(8 8 8 / 56%), rgb(40 40 40 / 51%)
    ), url({{ asset('public/asset') }}/img/bg.jpg);">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<nav class="breadcrumb bg-transparent">
						<a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
						<a class="breadcrumb-item" href="#">Page <i class="fa fa-angle-right"></i></a>
						<span class="breadcrumb-item">About Us</span>
					</nav>
					<h1 class="text-center">About Us</h1>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb End -->

		<div class="main-section-area">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="bg-white p-5">
							<div class="row">
								<div class="col-md-12">
									<div class="about">
										<p>
											{!! $about->content !!}
										</p>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4">
									<div class="mission">
										<h3>Mission</h3>
										<p>
											{!! $about->mission !!}
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mission">
										<h3>Vision</h3>
										<p>
											{!! $about->vision !!}
										</p>
									</div>
								</div>
								<div class="col-md-4">
									<div class="mission">
										<h3>Establishment</h3>
										<p>
											{!! $about->establistmet !!}
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>
		</div>

	</section>

	<!-- main-section-area-start -->

@endsection