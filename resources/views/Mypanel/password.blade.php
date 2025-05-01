@extends('../Frontend.Layout.master')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumbbg">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <nav class="breadcrumb bg-transparent">
                        <a class="breadcrumb-item" href="#">Home <i class="fa fa-angle-right"></i></a>
                        <a class="breadcrumb-item" href="#">Shop <i class="fa fa-angle-right"></i></a>
                        <span class="breadcrumb-title">Cart</span>
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
                @include('Mypanel.verification')
                <div class="row">

                    <div class="col-md-3">
                        @include('Mypanel.sidebar')
                    </div>
                    <div class="col-md-9">
                        <div class="form-area">
                            <div class="form-area-head">
                                <h5>Password Change</h5>
                            </div>
                            {{--                            <div class="add-btn-area">--}}
                            {{--                                <a href="#">Add new shipping address</a>--}}
                            {{--                            </div>--}}
                            <div class="anather">
                                {!! Form::open(['method'=>'POST','route'=>'mypanel.password.store','class'=>'form-horizontal']) !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Old Password', ['class' => 'col-form-label']) !!}
                                            {!! Form::text('old_password', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('name', 'New Password', ['class' => 'col-form-label']) !!}
                                            {!! Form::text('new_password', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Confirm Password', ['class' => 'col-form-label']) !!}
                                            {!! Form::text('confirm_password', null, ['class'=>'form-control','id'=>'receiver']) !!}
                                        </div>
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