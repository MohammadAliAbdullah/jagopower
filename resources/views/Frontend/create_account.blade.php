@extends('Frontend.Layout.master')

@section('content')
	<!-- Breadcrumb Start -->
	<div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Shop <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Sign In</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
	<!-- Breadcrumb End -->
	<!-- register part start-->
	<div class="content-section registerbox section-padding">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="bradgam">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="offset-md-2 col-md-8">
					<div class="newregisterform">
						<div class="row">
							<div class="col-md-7">
								<div class="form-group">
									<label for="">Email Address*</label>
									<input type="email" class="form-control" placeholder="Please Enter Your Email">
								</div>
								<div class="form-group">
									<label for="">Full Name*</label>
									<input type="text" class="form-control" placeholder="Please Enter Your Name">
								</div>
								<div class="form-group">
									<label for="">Password*</label>
									<input type="password" class="form-control" placeholder="Minimum 6 characters or number">
								</div>
								<div class="form-group">
									<label for="">Birthday*</label>
									<input type="text" class="form-control" id="datepick" placeholder="Date of Birth">
								</div>
							</div>
							<div class="col-md-5">

								<div class="form-group form-check">
									<input type="checkbox" class="form-check-input" id="exampleCheck1">
									<label class="form-check-label" for="exampleCheck1">I want to receive exclusive offers and promotions.</label>
								</div>
								<div class="form-group">
									<button type="submit">SIGN UP</button>
								</div>
								<div class="form-group">
									<label for="">Or, sign up with</label>
									<a href="#">Sign up with Mobile</a>
								</div>
								<div class="form-group">
									<div class="social-login">
										<a href="#" class="fb"> Facebook</a>
										<a href="#" class="go"> Gmail</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- register part end -->
@endsection
@section('style')
	<link href="{{ asset('public/asset') }}/css/reg.css" rel="stylesheet">
@endsection