<!-- Vendor Start -->
<section class="vendorlogo">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    @foreach (brandh() as $brand)
                        <div class="bg-light p-4">
                            {{-- a link --}}
                            <a href="{{ url('shops/ceiling-fans-1') }}/{{ $brand->slug }}">
                                <img src="{{ asset('public/images/brand') }}/{{ $brand->images }}"
                                    alt="{{ $brand->title }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Vendor End -->
<!-- Footer Start -->
<section class="footertop">
    <div class="container-fluid">
        <!-- footer top -->
        <div class="row">
            <!-- sing up area -->
            <div class="col-md-6 mb-1">
                <h5 class="text-white">Subscribe our Newsletter to get updated new product & offer </h5>
                {!! Form::open(['method' => 'POST', 'route' => 'newsletter.store']) !!}
                <div class="input-group">
                    <input type="text" name="email" class="form-control" placeholder="Your Email Address">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary subscribe text-white">Subscribe</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="col-md-2">
                <!-- empty -->
            </div>
            <!-- social area  -->
            <div class="col-md-4">
                <h6 class="text-secondary text-uppercase mb-3">Follow Us</h6>
                <div class="d-flex social">
                    <a href="{{ socialh()->facebook ?? '#' }}" target="_blank">
                        <i class="fab fa-facebook-f text-white"></i>
                    </a>
                    <a href="{{ socialh()->twitter ?? '#' }}" target="_blank">
                        <i class="fab fa-twitter text-white"></i>
                    </a>
                    <a href="{{ socialh()->linkedin ?? '#' }}" target="_blank">
                        <i class="fab fa-linkedin-in text-white"></i>
                    </a>
                    <a href="{{ socialh()->instagram ?? '#' }}" target="_blank">
                        <i class="fab fa-instagram text-white"></i>
                    </a>
                    <a href="{{ socialh()->youtube ?? '#' }}" target="_blank">
                        <i class="fab fa-youtube text-white"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="footerbg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <img class="img-fluid" src="{{ asset('public/images') }}/sslcommerz.png" />
            </div>
        </div>
        <!-- footer menus -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row">
                    <!-- ABOUT -->
                    <div class="col-md-3">
                        <div class="footerpart">
                            <h3>About Us</h3>
                            <ul>
                                <li>
                                    <a href="{{ route('about.us') }}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{ url('faq') }}">FAQ</a>
                                </li>
                                <li>
                                    <a href="{{ route('blog.index') }}">Blog</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact.us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- INFORMATION -->
                    <div class="col-md-3">
                        <div class="footerpart">
                            <h3>Information</h3>
                            <ul>
                                <li>
                                    <a href="{{ url('page') }}/terms-conditions	">Terms & Conditions</a>
                                </li>
                                <li>
                                    <a href="{{ url('page') }}/payment-options	">Payment options</a>
                                </li>
                                <li>
                                    <a href="{{ url('page') }}/refund-return-policy	">Refund & Return Policy</a>
                                </li>
                                <li>
                                    <a href="{{ url('page') }}/terms-of-services">Termes of Service</a>
                                </li>
                                <li>
                                    <a href="{{ url('page') }}/privacy-policy">Pivacy Policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- POPULER brands -->
                    <div class="col-md-2">
                        <div class="footerpart">
                            <h3>Top Brand</h3>
                            <ul>
                                @foreach (topbrand() as $topbrand)
                                    <li>
                                        <a  href="{{ url('brands') }}/{{ $topbrand->slug }}">{{ $topbrand->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footeraddress">
                            <h3>Contact Us</h3>
                            <ul>
                                <li>
                                    Femina Lightings Ltd
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i> {{ contacth()->phone }}
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i> {{ contacth()->email }}
                                </li>
                                <li>
                                    <i class="fas fa-map-marker-alt"></i> {{ contacth()->address }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- copyright area  -->
<section class="copyrightbg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="copyleft">
                    <p>
                        Copyright 2013-<?= date('Y') ?> © All Right Reserved. Femina Lightings Pvt Ltd
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="copyright">
                    {{-- <p>
						Website Design and Development by <a class="text-primary" href="https://my-softit.com" target="_blank">MY SOFT IT</a>
					</p> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Footer End -->
