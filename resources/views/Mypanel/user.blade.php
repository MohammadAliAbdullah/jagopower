@extends('../Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">My Panel <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Account Information</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- main-section-area-start -->
    <section>

        <div class="main-section-area">
            <div class="container">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('Mypanel.message')
                        </div>
                    </div>
                </div>
            @if($profile->status=='Active')
                <div class="row">
                    <div class="col-md-12">
                        <div class="hello-omor">
                            <p>Hello ! <b>{{ $profile->name }}</b> Your account not verified, Please verify your account <a href="">Click to Verify</a> .</p>
                        </div>
                    </div>
                </div>
            @endif
                <!-- Terms-Condition-area-start -->

                <!-- <div class="faq-area">
                    <h3>Frequently Asked Questions</h3>

                    <p>Last Updated on Jun 02, 2017</p>
                </div> -->

                <!-- Terms-Condition-area-end -->

                <div class="row">

                    <div class="col-md-3">
                        @include('Mypanel.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="form-area">
                            <div class="form-area-head">
                                <h5>Account Information</h5>
                            </div>
{{--                            <div class="add-btn-area">--}}
{{--                                <a href="#">Add new shipping address</a>--}}
{{--                            </div>--}}
                            <div class="anather">
                                {!! Form::model($profile, ['method'=>'PATCH','route'=> ['mypanel.profile.update', $profile->id],'class'=>'form-horizontal']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                                                {!! Form::text('name', null, ['class'=>'form-control','id'=>'receiver', 'readonly']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('name', 'Email', ['class' => 'col-sm-2 col-form-label']) !!}
                                                {!! Form::email('email', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {!! Form::label('name', 'Phone', ['class' => 'col-sm-2 col-form-label']) !!}
                                                {!! Form::email('phone', null, ['class'=>'form-control','id'=>'receiver', 'readonly']) !!}
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            {!! Form::label('name', 'Address', ['class' => 'col-sm-2 col-form-label']) !!}
                                            {!! Form::textarea('address', null, ['class'=>'form-control','id'=>'receiver', 'rows'=>2]) !!}
                                        </div>

                                    </div>

{{--                                    <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">--}}
{{--                                    <label for="vehicle1"> Set As Default</label>--}}


                                <div class="d-flex justify-content-start mt-3">
                                    <div class="save">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                    <div class="save">
                                        <button  onclick="window.history.back()" class="btn btn-default float-right">Cancel</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                </div>




            </div>
        </div>

    </section>
@endsection
@section('style')
    <link href="{{ asset('public/asset/css') }}/order.css" rel="stylesheet" type="text/css">
@endsection