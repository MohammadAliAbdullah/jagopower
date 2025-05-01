@extends('Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Registration <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Registration</span>
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
                        @include('include.message')
                        <div class="row">
                            <div class="col-md-7">
                                <form method="post" action="{{ route('mypanel.register_user') }}">
                                    @csrf
                                    <div class="form-group">
                                        {{--                                        <label for="">Full Name*</label> --}}
                                        <input type="text" class="form-control" name="name" required
                                            placeholder="Please Enter Your Name">
                                    </div>
                                    <div class="form-group">
                                        {{--                                        <label for="">Phone Number*</label> --}}
                                        <input type="number" class="form-control" name="phone" required
                                            placeholder="Please Enter Your Phone">
                                    </div>
                                    <div class="form-group">
                                        {{--                                        <label for="">Email Address*</label> --}}
                                        <input type="email" class="form-control" name="email" required
                                            placeholder="Please Enter Your Email">
                                    </div>
                                    <div class="form-group">
                                        {{--                                        <label for="">Password*</label> --}}
                                        <input type="password" name="password" required class="form-control"
                                            placeholder="Please Enter Your Password">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="rememberme" class="form-check-input" id="exampleCheck1"
                                            checked>
                                        <label class="form-check-label" for="exampleCheck1">I agree to Femina Lightings Ltd
                                            <a href="">Terms of Use</a> and <a href="">Privacy
                                                Policy</a></label>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit">Registration</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-5">
                                {{--                                <div class="form-group"> --}}
                                {{--                                    <a href="#" class="btn btn-success text-white"><i class="fas fa-phone-alt text-white"></i> Login with Mobile</a> --}}
                                {{--                                </div> --}}
                                <label class="pt-5">Or, Login your account</label>
                                <div class="form-group">
                                    <div class="social-login">
                                        {{--                                        <a href="#" class="phone"><i class="fas fa-phone-alt text-white"></i>Sign up with Mobile</a> --}}
                                        <a href="{{ route('login') }}" class="email"><i
                                                class="fas fa-envelope text-white"></i>Login with Email</a>
                                        {{--                                        <a href="#" class="fb"><i class="fab fa-facebook-f text-white"></i> Facebook</a> --}}
                                        {{--                                        <a href="#" class="go"><i class="fab fa-google  text-white"></i> Google</a> --}}
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
